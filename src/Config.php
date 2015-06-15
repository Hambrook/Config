<?php

namespace Hambrook;

/**
 * CONFIG
 *
 * Easy-to-work-with config object
 *
 * @version  1.0.0
 * @author Rick Hambrook <rick@rickhambrook.com>
 */
class Config extends Nest {
	private $file     = false;
	public  $autosave = false;

	/**
	 * __CONSTRUCT
	 *
	 * @param  string  $file      Path to the json save file
	 * @param  bool    $autosave  Whether to auto-save on set or not
	 */
	public function __construct($file, $autosave=false, $magicSeparator="__") {
		$this->file = $file;
		$this->autosave = $autosave;
		parent::__construct([], $magicSeparator);
		$this->loadJSON(@file_get_contents($this->file));
		register_shutdown_function([$this, "save"]);
	}

	/**
	 * SAVE
	 *
	 * Save the config to the specified file, recursively making directories as needed
	 *
	 * @return  $this
	 */
	public function save() {
		$segments = explode("/", $this->file);
		array_pop($segments);
		$currPath = "";
		foreach ($segments as $s) {
			$currPath .= $s."/";
			if (!is_dir($currPath)) {
				if (!mkdir($currPath)) {
					return false;
				}
			}
		}
		file_put_contents($this->file, $this->toJSON());
		return $this;
	}

	/**
	 * SET
	 *
	 * Set a value then optionally save
	 *
	 * @param   string  $path   Path to save the value to
	 * @return  mixed   $value  Value to save
	 *
	 * @return  $this
	 */
	function set() {
		call_user_func_array("parent::set", func_get_args());
		if ($this->autosave) {
			$this->save();
		}
		return $this;
	}
}
