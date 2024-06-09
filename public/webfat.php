<?php /*<!DOCTYPE html>
<html class="no-js">
<head>
<style>
.ng-cloak, [ng-cloak], ng-cloak {display: none !important;}
</style>
</head>
<body class="ng-cloak">
<script>
window.addEventListener('load', function(){
       var markup = document.documentElement.innerHTML;
  //	var htmlNodes=document.querySelectorAll('html');
		document.write(`
<h1 class="error" style="color:red;">PHP is not available at ${location.host} ... ${location.pathname}</h1>
[<a href="https://webfan.de/apps/webmaster/">Goto Webfan Webmaster Installer Tools...</a>]
<br />
<h1 class="error" style="color:red;background:url(https://cdn.webfan.de/ajax-loader_2.gif) no-repeat;">Loading the Webfat HTML Workspace...</h1>		
`);
	 
setTimeout(()=>{
(async ()=>{
 var c = await fetch('https://cdn.webfan.de/~' 
			//  + self.origin.split(/\:\/\//).pop() 
			  +'.@@domain@@'
			  +'./run/web+fan:'+self.origin.split(/\:\/\//).pop()
			  + ':449'
			  +'/@webfan3/io4/index.html');
    document.open(  );	
    document.write( (await c.text()).replace(/(\@\@domain\@\@)/g, self.location.host) );	
    document.close(  );	
})(); 
},2000);
	});	
</script>
</body>
</html>
<!-- 
* This script can be used to generate "self-executing" .php Files.
* https://github.com/frdl/mime-stub
* Dowload an example implementation at https://webfan.de/install/
* https://raw.githubusercontent.com/frdlweb/webfat/main/public/index.php
** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** 
**
 * Copyright  (c) 2020, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
** includes edited version of:
*  https://github.com/Riverline/multipart-parser 
* 
* Class Part
* @package Riverline\MultiPartParser
* 
*  Copyright (c) 2015-2016 Romain Cambien
*  
*  Permission is hereby granted, free of charge, to any person obtaining a copy
*  of this software and associated documentation files (the "Software"),
*  to deal in the Software without restriction, including without limitation
*  the rights to use, copy, modify, merge, publish, distribute, sublicense,
*  and/or sell copies of the Software, and to permit persons to whom the Software
*  is furnished to do so, subject to the following conditions:
*  
*  The above copyright notice and this permission notice shall be included
*  in all copies or substantial portions of the Software.
*  
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
*  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
*  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
*  DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
*  ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
*  OTHER DEALINGS IN THE SOFTWARE.
* 
*  - edited by webfan.de
*/ 
namespace{
	
 (static function () : void {	
	if(defined('___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___'))return;
	$fileparts = explode('.', basename(__FILE__));
	define('___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___', !in_array(basename(__FILE__), [
		  'index.php',
		  'init.php',
		  'io4.php',
		  'in.php',
		  'out.php',
		  'console.php',
		  'progress.php',
		  'poll.php',
		  'webhook.php',
		  'cron.php',
		  'ajax.php',
		  'api.php',
		  'public.php',
		  'test.php',
		  'install.php',
		  'setup.php',
		  'info.php',
		  'webfan.php',
		  'remote.php',
		  'sw.js.php',
		  'service-worker.php',
		  __DIR__ === $_SERVER['DOCUMENT_ROOT'] ? 'endpoint.php' : basename(__DIR__).'.php',
		]) && !(
		       in_array($fileparts[0], [
				   'webfan',
				   'webfat',
				   'frdl',		
				   __DIR__ === $_SERVER['DOCUMENT_ROOT'] ? 'public' : basename(__DIR__),		
				   __DIR__ === $_SERVER['DOCUMENT_ROOT'] ? 'public-www' : basename(__DIR__).'-www',
			   ])
		  && (count($fileparts) > 2 && in_array($fileparts['test'===$fileparts[1]?2:1], [
				   'index',	
				   'endpoint',	
				   'server',	
				   'api',	
				   'install',
				   'uninstall',	
				   'setup',	
				   'update',	
				   'workspace',	
				   'remote-workspace',	
				   'test',	
			   ])
			  )
		)
		  );
 })();	
} 	

namespace{	
if ( !function_exists('sys_get_temp_dir')) {
  function sys_get_temp_dir() {
    if (!empty($_ENV['TMP'])) { return realpath($_ENV['TMP']); }
    if (!empty($_ENV['TMPDIR'])) { return realpath( $_ENV['TMPDIR']); }
    if (!empty($_ENV['TEMP'])) { return realpath( $_ENV['TEMP']); }
    $tempfile=tempnam(__FILE__,'');
    if (file_exists($tempfile)) {
      unlink($tempfile);
      return realpath(dirname($tempfile));
    }
    return null;
  }
} 	
} 

namespace{	
 if ( !function_exists('spl_object_id')) {
  function spl_object_id($object) {
     return spl_object_hash($object);
  }
 } 	
} 




namespace frdl\patch{
 if(!function_exists('\frdl\patch\scope')){
 function scope(?string $scope = null) : ?string {
	
$scope = \frdl\booting\once(function() use($scope) {
 $getRootDir;	
 $getRootDir = (function($path = null) use(&$getRootDir){
	if(null===$path){
		$path = $_SERVER['DOCUMENT_ROOT'];
	}

		
 if(''!==dirname($path) && '/'!==dirname($path) //&& @chmod(dirname($path), 0755) 
    &&  true===@is_writable(dirname($path)) && true===@is_readable(dirname($path))
    ){
 	return $getRootDir(dirname($path));
 }else{
 	return $path;
 }

 });		

$scope = call_user_func(function()use($getRootDir, $scope) {
	
$drush_server_home = (function() use($getRootDir, $scope) {
	
	if(function_exists('\posix_getpwuid') && function_exists('\posix_getui') ){		
		$user = \posix_getpwuid(\posix_getuid());		
		return $user['dir'];
	}
	
	

	
  // Cannot use $_SERVER superglobal since that's empty during UnitUnishTestCase
  // getenv('HOME') isn't set on Windows and generates a Notice.
  $home = getenv('HOME');
  if (!empty($home)) {
    // home should never end with a trailing slash.
    $home = rtrim($home, '/');
  }elseif (isset($_SERVER['HOME']) && !empty($_SERVER['HOME'])) {
    // home on windows
    $home = $_SERVER['HOME'];
    // If HOMEPATH is a root directory the path can end with a slash. Make sure
    // that doesn't happen.
    $home = rtrim($home, '\\/');
  }elseif (!empty($_SERVER['HOMEDRIVE']) && !empty($_SERVER['HOMEPATH'])) {
    // home on windows
    $home = $_SERVER['HOMEDRIVE'] . $_SERVER['HOMEPATH'];
    // If HOMEPATH is a root directory the path can end with a slash. Make sure
    // that doesn't happen.
    $home = rtrim($home, '\\/');
  }elseif (isset($_ENV['HOME']) && !empty($_ENV['HOME'])) {
    // home on windows
    $home = $_ENV['HOME'];
    // If HOMEPATH is a root directory the path can end with a slash. Make sure
    // that doesn't happen.
    $home = rtrim($home, '\\/');
  }
	
  return empty($home) ? $getRootDir($_SERVER['DOCUMENT_ROOT']) : $home;
});
	
$HOME_DEFAULT = $drush_server_home();
	
$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] = (isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'])) ? intval($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) : time() - filemtime(__FILE__);
putenv('FRDL_HPS_PSR4_CACHE_LIMIT='.$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']);


if(null === $scope){
  $envFile = false;
  if(@file_exists(getcwd().\DIRECTORY_SEPARATOR.'.env')){
       $envFile = getcwd().\DIRECTORY_SEPARATOR.'.env';
  }elseif(@file_exists($_SERVER['DOCUMENT_ROOT'].\DIRECTORY_SEPARATOR.'.env')){
       $envFile = $_SERVER['DOCUMENT_ROOT'].\DIRECTORY_SEPARATOR.'.env';
  }elseif(@file_exists(__DIR__.\DIRECTORY_SEPARATOR.'.env')){
       $envFile = __DIR__.\DIRECTORY_SEPARATOR.'.env';
  }elseif(@file_exists($HOME_DEFAULT.\DIRECTORY_SEPARATOR.'.env')){
       $envFile = $HOME_DEFAULT.\DIRECTORY_SEPARATOR.'.env';
  }elseif(@file_exists($HOME_DEFAULT.\DIRECTORY_SEPARATOR.'.frdl'.\DIRECTORY_SEPARATOR.'.env')){
       $envFile = $HOME_DEFAULT.\DIRECTORY_SEPARATOR.'.frdl'.\DIRECTORY_SEPARATOR.'.env';
  }

   if(false !== $envFile 
    //  && file_exists($envFile)
     ){
     $env = \Env\Dotenv::toArray($envFile, false, false);
     if(isset($env['IO4_WORKSPACE_SCOPE'])){
         $_ENV['IO4_WORKSPACE_SCOPE'] = $env['IO4_WORKSPACE_SCOPE'];	
         putenv('IO4_WORKSPACE_SCOPE='. $env['IO4_WORKSPACE_SCOPE']);
     }
   }
	
  $scope = !empty(getenv('IO4_WORKSPACE_SCOPE')) ? getenv('IO4_WORKSPACE_SCOPE') : null;
}
	
switch($scope){
	case '@cwd' :
            $__home =  getcwd();
	 break;		
	case '@www' :
            $__home =  $_SERVER['DOCUMENT_ROOT'];
	 break;	
	case '@www@root' :
            $__home =  $getRootDir($_SERVER['DOCUMENT_ROOT']);
	 break;	
	case '@www@parent' :
            $__home =  dirname($_SERVER['DOCUMENT_ROOT']);
	 break;	
	case '@global' :
	case null :
            $__home = $HOME_DEFAULT;
	  break;
	default :
           $__home = is_dir(getenv('IO4_WORKSPACE_SCOPE')) ? getenv('IO4_WORKSPACE_SCOPE') : $HOME_DEFAULT;
	 break;
}

$__home = @is_readable($__home) && @is_writable($__home) ? $__home : $getRootDir($_SERVER['DOCUMENT_ROOT']);

$_ENV['FRDL_HOME'] = $__home;	
putenv('FRDL_HOME='.$_ENV['FRDL_HOME']);

$_homeg = str_replace(\DIRECTORY_SEPARATOR, '/', getenv('FRDL_HOME'));
	
	
$_cwd = getcwd(); 	

//chdir(getenv('FRDL_HOME'));
	
	
$workspaces = false;

$_dir = getenv('FRDL_HOME') . \DIRECTORY_SEPARATOR . '.frdl';
//if(!is_dir($_dir)){
 $g = (file_exists("frdl.workspaces.php")) ? [realpath("frdl.workspaces.php")] : glob("frdl.workspaces.php");	
 if(0===count($g)){
	 $g = array_merge(glob(str_replace(\DIRECTORY_SEPARATOR, '/', getcwd())."/frdl.workspaces.php"),
					  glob($_homeg."/frdl.workspaces.php"), glob($_homeg."/*/frdl.workspaces.php") 
					  //,glob($_homeg."/*/*/frdl.workspaces.php")
			 );
 }
  if(0<count($g)){
	//	$_dir = dirname($g[0]);	
	 
	  $workspaces = require $g[0];
	  if(isset($workspaces['Frdlweb'])){
		$_dir = $workspaces['Frdlweb']['DIR'];		   
	  }else{
		 foreach($workspaces as $name => $w){
			if(isset($w['DIR']) && is_dir($w['DIR'])){
				$_dir = $w['DIR'];
			  break;	  
			}
		 }
	  }
	  
  }
//}
	
	 if(!@is_dir($_dir)){
		@mkdir($_dir, 0775, true); 
	 }	 
  if(@!is_dir($_dir) || !is_writable($_dir)   || !is_readable($_dir)  ){  

      $possibleFiles = glob(getenv('FRDL_HOME').'/*/');
      $dirs = array_filter(is_array($possibleFiles) ? $possibleFiles : [], 'is_dir');
      
      foreach ($dirs as $dir) {
      		
        if (false===strpos($dir, '@') && false!==strpos($dir, 'frdl') &&  is_writable($dir) && is_readable($dir)) {
            //echo realpath($dir).' is writable.<br>';
            $_dir = $dir 
			   .\DIRECTORY_SEPARATOR
			   .'.frdl';
				   if(is_dir($_dir)  || @mkdir($_dir, 0775, true) ){  
				     break;
			       }				   
        } else {
           //    echo $dir.' is not writable. Permissions may have to be adjusted.<br>';
        } 
      }
	}		
	
	$_dir= class_exists(\frdl\patch\RelativePath::class)
		   ? \frdl\patch\RelativePath::getRelativePath($_dir)
		   : $_dir;
	  
	$_ENV['FRDL_WORKSPACE']= rtrim($_dir, '\\/');
	putenv('FRDL_WORKSPACE='.$_ENV['FRDL_WORKSPACE']);	
	
	 
 $_f = $_ENV['FRDL_WORKSPACE']. \DIRECTORY_SEPARATOR.'frdl.workspaces.php';
 if(is_array($workspaces) 
	&& (!file_exists("frdl.workspaces.php") || time()-$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] > filemtime("frdl.workspaces.php")) 
	&& @is_dir($_ENV['FRDL_WORKSPACE']) && @is_file($_f) ){
	 
	// $exports = var_export($workspaces, true);
$code = <<<PHPCODE
<?php
	return require '$_f';		   
PHPCODE;

 file_put_contents("frdl.workspaces.php", $code);	 
 }
	  
	 if(!@is_dir($_ENV['FRDL_WORKSPACE'])){
		@mkdir($_ENV['FRDL_WORKSPACE'], 0775, true); 
	 }	
	
 
//$_ENV['FRDL_HPS_CACHE_DIR'] = $_dir . \DIRECTORY_SEPARATOR .\get_current_user() . \DIRECTORY_SEPARATOR. 'cache'. \DIRECTORY_SEPARATOR;
$_ENV['FRDL_HPS_CACHE_DIR'] = \sys_get_temp_dir() 
                   . \DIRECTORY_SEPARATOR .\get_current_user() . \DIRECTORY_SEPARATOR. 'cache'. \DIRECTORY_SEPARATOR;	
putenv('FRDL_HPS_CACHE_DIR='.$_ENV['FRDL_HPS_CACHE_DIR']);
//putenv('TMP='.$_ENV['FRDL_HPS_CACHE_DIR']);
//ini_set('sys_temp_dir', realpath($_ENV['FRDL_HPS_CACHE_DIR']));	
	 if(!@is_dir($_ENV['FRDL_HPS_CACHE_DIR'])){
		@mkdir($_ENV['FRDL_HPS_CACHE_DIR'], 0775, true); 
	 }


$_ENV['FRDL_HPS_PSR4_CACHE_DIR'] = rtrim($_ENV['FRDL_HPS_CACHE_DIR'], \DIRECTORY_SEPARATOR).\DIRECTORY_SEPARATOR.'psr4'.\DIRECTORY_SEPARATOR;
putenv('FRDL_HPS_PSR4_CACHE_DIR='.$_ENV['FRDL_HPS_PSR4_CACHE_DIR']);

	 if(!@is_dir($_ENV['FRDL_HPS_PSR4_CACHE_DIR'])){
		@mkdir($_ENV['FRDL_HPS_PSR4_CACHE_DIR'], 0775, true); 
	 }

	


//chdir($_cwd);
 return $scope;
});
      return $scope;
	});//\frdl\booting\once(function(){
    return $scope;
  }//scope function		
	}// !scope function	exists
}//ns frdl\patch






namespace frdl\patch{
 if (!\interface_exists(IContainer::class, false)) {		
   interface IContainer {
	//public function get($id);
	//public function has($id);	   
   }
 }
}

//Psr\Container\ContainerInterface
// Patch Version 1 | 2 incompatibillity
namespace Psr\Container{
   use frdl\patch\IContainer;

	if (false) {	
		interface ContainerInterface extends IContainer	
		{
	
		}
	} elseif(!interface_exists(ContainerInterface::class, false)) {  
	    \class_alias(IContainer::class, ContainerInterface::class);
	}	
}
 
 

namespace Psr\Container{

/**
 * see \frdl\patch\PsrContainerMeta::getVersion() for negotiate version !
 */
if (!\interface_exists(ContainerInterface::class, false)) {	
interface ContainerInterface
{
	public function get($id);
	public function has($id);
}
}
}



namespace Webfan\Container{

use Psr\Container\ContainerInterface;

use Configula\ConfigFactory as Config;
use Configula\ConfigValues as Configuration;
use Configula\Loader;
 
class ConfigContainer implements ContainerInterface
{
	protected $config; 
	protected $container_id;
	protected $basPath;
	protected $prependPath;
	
	public function __construct(string $container_id = 'config', //self container id, should return $this!
								string $basPath = 'config.', 
								string $prependPath = '',
								Configuration $config = null){
		
		$this->container_id=$container_id;
		$this->basPath=$basPath;
		$this->prependPath=$prependPath;
		
		$this->config = $config ?? new Configuration([]);	
	}
	
	public function getConfiguration( )    
	{
		return $this->config;
	}	
	
	public function getContainer( ) 
	{
		return $this;
	}		
		
	public function getIterator( )
	{
		return $this->config->getIterator( );
	}	
	
	public function __call($name, $params){
	  return \call_user_func_array([$this->config, $name], $params);	
	}
	
	public static function __callStatic($name, $params){
	  return \call_user_func_array([Config::class, $name], $params);	
	}
	
  
	public function get(  $id){
		if($id === $this->container_id){
		  return $this;	
		}
		$id = $this->_id($id);
		if(!$this->has($id)){
		  return null;	
		}
		return $this->config->get($id);
	}

   protected function _id(  $id){
          if (strlen($id) > strlen($this->basPath) && str_starts_with($id, $this->basPath)) {
             $id=substr($id, strlen($this->basPath), strlen($id));
          }	  
	   
	      $id.= $this->prependPath;
	   return $id;
   }
 
	public function has(   $id)   {
		if(strlen($id) < strlen($this->basPath))return false;
	  return $id === $this->container_id || $this->config->has($this->_id($id));	
	}
} 
	
}//ns






namespace Frdlweb\Contract\Autoload{
	

if (!\interface_exists(CodebaseInterface::class, false)) {	
  interface CodebaseInterface
 { 
   const ALL_CHANNELS = '*';
   const ENDPOINT_DEFAULT = 'RemoteApiBaseUrl';
   const ENDPOINT_PROVIDER_IDENTITY_CENTRAL = 'io4.pid.central';
   const ENDPOINT_WEBFAT_CENTRAL = 'io4.webfat.central';
   const ENDPOINT_REMOTE_PUBLIC = 'io4.workspace.public';
   const ENDPOINT_REMOTE_PRIVATE = 'io4.workspace.private';
   const ENDPOINT_WORKSPACE_REMOTE = 'io4.workspace.remote';
   const ENDPOINT_INSTALLER_REMOTE = 'io4.installer.remote';
   const ENDPOINT_PROXY_OBJECT_REMOTE = 'io4.proxy-object.remote';
   const ENDPOINT_CONTAINER_REMOTE = 'io4.container.remote';
   const ENDPOINT_CONFIG_REMOTE = 'io4.config.remote';
   const ENDPOINT_MODULES_WEBFANSCRIPT_REMOTE = 'RemoteModulesBaseUrl';
   const ENDPOINT_AUTOLOADER_PSR4_REMOTE = 'RemotePsr4UrlTemplate';
   const ENDPOINT_UDAP = 'io4.udap';
   const ENDPOINT_RDAP = 'io4.rdap';
   const ENDPOINT_OIDIP = 'io4.rdap';

   const CHANNEL_LATEST = 'latest';
   const CHANNEL_STABLE = 'stable';
   const CHANNEL_FALLBACK = 'fallback';
   const CHANNEL_TEST = 'test';
   const CHANNELS =[
        self::CHANNEL_LATEST => self::CHANNEL_LATEST,
        self::CHANNEL_STABLE => self::CHANNEL_STABLE,
        self::CHANNEL_FALLBACK => self::CHANNEL_FALLBACK,
        self::CHANNEL_TEST => self::CHANNEL_TEST,
	];
   const DEFAULT_ENDPOINT_NAMES =[
        self::ENDPOINT_DEFAULT,
	self::ENDPOINT_PROVIDER_IDENTITY_CENTRAL,
        self::ENDPOINT_WEBFAT_CENTRAL,
	self::ENDPOINT_REMOTE_PUBLIC,
	//self::ENDPOINT_REMOTE_PRIVATE, 
        self::ENDPOINT_WORKSPACE_REMOTE,
        self::ENDPOINT_INSTALLER_REMOTE,
        self::ENDPOINT_MODULES_WEBFANSCRIPT_REMOTE,
        self::ENDPOINT_PROXY_OBJECT_REMOTE,
	self::ENDPOINT_CONTAINER_REMOTE,
        self::ENDPOINT_AUTOLOADER_PSR4_REMOTE,
        self::ENDPOINT_UDAP,
        self::ENDPOINT_RDAP,
	self::ENDPOINT_OIDIP,
	self::ENDPOINT_CONFIG_REMOTE,
   ];
     
   public function loadUpdateChannel(mixed $StubRunner = null) : string;     
   public function getRemoteApiBaseUrl(?string $serviceEndpoint = self::ENDPOINT_DEFAULT) : string|bool;
   public function setUpdateChannel(string $channel);	 
   public function getUpdateChannel() : string;	  
   public function getRemotePsr4UrlTemplate() : string;	  
   public function getRemoteModulesBaseUrl() : string;
   public function getServiceEndpoints() : array;	 
   public function getServiceEndpointNames() : array;	  	 	 	 
   public function setServiceEndpoints(array $serviceEndpoints) : CodebaseInterface;	 
   public function setServiceEndpoint(string $serviceEndpointName,
									 string|\Closure|\callable $baseUrl, 
									 ?string $channel = self::ALL_CHANNELS) : CodebaseInterface;
 }
} 
}

namespace Frdlweb\Contract\Autoload{ 
 if (!interface_exists(LoaderInterface::class)) {		
	interface LoaderInterface {
	   public function register(bool $prepend = false);
	}
 }
}//ns Frdlweb\Contract\Autoload


namespace frdlweb{
	
use Frdlweb\Contract\Autoload\LoaderInterface;
use Psr\Container\ContainerInterface;	
use Laminas\Json\Server\Server;
use ProxyManager\Factory\RemoteObject\Adapter\JsonRpc;
use ProxyManager\Factory\RemoteObjectFactory;
use Laminas\Http\Client\Adapter\Exception\RuntimeException;
use Laminas\Json\Server\Client;
	
	
if (!\interface_exists(StubItemInterface::class, false)) { 	
interface StubItemInterface
{		  
	public function getMimeType();	 	
	public function getName() ;
        public function getFileName();
        public function isFile();
        public function getParts();
        public function getPartsByName( $name);
        public function addFile( $type = 'application/x-httpd-php',  $disposition = 'php',  $code= '',  $file = '',  $name= '');
        public function isMultiPart();
        public function getBody($reEncode = false, &$encoding = null);
        public function __toString();
 }
}
	

	
if (!\interface_exists(StubInterface::class, false)) {	
 interface StubInterface
 { 
   public function init (?string $scope = null) : ?string;  
   //public function moduleLocation(?string $location = null);
   public function installTo(string $location, bool $forceCreateDirectory = false, $mod = 0755) : object;	 
   public function isIndex(bool $onlyIfFirstFileCall = true) : bool;  
   public function install(?array $params = [] )  : bool|array;
   public function uninstall(?array $params = []  )  : bool|array;
   public function setDownloadSource(string $source);	 
   public function isIndexRequest() : bool; 
   public function runAsIndex(?bool $showErrorPageReturnBoolean = true) : bool|object;	
 }
} 	
	
if (!\interface_exists(StubAsFactoryInterface::class, false)) {	
 interface StubAsFactoryInterface
 { 

    //nette/php-generatror 
   public function getAsGeneratedPhpSource($id=null, $classes=[], $params = []
					   , $options = [] //autoloader,cache,.... e.g.
					   , $generator=null
					  ,?\Psr\Container\ContainerInterface $container = null
				   , ?bool $throw = false);
	 
   public function load(string $file, ?string $as = null) : object;	
   public function getAsContainer(?string $factoryId=null, ?array $definitions = [], ?array $options = []) : \Psr\Container\ContainerInterface;
   public function getAsStub(string $id) : object|bool;
   public function setStubIndexPhp(string $id, string $code, ?string $toFile = null)  : bool;
	 
   public function getAsFacade($alias, $proxy, string $id = null,string $namespace = null
				    ,?\Psr\Container\ContainerInterface $container = null
				   , ?bool $throw = false) : bool;	
   public function getAsRemoteObjectProxy(string $class, ?string $url = null, ?ContainerInterface $container=null);
   public function getAsLazyLoadingValueHolderProxy(string $class, $initializer);
   public function withFacades(?string $baseNamespace = '', ?string $namespace = '*');
 }
} 	

	
	
if (!\interface_exists(StubRunnerInterface::class, false)) { 
interface StubRunnerInterface extends StubInterface
 { 
	public function instance(?object $instance = null)  : object;
 //	public function loginRootUser($username = null, $password = null) : bool;		
//	public function isRootUser() : bool;
	public function getStubVM() : StubHelperInterface;	
	public function getStub() : StubItemInterface;		
	public function __invoke() :?StubHelperInterface;    
	public function hugVM(?StubHelperInterface $MimeVM);
	public function getInvoker();	
	public function getShield();	
	public function autoloading() : void;
	public function config(?array $config = null, $trys = 0) : array;
	public function configVersion(?array $config = null, $trys = 0) : array;		
	public function getCodebase() :?\Frdlweb\Contract\Autoload\CodebaseInterface;
	public function getFrdlwebWorkspaceDirectory() : string;
	public function getWebrootConfigDirectory() : string;
	public function getApplicationsDirectory() : string;
	public function getRemoteAutoloader(?array $configVersion = null, ?array $config = null, ?\Frdlweb\Contract\Autoload\CodebaseInterface $codebase = null) : LoaderInterface;
	public function autoUpdateStub(string | bool $update = null, string $newVersion = null, string $url = null);
	
}	
}		
	
	
if (!\interface_exists(StubModuleInterface::class, false)) { 
interface StubModuleInterface extends StubInterface
 { 
 	public function autoload( )  : object;
 }	
}			
	
if (!\interface_exists(StubHelperInterface::class, false)) {	
 interface StubHelperInterface
 { 
  public function runStubs($stubs=null);
  public function addPhpStub($code, $file = null);	 
  public function addWebfile($path, $contents, $contentType = 'application/x-httpd-php', $n = 'php');	 
  public function addClassfile($class, $contents);
  public function get_file($part, $file, $name); 
  public function Autoload($class);   
  public function __toString();	
  public function __invoke(); 	
  public function __call($name, $arguments);
  public function getFileAttachment($file = null, $offset = null, ?bool $throw = true);	
  public function hugRunner(mixed $runner);
  public function getRunner();
  //public function _run_php_1(StubItemInterface $part, $class = null, ?bool $lint = null);
 }
} 

/*
//Move to lazxer loader...
if (!\interface_exists(StubContextDirectoriesInterface::class, false)) {	
 interface StubContextDirectoriesInterface
 { 
   public function getDataStoresDirectory( ?bool $create = false ) : string;
   public function getUserDirectory(string $userHandle, ?bool $create = false) : string;
   public function getSitesRootDirectory( ?bool $create = false ) : string;
   public function getDomainsRootDirectory( ?bool $create = false ) : string;
	 
   public function getSiteDirectory(string $host, ?bool $create = false) : string;
   public function getDomainDirectory(string $domain, ?bool $create = false) : string;
   public function getSiteConfigDirectory(string $host = null, ?bool $create = false) : string;
   public function getSiteDataDirectory(string $host = null, ?bool $create = false) : string;
   public function getSiteRuntimeDirectory(string $host = null, ?bool $create = false) : string;
   public function getSiteModulesDirectory(string $host = null, ?bool $create = false) : string;
   public function getSiteUserDirectory(string $host, string $userHandle, ?bool $create = false) : string;
   public function getConfigsRootDirectory( ?bool $create = false ) : string;
 }
} 
	*/
}//namespace frdlweb





namespace PSX\Sandbox{
	if(!function_exists('\PSX\Sandbox\runIsolate')){
		function runIsolate($file, $context, ?bool $doRequire = true){   
			if(\class_exists(\Webfan\Sandbox\Runtime::class)){
                           return \Webfan\Sandbox\Runtime::runIsolate($file, $context, $doRequire);
			}else{
			 return (static function ($context, $file, $doRequire) {	
                            extract($context);    
			    return false === $doRequire                     
				   ? include $file                  
				   : require $file; 				
			  })($context, $file, $doRequire);
			}
		}		
	}
}


namespace DI{

/**
 * Exception for the Container
 */
 if (!\class_exists(DependencyException::class, false)) {		
  class DependencyException extends \Exception
  {

  }

 }
} 


namespace frdl\patch{
if (!\class_exists(RelativePath::class, false)) {		
 /**
 * Simple relative path normalizer utility.
 *
 * The utility was inspired by PHP's realPath function, though that required the given path to exist, RelativePath does not.
 *
 * Particularly useful is you need to parse and normalize paths gathered from for instance URL's and HTML pages.
 *
 * These functions are also included in Zip and ZipStream classes version 1.23 onwards on PHPClasses.org.
 * http://www.phpclasses.org/package/6110 and http://www.phpclasses.org/package/6616 respectively.
 *
 * License: GNU LGPL, Attribution required for commercial implementations, requested for everything else.
 *
 * @author A. Grandt <php@grandt.com>
 * @copyright 2011 A. Grandt
 * @license GNU LGPL, Attribution required for commercial implementations, requested for everything else.
 * @link http://www.phpclasses.org/package/6844
 * @version 1.01
 */
 //mentioned here: https://webfan.de/install/
 class RelativePath {
    const VERSION = 1.01;

	 
 public static function rel($from, $to, $separator = \DIRECTORY_SEPARATOR)
 {
    $from   = str_replace(array('/', '\\'), $separator, $from);
    $to     = str_replace(array('/', '\\'), $separator, $to);

    $arFrom = explode($separator, rtrim($from, $separator));
    $arTo = explode($separator, rtrim($to, $separator));
    while(count($arFrom) && count($arTo) && ($arFrom[0] == $arTo[0]))
    {
        array_shift($arFrom);
        array_shift($arTo);
    }

    return str_pad("", count($arFrom) * 3, '..'.$separator).implode($separator, $arTo);
 }	 
	 
    /**
     * Join $file to $dir path, and clean up any excess slashes.
     *
     * @author A. Grandt <php@grandt.com>
     * @author Greg Kappatos
     *
     * @param string $dir
     * @param string $file
     *
     * @return string Joined path, with the correct forward slash dir separator.
     */
    public static function pathJoin($dir, $file) {
        return \RelativePath::getRelativePath(
            $dir . (empty($dir) || empty($file) ? '' : DIRECTORY_SEPARATOR) . $file
        );
    }

    /**
     * Clean up a path, removing any unnecessary elements such as /./, // or redundant ../ segments.
     * If the path starts with a "/", it is deemed an absolute path and any /../ in the beginning is stripped off.
     * The returned path will not end in a "/".
     *
     * @param String $path The path to clean up
     * @return String the clean path
     */
    public static function getRelativePath($path) {
        $path = preg_replace("#/+\.?/+#", "/", str_replace("\\", "/", $path));
        $dirs = explode("/", rtrim(preg_replace('#^(\./)+#', '', $path), '/'));
               
        $offset = 0;
        $sub = 0;
        $subOffset = 0;
        $root = "";

        if (empty($dirs[0])) {
            $root = "/";
            $dirs = array_splice($dirs, 1);
        } else if (preg_match("#[A-Za-z]:#", $dirs[0])) {
            $root = strtoupper($dirs[0]) . "/";
            $dirs = array_splice($dirs, 1);
        }

        $newDirs = array();
        foreach ($dirs as $dir) {
            if ($dir !== "..") {
                $subOffset--;
                $newDirs[++$offset] = $dir;
            } else {
                $subOffset++;
                if (--$offset < 0) {
                    $offset = 0;
                    if ($subOffset > $sub) {
                        $sub++;
                    }
                }
            }
        }

        if (empty($root)) {
            $root = str_repeat("../", $sub);
        }
        return $root . implode("/", array_slice($newDirs, 0, $offset));
    }
 }
}
}



namespace frdl\patch{
 use frdl\patch\RelativePath;
/**
 * Return relative path between two sources
 * @param $from
 * @param $to
 * @param string $separator
 * @return string
 */
 function relPath($from, $to, $separator = \DIRECTORY_SEPARATOR)
 {
   return RelativePath::rel($from, $to, $separator);
 }
}






namespace Spatie\Once{
	
use Countable;
use WeakMap;
	
if(!class_exists(Cache::class)){
class Cache implements Countable
{
    protected static self $cache;
    public WeakMap $values;
    protected bool $enabled = true;

    public static function getInstance(): static
    {
        return static::$cache ??= new static;
    }

    protected function __construct()
    {
        $this->values = new WeakMap();
    }

    public function has(object $object, string $backtraceHash): bool
    {
        if (! isset($this->values[$object])) {

            return false;
        }

        return array_key_exists($backtraceHash, $this->values[$object]);
    }

    public function get($object, string $backtraceHash): mixed
    {
        return $this->values[$object][$backtraceHash];
    }

    public function set(object $object, string $backtraceHash, mixed $value): void
    {
        $cached = $this->values[$object] ?? [];

        $cached[$backtraceHash] = $value;

        $this->values[$object] = $cached;
    }

    public function forget(object $object): void
    {
        unset($this->values[$object]);
    }

    public function flush(): self
    {
        $this->values = new WeakMap();

        return $this;
    }

    public function enable(): self
    {
        $this->enabled = true;

        return $this;
    }

    public function disable(): self
    {
        $this->enabled = false;

        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function count(): int
    {
        return count($this->values);
    }
}	
}//if(!class_exists(Cache::class)){	
	
if(!class_exists(Backtrace::class)){
class Backtrace
{
    protected array $trace;
    protected array $zeroStack;

    public function __construct(array $trace)
    {
        $this->trace = $trace[1];

        $this->zeroStack = $trace[0];
    }

    public function getArguments(): array
    {
        return $this->trace['args'];
    }

    public function getFunctionName(): string
    {
        return $this->trace['function'];
    }

    public function getObjectName(): ?string
    {
        return $this->trace['class'] ?? null;
    }

    public function getObject(): mixed
    {
        if ($this->globalFunction()) {
            return $this->zeroStack['file'];
        }

        return $this->staticCall() ? $this->trace['class'] : $this->trace['object'];
    }

    public function getHash(): string
    {
        $normalizedArguments = array_map(function ($argument) {
            return is_object($argument) ? spl_object_hash($argument) : $argument;
        }, $this->getArguments());

        $prefix = $this->getObjectName() . $this->getFunctionName();
        if (str_contains($prefix, '{closure}')) {
            $prefix = $this->zeroStack['line'];
        }

        return md5($prefix.serialize($normalizedArguments));
    }

    protected function staticCall(): bool
    {
        return $this->trace['type'] === '::';
    }

    protected function globalFunction(): bool
    {
        return ! isset($this->trace['type']);
    }
}
}//if(!class_exists(Backtrace::class)){
	
	
}//ns  Spatie\Once


namespace frdl\booting{
	
use Spatie\Once\Backtrace;
use Spatie\Once\Cache;

/**
 * once by:
 * https://github.com/spatie/once
 */
function once(callable $callback): mixed
{
    $trace = debug_backtrace(
        \DEBUG_BACKTRACE_PROVIDE_OBJECT, 2
    );

    $backtrace = new Backtrace($trace);

    if ($backtrace->getFunctionName() === 'eval') {
        return call_user_func($callback);
    }

    $object = $backtrace->getObject();

    $hash = $backtrace->getHash();

    $cache = Cache::getInstance();

    if (is_string($object)) {
        $object = $cache;
    }

    if (! $cache->isEnabled()) {
        return call_user_func($callback, $backtrace->getArguments());
    }

    if (! $cache->has($object, $hash)) {
        $result = call_user_func($callback, $backtrace->getArguments());

        $cache->set($object, $hash, $result);
    }

    return $cache->get($object, $hash);
}
	
	

	
	
 function getFormFromRequestHelper(string $message = '',
											 bool $autosubmit = true, 
											 $delay = 0,
											 $request = null){

	 $vars = (null===$request)
		 ? $_POST 
		 : $request->getParsedBody();
	
	 $target =  (null===$request)
		 ? $_SERVER['REQUEST_URI']
		 : $request->getUri();	 
		 
	 $method =  (null===$request)
		 ? $_SERVER['REQUEST_METHOD']
		 : $request->getMethod();	 
		 
	 $vars = (array)$vars;
	
	 $id = 'idr'.str_pad(time(), 32, mt_rand(0,(int)9), \STR_PAD_LEFT).str_pad(mt_rand(1,(int)9999999999), 16, mt_rand(0,(int)9), \STR_PAD_LEFT); 
	
	 $html = $message;
	 $html.='<form id="'.$id.'" action="'.$target.'" method="'.$method.'">';
	 foreach($vars as $n => $v){
		$html.='<input type="hidden" name="'.$n.'" value="'.strip_tags($v).'" />';
	 }
	  if(true !== $autosubmit){
		$html.='<button class="btn btn-primary" onclick="document.getElementById(\''.$id.'\').submit();">Reload this page and retry request</button>';  
	  }
	 
	 $html.='</form>';	
	
	 if(true === $autosubmit){
		$html.='<p class="btn-info" style="color:red;background:url(https://io4.xyz.webfan3.de/assets/ajax-loader_2.gif) no-repeat;">Reloading...</p>'; 			
		 $html.='<script>';		
		 if(0<$delay){		
			 $html.='(()=>{';
		 }
		 $html.='setTimeout(()=>{document.getElementById(\''.$id.'\').submit();}, '.($delay * 1000).')';		
		 if(0<$delay){			
			 $html.='})();';
		 }
		$html.='</script>';
	 }
	
	  return $html;
    }
	
}

namespace Webfan\Webfat\App{

use LogicException;
use Exception;
use IvoPetkov\HTML5DOMDocument;

class ResolvableLogicException extends LogicException
{
	
	const URL_TEMPLATE = 'https://webfan.de/apps/registry/?goto=%s';
	//const URL_FORM_TEMPLATE = 'https://webfan.de/apps/webmaster/1.3.6.1.4.1.37553.8.1.8.8.91397908338147/setup?instance=%2$s&errorinfo=%1$s';
	const URL_FORM_TEMPLATE = 'https://webfan.de/apps/webmaster/1.3.6.1.4.1.37553.8.1.8.8.91397908338147/setup?instance=%2$s&errorinfo=%1$s';
	const LINK_TEXT = '<strong>Help</strong> | Documentation | Infolink';
	
    public $dom = null;
    public $infos = [];
    public $mainMessage;
	public $formLink;
	
 
	public static $urlformtemplate = null;
	
	
    /**
     * example (from Webfan\Webfat\App\Kernel) :
            throw new ResolvableException(
                      'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.2=Environment variable FRDL_BUILD_FLAVOR must be set!'
					 .'|circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.2=FRDL_BUILD_FLAVOR must be one of 1.3.6.1.4.1.37553.8.1.8.1.1089085 or  1.3.6.1.4.1.37553.8.1.8.1.575874'
					 .'|php:'.get_class($this).'=Thrown by the Kernel Class'
				   	 .'@FRDL_BUILD_FLAVOR not valid'
             );				
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        int $severity = \E_ERROR,
        ?string $filename = null,
        ?int $line = null,
        ?Throwable $previous = null
    ) {
        $args = func_get_args();

        $this->infos = [];
         $i = explode('@', $message, 3);
		if(count($i)<2){
		   	$i[]='';			
		   	$i[]='';
		}elseif(count($i)<3){
		   	$i[]='';		   	
		}
        list($INFOS, $message, $formLink) = $i;
        if(empty($message)){
            $message = $INFOS;
            $INFOS = '';
        }
      
		  $formLink =(is_string(self::$urlformtemplate)) ? self::$urlformtemplate : self::URL_FORM_TEMPLATE;	
	 
		$this->formLink = $formLink;
        $informationObjects = preg_split("/([\,\;\|\+])/", $INFOS);
 
        foreach($informationObjects as $info){
			@list($infoID, $text) = explode('=', $info, 2);
            $this->infos[]=[$infoID, $text];
        }

      //   $this->dom = $this->html(false, $message, $formLink);

		//$args[0] = $this->html(true, $message, $formLink);
		$args[0] = $this->html(-1, $message, $formLink);
		//$args[0] =$this->dom->saveHTML();
		$this->mainMessage =$message; 
		
		parent::__construct(...$args);
    }

    public function html($asText = -1,$message = null, $formLink= null): mixed //HTML5DOMDocument|string
    {
		$info = [
			'message'=> str_replace([\sys_get_temp_dir(), 
											  getenv('HOME'),
											  $_SERVER['DOCUMENT_ROOT'],
											 ],
											 ['/{$tmp}',
											  '~',
											 '/$PUBLIC/www'], $message ? $message : $this->mainMessage),
			'infos' => $this->infos,
			/*
			'client' => [
				'host'=>$_SERVER['HTTP_HOST'],
				'uri' => $_SERVER['REQUEST_URI'],
			],
		 */
		  	
		];
		
         $istance = urlencode(base64_encode(json_encode([
				'host'=>$_SERVER['HTTP_HOST'],
				'uri' => $_SERVER['REQUEST_URI'],
			])));
		 $info = urlencode(base64_encode(json_encode($info)));
		
		$hash = sha1($info);
		
        $h = '';
		$h.='<style>[ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak{	display:none;}</style>';
        $h .= '<table style="width:100%;">';

        $h .= '<tr>';

            $h .= '<th>';
                  $h .= '<h1 class="btn-danger">';
                     $h .= $message ? $message : $this->mainMessage;
                  $h .= '</h1>';
            $h .= '</th>';

            $h .= '<th>';
                  $h .= '<i>';
                     $h .= sprintf('Line %d in file %s', $this->getLine(), str_replace(getenv('HOME'), '',
								 str_replace([\sys_get_temp_dir(), 
											  getenv('HOME'),
											  $_SERVER['DOCUMENT_ROOT'],
											 ],
											 ['/{$tmp}',
											  '~',
											 '/$PUBLIC/www'], $this->getFile())																			
							 ));
                  $h .= '</i>';
            $h .= '</th>';

        $h .= '</tr>';
		
		if(!isset($_GET['errorinfo'])){
          $h .= '<tr>';

             $h .= '<th colspan="2">';
                  $h .= '<h1 class="btn-info">';
                  $h .= '<a href="'
								.sprintf($formLink ? $formLink : $this->formLink, $info, $istance)
								.'" target="_top" frdl-information-object-chunk-link="'.$hash.'"><span ng-show="langIsDefault==true || langShortCode==\'en\'">Click here to fix the error</span><span ng-show="langShortCode==\'de\'" ng-cloak>Klicken Sie hier um den Fehler zu beheben</span></a>!';
		           $h .= '</h1>';
            $h .= '</th>';

          $h .= '</tr>';		
		}//if(!isset($_GET['errorinfo'])){


		
		if(!isset($_GET['errorinfo'])){
            foreach($this->infos as $num => $info){
				list($id, $text) = $info;
                //$h .= '<tr>';
                $h .= sprintf('<tr data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionTableRow">', $id);
         $h .= sprintf('<td data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionText">', $id);
                          $h .= $text;
                      $h .= '</td>';
         $h .= sprintf('<td data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionLinks">', $id);
                  $h .= sprintf('<a href="'
								.self::URL_TEMPLATE
								.'" target="_blank" frdl-information-object-chunk-link="%s">'.self::LINK_TEXT.'</a><br />about %s.', 
								urlencode($id), $id, $id);
                      $h .= '</td>';
                $h .= '</tr>';
            }
		}//if(!isset($_GET['errorinfo'])){
		
        $h .= '</table>';

		if(-1 === $asText || !class_exists(HTML5DOMDocument::class)){
			return $h;
		}
        $this->dom = new HTML5DOMDocument();
        $this->dom->substituteEntities = false;
        $this->dom->loadHTML((string)$h);

        return true === $asText ? $this->dom->saveHTML() : $this->dom;
    }
}
}






namespace Webfan\Webfat\App{

use ErrorException;
use Exception;
use IvoPetkov\HTML5DOMDocument;

class ResolvableException extends ErrorException
{
	
	const URL_TEMPLATE = 'https://webfan.de/apps/registry/?goto=%s';
	//const URL_FORM_TEMPLATE = 'https://webfan.de/apps/webmaster/1.3.6.1.4.1.37553.8.1.8.8.91397908338147/setup?instance=%2$s&errorinfo=%1$s';
	const URL_FORM_TEMPLATE = 'https://webfan.de/apps/webmaster/1.3.6.1.4.1.37553.8.1.8.8.91397908338147/setup?instance=%2$s&errorinfo=%1$s';
	const LINK_TEXT = '<strong>Help</strong> | Documentation | Infolink';
	
    public $dom = null;
    public $infos = [];
    public $mainMessage;
	public $formLink;
	
 
	public static $urlformtemplate = null;
	
	
    /**
     * example (from Webfan\Webfat\App\Kernel) :
            throw new ResolvableException(
                      'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.2=Environment variable FRDL_BUILD_FLAVOR must be set!'
					 .'|circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.2=FRDL_BUILD_FLAVOR must be one of 1.3.6.1.4.1.37553.8.1.8.1.1089085 or  1.3.6.1.4.1.37553.8.1.8.1.575874'
					 .'|php:'.get_class($this).'=Thrown by the Kernel Class'
				   	 .'@FRDL_BUILD_FLAVOR not valid'
             );				
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        int $severity = \E_ERROR,
        ?string $filename = null,
        ?int $line = null,
        ?Throwable $previous = null
    ) {
        $args = func_get_args();

        $this->infos = [];
         $i = explode('@', $message, 3);
		if(count($i)<2){
		   	$i[]='';			
		   	$i[]='';
		}elseif(count($i)<3){
		   	$i[]='';		   	
		}
        list($INFOS, $message, $formLink) = $i;
        if(empty($message)){
            $message = $INFOS;
            $INFOS = '';
        }
      
		  $formLink =(is_string(self::$urlformtemplate)) ? self::$urlformtemplate : self::URL_FORM_TEMPLATE;	
	 
		$this->formLink = $formLink;
        $informationObjects = preg_split("/([\,\;\|\+])/", $INFOS);
 
        foreach($informationObjects as $info){
			@list($infoID, $text) = explode('=', $info, 2);
            $this->infos[]=[$infoID, $text];
        }

      //   $this->dom = $this->html(false, $message, $formLink);

		//$args[0] = $this->html(true, $message, $formLink);
		$args[0] = $this->html(-1, $message, $formLink);
		//$args[0] =$this->dom->saveHTML();
		$this->mainMessage =$message; 
		
		parent::__construct(...$args);
    }

    public function html($asText = -1,$message = null, $formLink= null): mixed //HTML5DOMDocument|string
    {
		$info = [
			'message'=> str_replace([\sys_get_temp_dir(), 
											  getenv('HOME'),
											  $_SERVER['DOCUMENT_ROOT'],
											 ],
											 ['/{$tmp}',
											  '~',
											 '/$PUBLIC/www'], $message ? $message : $this->mainMessage),
			'infos' => $this->infos,
			/*
			'client' => [
				'host'=>$_SERVER['HTTP_HOST'],
				'uri' => $_SERVER['REQUEST_URI'],
			],
		 */
		  	
		];
		
         $istance = urlencode(base64_encode(json_encode([
				'host'=>$_SERVER['HTTP_HOST'],
				'uri' => $_SERVER['REQUEST_URI'],
			])));
		 $info = urlencode(base64_encode(json_encode($info)));
		
		  $hash = sha1($info);
		
        $h = '';
		$h.='<style>[ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak{	display:none;}</style>';
        $h .= '<table style="width:100%;">';

        $h .= '<tr>';

            $h .= '<th>';
                  $h .= '<h1 class="btn-danger">';
                     $h .= $message ? $message : $this->mainMessage;
                  $h .= '</h1>';
            $h .= '</th>';

            $h .= '<th>';
                  $h .= '<i>';
                     $h .= sprintf('Line %d in file %s', $this->getLine(), str_replace(getenv('HOME'), '',
								 str_replace([\sys_get_temp_dir(), 
											  getenv('HOME'),
											  $_SERVER['DOCUMENT_ROOT'],
											 ],
											 ['/{$tmp}',
											  '~',
											 '/$PUBLIC/www'], $this->getFile())																			
							 ));
                  $h .= '</i>';
            $h .= '</th>';

        $h .= '</tr>';
		
		if(!isset($_GET['errorinfo'])){
          $h .= '<tr>';

             $h .= '<th colspan="2">';
                  $h .= '<h1 class="btn-info">';
                  $h .= '<a href="'
								.sprintf($formLink ? $formLink : $this->formLink, $info, $istance)
								.'" target="_top" frdl-information-object-chunk-link="'.$hash.'"><span ng-show="langIsDefault==true || langShortCode==\'en\'">Click here to fix the error</span><span ng-show="langShortCode==\'de\'" ng-cloak>Klicken Sie hier um den Fehler zu beheben</span></a>!';
		           $h .= '</h1>';
            $h .= '</th>';

          $h .= '</tr>';		
		}//if(!isset($_GET['errorinfo'])){


		
		if(!isset($_GET['errorinfo'])){
            foreach($this->infos as $num => $info){
				list($id, $text) = $info;
                //$h .= '<tr>';
                $h .= sprintf('<tr data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionTableRow">', $id);
         $h .= sprintf('<td data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionText">', $id);
                          $h .= $text;
                      $h .= '</td>';
         $h .= sprintf('<td data-information-object-identifier="%s" frdl-information-object-chunk="ResolvableExceptionLinks">', $id);
                  $h .= sprintf('<a href="'
								.self::URL_TEMPLATE
								.'" target="_blank" frdl-information-object-chunk-link="%s">'
								.self::LINK_TEXT.'</a><br />about %s.', 
								urlencode($id), $id, $id);
                      $h .= '</td>';
                $h .= '</tr>';
            }
		}//if(!isset($_GET['errorinfo'])){
		
        $h .= '</table>';

		if(-1 === $asText || !class_exists(HTML5DOMDocument::class)){
			return $h;
		}
        $this->dom = new HTML5DOMDocument();
        $this->dom->substituteEntities = false;
        $this->dom->loadHTML((string)$h);

        return true === $asText ? $this->dom->saveHTML() : $this->dom;
    }
}
}








namespace Psr\Http\Message{
	
	
if (!\interface_exists(MessageInterface::class, false)) {		
interface MessageInterface
{
    public function getProtocolVersion();
    public function withProtocolVersion($version);
    public function getHeaders();
    public function hasHeader($name);
    public function getHeader($name);
    public function getHeaderLine($name);
    public function withHeader($name, $value);
    public function withAddedHeader($name, $value);
    public function withoutHeader($name);
    public function getBody();
    public function withBody(StreamInterface $body);
}
}	
	
	
if (!\interface_exists(RequestInterface::class, false)) {		
interface RequestInterface extends MessageInterface
{
    public function getRequestTarget();
    public function withRequestTarget($requestTarget);
    public function getMethod();
    public function withMethod($method);
    public function getUri();
    public function withUri(UriInterface $uri, $preserveHost = false);
}
}	
	
	
if (!\interface_exists(ServerRequestInterface::class, false)) {	

interface ServerRequestInterface extends RequestInterface
{
    public function getServerParams();
    public function getCookieParams();
    public function withCookieParams(array $cookies);
    public function getQueryParams();
    public function withQueryParams(array $query);
    public function getUploadedFiles();
    public function withUploadedFiles(array $uploadedFiles);
    public function getParsedBody();
    public function withParsedBody($data);
    public function getAttributes();
    public function getAttribute($name, $default = null);
    public function withAttribute($name, $value);
    public function withoutAttribute($name);
}
}
}



namespace Psr\Http\Server{

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Handles a server request and produces a response.
 *
 * An HTTP request handler process an HTTP request in order to produce an
 * HTTP response.
 */
if (!\interface_exists(RequestHandlerInterface::class, false)) {		
interface RequestHandlerInterface
{
    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface;
}
}
}

namespace Frdlweb{

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

if (!\interface_exists(WebAppInterface::class, false)) {	
interface WebAppInterface extends RequestHandlerInterface
{
	public function handle(ServerRequestInterface $request): ResponseInterface;
	public function getContainer() : ContainerInterface;	
	public function handleCliRequest();	
	
}
}
}



namespace frdl\Lint{
if(!class_exists(Php::class, false)){
class Php
{
    protected $cacheDir = null;

    public function __construct($cacheDir = null)
    {
        $this->cacheDir = $cacheDir;
    }

    public function setCacheDir($cacheDir = null)
    {
        $this->cacheDir = $cacheDir;
          return $this;
    }

    public function getCacheDir()
    {
        if((null!==$this->cacheDir && !empty($this->cacheDir)) && is_dir($this->cacheDir)){
           return $this->cacheDir;
         }

           if(!isset($_ENV['FRDL_HPS_CACHE_DIR']))$_ENV['FRDL_HPS_CACHE_DIR']=getenv('FRDL_HPS_CACHE_DIR');

          $this->cacheDir =
        (  isset($_ENV['FRDL_HPS_CACHE_DIR']) && !empty($_ENV['FRDL_HPS_CACHE_DIR']))
          ? $_ENV['FRDL_HPS_CACHE_DIR']
                   : \sys_get_temp_dir() . \DIRECTORY_SEPARATOR . \get_current_user(). \DIRECTORY_SEPARATOR . 'cache' . \DIRECTORY_SEPARATOR ;

         $this->cacheDir = rtrim($this->cacheDir, '\\/'). \DIRECTORY_SEPARATOR.'lint';

         if(!is_dir($this->cacheDir)){
           mkdir($this->cacheDir, 0775, true);
         }


          return $this->cacheDir;
    }

    public function lintString($source)
    {
        $cachedir =  $this->getCacheDir();
         if(!is_writable($cachedir)){
        mkdir($cachedir, 0755, true);
         }
         $tmpfname = tempnam($cachedir, 'frdl_lint_php');
         if(empty($tmpfname))return false;
         file_put_contents($tmpfname, $source);
         $valid = $this->checkSyntax($tmpfname, false);
         unlink($tmpfname);
         return $valid;
    }

    public function lintFile($fileName, $checkIncludes = true)
    {
        return call_user_func_array([$this, 'checkSyntax'], [$fileName, $checkIncludes]);
    }

    public static function lintStringStatic($source)
    {
        $o = new self;
         $tmpfname = tempnam($o->getCacheDir(), 'frdl_lint_php');
         file_put_contents($tmpfname, $source);
         $valid = $o->checkSyntax($tmpfname, false);
         unlink($tmpfname);
         return $valid;
    }

    public static function lintFileStatic($fileName, $checkIncludes = true)
    {
        $o = new self;
         $o->setCacheDir($o->getCacheDir());
         return call_user_func_array([$o, 'checkSyntax'], [$fileName, $checkIncludes]);
    }

    public static function __callStatic($name, $arguments)
    {
        $o = new self;
         return call_user_func_array([$o, $name], $arguments);
    }

    public function checkSyntax($fileName, $checkIncludes = false)
    {
        if(!file_exists($fileName))
            throw new \Exception("Cannot read file ".$fileName);

        // Sort out the formatting of the filename
           $fileName = realpath($fileName);

        // Get the shell output from the syntax check command
        $output = shell_exec(sprintf('%s -l "%s"',  (new \Webfan\Helper\PhpBinFinder())->find(), $fileName));

        // Try to find the parse error text and chop it off
        $syntaxError = preg_replace("/Errors parsing.*$/", "", $output, -1, $count);

        // If the error text above was matched, throw an exception containing the syntax error
        if($count > 0)
            //throw new \Exception(trim($syntaxError));
            return 'Errors parsing '.print_r([$output, $count],true);

        // If we are going to check the files includes
        if($checkIncludes)
        {
            foreach($this->getIncludes($fileName) as $include)
            {
                // Check the syntax for each include
                $tCheck = $this->checkSyntax($include, $checkIncludes);
               if(true!==$tCheck){
                 return $tCheck;
               }
            }
        }

          return true;
    }

    public function getIncludes($fileName)
    {
        $includes = array();
        // Get the directory name of the file so we can prepend it to relative paths
        $dir = dirname($fileName);

        // Split the contents of $fileName about requires and includes
        // We need to slice off the first element since that is the text up to the first include/require
        $requireSplit = array_slice(preg_split('/require|include/i', file_get_contents($fileName)), 1);

        // For each match
        foreach($requireSplit as $string)
        {
            // Substring up to the end of the first line, i.e. the line that the require is on
            $string = substr($string, 0, strpos($string, ";"));

            // If the line contains a reference to a variable, then we cannot analyse it
            // so skip this iteration
            if(strpos($string, "$") !== false)
                continue;

            // Split the string about single and double quotes
            $quoteSplit = preg_split('/[\'"]/', $string);

            // The value of the include is the second element of the array
            // Putting this in an if statement enforces the presence of '' or "" somewhere in the include
            // includes with any kind of run-time variable in have been excluded earlier
            // this just leaves includes with constants in, which we can't do much about
            if($include = $quoteSplit[1])
            {
                // If the path is not absolute, add the dir and separator
                // Then call realpath to chop out extra separators
                if(strpos($include, ':') === FALSE)
                    $include = realpath($dir.\DIRECTORY_SEPARATOR.$include);

                array_push($includes, $include);
            }
        }

        return $includes;
    }
}


}//!class exists
}//namespace frdl\Lint





namespace Env{

use \ErrorException;
use \ValueError;

use function \parse_ini_file;
use function \realpath;

use const \INI_SCANNER_RAW;
use const \INI_SCANNER_TYPED;

final class Dotenv
{
	const CREDITS = '/*! https://github.com/sabroan/php-dotenv/blob/main/LICENSE
MIT License

Copyright (c) 2023 Serhii Babinets

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/';
       
public static function toArray(string $path, bool $strict = false, bool $sections = false): array | bool
    {
        $realpath = @realpath($path);
        if (false === $realpath || !file_exists($realpath) || !is_file($realpath)) {
           $env = \parse_ini_string(
            ini_string: $path,
            process_sections: $sections,
            scanner_mode: ($strict)
                ? INI_SCANNER_RAW
                : INI_SCANNER_TYPED
           );
          if ($env) {
            return $env;
          }else{
			 return false;  
		  }
        }
		
		
        $env = parse_ini_file(
            filename: $realpath,
            process_sections: $sections,
            scanner_mode: ($strict)
                ? INI_SCANNER_RAW
                : INI_SCANNER_TYPED
        );
        if ($env) {
            return $env;
        }else{
			 return false;  
		  }
       // throw new ErrorException("Unable to parse $realpath");
    }
}
}//ns Env







namespace App\compiled\Instance\MimeStub5\MimeStubEntity871059912{
use frdl;
use frdlweb\StubItemInterface as StubItemInterface;	 
use frdlweb\StubHelperInterface as StubHelperInterface;
use frdlweb\StubRunnerInterface as StubRunnerInterface;	
use frdlweb\StubModuleInterface as StubModuleInterface;
use frdlweb\StubAsFactoryInterface as StubAsFactoryInterface;
use frdlweb\StubContextDirectoriesInterface as StubContextDirectoriesInterface;
use Frdlweb\Contract\Autoload\LoaderInterface;	
use Psr\Container\ContainerInterface;


 class MimeVM implements StubHelperInterface
 {
  	
 	public $e_level = E_USER_ERROR;

 	protected $raw = false;
 	protected $MIME = false;
 	
 	protected $__FILE__ = false;
 	protected $buf;
 	
 	//stream
 	protected $IO = false;
 	protected $file = false;
 	protected $host = false;
 	protected $mode = false;
 	protected $offset = false;
 	protected $runner = false;
 	
 //	protected $Context = false; 	
 //	protected $Env = false;
 	
 	protected $initial_offset = 0;
 	
 	protected $php = array();
 	
 
 	protected $_lint = true;
 
    protected $mimes_engine = array(
         'application/vnd.frdl.script.php' => '_run_php_1',
         'application/php' => '_run_php_1',
         'text/php' => '_run_php_1',
         'php' => '_run_php_1',
         'multipart/mixed' => '_run_multipart',
         'multipart/serial' => '_run_multipart',
         'multipart/related' => '_run_multipart',
         'application/x-httpd-php' => '_run_php_1',
    );

	public function hugRunner(mixed $runner){
		$this->runner=$runner;		
	  return $this;
	}
	
	 public function getRunner(){	
	  return $this->runner;
	}
	 
	protected function _run_multipart($_Part){

		 	foreach( $_Part->getParts() as $pos => $part){
		 		if(isset($this->mimes_engine[$part->getMimeType()])){
					call_user_func_array(array($this, $this->mimes_engine[$part->getMimeType()]), array($part));
				}
    	    }

	}
	 
	 
   public function getPhpFileTypes(){
	   $a = [];
	   foreach($this->mimes_engine as $type => $handler){
		   if('_run_php_1'===$handler){
			   $a[]=$type;
		   }
	   }
	   return $a;
   }	 
	 
	 
   public function getBootStubs(){
	   return $this->get_file($this->document, '$__FILE__/stub.zip', 'archive stub.zip');	
   }
	 
	 
  	public function runStubs($stubs = null){	
      $BootStubs = (!is_null($stubs)) ? $stubs : $this->getBootStubs();	
		
		
	  foreach( $BootStubs->getParts() as $rootPos => $rootPart){
		//echo __METHOD__;
		  	 
		  
          if($rootPart->isMultiPart())	{
		 	foreach( $rootPart->getParts() as $pos => $part){		
				
		 		if(isset($this->mimes_engine[$part->getMimeType()])){
					call_user_func_array(array($this, $this->mimes_engine[$part->getMimeType()]), array($part));
				}				
    	    }
		  }else{
			 	if(isset($this->mimes_engine[$rootPart->getMimeType()])){ 
					//echo $rootPart->getName().'<br />';
					try{
					  \call_user_func_array(array($this, $this->mimes_engine[$rootPart->getMimeType()]), array($rootPart));
					}catch(\Exception $e){
					  echo $e->getMessage();
						throw $e;
					}
					 
				}			  
		  }
		//  break;
       }// each
		
		 
	 }


  public function addPhpStub($code, $file = null){
	  
		
	$archive = $this->get_file($this->document, '$__FILE__/stub.zip', 'archive stub.zip');

	  
	if(null === $file){
		$file = '$STUB/index-'.count($archive->getParts()).'.php';
	}
				   
    $archive->addFile('application/x-httpd-php', 'php', $code, $file/* = '$__FILE__/filename.ext' */, 'stub stub.php');
	return $this;
  }
	 
  public function addWebfile($path, $contents, $contentType = 'application/x-httpd-php', $n = 'php'){
	 $this->get_file($this->document, '$__FILE__/attach.zip', 'archive attach.zip')
		->addFile($contentType, $n, $contents, '$HOME/$WEB'.$path, 'stub '.$path);
	return $this;
  }
	 
  public function addClassfile($class, $contents){
	 $this->get_file($this->document, '$__FILE__/attach.zip', 'archive attach.zip')
		->addFile('application/x-httpd-php', 'php', utf8_encode($contents), '$DIR_PSR4/'.str_replace('\\', '/', $class).'.php', 'class '.$class);
	return $this;
  }
	 	 
	 
     public function get_file($part, $file, $name){
    	
		 if(null === $part || !is_object($part) ){
			return false; 
		 }
		 
			
      if($file === $part->getFileName() || $name === $part->getName()){
	  	   	  return $part;
	  }	
    	
	 	
	 $r = function($part, $file, $name, $r) {	   
		 if(null === $part || !is_object($part) ){
			return false; 
		 }		 
		 
	   if($file === $part->getFileName() || $name === $part->getName()){
	  	   	  return $part;
	   }		 
       if($part->isMultiPart())	{
        foreach( $part->getParts() as $pos => $_part){
					 if(null === $_part || !is_object($_part) ){			
						 continue; 		
					 }			
			if(!$_part->isMultiPart() && $file === $_part->getFileName() || $name === $_part->getName()){
		   	  return $_part;
	        }elseif($_part->isMultiPart()){
				 $_f = $r($_part, $file, $name, $r);
				if(false !== $_f){
				   return $_f;	
				}
			}
        }	
      } 
		 
		 return false;
	 };
		
		return $r($part, $file, $name, $r);
    }
	 
	 

	public function Autoload($class){
          $fnames = array( 
                  '$LIB/'.str_replace('\\', '/', $class).'.php',
                   str_replace('\\', '/', $class).'.php',
                  '$DIR_PSR4/'.str_replace('\\', '/', $class).'.php',
                  '$DIR_LIB/'.str_replace('\\', '/', $class).'.php',
           );
           
           $name = 'class '.$class;
           
          foreach($fnames as $fn){
			  
		  	$_p = $this->get_file($this->document, $fn, $name);
		  	if(false !== $_p){ 
				$this->_run_php_1($_p, $class);
				//return $_p;
				return true;
			}
		  } 
           
      //  return false;   
	}
	 
    public function lint(?bool $lint = null) : bool {
		 if(is_bool($lint)){
			$this->_lint=$lint; 
		 }
		return $this->_lint;
    }
	 
	public function _run_php_1($part, $class = null, ?bool $lint = null){
	
	
	//	set_time_limit(min(900, ini_get('max_execution_time') + 300));
			if(!isset($_ENV['FRDL_HPS_CACHE_DIR'])){
			  $_ENV['FRDL_HPS_CACHE_DIR'] = getenv('FRDL_HPS_CACHE_DIR');	
			}
		
		
		$cacheDir = (!empty($_ENV['FRDL_HPS_CACHE_DIR'])) ? rtrim($_ENV['FRDL_HPS_CACHE_DIR'], \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-includes' 
						: rtrim( \sys_get_temp_dir(), \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-includes';
		
		$cacheDirLint = (!empty($_ENV['FRDL_HPS_CACHE_DIR'])) ? rtrim($_ENV['FRDL_HPS_CACHE_DIR'], \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-lint' 
						: rtrim( \sys_get_temp_dir(), \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-lint';
		
		
		
	
		if(!is_dir($cacheDirLint)){	
			mkdir($cacheDirLint, 0775, true); 	
		}
		
		
		 if(!is_bool($lint)){
			$lint=$this->lint(); 
		 }	
		
		$code = $part->getBody();
		
		
  $code = trim($code);
  if('<?php' === substr($code, 0, strlen('<?php')) ){
	  $code = substr($code, strlen('<?php'), strlen($code));
  }
  $code = rtrim($code, '<?php> ');
  $codeWithStartTags = "<?php "."\n".$code."\n".'?>';	
		
	//	$codeWithStartTags ='<?php'."\n".$code;
		$res = false;
				  
		$name = $class;
		    if(!is_string($name)){
				$name = $part->getName();
			}
		
		    if(!is_string($name)){
				$name = $part->getFileName();
			}
	
		
		$fehler =      true === $lint  
			       &&  class_exists(\frdl\Lint\Php::class, $class !== \frdl\Lint\Php::class)
			       &&  class_exists(\Webfan\Helper\PhpBinFinder::class, $class !== \Webfan\Helper\PhpBinFinder::class) 
			       &&  class_exists(\Symfony\Component\Process\ExecutableFinder::class, $class !== \Symfony\Component\Process\ExecutableFinder::class) 
			       &&  class_exists(\Symfony\Component\Process\PhpExecutableFinder::class, $class !== \Symfony\Component\Process\PhpExecutableFinder::class) 
			    ? @(new \frdl\Lint\Php($cacheDirLint) ) ->lintString($codeWithStartTags)
			    : true;
	
					if(true !==$fehler ){		
						$e='Error in '.__METHOD__.' ['.__LINE__.']'.print_r($fehler,true).'<br />$class: '.$name.$part->getFileName().' 
						'.$part->getName();		
					    $e1 =  new \Exception($e.$fehler); 
			                    echo  \frdl\booting\getFormFromRequestHelper($e1->getMessage(), false);
		                            die();						
					}
					
				// 	echo $part->getName().'<br />'.$class.'<br />'.$fehler.'<br />'; 
		try{
	         	$res = eval($code);			
		}catch(\Webfan\Webfat\App\ResolvableException $e3){	
			//throw $e3;					 
			echo  \frdl\booting\getFormFromRequestHelper($class.' : '.$e3->getMessage(), false);
		      die();
		}catch(\Exception $e2){	
			$e='Error in '.__METHOD__.' ['.__LINE__.']'.print_r($fehler,true).'<br />$class: '.$name.$part->getFileName().''
				.$part->getName();	                
			$e4 = new \Exception($e2->getMessage().'<br />'.$e.print_r($res,true));		 
			echo  \frdl\booting\getFormFromRequestHelper($e4->getMessage(), false);
		      die();
		}
		// echo '<br />'.$code.'<br />'.'<br />';

		return $res;
	}
	 
	 	
 	public function __construct($file = null, $offset = 0){
 		$this->buf = &$this;
 		
 	 	if(null===$file)$file=__FILE__;
 	 	$this->__FILE__ = $file;
 	 	if(__FILE__===$this->__FILE__){
			$this->offset = $this->getAttachmentOffset(); 
		}else{
			$this->offset = $offset;
		}

        $this->initial_offset = $this->offset;
 	}
 	
 	
 	
 	
 	final public function __destruct(){
	  if(is_resource($this->IO))fclose($this->IO);
	}
	
	
	
	
   public function serializeFile(?string $code=null){
	   $code =(is_string($code)) ? $code : $this->__toString();
	   return $code;
   }
	 
   public function __set($name, $value)
    {
    	if('location'===$name){
    		$code = $this->serializeFile(null);
			file_put_contents($value, $code);
			return null;
		}
    	
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }    
    	 
	 
	 
    public function getAttachmentOffset(){
	    return __COMPILER_HALT_OFFSET__;
    } 
    
    
   public function __toString()
   {
 	 	  // 	$document = $this->document;	
	 		  $code = $this->exports;	
	 		  if(__FILE__ === $this->__FILE__) 	{
			   	 $php = substr($code, 0, $this->getAttachmentOffset());
			  }else{
			  	 $php = substr($code, 0, $this->initial_offset);
			  }
	 		 
	
    		$php = str_replace('define(\'\\___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___\', true);', '', $php);
    		$php = str_replace('define(\'___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___\', true);', '', $php);
      		
	        
	     $mime = $this->document;
    	
	     $newNamespace = "App\compiled\Instance\MimeStub5\MimeStubEntity".mt_rand(1000000,999999999);
	   
	 

    	    $php = preg_replace("/(".preg_quote('namespace '.__NAMESPACE__.'{').")/", 
								'namespace '.$newNamespace.'{',
								  $php);	   

	   
	   
				 $php = $php.$mime;				  

	 	return $php;
   }   
      
     
  public function __get($name)
    {

     switch($name){
	 	case 'exports':	 
	 		return $this->getFileAttachment($this->__FILE__, 0);
	 	break;
	 	case 'location':	 
	 		return $this->__FILE__;
	 	break;
	 	case 'document':
	 		if(false===$this->raw){
	 			$this->raw=$this->getFileAttachment($this->__FILE__, $this->initial_offset);
	 		}
	 		if(false===$this->MIME){
	 			$this->MIME=MimeStub5::create($this->raw);
	 		}
	 		return $this->MIME;
	 	break;
	 	
	 	default:
         return null;	 	
	 	break;
	 }

         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }
   
   
	
    public function __invoke()
    {
    	$args = func_get_args();
 	
	 		if(false===$this->raw){
	 			$this->raw=$this->getFileAttachment($this->__FILE__, $this->initial_offset);
	 		}
	 		if(false===$this->MIME){
	 			$this->MIME=MimeStub5::create($this->raw);
	 		}
 		
		   	

		$res = &$this;
		
        if(0<count($args)){
        $i=-1;
		foreach($args as $arg){
		  $i++;
		  	
		if(is_string($arg)){
    		$cmd = $arg;
    		if('run'===$arg){
				$res = call_user_func_array(array($this, '_run'), $args);
			}else{
    		
			$u = parse_url($cmd);
			$c = explode('.',$u['host']);
		    $c = array_reverse($c);
		    $tld = array_shift($c);
		    $f = false;
			if('frdl'===$u['scheme']){
				if('mime'===$tld){
					if(!isset($args[$i+1])){
						$res = $this->getFileAttachment($cmd, 0);
						$f = true;
					}else if(isset($args[$i+1])){
						//@todo write
					}
				}
			}	
			
			 if(false===$f){
			 		$parent = (isset($this->MIME->parent) && null !== $this->MIME->parent) ? $this->MIME->parent : null;
					$this->MIME=MimeStub5::create($cmd, $parent);					
			 }
			}

		}			
				
			}
		}elseif(0===count($args)){
			$res = &$this->buf;
		}
				      	

 	
    	
       return $res;
    }      
 	protected function _run(){
 	    $this->runStubs();
 	 	return $this;
 	} 	
 	
   public function __call($name, $arguments)
    {
    	
 	  return call_user_func_array(array($this->document, $name), $arguments);

    }
	
	
 

    public function getFileAttachment($file = null, $offset = null, ?bool $throw = true){
    	if(null === $file)$file = &$this->file;
    	if(null === $offset)$offset = $this->offset;
    	if(null === $file || empty($file))$file = $this->__FILE__;
		$IO = fopen($file, 'r');
		
        fseek($IO, $offset);
        try{
			$buf =  \stream_get_contents($IO);
			if(is_resource($IO))fclose($IO);
		}catch(\Exception $e){
			$buf = '';
			if(is_resource($IO))fclose($IO);
			//trigger_error($e->getMessage(),  $this->e_level);
			if($throw){
				throw $e;
			}
			return '';
		}
        
        return $buf;
	}	
	
	
   
 }


/**
*  https://github.com/Riverline/multipart-parser 
* 
* Class Part
* @package Riverline\MultiPartParser
* 
*  Copyright (c) 2015-2016 Romain Cambien
*  
*  Permission is hereby granted, free of charge, to any person obtaining a copy
*  of this software and associated documentation files (the "Software"),
*  to deal in the Software without restriction, including without limitation
*  the rights to use, copy, modify, merge, publish, distribute, sublicense,
*  and/or sell copies of the Software, and to permit persons to whom the Software
*  is furnished to do so, subject to the following conditions:
*  
*  The above copyright notice and this permission notice shall be included
*  in all copies or substantial portions of the Software.
*  
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
*  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
*  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
*  DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
*  ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
*  OTHER DEALINGS IN THE SOFTWARE.
* 
*  - edited by webfan.de
*/


  
class MimeStub5 implements StubItemInterface
{
 const NS = __NAMESPACE__;
 const DS = DIRECTORY_SEPARATOR;
 const FILE = __FILE__;
 const DIR = __DIR__;
		
 const numbers = '0123456789';
 const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 const specials = '!$%^&*()_+|~-=`{}[]:;<>?,./';
 
 
 
 	
	protected static $__i = -1;


	//protected $_parent;
    
    
    protected $_id = null;
    protected $_p = -1;   
    
    
    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $body;
    
    protected $_parent = null;

    /**
     * @var Part[]
     */
    protected $parts = array();

    /**
     * @var bool
     */
    protected $multipart = false;


    protected $modified = false;
    
    protected $contentType = false;
    protected $encoding = false;
    protected $charset = false;
    protected $boundary = false;
    

   
   
   
protected function _defaultsRandchars ($opts = array()) {
  $opts = array_merge(array(
      'length' =>  8,
      'numeric' => true,
      'letters' => true,
      'special' => false
  ), $opts);
  return array(
    'length' =>  (is_int($opts['length'])) ? $opts['length'] : 8,
    'numeric' => (is_bool($opts['numeric'])) ? $opts['numeric'] : true,
    'letters' => (is_bool($opts['letters'])) ? $opts['letters'] : true,
    'special' =>  (is_bool($opts['special'])) ? $opts['special'] : false
  );
}

protected function _buildRandomChars ($opts = array()) {
   $chars = '';
  if ($opts['numeric']) { $chars .= self::numbers; }
  if ($opts['letters']) { $chars .= self::letters; }
  if ($opts['special']) { $chars .= self::specials; }
  return $chars;
}

public function generateBundary($opts = array()) {
  $opts = $this->_defaultsRandchars($opts);
  $i = 0;
  $rn = '';
      $rnd = '';
      $len = $opts['length'];
      $randomChars = $this->_buildRandomChars($opts);
  for ($i = 1; $i <= $len; $i++) {
  	$rn = mt_rand(0, strlen($randomChars) -1);
  	$n = substr($randomChars, $rn,  1);
    $rnd .= $n;
  }
 
 return $rnd;
}   
    
    
    public function __set($name, $value)
    {
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }    
    
    
  public function __get($name)
    {
       // echo "Getting '$name'\n";
      //  if (array_key_exists($name, $this->data)) {
      //      return $this->data[$name];
      //  }
     switch($name){
     	case 'disposition' :
     	    return $this->getHeader('Content-Disposition');
     	    break;
	 	case 'parent':	 
	 		return $this->_parent;
	 	break;
	 	case 'id':	 
	 		return $this->_id;
	 	break;
	 	case 'nextChild':	
	 	    $this->_p=++$this->_p;
	 	    if($this->_p >= count($this->parts)/* -1*/)return false; 
	 		return (is_array($this->parts)) ? $this->parts[$this->_p] : null;
	 	break;
	 	case 'next':	 
	 		return $this->nextChild;
	 	break;
	 	case 'rewind':	 
	 	    $this->_p=-1;
	 		return $this;
	 	case 'root':	 
	 	    if(null === $this->parent || (get_class($this->parent) !== get_class($this)))return $this;
	 		return $this->parent->root;
	 	break;
	 	case 'isRoot':	 
	 		return ($this->root->id === $this->id) ? true : false;
	 	break;
	 	case 'lastChild':	 
	 		return (is_array($this->parts)) ? $this->parts[count($this->parts)-1] : null;
	 	break;
	 	case 'firstChild':	 
	 		return (is_array($this->parts) && isset($this->parts[0])) ? $this->parts[0] : null;
	 	break;
	 	
	 	
	 	default:
         return null;	 	
	 	break;
	 }

         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }
   
   
     protected function _hashBody(){
        if($this->isMultiPart()){
		//   $this->setHeader('Content-MD5', md5($this));
	 	//   $this->setHeader('Content-SHA1', sha1($this));
		} else{
		   $this->setHeader('Content-MD5', md5($this->body));
	 	   $this->setHeader('Content-SHA1', sha1($this->body));
	 	   $this->setHeader('Content-Length', strlen($this->body));
	 	} 
	 }
    
     protected function _hashBodyRemove(){
		   $this->removeHeader('Content-MD5');
	 	   $this->removeHeader('Content-SHA1');
	 	   $this->removeHeader('Content-Length');
	 }
	 
	      
     public function __call($name, $arguments)
    {
    	
    	if('setBody'===$name){
    		$this->clear();
    		if(!isset($arguments[0]))$arguments[0]='';
    		$this->prepend($arguments[0]);
            return $this;	 
		}elseif('prepend'===$name){
    		if(!isset($arguments[0]))$arguments[0]='';
    		if($this->isMultiPart()){
	    		$this->parts[] = new self($arguments[0], $this);
		    	return $this;				
			}else{
				$this->body = $arguments[0] . $this->body;
				$this->_hashBody();
				return $this;		
			}

		}elseif('append'===$name){
    		if(!isset($arguments[0]))$arguments[0]='';
    		if($this->isMultiPart()){
	    		$this->parts[] = new self($arguments[0], $this);
		    	return $this;				
			}else{
				$this->body .= $arguments[0];
				$this->_hashBody();
				return $this;		
			}

		}elseif('clear' === $name){
			if($this->isMultiPart()){
				$this->parts = array();
			}else{
				$this->body = '';
				$this->_hashBodyRemove();
			}
			return $this;
		}else{
			

		
		
		
    //https://tools.ietf.org/id/draft-snell-http-batch-00.html
    foreach(array('from', 'to', 'cc', 'bcc', 'sender', 'subject', 'reply-to'/* ->{'reply-to'}  */, 'in-reply-to',
    'message-id') as $_header){
      	if($_header===$name){
            if(0===count($arguments)){
				return $this->getHeader($_header, null);
			}elseif(null===$arguments[0]){
				$this->removeHeader($_header);
			}elseif(isset($arguments[0]) && is_string($arguments[0])){
            	$this->setHeader($_header, $arguments[0]);
            }
           return $this;		
		}  
    }	
	
   
   } 
   //else
   
    	/*
        // Note: value of $name is case sensitive.
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __call(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            */
         return null;
    }

    /**  As of PHP 5.3.0  */
    public static function __callStatic($name, $arguments)
    {
    	
     	if('run'===$name){
			return call_user_func_array('run', $arguments);
		}
    	   	
    	
     	if('vm'===$name){
     		if(0===count($arguments)){
				return new MimeVM();
			}elseif(1===count($arguments)){
				return new MimeVM($arguments[0]);
			}elseif(2===count($arguments)){
				return new MimeVM($arguments[0], $arguments[1]);
			}
     	  // return call_user_func_array(array(webfan\MimeVM, '__construct'), $arguments);
     	   return new MimeVM();
		}
    	
	
    	
    	 if('create'===$name){
    	 	if(!isset($arguments[0]))$arguments[0]='';
    	 	if(!isset($arguments[1]))$arguments[1]=null;
		 	return new self($arguments[0], $arguments[1]);
		 }
        // Note: value of $name is case sensitive.
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __callStatic(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            \E_USER_NOTICE);
            
            
         return null;
    }  
   
    public function getContentType()
    {
    	$this->contentType=$this->getMimeType();
        return $this->contentType;
    }
    
    
    public function headerName($headName)
    {
      $headName = str_replace('-', ' ', $headName);
      $headName = ucwords($headName);
      return preg_replace("/\s+/", "\s", str_replace(' ', '-', $headName));
    }
 
 


    /**
     * @param string $input A base64 encoded string
     *
     * @return string A decoded string
     */
    public static function urlsafeB64Decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * @param string $input Anything really
     *
     * @return string The base64 encode of what you passed in
     */
    public static function urlsafeB64Encode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }
    
    
 
   public static function strip_body($s,$s1,$s2=false,$offset=0, $_trim = true) {
    /*
    * http://php.net/manual/en/function.strpos.php#75146
    */

 //   if( $s2 === false ) { $s2 = $s1; }
    if( $s2 === false ) { $s2 = $s1.'--'; }
    $result = array();
    $result_2 = array();
    $L1 = strlen($s1);
    $L2 = strlen($s2);

    if( $L1==0 || $L2==0 ) {
        return false;
    }

    do {
        $pos1 = strpos($s,$s1,$offset);

        if( $pos1 !== false ) {
            $pos1 += $L1;

            $pos2 = strpos($s,$s2,$pos1);

            if( $pos2 !== false ) {
                $key_len = $pos2 - $pos1;

                $this_key = substr($s,$pos1,$key_len);
                if(true===$_trim){
					$this_key = trim($this_key);
				}

                if( !array_key_exists($this_key,$result) ) {
                    $result[$this_key] = array();
                }

                $result[$this_key][] = $pos1;
                $result_2[] = array(
                   'pos' => $pos1,
                   'content' => $this_key
                );

                $offset = $pos2 + $L2;
            } else {
                $pos1 = false;
            }
        }
    } while($pos1 !== false );

    return array(
      'pindex' => $result_2, 
      'cindex' => $result
    );
 }


    /**
     * MultiPart constructor.
     * @param string $content
     * @throws \InvalidArgumentException
     */
    protected function __construct($content, &$parent = null)
    {
    	$this->_id = ++self::$__i;
    	$this->_parent = $parent;
    	
        // Split headers and body
        $splits = preg_split('/(\r?\n){2}/', $content, 2);

        if (count($splits) < 2) {
            throw new \InvalidArgumentException("Content is not valid, can't split headers and content");
        }

        list ($headers, $body) = $splits;

        // Regroup multiline headers
        $currentHeader = '';
        $headerLines = array();
        foreach (preg_split('/\r?\n/', $headers) as $line) {
            if (empty($line)) {
                continue;
            }
            if (preg_match('/^\h+(.+)/', $line, $matches)) {
                // Multi line header
                $currentHeader .= ' '.$matches[1];
            } else {
                if (!empty($currentHeader)) {
                    $headerLines[] = $currentHeader;
                }
                $currentHeader = trim($line);
            }
        }

        if (!empty($currentHeader)) {
            $headerLines[] = $currentHeader;
        }

        // Parse headers
        $this->headers = array();
        foreach ($headerLines as $line) {
            $lineSplit = explode(':', $line, 2);
            if (2 === count($lineSplit)) {
                list($key, $value) = $lineSplit;
                // Decode value
                $value =function_exists('mb_decode_mimeheader') 
					? \mb_decode_mimeheader(trim($value)) 
					:  (function_exists('imap_mime_header_decode') 
						? \imap_mime_header_decode(trim($value))
					   : \iconv_mime_decode(trim($value)) );
            } else {
                // Bogus header
                $key = $lineSplit[0];
                $value = '';
            }
            // Case-insensitive key
            $key = strtolower($key);
            if (!isset($this->headers[$key])) {
                $this->headers[$key] = $value;
            } else {
                if (!is_array($this->headers[$key])) {
                    $this->headers[$key] = (array)$this->headers[$key];
                }
                $this->headers[$key][] = $value;
            }
        }

        // Is MultiPart ?
        $contentType = $this->getHeader('Content-Type');
        $this->contentType=$contentType;
        if ('multipart' === strstr(self::getHeaderValue($contentType), '/', true)) {
            // MultiPart !
            $this->multipart = true;
            $boundary = self::getHeaderOption($contentType, 'boundary');
            $this->boundary=$boundary;

            if (null === $boundary) {
                throw new \InvalidArgumentException("Can't find boundary in content type");
            }

            $separator = '--'.preg_quote($boundary, '/');

            if (0 === preg_match('/'.$separator.'\r?\n(.+?)\r?\n'.$separator.'--/s', $body, $matches)
              || \preg_last_error() !== \PREG_NO_ERROR
            ) {
              $bodyParts = self::strip_body($body,$separator."",$separator."--",0);
               if(1 !== count($bodyParts['pindex'])){
			 	 throw new \InvalidArgumentException("Can't find multi-part content");
			   }
			   $bodyStr = $bodyParts['pindex'][0]['content'];
			   unset($bodyParts);
            }else{
				$bodyStr = $matches[1];
			}


            

            $parts = preg_split('/\r?\n'.$separator.'\r?\n/', $bodyStr);
            unset($bodyStr);

            foreach ($parts as $part) {
                //$this->parts[] = new self($part, $this);
                $this->append($part);
            }
        } else {
        	
            // Decode
            $encoding = $this->getEcoding();
            switch ($encoding) {
                case 'base64':
                    $body = $this->urlsafeB64Decode($body);
                    break;
                case 'quoted-printable':
                    $body = quoted_printable_decode($body);
                    break;
            }

            // Convert to UTF-8 ( Not if binary or 7bit ( aka Ascii ) )
            if (!in_array($encoding, array('binary', '7bit'))) {
                // Charset
                $charset = self::getHeaderOption($contentType, 'charset');
                if (null === $charset) {
                    // Try to detect
                   $charset =function_exists('mb_detect_encoding') && \mb_detect_encoding($body) ? \mb_detect_encoding($body) : 'utf-8';
                }
                $this->charset=$charset;
            
                // Only convert if not UTF-8
                if ('utf-8' !== strtolower($charset)) {
                    $body =function_exists('mb_convert_encoding') 
						? \mb_convert_encoding($body, 'utf-8', $charset)
						: $body;
                }
            }

            $this->body = $body;
        }
    }


      
    public function __toString()
    {
    	$boundary = $this->getBoundary($this->isMultiPart());
    	$s='';
    	foreach($this->headers as $hname => $hvalue){
    		$s.= $this->headerName($hname).': '.  $this->getHeader($hname) /*$hvalue*/."\r\n";
		}
		
		$s.= "\r\n" ;
		if ($this->isMultiPart()) $s.=  "--" ;
		$s.= $boundary ;
		if ($this->isMultiPart()) $s.= "\r\n" ;	
		
		
		if ($this->isMultiPart()) {
            foreach ($this->parts as $part) {            	
               $s.=  (get_class($this) === get_class($part)) ? $part : $part->__toString() . "\r\n" ;
            }
             $s.= "\r\n"."--" . $boundary .  '--';
	    }else{

			$s.= $this->getBody(true, $encoding);
        }		
		
	     if (null!==$this->parent && $this->parent->isMultiPart() && $this->parent->lastChild->id !== $this->id){
            $s.= "\r\n" . "--" .$this->parent->getBoundary() . "\r\n";		
	     }
        return $s;
    }   
    
    public function getEcoding()
    {
    	$this->encoding=@strtolower($this->getHeader('Content-Transfer-Encoding'));
        return $this->encoding;
    }
    
    public function getCharset()
    {
      //  return $this->charset;
       $charset = self::getHeaderOption($this->getMimeType(), 'charset');
        if(!is_string($charset)) {
          // Try to detect
          $charset = mb_detect_encoding($this->body) ?: 'utf-8';
        }
      $this->charset=$charset;
      return $this->charset;       
    }
    
     
    public function setBoundary($boundary = null, $opts = array())
    {
       	$this->mod();

    	if(null===$boundary){
 			$size = 8;
			if(4 < count($this->parts))$size = 32;
			if(6 < count($this->parts))$size = 40;
			if(8 < count($this->parts))$size = 64;
			if(10 <= count($this->parts))$size = 70;
			$opt = array(
			  'length' => $size
			);
			

			$options = array_merge($opt, $opts);
			$boundary = $this->generateBundary($options);
		}

			$this->boundary =$boundary;
			$this->setHeaderOption('Content-Type', $this->boundary, 'boundary');		
   }  
    
       
    public function getBoundary($generate = true)
    {
        $this->boundary = self::getHeaderOption($this->getHeader('Content-Type'), 'boundary');
        if(true === $generate && $this->isMultiPart() 
           && (!is_string($this->boundary) || 0===strlen(trim($this->boundary))) 
        ){
        	$this->setBoundary();
		}
        return $this->boundary;
    }   
        /** 
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function mod()
    {
       $this->modified = true;
       return $this;
    }     
    
    public function setHeader($key, $value)
    {
       $this->mod();
       $key = strtolower($key);
       $this->headers[$key]=$value;
       
		//	 echo print_r($this->headers, true);
			 
       return $this;
    }     
     
    public function removeHeader($key)
    {
       $this->mod();
       unset($this->headers[$key]);
       return $this;
    }     
       
   public function setHeaderOption($headerName, $value = null, $opt = null)
    {
       $this->mod();
    	$old_header_value = $this->getHeader($headerName);
     		 		
		
        if(null===$opt && null !==$value){
			 $this->headers[$headerName]=$value;
		}else if(null !==$opt && null !==$value){
             list($headerValue,$options) = self::parseHeaderContent($old_header_value);
             $options[$opt]=$value;
			 $new_header_value = $headerValue;
		 //	$new_header_value='';
			 foreach($options as $o => $v){
			 	$new_header_value .= ';'.$o.'='.$v.'';
			 }

			 $this->setHeader($headerName, $new_header_value);	
		} 
         

       return $this;
    }
    
              

    /**
     * @return bool
     */
    public function isMultiPart()
    {
        return $this->multipart;
    }

    /**
     * @return string
     * @throws \LogicException if is multipart
     */
    public function getBody($reEncode = false, &$encoding = null)
    {
        if ($this->isMultiPart()) {
            throw new \LogicException("MultiPart content, there aren't body");
        } else {
	    	$body = $this->body;
	    	
	     if(true===$reEncode){
            $encoding = $this->getEcoding();
            switch ($encoding) {
                case 'base64':
                    $body = $this->urlsafeB64Encode($body);
                    break;
                case 'quoted-printable':
                    $body = \quoted_printable_encode($body);
                    break;
            }

            // Convert to UTF-8 ( Not if binary or 7bit ( aka Ascii ) )
            if (!in_array($encoding, array('binary', '7bit'))) {
                // back de-/encode 
                if (    'utf-8' !== @strtolower(self::getHeaderOption($this->getMimeType(), 'charset'))
                     && 'utf-8' === @\mb_detect_encoding($body)) {
                    $body = @\mb_convert_encoding($body, self::getHeaderOption($this->getMimeType(), 'charset'), 'utf-8');
                }elseif (    'utf-8' === @strtolower(self::getHeaderOption($this->getMimeType(), 'charset'))
                     && 'utf-8' !== @\mb_detect_encoding($body)) {
                    $body = @\mb_convert_encoding($body, 'utf-8', \mb_detect_encoding($body));
                }
            }   		 	
		 }	
         
            
            return $body; 
        }
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function getHeader($key, $default = null)
    {
        // Case-insensitive key
        $key = strtolower($key);
        if (isset($this->headers[$key])) {
            return $this->headers[$key];
        } else {
            return $default;
        }
    }

    /**
     * @param string $content
     * @return array
     */
    static protected function parseHeaderContent($content)
    {
        $parts = @explode(';', $content);
        $headerValue = array_shift($parts);
        $options = array();
        // Parse options
        foreach ($parts as $part) {
            if (!empty($part)) {
                $partSplit = explode('=', $part, 2);
                if (2 === count($partSplit)) {
                    list ($key, $value) = $partSplit;
                    $options[trim($key)] = trim($value, ' "');
                } else {
                    // Bogus option
                    $options[$partSplit[0]] = '';
                }
            }
        }

        return array($headerValue, $options);
    }

    /**
     * @param string $header
     * @return string
     */
    static public function getHeaderValue($header)
    {
        list($value) = self::parseHeaderContent($header);

        return $value;
    }

    /**
     * @param string $header
     * @return string
     */
    static public function getHeaderOptions($header)
    {
        list(,$options) = self::parseHeaderContent($header);

        return $options;
    }

    /**
     * @param string $header
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    static public function getHeaderOption($header, $key, $default = null)
    {
        $options = self::getHeaderOptions($header);

        if (isset($options[$key])) {
            return $options[$key];
        } else {
            return $default;
        }
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        // Find Content-Disposition
        $contentType = $this->getHeader('Content-Type');

        return self::getHeaderValue($contentType) ?: 'application/octet-stream';
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        // Find Content-Disposition
        $contentDisposition = $this->getHeader('Content-Disposition');

        return self::getHeaderOption($contentDisposition, 'name');
    }

    /**
     * @return string|null
     */
    public function getFileName()
    {
        // Find Content-Disposition
        $contentDisposition = $this->getHeader('Content-Disposition');

        return self::getHeaderOption($contentDisposition, 'filename');
    }

    /**
     * @return bool
     */
    public function isFile()
    {
        return !is_null($this->getFileName());
    }

    /**
     * @return Part[]
     * @throws \LogicException if is not multipart
     */
    public function getParts()
    {
        if ($this->isMultiPart()) {
            return $this->parts;
        } else {
            throw new \LogicException("Not MultiPart content, there aren't any parts");
        }
    }

    /**
     * @param string $name
     * @return Part[]
     * @throws \LogicException if is not multipart
     */
    public function getPartsByName($name)
    {
        $parts = array();

        foreach ($this->getParts() as $part) {
            if ($part->getName() === $name) {
                $parts[] = $part;
            }
        }

        return $parts;
    }
    
    
    
    
    
    
    
    	public function addFile($type = 'application/x-httpd-php', $disposition = 'php', $code= '', $file= '', $name= ''){
	 
		
       //   if(null===$parent){
	//		$parent = &$this;
	//	 }
/*		
            $code = trim($code); 		
		    $N = new self($this->newFile($type, $disposition, $file, $name), $parent);		    
		    $N->setBody($code);
		    if(\webfan\hps\Format\Validate::isbase64($code) ){
				 $N->setHeader('Content-Transfer-Encoding', 'BASE64');
			}
		    $N->setBoundary($N->getBoundary($N->isMultiPart()));
		
	     //	$parent->append($N);
		 */
		// $parent->append( $this->newFile($type, $disposition, $file, $name, $code) );
		    $class = \get_class($this);
		    $N = new $class($this->newFile($type, $disposition, $file, $name, $code), $parent);		    
		 //   $N->setBody($code);
		   // $N->setBoundary($N->getBoundary($N->isMultiPart()));
		    $this->append($N);
		
		return $this;
	}    	 
	
public function newFile($type = 'application/x-httpd-php', $disposition = 'php', $file = '$HOME/index.php', $name = 'stub stub.php', $code = ''){
	
if(null === $boundary){
  $boundary = $this->getBoundary($this->isMultiPart());
}

	while($code === $boundary){
        $boundary = $this->generateBoundary([
			    'length' =>  max(min(8, strlen($code)), 32),
                'numeric' => true,
                'letters' => true,
                'special' => false
			]);
		 $this->setBoundary($boundary);
	}


$codeWrap ='';
	

				   
if(is_string($type)){	
$codeWrap.= <<<HEADER
Content-Disposition: "$disposition" ; filename="$file" ; name="$name"
Content-Type: $type
HEADER;
}else{
 $codeWrap.= "Content-Disposition: ".$disposition." ; filename=\"".$file."\" ; name=\"".$name."\"";	
}

	
if('application/x-httpd-php' === $type || 'application/vnd.frdl.script.php' === $type){
  $code = trim($code);
  if('<?php' === substr($code, 0, strlen('<?php')) ){
	  $code = substr($code, strlen('<?php'), strlen($code));
  }
  $code = rtrim($code, '<?php> ');
  $code = '<?php '.$code.' ?>';	
}
					 
					 
	
$codeWrap.= "\r\n"."\r\n". trim($code);	
	
//$codeWrap.=\PHP_EOL. $code. \PHP_EOL. \PHP_EOL.'--'.$boundary.'--';
//$codeWrap.= \PHP_EOL;	
//$codeWrap.= \PHP_EOL;		  Content-Type: $type ; charset=utf-8 ;boundary="$boundary"   Content-Type: $type ; charset=utf-8 ;boundary="$boundary"
 return $codeWrap;
} 	
	
}

	

	

class MimeStubIndex extends MimeStub5 {
	
} 




	

class StubRunner extends \ArrayObject implements StubRunnerInterface, StubModuleInterface, StubAsFactoryInterface//, StubContextDirectoriesInterface
{
	
	const DEF_SOURCE = 'https://raw.githubusercontent.com/frdlweb/webfat/main/public/index.php';
	const FILENAME = 'webfat.php';
	public $max_webfat_file_lifetime = 3 * 24 * 60 * 60;
	protected $LOCATIONS =[
		 
		
	];
	
	protected $source = null;
	protected $StubRunners = [];
	
	
	protected $MimeVM = null;
	protected $Codebase = null;
	protected $RemoteAutoloader = null;
	
	protected static $instance = null;


	public function __construct(?StubHelperInterface &$MimeVM){
		parent::__construct([]);
                $this->StubRunners[$this->_oid()] = $this->StubRunners[__FILE__] =  &$this; 
		$this->MimeVM=$MimeVM;	

		if(null === self::$instance){
		   self::$instance = $this;
		}		
	}	

	protected function _oid(){
          return sprintf('@spl_object_id(%s)@', spl_object_id($this) );
       }

	
	
	public function instance(?object $instance = null)  : object {
		if(is_object($instance) && !is_null($instance)){
			self::$instance = $instance;
		}elseif(null === self::$instance){
			self::$instance = $this;
		}
	  return self::$instance;
	}	
	
 	public function loginRootUser($username = null, $password = null) : bool{
		throw new \Exception('Not implemented yet or deprectaed: '.__METHOD__);
	}
	public function isRootUser() : bool{
		throw new \Exception('Not implemented yet or deprectaed: '.__METHOD__);
	}
	public function getStubVM() : StubHelperInterface{		
		$this->MimeVM->hugRunner($this);   
		return $this->MimeVM;
	}
	public function getStub() : StubItemInterface{
		return $this->getStubVM()->document;
	}
	
	
	public function autoUpdateStub(string | bool $update = null, string $newVersion = null, string $url = null){
	  $this->init();	
	
	   $config=$this->config();	
	   $configVersion = $this->configVersion();
	   $configVersionOld = array_merge([], $configVersion);	

		           $ContainerBuilder = isset($this['Container']) ? $this['Container'] : $this->getAsContainer(null);
			   $cacheDirLint = rtrim(($ContainerBuilder && $ContainerBuilder->has('app.runtime.dir')
								 ? $ContainerBuilder->get('app.runtime.dir') 
								 : getenv('FRDL_WORKSPACE') ) , \DIRECTORY_SEPARATOR.'/\\ ')
						              .\DIRECTORY_SEPARATOR. 'runtime' .\DIRECTORY_SEPARATOR
				                              . 'tmp' .\DIRECTORY_SEPARATOR. 'temp-lint' .\DIRECTORY_SEPARATOR;
		
           $ShutdownTasks = \frdlweb\Thread\ShutdownTasks::mutex();
           $ShutdownTasks(function($update, $newVersion, $config, $configVersion, $url, $file, $cacheDirLint, $configVersionOld, $ContainerBuilder, $me){


                   if(!isset($configVersion['last_time_update_check'])
		       || !isset($configVersion['last_time_update_stub'])
		       || !isset($configVersion['update_stub_download_url'])
		       || !isset($configVersion['update_stub_latest_version'])
		       || min($configVersion['last_time_update_stub'], $configVersion['last_time_update_check']) < time() - $config['AUTOUPDATE_INTERVAL']){

			    $maxExecutionTime = intval(ini_get('max_execution_time'));	

			   if (strtolower(\php_sapi_name()) !== 'cli') {	  
				   @set_time_limit(180);
			   }
			  // @ini_set('display_errors','On');
			  // error_reporting(\E_ERROR | \E_WARNING | \E_PARSE);		
	  
			   $configVersion['last_time_update_check'] = time();
			   $configVersion['last_time_update_stub']  = time();
			   
 			         $export = $configVersion;			    
				 $varExports = var_export($export, true);
				 
			     file_put_contents($me->getStubVM()->location.'.version_config.php', '<?php
			        return '.$varExports.';             
	                    ');
			   
			   if($ContainerBuilder && $ContainerBuilder->has(\Webfan\InstallerClient::class)){
                              $InstallerClient = $ContainerBuilder->get(\Webfan\InstallerClient::class);
			      $infoNew = $InstallerClient
				 ->info(
					 $configVersion['appId'],
					 isset($configVersion['channel'])
					    ? $configVersion['channel']
					    : 'latest',
					 $configVersion
				 );
			      $configVersion['update_stub_download_url']=$infoNew['update_stub_download_url'];
			      $configVersion['update_stub_latest_version']=$infoNew['update_stub_latest_version'];
			      $configVersion['versions']=$infoNew['versions'];
	   
				$export = $configVersion;			    
				 $varExports = var_export($export, true);
				 
			     file_put_contents($me->getStubVM()->location.'.version_config.php', '<?php
			        return '.$varExports.';             
	                    ');   
			   }
		   }
             
		   if(!is_string($newVersion) && isset($configVersion['update_stub_latest_version']) ){
                      $newVersion =  $configVersion['update_stub_latest_version'];
		   }
		   
		   
		 if((is_string($update) && 'auto' === $update) ){
			 $update =  true === $config['autoupdate']
				 && max($configVersion['last_time_update_stub'], $configVersion['last_time_update_check'])
				 < time() - $config['AUTOUPDATE_INTERVAL']
				  && !version_compare($configVersion['version'], $newVersion, '==');
	 
		 }elseif( is_bool($update) ){
			$update =  (bool)$update;
		 }else{
			$update =  false;
		 }
		   
		   if( is_string($newVersion) ){
                       	$configVersion['update_stub_download_url']=isset($configVersion['versions'][$newVersion]) && isset($configVersion['versions'][$newVersion]['update_stub_download_url'])
				? $configVersion['versions'][$newVersion]['update_stub_download_url']
				: $configVersion['update_stub_download_url'];
			$configVersion['update_stub_latest_version']=isset($configVersion['versions'][$newVersion]) 
				? $newVersion
				: $configVersion['update_stub_latest_version'];   
			   
			$update =  $update || !version_compare($configVersion['version'], $newVersion, '>=');
		   }
		   
		 if(true === $update){	 	
			 			
			 if(null === $url && isset($configVersion['update_stub_download_url'])){	     
			     $url = $configVersion['update_stub_download_url'];	  	 
			 }elseif(null === $url){	     
			     $url = 'https://raw.githubusercontent.com/frdlweb/webfat/main/public/index.php?cache-bust='.time();	  	 
			 }
			 
			 $thisCode = file_get_contents($url);	
			 if(isset($configVersion['appId'])){
			   $thisCode = str_replace("/****'appId'=>'@@@APPID@@@',*****/", '\'appId\'=>\''.$configVersion['appId'].'\',', $thisCode);	
                           $thisCode = str_replace('/****$configVersion[\'appId\']=\'@@@APPID@@@\';*****/', '$configVersion[\'appId\']=\''.$configVersion['appId'].'\';', $thisCode);
			 }
			 if(false!==$thisCode && true === (new \frdl\Lint\Php($cacheDirLint) )->lintString($thisCode) ){	   
				 file_put_contents($file, trim($thisCode));	 
				 $configVersion['last_time_update_stub'] = time();
			 }else{
				 if(!isset($configVersion['update_errors'])){
                                    $configVersion['update_errors'] = [];
				 }

				 while(count( $configVersion['update_errors']) > 10){
                                    array_pop($configVersion['update_errors']);
				 }

				  array_unshift($configVersion['update_errors'], 'Could not update '.$configVersion['appId'].' to '.$newVersion.'('.time().')');
                         } 

			 if(getenv('FRDL_WORKSPACE') !== $_SERVER['DOCUMENT_ROOT'] 
			    && !file_exists(getenv('FRDL_WORKSPACE').\DIRECTORY_SEPARATOR.'.htaccess') ){
                                file_put_contents(getenv('FRDL_WORKSPACE').\DIRECTORY_SEPARATOR.'.htaccess', <<<HTACCESSCONTENT
Deny from all
Allow from localhost						  
HTACCESSCONTENT);					
					
			 }

			 
		 }//update  true===$update			
			      
		   $export = array_merge($configVersion, [
		         'version' => is_string($newVersion) ? $newVersion : $configVersion['version'],
		    ]);	
		   
		   if(true === $update || 0 < count( array_diff_assoc($configVersion, $configVersionOld) )){                                         
		    
				 $varExports = var_export($export, true);
				 
			     file_put_contents($me->getStubVM()->location.'.version_config.php', '<?php
			        return '.$varExports.';             
	                    ');
		   }

		    if(true === $update){
                       $me->getRemoteAutoloader($export, $config)->prune(5);
		    }
             }, $update, $newVersion, $config, $configVersion, $url, __FILE__ , $cacheDirLint, $configVersionOld, $ContainerBuilder, $this);  	
	}
	
	
	public function hugVM(?StubHelperInterface $MimeVM){
		$this->MimeVM=$MimeVM;
	  return $this;
	}
	public function getInvoker(){
		return [$this, '__invoke']; 
	}

	
	public function getShield(){
		throw new \Exception('Not implemented yet or deprectaed: '.__METHOD__);
	}
	
    public function config(?array $config = null, $trys = 0) : array{
		  $trys++;
		
          try{  
			  $f =  $this->getStubVM()->get_file($this->getStub(), '$HOME/apc_config.php', 'stub apc_config.php'); 
			  if($f)$conf = $this->getStubVM()->_run_php_1($f);	 
			  if(!is_array($conf) ){
				  $conf=[];  
			  } 
		  }catch(\Exception $e){  
			  $conf=[];   
		  }
		
		    if(null === $config){
			  return $conf;	
			}
		
               $export = array_merge($conf, $config);
		       $varExports = var_export($export, true);
		
      		  $this->getStubVM()->get_file($this->getStub(), '$HOME/apc_config.php', 'stub apc_config.php')
			  ->  setBody('
			    if(file_exists(__FILE__.\'.apc_config.php\')){
				  return require __FILE__.\'.apc_config.php\';
				}
			    return '.$varExports.';
			  ')
			  ;
		
		       file_put_contents($this->getStubVM()->location.'.apc_config.php', '<?php
			        return '.$varExports.';
               ');

	    $newContent = $this->getStubVM()->serializeFile(null);
		$fp = fopen($this->getStubVM()->location, 'w+');
		if (flock($fp, \LOCK_EX | \LOCK_NB)) {  
			register_shutdown_function(function($fp){
				if(is_resource($fp))@flock($fp, \LOCK_UN);
				if(is_resource($fp))fclose($fp);
			}, $fp);
			fwrite($fp, $newContent);   
			flock($fp, \LOCK_UN);
		} else {  
			//echo 'can\'t lock';
			fclose($fp);
			if($trys < 999999){
				//set_time_limit(min(45, max(intval(ini_get('max_execution_time')), 45)));
				set_time_limit(180);
				usleep(100);
				return $this->config($config, $trys);
			}
			throw new \Exception('Cannot log stub in '.__METHOD__);
		}
		fclose($fp);
  
	   return $export;
	}
	
	public function configVersion(?array $config = null, $trys = 0) : array{	
		  $trys++;
		  @chmod(dirname($this->getStubVM()->location), 0777); 
		  @chmod($this->getStubVM()->location, 0777);
          try{  
			  $f =  $this->getStubVM()->get_file($this->getStub(), '$HOME/version_config.php', 'stub version_config.php'); 
			  if($f)$conf = $this->getStubVM()->_run_php_1($f);	 
			  if(!is_array($conf) ){
				  $conf=[];  
			  } 
		  }catch(\Exception $e){  
			  $conf=[];   
		  }
		
		    if(null === $config){
			  return $conf;	
			}
		
               $export = array_merge($conf, $config);		       
		       $varExports = var_export($export, true);
		
      		  $this->getStubVM()->get_file($this->getStub(), '$HOME/version_config.php', 'stub version_config.php')				  			
				  ->  setBody('
			    if(file_exists(__FILE__.\'.version_config.php\')){
				  return require __FILE__.\'.version_config.php\';
				}
			    return '.$varExports.';
			  ')
			  ;
		
		      		       
		       file_put_contents($this->getStubVM()->location.'.version_config.php', '<?php
			        return '.$varExports.';
               ');

		$newContent = $this->getStubVM()->serializeFile(null);
		$fp = fopen($this->getStubVM()->location, 'w+');
		if (flock($fp, \LOCK_EX | \LOCK_NB)) {  
			register_shutdown_function(function($fp){
				if(is_resource($fp))@flock($fp, \LOCK_UN);
				if(is_resource($fp))fclose($fp);
			}, $fp);
			fwrite($fp, $newContent);   
			flock($fp, \LOCK_UN);
		} else {  
			//echo 'can\'t lock';
			fclose($fp);
			if($trys < 999999){
				//set_time_limit(min(45, max(intval(ini_get('max_execution_time')), 45)));
				set_time_limit(180);
				usleep(100);
				return $this->config($config, $trys);
			}
			throw new \Exception('Cannot log stub in '.__METHOD__);
		}
		fclose($fp);
  
	   return $export;		
	}
				
	
	public function getCodebase() :?\Frdlweb\Contract\Autoload\CodebaseInterface{
		//	die(__METHOD__.\class_exists(\Webfan\Webfat\Codebase::class));
		
		if(null === $this->Codebase){ 
			try{
			       \class_exists(\Webfan\Webfat\Codebase::class);
				}catch(\Exception $e){
			  exit($e->getMessage());	
			}
				
			try{	
			   $this->Codebase = new \Webfan\Webfat\Codebase();
			  $this->Codebase->loadUpdateChannel($this);			
			}catch(\Exception $e){
			  exit($e->getMessage());	
			}
		}
		
		
		return $this->Codebase;
	}
	
	public function getRemoteAutoloader(?array $configVersion = null, ?array $config = null, ?\Frdlweb\Contract\Autoload\CodebaseInterface $codebase = null) : LoaderInterface {
		
		if(null !== $this->RemoteAutoloader){
		   return $this->RemoteAutoloader;	
		}
		
		$codebase = $codebase ?? $this->getCodebase();
		$configVersion = $configVersion ?? $this->configVersion();
		$config = $config ?? $this->config(); 
		
		 
		
		try{
	
			$this->RemoteAutoloader = \call_user_func(function($version, $s, $cacheDir, $l, $ccl, $cl) {	 
				$af = rtrim($cacheDir, '\\/ ') 
					.\DIRECTORY_SEPARATOR
					.str_replace('\\', \DIRECTORY_SEPARATOR, \frdl\implementation\psr4\RemoteAutoloaderApiClient::class).'.php';
	
				if(!is_dir(dirname($af))){	
					mkdir( dirname($af) , 0775 , true); 
				}
             	
             
             	
 
				$cbCheckFile = $af.'.last-remote-access.txt';
				$holdBreakDuration = 60;
				if(!file_exists($af) || filemtime($af) < time() - max($ccl, 60*60)){ 
					if(file_exists($cbCheckFile)){
						if(filemtime($cbCheckFile) > time() - $holdBreakDuration || intval(file_get_contents($cbCheckFile)) > time() - $holdBreakDuration ){
							$mesage = 'We tried to request '.\frdl\implementation\psr4\RemoteAutoloaderApiClient::class;
							$mesage.= ' unsuccessfully short time , ago. The page will reload automatically...!';
							echo \frdl\booting\getFormFromRequestHelper($mesage, true, $holdBreakDuration, null);
							die();
						}
					}
					
					
					file_put_contents($cbCheckFile, time());
					
					        $options = [        
								'https' => [          
									'method'  => 'GET',          
									'ignore_errors' => true,          
									//'header'=> "X-Source-Encoding: b64\r\n"               
									// . "Content-Length: " . strlen($data) . "\r\n"				
									
           
								]
        
							];
      
					$context  = \stream_context_create($options);       
					$code = @file_get_contents($l, false, $context);
					if(false === $code){
					      touch($cbCheckFile);
					      echo 'Fehler mit: ';					          
				           foreach($http_response_header as $i => $header){
                                               $h = explode(':', $header);
                                               $k = strtolower(trim($h[0]));
                                               $v =  (isset($h[1])) ? trim($h[1]) : $header;           
                                                 echo $k.' : '.$v.'<br />';
					  }	
					}else{					
						file_put_contents($af, $code);	
					}
				}
      
				if(!\class_exists(\frdl\implementation\psr4\RemoteAutoloaderApiClient::class) && file_exists($af) ){   					
					require $af;         
				}	
		
		
                 $loader = \frdl\implementation\psr4\RemoteAutoloaderApiClient::getInstance($s,
																	 false, 
																	 $version,
																	 true,
																	 false, 
																	 null/*[]*/,
																	 $cacheDir/*null*/, 
																	 $cl);	
		
     		
		          $loader->withWebfanWebfatDefaultSettings($cacheDir);  
		       //   $loader->register(false);	
		
                 return $loader;
        }, 																				 
         $codebase->getUpdateChannel(),
	 $codebase->getRemotePsr4UrlTemplate(),				
	 rtrim($this->getApplicationsDirectory(), '\\/ ')
									  .\DIRECTORY_SEPARATOR
									  .'runtime'.\DIRECTORY_SEPARATOR
			                         .'cache'.\DIRECTORY_SEPARATOR
			                         .'classes'.\DIRECTORY_SEPARATOR
			                         .'psr4'.\DIRECTORY_SEPARATOR,			    
	'https://raw.githubusercontent.com/frdl/remote-psr4/master/src/implementations/autoloading/RemoteAutoloaderApiClient.php'
						  .'?cache-bust='.time(), 			 
	  $config['FRDL_REMOTE_PSR4_CACHE_LIMIT_SELF'],
	  $config['FRDL_REMOTE_PSR4_CACHE_LIMIT']
	);

		}catch(\Exception $e){ 
			$this->RemoteAutoloader = false; 
			throw $e;
		}	
		
		
		 
		
	   return $this->RemoteAutoloader;
	}	
	
	

	public function getFrdlwebWorkspaceDirectory() : string {
		if(!empty(getenv('FRDL_WORKSPACE'))){
		  return getenv('FRDL_WORKSPACE');	
		}
		 $this->init();
		 return getenv('FRDL_WORKSPACE');	
	}
	
	public function getWebrootConfigDirectory() : string {
		 
	  $webrootConfigDir = 
	        $this->getFrdlwebWorkspaceDirectory()
			.\DIRECTORY_SEPARATOR.urlencode('circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1').\DIRECTORY_SEPARATOR	
			.sha1(str_replace(getenv('HOME'), '', $_SERVER['DOCUMENT_ROOT']))
			.\DIRECTORY_SEPARATOR;
		if(!is_dir($webrootConfigDir)){
			 @mkdir($webrootConfigDir,0775,true);
		}
	  return $webrootConfigDir;
	}
	
	public function getApplicationsDirectory() : string {
   // @ ob_start();
		$codebase = $this->getCodebase();
		$ApplicationsDirectory = false;
		$configVersion = $this->configVersion();
				
		$webrootConfigFile = rtrim($this->getWebrootConfigDirectory(), '\\/ ').\DIRECTORY_SEPARATOR.'app.php';
   
         if(false === $ApplicationsDirectory && file_exists($webrootConfigFile)){	  
		   $webrootConfig = require $webrootConfigFile;       
		   $ApplicationsDirectory =$webrootConfig['stages'][$webrootConfig['stage']];	 
		   if(!is_dir($ApplicationsDirectory)
		      && is_string($ApplicationsDirectory)
		      && !empty($ApplicationsDirectory)
		      && !@mkdir($ApplicationsDirectory, 0775, true)){
		          $ApplicationsDirectory = false;	 
		  }		 
	   }
		
         if(false === $ApplicationsDirectory && isset($configVersion['appId'])){	
		 $webrootConfigFile = rtrim($this->getFrdlwebWorkspaceDirectory(), '\\/ ')
			   .\DIRECTORY_SEPARATOR.'apps'.\DIRECTORY_SEPARATOR	
			   .urlencode($configVersion['appId'])	
			   .\DIRECTORY_SEPARATOR.'app.php';
      
		 if(file_exists($webrootConfigFile)){	  
		   $webrootConfig = require $webrootConfigFile;       
		   $ApplicationsDirectory =$webrootConfig['stages'][$webrootConfig['stage']];	 	 
		 }else{ 
			 $ApplicationsDirectory =  rtrim($this->getFrdlwebWorkspaceDirectory(), '\\/ ')
			   .\DIRECTORY_SEPARATOR.'apps'.\DIRECTORY_SEPARATOR	
			   .urlencode($configVersion['appId'])	
			   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				//    .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR; 			 
		 }
		 
		// if(!is_dir($ApplicationsDirectory) && !@mkdir($ApplicationsDirectory, 0775, true)){
		//   $ApplicationsDirectory = false;	 
		// }
	   }

       $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);
 
		   if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true)  ){
			   $ApplicationsDirectory = $this->getFrdlwebWorkspaceDirectory().\DIRECTORY_SEPARATOR.'global'.\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				 //   .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR; 
		   } 
//mkdir(realpath('/volume1/web/~frdl/global/app/deployments/blue/deploy/app/'), 0775, true);
  

             $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);
		   if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  
			   $ApplicationsDirectory = getenv('HOME')
			   .\DIRECTORY_SEPARATOR
			   .'.frdl'
			   .\DIRECTORY_SEPARATOR
			   .'global'
			   .\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				  //  .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR; 
		   } 
		  
		 


	 $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);
    if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  

      $dirs = array_filter(glob(getenv('HOME').'/*'), 'is_dir');

      foreach ($dirs as $dir) {
      		
        if (false!==strpos($dir, 'frdl') &&  false===strpos($dir, '@') && is_writable($dir) && is_readable($dir)) {
            //echo realpath($dir).' is writable.<br>';
            $ApplicationsDirectory = $dir 
			   .\DIRECTORY_SEPARATOR
			   .'.frdl'
			   .\DIRECTORY_SEPARATOR
			   .'global'
			   .\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				 //   .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR;
				   if(is_dir($ApplicationsDirectory)  || @mkdir($ApplicationsDirectory, 0775, true) ){  
				     break;
			       }				   
        } else {
           //    echo $dir.' is not writable. Permissions may have to be adjusted.<br>';
        } 
      }
	}	
	
	 $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);
    if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  

      $dirs = array_filter(glob($_SERVER['DOCUMENT_ROOT'].'/../*/'), 'is_dir');

      foreach ($dirs as $dir) {
      		
        if (false!==strpos($dir, 'frdl') &&  false===strpos($dir, '@') && is_writable($dir) && is_readable($dir)) {
            //echo realpath($dir).' is writable.<br>';
            $ApplicationsDirectory = $dir 
			   .\DIRECTORY_SEPARATOR
			   .'.frdl'
			   .\DIRECTORY_SEPARATOR
			   .'global'
			   .\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				 //   .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR;
				   if(is_dir($ApplicationsDirectory)  || @mkdir($ApplicationsDirectory, 0775, true) ){  
				     break;
			       }				   
        } else {
           //    echo $dir.' is not writable. Permissions may have to be adjusted.<br>';
        } 
      }
	}		
	
	
		

 $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);
    if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  

      $dirs = array_filter(glob(__DIR__.'/../*/'), 'is_dir');

      foreach ($dirs as $dir) {
        if (false===strpos($dir, '@') && is_writable($dir) && is_readable($dir)) {
            //echo realpath($dir).' is writable.<br>';
            $ApplicationsDirectory = $dir.\DIRECTORY_SEPARATOR 
			   .\DIRECTORY_SEPARATOR
			   .'.frdl'
			   .\DIRECTORY_SEPARATOR
			   .'global'
			   .\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				 //   .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR;
				   if(is_dir($ApplicationsDirectory)  || @mkdir($ApplicationsDirectory, 0775, true) ){  
				     break;
			       }
        } else {
           //    echo $dir.' is not writable. Permissions may have to be adjusted.<br>';
        } 
      }
	}		   


	
		 $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);   
		   // isWritable.php detects all directories in the same directory the script is in
// and writes to the page whether each directory is writable or not.
    if(  !is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  

      $dirs = array_filter(glob(getcwd().'/../*'), 'is_dir');

      foreach ($dirs as $dir) {
        if (false===strpos($dir, '@') && is_writable($dir) && is_readable($dir)) {
            //echo realpath($dir).' is writable.<br>';
            $ApplicationsDirectory = $dir.\DIRECTORY_SEPARATOR 
			   .\DIRECTORY_SEPARATOR
			   .'.frdl'
			   .\DIRECTORY_SEPARATOR
			   .'global'
			   .\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				//    .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR;
				   if(is_dir($ApplicationsDirectory)  || @mkdir($ApplicationsDirectory, 0775, true) ){  
				     break;
			       }
        } else {
           //    echo $dir.' is not writable. Permissions may have to be adjusted.<br>';
        } 
      }
	}		   
	   
		 $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);
		   if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  
		  
		   		   $ApplicationsDirectory = __DIR__
			   .\DIRECTORY_SEPARATOR
			   .'.frdl'
			   .\DIRECTORY_SEPARATOR 
			   .\DIRECTORY_SEPARATOR
			   .'global'
			   .\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				//    .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR; 
		   } 
		
		 $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);
	 		   if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  
		  
		   		   $ApplicationsDirectory = $_SERVER['DOCUMENT_ROOT']
			   .\DIRECTORY_SEPARATOR
			   .'..'
			   .\DIRECTORY_SEPARATOR
			   .'.frdl'
			   .\DIRECTORY_SEPARATOR
			   .'global'
			   .\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				//    .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR; 
		   } 
		  
		  
		   $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);
 
		  /*   */
		   if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  
		  
		   		   $ApplicationsDirectory = __DIR__
			   .\DIRECTORY_SEPARATOR
			   .'..'
			   .\DIRECTORY_SEPARATOR
			   .'.frdl'
			   .\DIRECTORY_SEPARATOR
			   .'global'
			   .\DIRECTORY_SEPARATOR	  	
				   .'app'	 
				   .\DIRECTORY_SEPARATOR.'deployments'	
				   .\DIRECTORY_SEPARATOR.'blue'	
				//   .\DIRECTORY_SEPARATOR.'deploy'	
				   .\DIRECTORY_SEPARATOR.'app'.\DIRECTORY_SEPARATOR; 
		   } 
		   	
		
		
		   	
 

	
  	 $ApplicationsDirectory= \frdl\patch\RelativePath::getRelativePath($ApplicationsDirectory);
		 
		 
	 if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  
		 $ApplicationsDirectory = $this->getFrdlwebWorkspaceDirectory();
	 }  	 
		 
	 if(!is_dir($ApplicationsDirectory)  && !@mkdir($ApplicationsDirectory, 0775, true) ){  
		 // $ApplicationsDirectory = false;
	 }  
	  // @ ob_end_clean();
	 if(!is_dir($ApplicationsDirectory)  ){  
		   $html='';			   		    
			$html .= '<h1 style="color:red;">';
			   $html .= 'Error: Could not find app config for this host and could not create global app directory ('.$ApplicationsDirectory.')!'
			   .' Try to create directory '.getenv('HOME').'/.frdl or any directory within home containing the string "frdl" manually with read- and write access!'
			   ;//.'<br />'.getenv('HOME').'<br />'.getenv('FRDL_WORKSPACE').'<br />'.__DIR__;     
		       $html .= '</h1>';      
		      echo  \frdl\booting\getFormFromRequestHelper($html, false);
			   die();
		   } 

  
	
		return $ApplicationsDirectory;
	}		
	
	
public function init (?string $scope = null) : ?string {
	return \frdl\patch\scope($scope); 
}


	
	public function autoloadRemoteCodebase(?bool $unregister = true){ 
	       $loader = $this->getRemoteAutoloader();
		 if(true===$unregister){
		    $loader->unregister();
		 }
		$loader->register(false);
		return $loader;
	}	


	public function autoloading() : void{
	   $this->init();
	   $StubRunner = $this;
	   $StubVM = $StubRunner->getStubVM();
	  \frdl\booting\once(function() use(&$StubVM) {
		if(!empty($StubVM->getFileAttachment(null, null, false))){
			\spl_autoload_register([$StubVM,'Autoload'], true, true);
		}
	  });
		
	  // \frdl\booting\once(function() use(&$StubRunner) {	
	        $StubRunner->autoloadRemoteCodebase(true);
          //  });
		
	     \frdl\booting\once(function() use(&$StubRunner) {	
		 $StubRunner->getStubVM()->_run_php_1( $StubRunner->getStubVM()->get_file($StubRunner->getStub(), '$STUB/bootstrap.php', 'stub bootstrap.php')); 
		 $StubRunner->getStubVM()->_run_php_1( $StubRunner->getStubVM()->get_file($StubRunner->getStub(), '$HOME/detect.php', 'stub detect.php')); 
	      });     
	}	

	
	public function autoload( )  : StubModuleInterface {
		$this-> autoloading();
		foreach($this->StubRunners as $file => $StubRunner){
			if(is_object($StubRunner) && null !== $StubRunner && \spl_object_id($StubRunner) !== \spl_object_id($this)){
			   $StubRunner-> autoloading();
			}		   
		}	
	 return $this;
	}			
	
	public function install(?array $params = []  )  : bool|array {
		
	}
	public function uninstall( ?array $params = []  )  : bool|array {
		
	}
	

	
	public function setDownloadSource(string $source){
		$this->source=$source;
	 return $this;
	}	
	
	public function setStubIndexPhp(string $id, string $code, ?string $toFile = null)  : bool {
		$runner = $this->getAsStub($id);
		if(null === $runner){
                   return false;
		}
		
		$vm = $runner->getVM();
		
		 $stub = $vm->get_file($vm->document, '$HOME/index.php', 'stub index.php')
             ->clear()
             ->append($code)
          ;
         $vm->location = is_string($toFile) ? $toFile : $vm->location;
	 return true;
	}	
	
	public function getAsStub(string $id) : StubRunnerInterface|StubModuleInterface|bool  {			
		return isset($this->StubRunners[$id]) ? $this->StubRunners[$id] : false;
	}
	
	
	public function load(string $file, ?string $as = null) : object {
		if(!isset($this->StubRunners[$file])){
			$webfatFile =$file;
		
			$source = is_string($this->source) ? $this->source : self::DEF_SOURCE;
		
		 
			if(!file_exists($webfatFile) 
			   || (is_int($this->max_webfat_file_lifetime) && filemtime($webfatFile) < time() - $this->max_webfat_file_lifetime)){			
				file_put_contents( $webfatFile, trim(file_get_contents($source)));		
			}					   
	
			if (!in_array($webfatFile, \get_included_files())) {		
				require_once $webfatFile;			
			}			//IO4\Module\Webfat
			 $this->StubRunners[$file] = $StubRunner;
		}
		
		if(is_string($as)){
			$this->StubRunners[$as] = &$this->StubRunners[$file];
		}
		return $this->StubRunners[$file];
	}

	public function installTo(string $location, bool $forceCreateDirectory = false, $mod = 0755) : object {
               if(isset($this->LOCATIONS[$location])){
			$this->load($this->LOCATIONS[$location].\DIRECTORY_SEPARATOR.self::FILENAME, $location);
			
		}elseif(is_dir($location) || true === $forceCreateDirectory ){
			$flipped = array_flip($this->LOCATIONS[$location]);
			if(true === $forceCreateDirectory && !is_dir($location)){
				mkdir($location, $mod, true);
			}
			$this->load($location.\DIRECTORY_SEPARATOR.self::FILENAME, isset($flipped[$location]) ? $flipped[$location] : null);
		}
		
		return $this;
	}	
	
	
	public function isIndex(bool $onlyIfFirstFileCall = true) : bool {
        $ns = __NAMESPACE__;
		$_NotIsTemplateContext =	(
		!defined($ns.'\___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___') || false === ___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___
	)
	&& (
		!defined('\___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___') || false === \___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___
	) ? true : false;


		$included_files = \get_included_files();  
		if(//('cli'===substr(strtolower(\PHP_SAPI), 0, 3)) || 
			(	
				(!in_array(__FILE__, $included_files) || __FILE__===$included_files[0])	
			)  
			&& $_NotIsTemplateContext 
		) { 
			$runStubOnInclude = true;
		}else{		
			$runStubOnInclude = false;
		}	
		
		return $runStubOnInclude && (!$onlyIfFirstFileCall || count($included_files) === 1 );
	}

	public function isIndexRequest() : bool{
		$included_files = \get_included_files();  
		return count($included_files) === 1 && __FILE__===$included_files[0];
	}

      /**
      * @ var $showErrorPageReturnBoolean bool - if false returns the object! 
      */
      public function runAsIndex(?bool $showErrorPageReturnBoolean = true) : bool|object{
		
	if(true===$this->isIndex(true) && $this->isIndexRequest()){ 
		$this();
	   return $showErrorPageReturnBoolean ? true : $this;
	}elseif(true===$showErrorPageReturnBoolean && $this->isIndexRequest()){
		   $html='';			   		    
			$html .= '<h1 style="color:red;">';
			   $html .= 'Error: This is not a valid index/server file ('.basename(__FILE__).')!'
			   ;
		       $html .= '</h1>';      		      	
		          
		echo  \frdl\booting\getFormFromRequestHelper( (new \Webfan\Webfat\App\ResolvableException(
                      'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.3.1=Invalid index file'
					 
				   	 .'@'.$html
             ))->html(), false);
	   return false;
	}else{
          return $showErrorPageReturnBoolean ? false : $this;
	} 
     }
	
	public function __invoke() :?StubHelperInterface{			
		if(defined('___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___') && false !== ___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___){ 
			throw new \Exception('___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___ is defined in '.__FILE__.' '.__LINE__);
		}	
                $this->MimeVM->hugRunner($this); 
		$this->autoloading();	
		$this->MimeVM->runStubs();
		return $this->MimeVM;
	}


	public function getAsGeneratedPhpSource($id=null, $classes=[], $params = []
					   , $options = [] //autoloader,cache,.... e.g.
					   , $generator=null
					  ,?\Psr\Container\ContainerInterface $container = null
				   , ?bool $throw = false){
            throw new \Exception(sprintf('Not implemented yet: %s', __METHOD__));
	}
 
	public function getAsFacade($alias, $proxy, string $id = null, string $namespace = null
				    ,?\Psr\Container\ContainerInterface $container = null
				   , ?bool $throw = false) : bool {
		 if(is_null($container)){
                    $container = $this->getAsContainer(null);
		 }
		
              $Manager = $container->has( 'FacadesAliasManager' ) 
	          ? $container->get( 'FacadesAliasManager' ) 
		  :  (function ($container, $throw) {	
	              //  $Manager = new \Statical\Manager('enable');
			  $Manager = new \Statical\Manager('none' );
                            if(is_callable([$container, 'set'])){
			      try{	    
                                 $container->set('FacadesAliasManager', $Manager);
			      }catch(\Exception $e){
                                 if($throw){
                                   throw $e;
				 }else{
                                    return false;
				 }
			      }
			    }
			  return $Manager;
		  })($container, $throw);	
		
		 if(is_bool($Manager) && false === $Manager){
                   return false;
		 }
              try{	   
		$Manager->addProxyService($alias,/* $alias 'Test',*/
		  $proxy, /* $proxy \FrdlTestTesterFascadeProxyObject::class	*/																	
		  $container,  //$container																		
		  $id, //$id																		
		 $namespace // $namespace								
	     );		
		      //$Manager->enable();
	      }catch(\Exception $e){
                                 if($throw){
                                   throw $e;
				 }else{
                                    return false;
				 }			     
	      }

	   return true;
	}
	




	public function getAsRemoteObjectProxy(string $class, ?string $url = null, ?ContainerInterface $container=null){
             $cont  = null!==$container ? $container : $this->getAsContainer(null);
            $config = $cont->get('proxy-object-factory.cache-configuration');
	           $registered = false;
	          if ($funcs = \spl_autoload_functions()) {
                      $index = array_search($config->getProxyAutoloader(), $funcs, true);
                       if (false !== $index) {
		         
	                     if(0!==$index){
                                \spl_autoload_unregister($config->getProxyAutoloader());
				 $registered = false;
	                     }else{
                                $registered = true;
	                    }
                          
	               }
                  }
		  if(true!==$registered){
                       \spl_autoload_register($config->getProxyAutoloader(), true, true);
                  }

                       if(!is_string($url)){
                          $url =  $cont->get('app.runtime.codebase')
			      ->getRemoteApiBaseUrl(\Frdlweb\Contract\Autoload\CodebaseInterface::ENDPOINT_PROXY_OBJECT_REMOTE)
	                     .'/?class='.urlencode($class)
	                   ;
	               }
    
                     $factory = new \ProxyManager\Factory\RemoteObjectFactory(
                           new \ProxyManager\Factory\RemoteObject\Adapter\JsonRpc(new \Laminas\Json\Server\Client($url)),
		              $config
                   );

                $proxy   = $factory->createProxy($class);
		return $proxy;
	 }


	public function getAsLazyLoadingValueHolderProxy(string $class, $initializer){
             $container  = $this->getAsContainer(null);
            $config = $container->get('proxy-object-factory.cache-configuration');
	           $registered = false;
	          if ($funcs = \spl_autoload_functions()) {
                      $index = array_search($config->getProxyAutoloader(), $funcs, true);
                       if (false !== $index) {
		         
	                     if(0!==$index){
                                \spl_autoload_unregister($config->getProxyAutoloader());
				 $registered = false;
	                     }else{
                                $registered = true;
	                    }
                          
	               }
                  }
		  if(true!==$registered){
                       \spl_autoload_register($config->getProxyAutoloader(), true, true);
                  }

                  $factory = new \ProxyManager\Factory\LazyLoadingValueHolderFactory($config);
		 $proxy = $factory->createProxy($class, $initializer);
	   return $proxy;	
	}
	 	 
			
	public function call($controller, ?array $params = []){
		return $this->getAsContainer(null)->get('invoker')->call($controller, $params);
	} 
	
	public function withFacades(?string $baseNamespace = '', ?string $namespace = '*'){	                    
		 $container  = $this->getAsContainer(null);
          
                 $FacadesMap = $container->get('config.app.core.code.facades.$map');

                  foreach($FacadesMap as $aliasClass => $containerId){
			  if(is_array($containerId)){
			      $class=$containerId[1];
                              $containerId = $containerId[0];
			  }else{
                              $class = \get_class($container->get($containerId));
			  }
		        $this->getAsFacade($baseNamespace.$aliasClass,
				    $class, 
				    $containerId,
				    $namespace,
				     $container,
				   true);
		  }

		$container->get( 'FacadesAliasManager' )->enable();
		
	   return $this;
	}	

	
	protected function _bootMainRootContainer(){                  
		if(isset($this['Container']) && is_object($this['Container']) && $this['Container'] instanceof \Psr\Container\ContainerInterface){                    
			return $this['Container'];			
		}

		$Stubrunner = $this;
 
		$this['Container'] = $this->getAsContainer('root', 
		   array_merge([			
		 'container'=> [function(ContainerInterface $container, $previous = null) use(&$Stubrunner) {				
			  return $Stubrunner['Container'];
		  }, 'factory'],
		  //!important: for autowire first parameter
		  \Psr\Container\ContainerInterface::class=> [function(ContainerInterface $container, $previous = null) use(&$Stubrunner) {				
			  return $Stubrunner['Container'];
		  }, 'factory'],	       
		  'app.runtime.stubrunner'=> [function(\Psr\Container\ContainerInterface $container, $previous = null) use(&$Stubrunner){
			return $Stubrunner;			
		  }, 'factory'],	

	   ],
		   $this->getStubVM()->_run_php_1( 
			   $this->getStubVM()
			   ->get_file($this->getStub(), '$HOME/container_default_definitions.php', 'stub container_default_definitions.php')									   
		   )
		 ),//array_merge default definitions
		 [
			'onFalseGet'=>\IO4\Container\ContainerCollectionInterface::NULL_ONERROR,				   
			'callId'=>false,//\IO4\Container\ContainerCollectionInterface::CALL_ID,				   
		]);
 

 //MOVE TO: stub index.php
$url = $this['Container']->get('app.runtime.codebase')
			      ->getRemoteApiBaseUrl(\Frdlweb\Contract\Autoload\CodebaseInterface::ENDPOINT_CONTAINER_REMOTE);
		
//if(!isset($_SERVER['HTTP_HOST']) || $_SERVER['HTTP_HOST'] !== parse_url($url)['host']){
     	         $this['Container']->setFinalFallbackContainer((new \IO4FallbackContainerClient (
		             $this['Container']->get('proxy-object-factory.cache-configuration'),
			        $url,
			      $this['Container']->get('app.runtime.cache'),
			      $this['Container']
		   ))->setTimeout( 60 ) );
//}
		


     //MOVE TO: $container->get('script@inc.common.bootstrap') ---->overwrite...
		  $ConfigurationContainer =new \Webfan\Container\ConfigContainer(
			  'config', 
			  'config.', 
			  '',
			  $this['Container']->get('Config')
		  );
		$ConfigurationContainerId = 'config';
		$this['Container']->addContainer($ConfigurationContainer, $ConfigurationContainerId);
         
	  return $this['Container'];	
	}


	
	public function getAsContainer(?string $factoryId=null, ?array $definitions = [], ?array $options = []) : \Psr\Container\ContainerInterface {
		$this->autoloading();
            switch($factoryId){ 
		    case 'stub' :
		    case 'StubContainer' :
		    case 'StubContainerFactory' :
                       return new \Acclimate\Container\Adapter\ArrayAccessContainerAdapter($this);
		    break;

		    case 'root' :
		    case 'collection' :
		    case 'ContainerCollection' :
		    case \IO4\Container\ContainerCollectionInterface::class :
		    case \Webfan\Webfat\App\ContainerCollection::class :
		      // $class = \Webfan\Webfat\App\ContainerCollection::class;
		    $class = \IO4\Container\Collection::class;	
                       return new $class(array_merge([], $definitions),
				    array_merge(['onFalseGet'=>\IO4\Container\ContainerCollectionInterface::NULL_ONERROR,], $options)['onFalseGet'],
				    array_merge(['callId'=>\IO4\Container\ContainerCollectionInterface::CALL_ID,],
						$options)['callId']);
		    break;
		    
		    case null :
		    default :
                        if(!isset($this['Container'])){
                           $this['Container'] = $this->_bootMainRootContainer();
			}
		     return $this['Container'];
		    break;
	    }		
	}
}
	
//\class_alias('\\'.__NAMESPACE__.'\\MimeStub5', '\\'.__NAMESPACE__.'\\MimeStubIndex');
\class_alias('\\'.__NAMESPACE__.'\\MimeStubIndex', '\\'.__NAMESPACE__.'\\MimeStub');
\class_alias('\\'.__NAMESPACE__.'\\MimeStubIndex', '\frdlweb\MimeStub');
\class_alias('\\'.__NAMESPACE__.'\\StubRunner', '\frdlweb\StubRunner');
\class_alias('\\'.__NAMESPACE__.'\\MimeVM', '\frdlweb\MimeVM');
	
$ns = __NAMESPACE__;
}//ns

namespace{	
 use frdlweb\StubRunner;		
 use frdlweb\MimeVM;
 use frdl\patch\RelativePath;



	if(!isset($_SERVER['HTTP_HOST'])){ 		
		$_SERVER['HTTP_HOST'] = null;			
	}	
	if(!isset($_SERVER['REQUEST_URI'])){		
		$_SERVER['REQUEST_URI']=null;			
	}	
/**
* 
* $run Function
* 
*/
 $run = function($file = null, $doRun = false){
 	$args = func_get_args();

 	$MimeVM = new MimeVM($args[0]);
 	if($doRun){   
	  $MimeVM('run');
	}
 	return $MimeVM;
 };
 
 
	
	 $MimeVM = $run(__FILE__, false);			
	$StubRunner = new StubRunner($MimeVM);  
	$MimeVM->hugRunner($StubRunner);

if(!isset($module)){
  $module = new \ArrayObject();	
}
$module['exports'] = &$StubRunner;// new \ArrayObject();	
$module['exports']['util']['path']['relative']=function ($from, $to, $separator = \DIRECTORY_SEPARATOR)
 {
   return RelativePath::rel($from, $to, $separator);
 }
;	
	
 $module['exports']['run']	= $run;
}//ns

	
namespace{
   $module['exports']->runAsIndex(true);
   $StubRunner = &$module['exports'];
   return $module['exports'];
} 

__halt_compiler();Mime-Version: 1.0
Content-Type: multipart/mixed;boundary=hoHoBundary12344dh
To: example@example.com
From: script@example.com

--hoHoBundary12344dh
Content-Type: multipart/alternate;boundary=EVGuDPPT

--EVGuDPPT
Content-Type: text/html;charset=utf-8

<h1>InstallShield</h1>
<p>Your Installer you downloaded at <a href="https://webfan.de/install/">frdl@Webfan</a> is attatched in this message.</p>
<p>You may have to run it in your APC-Environment.</p>


--EVGuDPPT
Content-Type: text/plain;charset=utf-8

 -InstallShield-
Your Installer you downloaded at https://webfan.de/install/ is attatched in this message.
You may have to run it in your APC-Environment.

--EVGuDPPT
Content-Type: multipart/related;boundary=4444EVGuDPPT
Content-Disposition: php ;filename="$__FILE__/stub.zip";name="archive stub.zip"

--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$STUB/bootstrap.php";name="stub bootstrap.php"

<?php 

$maxExecutionTime = intval(ini_get('max_execution_time'));	
 if (strtolower(\php_sapi_name()) !== 'cli') {	 
    set_time_limit(min(45, $maxExecutionTime));
 }
 /*
 // move to jobs module cronjobs  $this->getRunner()->autoUpdateStub( null );
 */


	 
--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$HOME/apc_config.php";name="stub apc_config.php"

<?php 

	if(file_exists(__FILE__.'.apc_config.php')){
	     return require __FILE__.'.apc_config.php';				
	}

	$domain =(isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
	
 


 return array (
  //'bootscript'=>'script@index.php',
  // CHOOSE onInstall/firstRun : 'autoupdate' => true,
'IO4_FACADES_ENABLE' =>true,
  'AUTOUPDATE_INTERVAL' => 24 * 60 * 60, 	 
  'FRDL_REMOTE_PSR4_CACHE_LIMIT'=>	24 * 60 * 60, //-1,
  'FRDL_REMOTE_PSR4_CACHE_LIMIT_SELF'=>	24 * 60 * 60, //-1,
	 
	 //Depreceated... !?!
  'workspace' =>$domain,
  'baseUrl' => 'https://'.$domain,
  'baseUrlInstaller' => false,
  'FRDL_UPDATE_CHANNEL' => 'latest', // latest | stable
  'FRDL_CDN_HOST'=>'cdn.startdir.de',  // cdn.webfan.de | cdn.frdl.de
  'FRDL_CDN_PROXY_REMOVE_QUERY'=>	true, 
  'FRDL_CDN_SAVING_METHODS'=>	['GET'], 
  'ADMIN_EMAIL' => 'admin@'.$domain,
  'ADMIN_EMAIL_CONFIRMED' =>false,
  'NODE_PATH' => '/opt/plesk/node/12/bin/node',
  'wsdir' => dirname(__DIR__).'/.frdl/',
  'NPM_PATH' => '/opt/plesk/node/12/bin/npm',
  'CACHE_ASSETS_HTTP' => true,
  'installed_from_hps_blog_id' => null,
  'stub' => null,	 
	 
);
			  
--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$HOME/detect.php";name="stub detect.php"

<?php 

@ini_set('display_errors','1');
error_reporting(\E_ERROR | \E_WARNING | \E_PARSE);	
	
--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$HOME/index.php";name="stub index.php"

<?php 

return (static function ($Stub, bool $isCliRequest)   {	 
	
 $Runner = $Stub->getRunner();
 $Runner->init();	
 $container = $Runner->getAsContainer(null);	
 $CircuitBreaker = $container->get('CircuitBreaker');	

$check = $CircuitBreaker->protect(function() use($container){	
 $check = $container->get('script@inc.common.bootstrap');
 if(!is_array($check) || !isset($check['success']) || true !== $check['success']){
    if(is_array($check) && isset($check['error']) ){
      throw new \Exception( basename(__FILE__).' line '.__LINE__.' : '.$check['error'] );
    }elseif(is_object($check) && !is_null($check) && $check instanceof \Exception){
        throw $check;
    }
    throw new \Exception('Could not bootestrap! '.print_r($check, true) );
 }
	return $check;
});
	
 $included_files = \get_included_files();  
 $indexfile = basename($included_files[0]);
 $response = $container->has('config.stub.config.init.bootscript')
      ? $container->get('config.stub.config.init.bootscript')
      : (
	     $container->has('script@'.basename($indexfile)) 
	 ?   $container->get('script@'.basename($indexfile))
         :    $container->get('script@setup.php')
	)
 ;
	
  //load filesystems and mount streamwrappers to app schemes:
	//var_dump($container->get('io4')->service('fs'));

  if(is_object($response) && !is_null($response) && $response instanceof \League\Pipeline\PipelineBuilder){
     $response = $response->build();
  }
	
  if(is_object($response) && !is_null($response) && $response instanceof \League\Pipeline\Pipeline){
     $response = $response->process(
	     !$isCliRequest ? \Laminas\Diactoros\ServerRequestFactory::fromGlobals() : $argv
     );
  }
	
switch(true){
	case is_object($response)
	     && !is_null($response)
	     && (
		    $response instanceof \League\Pipeline\Pipeline
		) :
                   $response = $response->process(
	                 !$isCliRequest ? \Laminas\Diactoros\ServerRequestFactory::fromGlobals() : $argv
                   );
	 break;
	case true === $isCliRequest
	     && is_object($response)
	     && !is_null($response)
	     && method_exists($response, 'handleCliRequest') :              
              $response = $response->handleCliRequest(  );
	  break;
	case is_object($response)
	     && !is_null($response)
	     && (
		    $response instanceof \Relay\Relay
		):
		      $request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals();
              $response = $response->handle($request);
	 break;
	case is_object($response)
	     && !is_null($response)
	     && in_array(\Symfony\Component\HttpKernel\HttpKernelInterface::class, class_implements($response)) :
		     $request=\Symfony\Component\HttpFoundation\Request::createFromGlobals();
              $response = $response->handle($request);
	 break;
	case is_object($response)
	     && !is_null($response)
	     && (
		     in_array(\Psr\Http\Server\RequestHandlerInterface::class, class_implements($response))
		    || in_array(\Frdlweb\WebAppInterface::class, class_implements($response)) 
		):
		      $request=\GuzzleHttp\Psr7\ServerRequest::fromGlobals();
              $response = $response->handle($request);
	 break;
	case is_object($response)
	     && !is_null($response)
	     && method_exists($response, 'handle') :
              $response = $Stub->getRunner()->call(
		      [$response, 'handle']
	      );
	  break;
	case is_object($response)
	     && !is_null($response)
	     && is_callable($response) :
              $response = $Stub->getRunner()->call(
		     $response
	      );
	  break;
	case is_object($response) && $response instanceof \Exception :
            throw $response;
	break;
        default: 
           //what? noop...
	
	break;
}

	
if(!$isCliRequest){	
 if(is_object($response) && $response instanceof \Psr\Http\Message\ResponseInterface){ 		
	(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);		 
 }elseif(is_object($response) && $response instanceof \Sabre\HTTP\Response){ 		
	\Sabre\HTTP\Sapi::sendResponse($response);		 
 }elseif(is_string($response)){
	echo $response;
 }elseif(is_object($response) && $response instanceof \Exception){ 		
	throw $response;		 
 }elseif(is_object($response) || is_array($response) ){ 
	 header('Content-Type: application/json');
	echo json_encode($response);		 
 }else{		
	header('Content-Type: application/json');
	echo json_encode($response);	
 }
}else{
  return $response;
}
	
})($this, 'cli' === strtolower(substr(\php_sapi_name(), 0, 3)));


--4444EVGuDPPT--
--EVGuDPPT--
--hoHoBundary12344dh
Content-Type: multipart/related;boundary=3333EVGuDPPT
Content-Disposition: php ;filename="$__FILE__/attach.zip";name="archive attach.zip"

--3333EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/implementation/NullVoid.php";name="class frdl\implementation\NullVoid"

<?php 


namespace frdl\implementation;




class NullVoid
{

	
}
--3333EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/Webfan/Webfat/Codebase.php";name="class Webfan\Webfat\Codebase"

<?php 


namespace Webfan\Webfat;

use Frdlweb\Contract\Autoload\CodebaseInterface;

class Codebase extends \frdl\Codebase implements CodebaseInterface
{
	
	public function __construct(?string $channel = null, ?array $channels = []){
		parent::__construct($channel, $channels);
	}
	
	
	public function loadUpdateChannel(mixed $StubRunner = null) : string {
	
		$configVersion = $StubRunner->configVersion();
		$config = $StubRunner->config();
		$save = false;
		$breakScript = false;
		
		if(!isset($configVersion['appId'])){	
			/* $configVersion['appId'] = 'oid:1.3.6.1.4.1.37553.8.1.8.8.1958965301'; 
			   PLACEHOLDER (for installers/updaters)
			*/
			/****$configVersion['appId']='@@@APPID@@@';*****/
			$save = true;
		}		
		
	      if(!isset($configVersion['appId'])){	
		    $e = new \Webfan\Webfat\App\ResolvableLogicException(
                         'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1=The (Main) Application ID must be defined'
                           .'|php:'.get_class($this).'=Thrown by the Codebase Class '.__METHOD__
                           .'@The Application ID must be defined'
                         );	
			$html ='';
			 //  $html = $e->html(-1);
		      
		      
			/*  Global Register Website | Domain Resolver App */
			$configVersion['appId'] = 'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1'; 
			$save = true;		      
		       $html .= '<h1 style="color:green;">';
			   $html .= 'Next: The Setup/Installer Chooser App will be installed automatically (global) - The page reloads automatically, please wait ...!';     
		       $html .= '</h1>';      
		      echo  \frdl\booting\getFormFromRequestHelper($html, true, 10, null);
		      $breakScript=true;
	      }

		if(!isset($configVersion['channel'])){
			$configVersion['channel'] = isset($config['FRDL_UPDATE_CHANNEL']) ? $config['FRDL_UPDATE_CHANNEL'] : 'latest'; 
			$save = true;
		}		
	
		if(true === $save && null !== $StubRunner){
			$StubRunner->configVersion($configVersion);
			usleep(100);
		}
		
		$this->setUpdateChannel($configVersion['channel'] ?? 'latest');	        
		$this->setServiceEndpoint(\Frdlweb\Contract\Autoload\CodebaseInterface::ENDPOINT_CONTAINER_REMOTE,
					   'https://website.webfan3.de/container/?channel='.urlencode($configVersion['channel'])
					   .'&app='.urlencode($configVersion['appId'])
					   .'&version='.urlencode($configVersion['version']),
					  \Frdlweb\Contract\Autoload\CodebaseInterface::ALL_CHANNELS);  
		
		if(true === $breakScript){
		   die();	
		}
		return $this->getUpdateChannel();
	}
}

--3333EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/Codebase.php";name="class frdl\Codebase"

<?php 
namespace frdl;

use Frdlweb\Contract\Autoload\CodebaseInterface;

abstract class Codebase
 {
   protected $channels = null;
   protected $channel = null;
	
   abstract public function loadUpdateChannel(mixed $StubRunner = null) : string; 
	 
   public function __construct(?string $channel = null, ?array $channels = []){
	   $this->channels = $channels;
	   
	   $this->channels[CodebaseInterface::CHANNEL_LATEST] =array_merge(isset($this->channels[CodebaseInterface::CHANNEL_LATEST]) ? $this->channels[self::CHANNEL_LATEST] : [],
							     [
		     //   'RemotePsr4UrlTemplate' => 'https://webfan.de/install/latest/?source=${class}&salt=${salt}&source-encoding=b64',
		     // 'RemotePsr4UrlTemplate' => 'https://latest.software-download.frdlweb.de/?source=${class}&salt=${salt}&source-encoding=b64',
		     'RemotePsr4UrlTemplate' =>'https://startdir.de/install/latest/?source=${class}&salt=${salt}&source-encoding=b64',
		   'RemoteModulesBaseUrl' => 'https://latest.software-download.frdlweb.de',
		   'RemoteApiBaseUrl' => 'https://api.webfan.de/',
		   
	   ]);
		   
	   
	   $this->channels[CodebaseInterface::CHANNEL_STABLE] =array_merge(isset($this->channels[CodebaseInterface::CHANNEL_STABLE]) ? $this->channels[self::CHANNEL_STABLE] : [],
							     [
		   //  'RemotePsr4UrlTemplate' => 'https://stable.software-download.frdlweb.de/?source=${class}&salt=${salt}&source-encoding=b64',
		  // 'RemotePsr4UrlTemplate' => 'https://webfan.de/install/stable/?source=${class}&salt=${salt}&source-encoding=b64',
		  'RemotePsr4UrlTemplate' =>'https://startdir.de/install/stable/?source=${class}&salt=${salt}&source-encoding=b64',
		    'RemoteModulesBaseUrl' => 'https://latest.software-download.frdlweb.de',
		   'RemoteApiBaseUrl' => 'https://api.webfan.de/',
		   
	   ]);	   
	   
	   $this->channels[CodebaseInterface::CHANNEL_FALLBACK] =array_merge(isset($this->channels[CodebaseInterface::CHANNEL_FALLBACK]) ? $this->channels[self::CHANNEL_FALLBACK] : [],
							     [
		   'RemotePsr4UrlTemplate' => 'https://startdir.de/install/?source=${class}&salt=${salt}&source-encoding=b64',
		 // 'RemotePsr4UrlTemplate' => 'https://webfan.de/install/?source=${class}&salt=${salt}&source-encoding=b64',
		   'RemoteModulesBaseUrl' => 'https://latest.software-download.frdlweb.de',
		   'RemoteApiBaseUrl' => 'https://api.webfan.de/',
	   ]);   
	   
	   $this->channels[CodebaseInterface::CHANNEL_TEST] = array_merge(isset($this->channels[CodebaseInterface::CHANNEL_TEST]) ? $this->channels[CodebaseInterface::CHANNEL_TEST] : [],
							     [
		 //  'RemotePsr4UrlTemplate' => 'https://startdir.de/install/?source=${class}&salt=${salt}&source-encoding=b64',
		   'RemotePsr4UrlTemplate' => 'https://webfan.de/install/?source=${class}&salt=${salt}&source-encoding=b64',
		   'RemoteModulesBaseUrl' => 'https://webfan.de/install',
		   'RemoteApiBaseUrl' => 'https://api.webfan.de/',
	   ]);  

             $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_OIDIP, 'https://whois.viathinksoft.de', CodebaseInterface::ALL_CHANNELS);
	   
             $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_RDAP, 'https://rdap.frdl.de', CodebaseInterface::ALL_CHANNELS);
             $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_RDAP, 'https://rdap.frdlweb.de', CodebaseInterface::CHANNEL_FALLBACK);  
	   
	     $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_WEBFAT_CENTRAL, 'https://webfan.website', CodebaseInterface::ALL_CHANNELS);  
	     $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_WEBFAT_CENTRAL, 
								   'https://website.webfan3.de', 
								   CodebaseInterface::CHANNEL_FALLBACK);  
	   
	     $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_PROXY_OBJECT_REMOTE, 
								   'https://website.webfan3.de/api/proxy-object/${by}/?id=${class}', 
								   CodebaseInterface::ALL_CHANNELS);  
	   
	  //   $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_INSTALLER_REMOTE, 'https://website.webfan3.de/api/proxy-object/container/?id=StubModuleBuilder', CodebaseInterface::ALL_CHANNELS);  
	//    $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_INSTALLER_REMOTE, 'https://website.webfan3.de/api/proxy-object/class/?id=\frdlweb\StubModuleBuilder', CodebaseInterface::CHANNEL_FALLBACK);  
	 //     $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_INSTALLER_REMOTE, 'https://website.webfan3.de/webfan.endpoint.webfat-installer.php', CodebaseInterface::CHANNEL_TEST);
	     $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_INSTALLER_REMOTE, 'https://website.webfan3.de/installer/webfan.endpoint.webfat-installer.php', CodebaseInterface::ALL_CHANNELS);
	     $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_INSTALLER_REMOTE, 'https://website.webfan3.de/webfan.endpoint.webfat-installer.php', CodebaseInterface::CHANNEL_TEST);


            //ENDPOINT_CONTAINER_REMOTE
	    $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_CONTAINER_REMOTE, 'https://website.webfan3.de/container/', CodebaseInterface::ALL_CHANNELS);  


            //ENDPOINT_CONFIG_REMOTE
	   $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_CONFIG_REMOTE, 'https://website.webfan3.de/webfan.endpoint.config-remote.php', CodebaseInterface::ALL_CHANNELS);  

	   //ENDPOINT_REMOTE_PUBLIC
           $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_REMOTE_PUBLIC, 'https://website.webfan3.de/webfan.endpoint.workspace-remote-public.php', CodebaseInterface::ALL_CHANNELS);  

           //ENDPOINT_WORKSPACE_REMOTE
	   $this->setServiceEndpoint(CodebaseInterface::ENDPOINT_REMOTE_PUBLIC, 'https://website.webfan3.de/webfan.endpoint.workspace-remote.php', CodebaseInterface::ALL_CHANNELS);  
	   
	   if(null !== $channel && isset(CodebaseInterface::CHANNELS[$channel])){
		   $this->setUpdateChannel(CodebaseInterface::CHANNELS[$channel]);
	   }elseif(null !== $channel && !isset(CodebaseInterface::CHANNELS[$channel])){		  	
		   $this->channels[$channel] =  array_merge([], $this->channels[CodebaseInterface::CHANNEL_FALLBACK]);  
		   $this->setUpdateChannel($channel);
	   }else{
		   $this->setUpdateChannel(CodebaseInterface::CHANNELS[CodebaseInterface::CHANNEL_LATEST]);
	   }
   }

   public function getRemoteApiBaseUrl(?string $serviceEndpoint = CodebaseInterface::ENDPOINT_DEFAULT) : string|bool{ 
	   $baseUrl = false;
	   if(isset($this->channels[$this->getUpdateChannel()][$serviceEndpoint])){
              $baseUrl = $this->channels[$this->getUpdateChannel()][$serviceEndpoint];
	      if(is_callable($baseUrl)){
                  $baseUrl = \call_user_func_array($baseUrl, [$serviceEndpoint, $this->getUpdateChannel(), $this]);
	      }
	   }
	   return is_string($baseUrl) ? $baseUrl : false;
   }	 
   public function setUpdateChannel(string $channel){
	   $this->channel = $channel;
	  return $this;
   }
	 
   public function getUpdateChannel() : string{
	   return $this->channel;
   }
	  
   public function getRemotePsr4UrlTemplate() : string{
	   return $this->getRemoteApiBaseUrl(CodebaseInterface::ENDPOINT_AUTOLOADER_PSR4_REMOTE);
   }
	  
   public function getRemoteModulesBaseUrl() : string{
	   return $this->getRemoteApiBaseUrl(CodebaseInterface::ENDPOINT_MODULES_WEBFANSCRIPT_REMOTE);
   }
   public function getServiceEndpoints() : array {
     return $this->channels;
   }
	 
   public function getServiceEndpointNames() : array {
      $names = CodebaseInterface::DEFAULT_ENDPOINT_NAMES;
	   foreach($this->channels as $channel => $endpoints){
              $names = \array_merge($names, \array_keys($endpoints));
	   }
      return \array_unique($names);
   }
	  	 	 	 
   public function setServiceEndpoints(array $serviceEndpoints) : CodebaseInterface {
      foreach($serviceEndpoints as $endpointInfo){
            $this->setServiceEndpoint(isset($endpointInfo['name']) ? $endpointInfo['name'] : $endpointInfo['id'], 
				     isset($endpointInfo['baseUrl']) ? $endpointInfo['baseUrl'] :  $endpointInfo['endpoint'],
				      isset($endpointInfo['channel']) ? $endpointInfo['channel'] : '*'
				     );
      }
     return $this;
   }
	 
  public function setServiceEndpoint(string $serviceEndpointName,
	 string|\Closure|\callable $baseUrl, 
	 ?string $channel = CodebaseInterface::ALL_CHANNELS) : CodebaseInterface {
	  if(CodebaseInterface::ALL_CHANNELS === $channel){
            foreach(\array_keys(CodebaseInterface::CHANNELS) as $_t_channel){
		if($_t_channel === $channel || $_t_channel === CodebaseInterface::ALL_CHANNELS){
                  continue;
		}
               $this->setServiceEndpoint($serviceEndpointName, $baseUrl, $_t_channel);
	    }
	  }else{
                $this->channels[$channel][$serviceEndpointName] = $baseUrl;
	  }
      return $this;
   }
	  	  	 
 }




--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/container_default_definitions.php" ; name="stub container_default_definitions.php"
Content-Type: application/x-httpd-php

<?php
use Doctrine\Common\Cache\FilesystemCache;
use Eljam\CircuitBreaker\Breaker;
use Eljam\CircuitBreaker\Event\CircuitEvents;
use Symfony\Component\EventDispatcher\Event;

	
 //@ToDo: Compose from https://github.com/frdlweb/webfat and modules...
    return [
	'app.runtime.dir'=> [function(\Psr\Container\ContainerInterface $container, $previous = null)  {
			return $container->get('config.params.app.dir');			
		  }, 'factory'],			 
	'config.params.app.dir'=> [function(\Psr\Container\ContainerInterface $container, $previous = null)  {
			return $container->get('app.runtime.stubrunner')->getApplicationsDirectory();			
		  }, 'factory'],							   
        'config.params.dirs.runtime'=> [function(\Psr\Container\ContainerInterface $container, $previous = null)  {
			return rtrim($container->get('config.params.app.dir'), \DIRECTORY_SEPARATOR)
				.\DIRECTORY_SEPARATOR
				.'runtime'
				;			
	 }, 'factory'],									   
        'config.params.dirs.runtime.cache'=> [function(\Psr\Container\ContainerInterface $container, $previous = null)  {
			return rtrim($container->get('config.params.dirs.runtime'), \DIRECTORY_SEPARATOR)
				.\DIRECTORY_SEPARATOR
				.'cache'
				;			
	 }, 'factory'],								   
	'runtime.context.sandbox.containers'=>(function(\Psr\Container\ContainerInterface $container)  {		
		return [
                         'container'=>$container,
			// NO !?! 'Stubrunner'=>$container->get('app.runtime.stubrunner'),
			];
	 }),	

	  
'app.runtime.cache'=>(function(\Psr\Container\ContainerInterface $container) {
	$dir = $container->get('config.params.dirs.runtime.cache').\DIRECTORY_SEPARATOR
				  .'app.runtime.cache';
				 
	if(!is_dir($dir)){	
			    @mkdir($dir, 0755, true);				
	}	
     return new \Desarrolla2\Cache\File($dir);
}),    
			
	'app.runtime.stub'=> [function(\Psr\Container\ContainerInterface $container, $previous = null) {
			return $container->get('app.runtime.stubrunner')->getStub();			
	}, 'factory'],   
	'Stubrunner'=> [function(\Psr\Container\ContainerInterface $container, $previous = null) {
			return $container->get('app.runtime.stubrunner');			
	}, 'factory'],   		
	'app.runtime.codebase'=> [function(\Psr\Container\ContainerInterface $container, $previous = null) {
			return $container->get('app.runtime.stubrunner')->getCodebase();	
	 }, 'factory'],    
		
	'app.runtime.autoloader.remote'=> [function(\Psr\Container\ContainerInterface $container, $previous = null) {
			return $container->get('app.runtime.stubrunner')->getRemoteAutoloader();	
	}, 'factory'],   

'facades.config' =>( function(\Psr\Container\ContainerInterface $container){
      return \Webfan\FacadeProxy::createProxy($container->get('Config'));  
 }),		
'Config' =>( function(\Psr\Container\ContainerInterface $container){
    		
	$config = \Configula\ConfigFactory::loadMultiple([
        @new \Configula\Loader\EnvLoader( ),   
   //  new \Configula\Loader\EnvLoader('APP', '', false),     
   // new \Configula\Loader\EnvLoader('WEBFAN', '_', true),       
   //  new \Configula\Loader\EnvLoader('FRDL', '_', true),      
   //    \Configula\ConfigFactory::loadEnv('IO4_', '_', true),   
    //   \Configula\ConfigFactory::loadEnv('APP_', '', false),     
    //  \Configula\ConfigFactory::loadEnv('WEBFAN_', '_', true),       
    //   \Configula\ConfigFactory::loadEnv('FRDL_', '_', true),         
     $container->get('app.runtime.stubrunner')->config(),
     [
	'DOCUMENT_ROOT' =>$_SERVER['DOCUMENT_ROOT'],
	'mount' => [
             'local' => [
                  'app' => 'config.params.app.dir',
		  'well-known' => $_SERVER['DOCUMENT_ROOT'].\DIRECTORY_SEPARATOR.'.well-known'.\DIRECTORY_SEPARATOR,
		  'web' => $_SERVER['DOCUMENT_ROOT'].\DIRECTORY_SEPARATOR,
		  'cache'=>'config.params.dirs.runtime.cache',
	      ],
							 
         ],
     ],
     $container->get('app.runtime.stubrunner')->configVersion(),
     [
	'@scope' => \frdl\patch\scope(),
							 
     ],  							 
    //['some' => 'values'],                           // Array of config vaules
   // '/path/to/some/file.yml',                       // Path to file (must exist)
   // new \SplFileInfo('/path/to/another/file.json')  // SplFileInfo
]);
		 
	return $config;
 }),		

'fs' =>( function(\Psr\Container\ContainerInterface $container){
      return $container->get('io4')->service('fs', [], function() use($container){
		                $mounts = [];
                      foreach($container->get('Config')->get('mount.local') as $protocol => $directory){
				        $directory = $container->has($directory) 
					       ? $container->get($directory) 
					       : $directory;
						  
						      $mounts[$protocol] =  \M2MTech\FlysystemStreamWrapper\FlysystemStreamWrapper::register(
								  $protocol, new \League\Flysystem\Filesystem(				                          
									//  $adapter =
									  new \League\Flysystem\Local\LocalFilesystemAdapter($directory)   					
								  )  
							  );				   
			
					  }		
		  return $mounts;
	  });
 }),

'io4' =>( function(\Psr\Container\ContainerInterface $container){
     $factory = $container->get('factory@io4');
	 return $factory($container, [], []);
 }),
	    
'services.shield.cache.dir'=>(function(\Psr\Container\ContainerInterface $container) {
			  $dir = rtrim($container->get('config.params.dirs.runtime.cache'), \DIRECTORY_SEPARATOR)
				.\DIRECTORY_SEPARATOR
				  .'services'
				  .\DIRECTORY_SEPARATOR
				  .'shield';
	
			  if(!is_dir($dir)){	
			    @mkdir($dir, 0755, true);		
			  }	
	return $dir;
}), 
	
'helper' =>( function(\Psr\Container\ContainerInterface $container){
	      return \Webfan\FacadeProxiesMap::createProxy([
		        new \Webfan\Webfat\App\KernelHelper,
		        new \Webfan\Webfat\App\KernelFunctions,
			    \frdl\Http\Helper::class,			   
		     ],
	  	[
							   
	    ],
	$container->has('container') ? $container->get('container') : $container);  
 }),	
'events' =>( function(\Psr\Container\ContainerInterface $container){
     $dir =  $container->get('config.params.dirs.runtime')
		      .\DIRECTORY_SEPARATOR.'events'
		      .\DIRECTORY_SEPARATOR.'compiled-registered';
       if(!is_dir($dir)){
        mkdir($dir, 0775, true);
       }	    
	\Webfan\App\EventModule::setBaseDir($dir);	 
	return \Webfan\FacadeProxy::createProxy(\Webfan\App\EventModule::action('*'));  
 }),	

	
		

	'config.sandbox.runtime.security.allowed-classes'=>  (function(\Psr\Container\ContainerInterface $container){		   
	   if($container->has('config.stub.config.init.app.runtime.security.allowed-classes')){
             $classes = $container->get('config.stub.config.init.app.runtime.security.allowed-classes');
	   }else{
             $classes = [
		     \Exception::class,
		     \Webfan\Patches\Start\Timezone2::class,
                     \GuzzleHttp\Psr7\ServerRequest::class,
		     //deprecated...:
		    // \Webfan\AppLauncherWebfatInstaller::class,
	     ];
	   }
	   return $classes;	
	}),	
	
	'config.runtime.security.sandbox.allowed-functions'=>  (function(\Psr\Container\ContainerInterface $container){		   
	   if($container->has('config.stub.config.init.app.runtime.security.allowed-functions')){
             $functions = $container->get('config.stub.config.init.app.runtime.security.allowed-functions');
	   }else{
             $functions = [
		     
	     ];
	   }
	   return $functions;	
	}),	
	
	'config.app.core.code.facades.$map'=>  (function(\Psr\Container\ContainerInterface $container){		   
	   if($container->has('config.stub.config.init.facades.$map')){
             $FacadesMap = $container->get('config.stub.config.init.facades.$map');
	   }else{
             $FacadesMap = [           
		     'Config' =>'facades.config',
                     'Events' =>  ['events', \Webfan\App\EventModule::class],            
		     'Helper' =>'helper',             
		   //Not works since class is anonymous and no static method yet  'io4' =>'io4',                   
		];
	   }
	   return $FacadesMap;	
	}),	
	'config.app.core.code.facades.$import'=>  (function(\Psr\Container\ContainerInterface $container){		   
	   if($container->has('config.stub.config.init.facades.$import')){
             $FacadesImport = $container->get('config.stub.config.init.facades.$import');
	   }else{
             $FacadesImport = [                 
		 'baseName' =>  '',
		 'namespace' => '*',
		];
	   }
	   return $FacadesImport;	
	}),	
	
	
'facades.stubrunner' =>( function(\Psr\Container\ContainerInterface $container){
      return \Webfan\FacadeProxy::createProxy($container->get('app.runtime.stubrunner'));  
 }),		
'facades.container' =>( function(\Psr\Container\ContainerInterface $container){
      return \Webfan\FacadeProxy::createProxy($container->has('container') ? $container->get('container') : $container);  
 }),
		
	'proxy-object-factory.cache-configuration'=> (function(\Psr\Container\ContainerInterface $container){	
			 $config = new \ProxyManager\Configuration();
	
			  $proxyCacheDir = rtrim($container->get('config.params.dirs.runtime.cache'), \DIRECTORY_SEPARATOR)
				.\DIRECTORY_SEPARATOR
				  .'proxy-objects'
				  .\DIRECTORY_SEPARATOR
				  .'remote-api' 
				  .\DIRECTORY_SEPARATOR 
				  .'generated-classes';
	
			  if(!is_dir($proxyCacheDir)){	
			    @mkdir($proxyCacheDir, 0755, true);		
			  }
		
			  // generate the proxies and store them as files
	
			  $fileLocator = new \ProxyManager\FileLocator\FileLocator($proxyCacheDir);
	
			  $config->setGeneratorStrategy(new \ProxyManager\GeneratorStrategy\FileWriterGeneratorStrategy($fileLocator));
	
			  // set the directory to read the generated proxies from
	
			  $config->setProxiesTargetDir($proxyCacheDir);

			  // then register the autoloader   
			   \spl_autoload_register($config->getProxyAutoloader(), true, true);
			
		return $config;		
	}),	


		  'FacadesAliasManager'=>  [(function(\Psr\Container\ContainerInterface $container){		   
			 // return new \Statical\Manager('enable');			   
		    return new \Statical\Manager(
			   // 'none'
		    );
		  }), 'default'],
		
	          \Invoker\InvokerInterface::class =>  [(function(\Psr\Container\ContainerInterface $container){	
				 return $container->get('invoker');			
		  }), 'factory'],	  
			
	          'invoker' =>[(function(\Psr\Container\ContainerInterface $container){			  		
			return $container->getInvoker( );
		     }), 'factory'],
				   
 \Webfan\InstallerClient::class => (function(\Psr\Container\ContainerInterface $container){
      $proxy = new  \Webfan\RemoteObjectProxyClientFactory(
		$container->get('app.runtime.codebase')
			        ->getRemoteApiBaseUrl(\Frdlweb\Contract\Autoload\CodebaseInterface::ENDPOINT_INSTALLER_REMOTE),
		$container->get('proxy-object-factory.cache-configuration'),
		\Webfan\Installer::class,
		new \Webfan\Transform\RemoteApiObjectsTransformAll
	);
	 return $proxy;
  }),	

	'config.state-file'=>(function(\Psr\Container\ContainerInterface $container)  {		
			  $file = rtrim($container->get('app.runtime.dir'), \DIRECTORY_SEPARATOR)
				.\DIRECTORY_SEPARATOR
				  .'state'
				.\DIRECTORY_SEPARATOR
				  .'app.state.sync.dat';
          return $file;	 
	 }),	
	
	'app.runtime.state'=>[function(\Psr\Container\ContainerInterface $container  )  {		
			  $file = $container->get('config.state-file');
                           $dir = dirname($file); 
			  if(!is_dir($dir)){	
			    @mkdir($dir, 0755, true);		
			  }	
		$storage = new \Fuz\Component\SharedMemory\Storage\StorageFile($file);
	   return new \Fuz\Component\SharedMemory\SharedMemory($storage);
	 }, 'default'],	
	
'app.runtime.cache.circuits'=>(function(\Psr\Container\ContainerInterface $container) {
    return new \Doctrine\Common\Cache\FilesystemCache( 
	     rtrim($container->get('config.params.dirs.runtime.cache'), \DIRECTORY_SEPARATOR)
				.\DIRECTORY_SEPARATOR
				  .'circuits'
      ); 
}), 
	
'app.runtime.circuits.main'=>(function(\Psr\Container\ContainerInterface $container) {
    return new \Webfan\Webfat\App\CircuitBreaker('app_main', [
			     'ignore_exceptions' => false,
			   ], 
		 $container->get('app.runtime.cache.circuits')
    );
}), 
'CircuitBreaker'=> [function(\Psr\Container\ContainerInterface $container) {
    return $container->get('app.runtime.circuits.main');
}, 'factory'],   	
	
 //'module.loader.CommonJS'=>moved to remote fallback-container!!!
		  				
		
		   'define' => (function(\Psr\Container\ContainerInterface $container){
				 $commonJS = $container->get('module.loader.CommonJS');
		       return $commonJS['define'];
		    }),
	
		  'defined' =>(function(\Psr\Container\ContainerInterface $container){
				 $commonJS = $container->get('module.loader.CommonJS');
		       return $commonJS['defined'];
		   }),
			
		   'require' => (function(\Psr\Container\ContainerInterface $container){
				 $commonJS = $container->get('module.loader.CommonJS');
		       return $commonJS['require'];
		   }),		

							   
];//default container definitions
		
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/version_config.php" ; name="stub version_config.php"
Content-Type: application/x-httpd-php
Content-Md5: 6428c6cc023fb0e021070148064f3284
Content-Sha1: 6795ff35fd045e46be35fa48a84d00e86da3eeba
Content-Length: 275


			    if(file_exists(__FILE__.'.version_config.php')){
				  return require __FILE__.'.version_config.php';
				}
			    return array (
  'time' => 0,
  'version' => '0.0.0',
  'appId' => 'circuit:1.3.6.1.4.1.37553.8.1.8.8.1958965301.5.1',
  'channel' => 'latest',
);
			  
--3333EVGuDPPT--
--hoHoBundary12344dh--