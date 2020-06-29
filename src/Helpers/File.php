<?php namespace CI4Xpander\Helpers;

class File
{
	public $source;
	public $destination;

	public function __construct($source = null)
	{
		$this->source = $source;
	}

    public function copy($destination = null, $source = null)
    {
		if (is_null($source)) {
			$source = $this->source;
		}

		if (is_null($destination)) {
			$destination = $this->destination;
		}

		@mkdir($destination, 0755, true);

		$dir = opendir($source);

		while(($file = readdir($dir))) {
			if (($file != '.') && ($file != '..')) {
				if (is_dir($source . '/' . $file)) {
					$this->copy($destination . '/' . $file, $source . '/'. $file);
				} else {
					$copy = copy($source . '/' . $file, $destination . '/' . $file);
				}
			}
		}

		closedir($dir);
	}
	
	public function source($source)
	{
		$this->source = $source;
		return $this;
	}

	public function destination($destination)
	{
		$this->destination = $destination;
		return $this;
	}

	public static function get($source = null)
	{
		return new self($source);
	}
}