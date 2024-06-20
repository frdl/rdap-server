<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use hiqdev\rdap\core\Infrastructure\Provider\DomainProviderInterface;
use hiqdev\rdap\core\Infrastructure\Serialization\SerializerInterface;
use hiqdev\rdap\core\Infrastructure\Serialization\Symfony\SymfonySerializer;
use hiqdev\rdap\WhoisProxy\Provider\WhoisDomainProvider2;
use Iodev\Whois\Whois;
use Iodev\Whois\Factory;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Factory\StreamFactory;

use Pdp\Manager;
use Pdp\CurlHttpClient;
use Pdp\Cache;
use Pdp\Cache2;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

use Psr\SimpleCache\CacheInterface;
/**

        $whois = Whois::create();
        $whoisDomainProvider = new WhoisDomainProvider($whois);
        $resultSearch = $whoisDomainProvider->get(DomainName::of('google.com'));
        $this->assertTrue(true);
		*/

			$directory = __DIR__.'/../cache/rdap/';
			if(!is_dir($directory))mkdir($directory, 0775, true);

			$directory = __DIR__.'/../cache/tld/';		
			if(!is_dir($directory))mkdir($directory, 0775, true);





return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
		'rdap.cache' => function (ContainerInterface $c) {
			$directory = __DIR__.'/../cache/rdap/';
			if(!is_dir($directory))mkdir($directory, 0775, true);
			$namespace = 'rdap';
			//$defaultLifetime = 24 * 60 * 60;
			$defaultLifetime = 3 * 60 * 60;
			$cache = new FilesystemAdapter(    
				// a string used as the subdirectory of the root cache directory, where cache   
				// items will be stored   
				$namespace,				
   
				// the default lifetime (in seconds) for cache items that do not define their   
				// own lifetime, with a value 0 causing items to be stored indefinitely (i.e.   
				// until the files are deleted)   
				$defaultLifetime,  
				// the main cache directory (the application needs read-write permissions on it)  
				// if none is specified, a directory is created inside the system temporary directory   
				$directory
			);
			
			return $cache;
		},
		'tld.cache' => function (ContainerInterface $c) {
			$directory = __DIR__.'/../cache/tld/';		
			if(!is_dir($directory))mkdir($directory, 0775, true);
			$cache = new Cache2($directory);			
			return $cache;
		},		
		'tld.cache.ttl' => 3600,
		Manager::class => function (ContainerInterface $c) {
			return new Manager($c->get('tld.cache'), $c->get(CurlHttpClient::class),$c->get('tld.cache.ttl'));
		},
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
	 
		'manager.pdp'  => function (ContainerInterface $c) {
			return $c->get(Manager::class);
		},		
		 
	    CurlHttpClient::class => \DI\autowire(CurlHttpClient::class),
        SerializerInterface::class => \DI\autowire(SymfonySerializer::class),
      //  DomainProviderInterface::class => DI\autowire(WhoisDomainProvider::class),
		  DomainProviderInterface::class => function (ContainerInterface $container) { 
			  $whoisDomainProvider = new WhoisDomainProvider2($container->get(Whois::class));
			  return $whoisDomainProvider;
		  },
        StreamFactoryInterface::class => \DI\autowire(StreamFactory::class),
        Whois::class => function (ContainerInterface $container) { 
			return Whois::create(); 
		},
    ]);
};
