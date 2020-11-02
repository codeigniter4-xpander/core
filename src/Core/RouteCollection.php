<?php namespace CI4Xpander\Core;

class RouteCollection extends \CodeIgniter\Router\RouteCollection {
    protected $groupNamespace = '';

    public function getGroupNamespace() {
        return $this->groupNamespace;
    }

    public function getGroupSet() {
        return $this->group;
    }

    public function setGroupSet($group = '') {
        $this->group = $group;
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
            $this->groupNamespace = isset($this->currentOptions['namespace']) ? ($this->currentOptions['namespace'] . '\\' ?? $this->getDefaultNamespace()) : $this->getDefaultNamespace();
		}

		if (is_callable($callback))
		{
			$callback($this);
		}

		$this->group          = $oldGroup;
		$this->currentOptions = $oldOptions;
    }
}
