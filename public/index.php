<?php
declare(strict_types=1);

namespace Webfan\Webfat\Module\RdapServer;

use App\Application\Handlers\HttpErrorHandler;
use App\Application\Handlers\ShutdownHandler;
use App\Application\ResponseEmitter\ResponseEmitter;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;
use frdl\security\floodprotection\FloodProtection;



/**
* @toDo: use libs
*/
class Helper
{
	
 public static $protocoll = 'HTTP/1.1';	

 public static function sendCorsHeaders(array $allowedOrigins = null, $fallbackOrigin = 'https://invalid.dns.frdl.de') {
	// CORS
	// Author: Till Wehowski
  if(null === $allowedOrigins){
     $allowedOrigins = [
       "*", 
       $_SERVER['SERVER_NAME'], 
       $_SERVER['HTTP_ORIGIN'],
       $_SERVER['HTTP_HOST']
     ]; 
  }
   
   
  $originRequested = strip_tags(((isset($_SERVER['HTTP_ORIGIN'])) ? $_SERVER['HTTP_ORIGIN'] : "*"));
  $origin = (in_array($originRequested, $allowedOrigins)) ?  $originRequested : $fallbackOrigin;
   
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Origin: ".$origin);

	header("Access-Control-Allow-Headers: If-None-Match, X-Requested-With, Origin, X-Frdlweb-Bugs, Etag, X-Forgery-Protection-Token, X-CSRF-Token, X-Frdl-Request-Negotiation");

	if (isset($_SERVER['HTTP_ORIGIN'])) {
		header('X-Frame-Options: ALLOW-FROM '.$origin);
	} else {
		header_remove("X-Frame-Options");
	}
   
	$expose = array('Etag', 'X-CSRF-Token');
	foreach (headers_list() as $num => $header) {
		$h = explode(':', $header);
		$expose[] = trim($h[0]);
	}
	header("Access-Control-Expose-Headers: ".implode(',',$expose));

	header("Vary: Origin");
 }
  
  public static function header($name, $value)
    {
       return header($name.': '.$value);
    }



  public static function status($code = 200)
    {
       if((int)$code == 200)return header(self::$protocoll.' 200 Ok');
       if((int)$code == 201)return header(self::$protocoll.' 201 Created');

       if((int)$code == 400)return header(self::$protocoll.' 400 Bad Request');
       if((int)$code == 401)return header(self::$protocoll.' 401 Unauthorized');
       if((int)$code == 403)return header(self::$protocoll.' 403 Forbidden');
       if((int)$code == 404)return header(self::$protocoll.' 404 Not Found');
       if((int)$code == 409)return header(self::$protocoll.' 409 Conflict');
       
       if((int)$code == 422)return header(self::$protocoll.' 422 Validation Failure');
       
       if((int)$code == 429)return header(self::$protocoll.' 429 Too Many Requests');
       
       if((int)$code == 455)return header(self::$protocoll.' 455 Blocked Due To Misbehavior');

       
       if((int)$code == 500)return header(self::$protocoll.' 500 Internal Server Error');
       if((int)$code == 501)return header(self::$protocoll.' 501 Not Implemented');
       if((int)$code == 503)return header(self::$protocoll.' 503 Service Unavailable');
       if((int)$code == 511)return header(self::$protocoll.' 511 Network Authentication Required');
	  
	  
       if(0===intval($code)){		
	  return header(self::$protocoll.' 501 Not Implemented');	  
       }
	  
	  \trigger_error('status code '.intval($code).' not implemented in \'' . get_class($this) . '\'   ' . __METHOD__. ' '.__LINE__, E_USER_ERROR);
    }
	
	
}

ini_set('display_errors', '0');
require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'dns.frdl.de'.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'autoload.php';

//\Webfan\Psr4Loader\RemoteFromWebfan::getInstance('frdl.webfan.de', true, 'latest', false);	

if(!is_dir(__DIR__ . '/../cache/flood-protection/')){
 mkdir(__DIR__ . '/../cache/flood-protection/', 0777, true);	
}

if(!is_dir(__DIR__ . '/../cache/container/')){
 mkdir(__DIR__ . '/../cache/container/', 0777, true);	
}


// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

//if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../cache/container');
//}

// Set up settings
$settings = require __DIR__ . '/../app/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();





 $FloodProtection = new FloodProtection('rdap', 30, 60, __DIR__ . '/../cache/flood-protection/');	
 if($_SERVER['REMOTE_ADDR'] !== $_SERVER['SERVER_ADDR'] 
	 && !in_array($_SERVER['REMOTE_ADDR'],  ['212.53.140.43', '212.72.182.211']) 
	&& $FloodProtection->check($_SERVER['REMOTE_ADDR'])
   ){
    header("HTTP/1.1 429 Too Many Requests");
    exit("Too Many Requests, try again later!");
 }

		$ShutdownTasks = \frdlweb\Thread\ShutdownTasks::mutex();
        $ShutdownTasks(function($container, $FloodProtection, $tempRdapDir, $CacheDir, $maxCacheTime){
			@\ignore_user_abort(true);
			$container->get('rdap.cache')->prune();
		    if(is_dir($tempRdapDir)){	
		    //  \webfan\hps\patch\Fs::pruneDir($tempRdapDir, $maxCacheTime * 4, true, false);
		    }
			
			
			$FloodProtection->prune();
		    if(is_dir($CacheDir)){	
		      \webfan\hps\patch\Fs::pruneDir($CacheDir, $maxCacheTime, true, false);
		    }
        }, $container, $FloodProtection, __DIR__.'/../cache/rdap/', __DIR__ . '/../cache/flood-protection/', 31 * 24 * 60 * 60);	 




// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();
$callableResolver = $app->getCallableResolver();

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

/** @var bool $displayErrorDetails */
$displayErrorDetails = $container->get('settings')['displayErrorDetails'];

// Create Request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();



$request = $serverRequestCreator->createServerRequestFromGlobals();




// Create Error Handler
$responseFactory = $app->getResponseFactory();
$errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
$errorHandler->setDisplayErrorDetailsFlag($displayErrorDetails);

// Create Shutdown Handler
$shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
register_shutdown_function($shutdownHandler);

// Add Routing Middleware
$app->addRoutingMiddleware();

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, false, false);
$errorMiddleware->setDefaultErrorHandler($errorHandler);
 Helper::status(200);

	 Helper::sendCorsHeaders([(isset($_SERVER['HTTP_ORIGIN']))?$_SERVER['HTTP_ORIGIN']:'*'], '*');	

// Run App & Emit Response
$response = $app->handle($request);
Helper::status($response->getStatusCode());
$responseEmitter = new ResponseEmitter();
ob_start(function($c) use($response) {
  Helper::sendCorsHeaders([(isset($_SERVER['HTTP_ORIGIN']))?$_SERVER['HTTP_ORIGIN']:'*'], '*');	
   Helper::status($response->getStatusCode());
	return $c;
});
$responseEmitter->emit($response);

