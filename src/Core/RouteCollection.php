<?php namespace CI4Xpander\Core;

use CodeIgniter\Router\RouteCollectionInterface;
use CodeIgniter\Autoloader\FileLocator;

class RouteCollection extends \CodeIgniter\Router\RouteCollection {
	public function __construct(FileLocator $locator, $moduleConfig)
	{
		helper('array');

		parent::__construct($locator, $moduleConfig);
		$this->currentOptions['versionNamespace'] = $this->getDefaultNamespace();
		$this->currentOptions['versionGroup'] = $this->group;
	}

    public function group(string $name, ...$params)
	{
		$oldGroup   = $this->group;
		$oldOptions = $this->currentOptions;

		$this->group = ltrim($oldGroup . '/' . $name, '/');

		$callback = array_pop($params);

		if ($params && is_array($params[0]))
		{
			$this->currentOptions = array_shift($params);
			$withVersion = $this->currentOptions['withVersion'] ?? false;

            if (isset($this->currentOptions['namespace'])) {
                if (substr($this->currentOptions['namespace'], 0, strlen('\\')) === '\\') {
                    $this->setDefaultNamespace(trim($this->currentOptions['namespace'], '\\'));
                } else {
                    if (isset($oldOptions['namespace'])) {
                        $this->currentOptions['namespace'] = $oldOptions['namespace'] . '\\' . $this->currentOptions['namespace'];
                    } else {
                        $this->currentOptions['namespace'] = $this->getDefaultNamespace() . $this->currentOptions['namespace'];
					}
					
					if ($withVersion) {
						$this->currentOptions['versionNamespace'] = $this->currentOptions['namespace'];
						$this->currentOptions['versionGroup'] = $this->group;
					} else {
						if (isset($oldOptions['withVersion'])) {
							if ($oldOptions['withVersion']) {
								$this->currentOptions['versionNamespace'] = $oldOptions['versionNamespace'];
								$this->currentOptions['versionGroup'] = $oldOptions['versionGroup'];
							}
							$this->currentOptions['withVersion'] = $oldOptions['withVersion'];
						}
					}
                }
			}
		}

		if (is_callable($callback))
		{
			$callback($this);
		}

		$this->group          = $oldGroup;
		$this->currentOptions = $oldOptions;
    }

    public function getRoutes($verb = null): array
	{
		if (empty($verb))
		{
			$verb = $this->getHTTPVerb();
		}

		$this->discoverRoutes();

		$routes = [];

		if (isset($this->routes[$verb]))
		{
			if (isset($this->routes['*']))
			{
				$extraRules = array_diff_key($this->routes['*'], $this->routes[$verb]);
				$collection = array_merge($this->routes[$verb], $extraRules);
			}
			foreach ($collection as $r)
			{
                $key          = key($r['route']);
				$routes[$key] = is_callable($r['route'][$key]) ? $r['route'][$key] : str_replace('\::', '::', $r['route'][$key]);
			}
		}

		return $routes;
    }

    public function setDefaultNamespace(string $value): RouteCollectionInterface
	{
		$this->defaultNamespace = filter_var($value, FILTER_SANITIZE_STRING);
		$this->defaultNamespace = rtrim($this->defaultNamespace, '\\') . '\\';

        if (isset($this->currentOptions['namespace'])) {
            $this->currentOptions['namespace'] = rtrim($this->defaultNamespace, '\\');
        }

		if (isset($this->currentOptions['withVersion'])) {
			if ($this->currentOptions['withVersion']) {
				$this->currentOptions['versionNamespace'] = rtrim($this->defaultNamespace, '\\');
				// $this->currentOptions['versionGroup'] = $this->group;
			}
		}

		return $this;
	}

	protected function generateVersioning(string $verb, string $from, $to, array $options = null)
	{
		$versions = [];
		if (isset($options['version'])) {
			$versions = array_merge($versions, $options['version']);
		}
		$versions[] = '';

		$originalVersionGroup = $this->currentOptions['versionGroup'];
		$originalNamesapce = $this->currentOptions['namespace'];
		$originalGroup = $this->group;
		$originalFrom = $from;
		$versionsMap = [];
		foreach ($versions as $version) {
			$findVersion = null;
			if ($version == '') {
				if (count($versionsMap) > 0) {
					$findVersion = $versionsMap[array_keys($versionsMap)[0]];
                    $findVersion = $findVersion[array_keys($findVersion)[0]];
                    $findVersion = $findVersion[array_keys($findVersion)[0]];
				}

				$from = $originalFrom;
			} else {
				$exGroup = explode('/', $this->currentOptions['versionGroup']);
				array_splice($exGroup, 1, 0, $version);
				$versionUrl = implode('/', $exGroup);

				$this->group = $versionUrl;

				if ($from == '/') {
					$from = trim(str_replace($originalVersionGroup, '', $originalGroup), '/');
				}

				$exVersion = explode('.', $version);

				if (count($exVersion) == 3) {
					$versionsMap = array_merge_recursive($versionsMap, [
						'M' . strval($exVersion[0]) => [
							'm' . strval($exVersion[1]) => [
								'p' . strval($exVersion[2]) => $version
							]
						]
					]);

					$findVersion = $version;
				} elseif (count($exVersion) == 2) {
					$versionsMap = array_merge_recursive($versionsMap, [
						'M' . strval($exVersion[0]) => [
							'm' . strval($exVersion[1]) => []
						]
					]);

					$findVersion = dot_array_search("M{$exVersion[0]}.m{$exVersion[1]}", $versionsMap);
					$findVersion = array_shift($findVersion);
				} elseif (count($exVersion) == 1) {
					$versionsMap = array_merge_recursive($versionsMap, [
						'M' . strval($exVersion[0]) => []
					]);

					$findVersion = dot_array_search("M{$exVersion[0]}", $versionsMap);
					$findVersion = array_shift($findVersion);
					$findVersion = array_shift($findVersion);
				}
			}

			if (!is_null($findVersion)) {
				$this->currentOptions['namespace'] = $this->currentOptions['versionNamespace'] . '\\' . 'V_' . str_replace('.', '_', $findVersion) . str_replace($this->currentOptions['versionNamespace'], '', $originalNamesapce);
			}

			// d($this->currentOptions);

			$this->create($verb, $from, $to, $options);

			$this->currentOptions['versionGroup'] = $originalVersionGroup;
			$this->group = $originalGroup;
			$this->currentOptions['namespace'] = $originalNamesapce;
		}
	}

	public function get(string $from, $to, array $options = null): RouteCollectionInterface
	{
		$withVersion = $options['withVersion'] ?? ($this->currentOptions['withVersion'] ?? false);
		if ($withVersion) {
			$this->generateVersioning('get', $from, $to, $options);
		} else {
			$this->create('get', $from, $to, $options);
		}

		return $this;
	}
}
