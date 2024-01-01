<?php
namespace IO4;
/**
* Please set your scope!!!
* See: https://github.com/frdlweb/webfat/blob/7b1fe168cc9328a65d66d5d147ffd39064e4cbf1/public/index.php#L4351
* recommended for production:
* putenv('IO4_WORKSPACE_SCOPE="@www@parent"');  
* recommended for global:
* putenv('IO4_WORKSPACE_SCOPE="@global"'); 
*/
 putenv('IO4_WORKSPACE_SCOPE="@www@parent"'); 
//putenv('IO4_WORKSPACE_SCOPE="@cwd"');
/** 
* Usage: 
require_once __DIR__.\DIRECTORY_SEPARATOR.'autoloader.php';
$webfatFile =__DIR__.\DIRECTORY_SEPARATOR.'webfat.php';
// OE e.g..: $webfatFile =getcwd().\DIRECTORY_SEPARATOR.'webfat.php';
$StubRunner = (new \IO4\Webfat)->getWebfat($webfatFile,
                                           true, //register autoloaders
                                           false //runAsIndex / run as "main app"
 );
*/

  function _installClass($class){
	  $plugin_root = __DIR__;
	  $p = explode('\\', $class);
	  $_f = implode(\DIRECTORY_SEPARATOR, $p);
	 $classFile = "{$plugin_root}/classes/{$_f}.php";

   if (!file_exists($classFile) || filemtime($classFile)<30*24*60*60) {
	// check if composer dependencies are distributed with the plugin
	 if(!is_dir(dirname($classFile))){
		 mkdir(dirname($classFile), 0755, true);
	 }
 	file_put_contents(
	  $classFile,	
	  file_get_contents('https://webfan.de/install/?source='.urlencode($class))	
	);
  }

     if ( !class_exists($class ) ) {
       require_once $classFile;
     }  
  }


 $plugin_root = __DIR__;
 $traitFile = "{$plugin_root}/classes/Webfan/Webfat/getWebfatTrait.php";

 if (!file_exists($traitFile) || filemtime($traitFile)<30*24*60*60) {
	// check if composer dependencies are distributed with the plugin
	 if(!is_dir(dirname($traitFile))){
		 mkdir(dirname($traitFile), 0755, true);
	 }
 	file_put_contents(
	  $traitFile,	
	  file_get_contents('https://webfan.de/install/?source=Webfan\Webfat\getWebfatTrait')	
	);
 }


 if ( !trait_exists( \Webfan\Webfat\getWebfatTrait::class ) ) {
     require_once  $traitFile;
 }

_installClass(\IO4\Webfat::class); 
