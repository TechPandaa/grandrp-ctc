<?php

class Language {

	var $language = 'de';
	var $language_path = 'languages/';
	var $module = array();

	function set_language($to) {

		$filepath = "languages/";
		$langs = array();

		if($dh = opendir($filepath)) {
			while($file = mb_substr(readdir($dh), 0, 2)) {
				if($file != "." and $file!=".." and is_dir($filepath.$file)) {
					$langs[] = $file;
				}
			}
			closedir($dh);
		}

		if(in_array($to, $langs)){
			if(is_dir($this->language_path.$to)) {
				$this->language = $to;
				return true;
			}
			else return false;
		}
		else return false;
	}

	function read_module($module, $add=false) {

		global $default_language;

				$langFolder = $this->language_path;
				$folderPath = '%s%s/%s.php';

		$languageFallbackTable = array($this->language, $default_language, 'de');
		$module = str_replace(array('\\', '/', '.'), '', $module);
		foreach ($languageFallbackTable as $folder) {
				$path = sprintf($folderPath, $langFolder, $folder, $module);
				if (file_exists($path)) {
						$module_file = $path;
						break;
				}
		}
		if (!isset($module_file)) {
				return false;
		}
		if (isset($module_file)) {
				include($module_file);
				if (!$add) {
						$this->module = array();
				}
				foreach ($language_array as $key => $val) {
						$this->module[ $key ] = $val;
				}
		}
		return true;
	}
	function replace($template) {

		foreach ($this->module as $key => $val) {
				$template = str_replace('%' . $key . '%', $val, $template);
		}
		return $template;

	}
}

?>