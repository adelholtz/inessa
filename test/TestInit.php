<?php
/**
 * @param $path
 * @param $fileName
 * @return bool
 */
function requireFile($path){
	$path = __DIR__."/../".$path;

	if (is_file($path) && is_readable($path)) {
		require_once $path;

		return true;
	}
	return false;
}

spl_autoload_register(function($class)
{ 
	$class = preg_replace("/Inessa\\\/","",$class);
	$path = preg_replace("/\\\/","/",$class);

	if(requireFile($path.".php")){
	  return;
	}

});
