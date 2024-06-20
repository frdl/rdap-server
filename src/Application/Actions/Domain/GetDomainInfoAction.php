<?php
declare(strict_types=1);

namespace App\Application\Actions\Domain;

use hiqdev\rdap\core\Domain\ValueObject\DomainName;
use hiqdev\rdap\core\Infrastructure\Provider\DomainProviderInterface;
use hiqdev\rdap\core\Infrastructure\Serialization\SerializerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamFactoryInterface;
use Slim\Psr7\Request;
//use Slim\Http\ServerRequest;
use Psr\Container\ContainerInterface;
use hiqdev\rdap\core\Domain\Exception\RdapException;
use hiqdev\rdap\core\Domain\ValueObject\Link;
use Pdp\Rules;
use hiqdev\rdap\core\Domain\ValueObject\Notice;

final class GetDomainInfoAction
{
	
	const CACHE_VERSION = '0.4.7';
    /**
     * @var DomainProviderInterface
     */
    private $domainProvider;
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;
	
	private $container;
	
	protected $cache;

    public function __construct(ContainerInterface $container, DomainProviderInterface $domainProvider, SerializerInterface $serializer, StreamFactoryInterface $streamFactory)
    {
		$this->container=$container;
        $this->domainProvider = $domainProvider;
        $this->serializer = $serializer;
        $this->streamFactory = $streamFactory;
		
		$this->cache= $this->container->get('rdap.cache');
    }

	public function getCacheKey($domainName){
		return 'rdap.domain.'.self::CACHE_VERSION
			//.'-'.filemtime(__FILE__).'-sf-'
			.sha1($domainName).strlen($domainName);
	}
	
	
	public function authoritativeLookup(string $name, string $type, ?int $limit = null){
		if(!\Webfan\RDAP\Rdap::isValidType($type)){
		  return false;//json_decode('{"error":"domain is not available"}');
		}
		//$result =false;
	    $cache= $this->cache;
		$item = $cache->getItem($this->getCacheKey('authoritative-lookup'. sha1($name.':'.$type)));
		if (!$item->isHit()) {   
		    $item->expiresAfter(is_int($limit) ? $limit : 3 * 60);
			
			$client = new \Webfan\RDAP\Rdap($type);				
					
			$result =  @$client->rdap($name,true);				
		   // $result = json_decode($result, \JSON_PRETTY_PRINT );
			if($result && !is_string($result) ){				
				//$result= $this->serializer->serialize($result);  	
				$result= json_encode($result);  
			}					
            
			$item->set($result);
			$cache->save($item);
			return $result;
		}else{		
			return $item->get();
		}
	}	
	
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (empty($args['domainName'])) {
            throw new \BadMethodCallException('Domain name is missing');
        }

       
		set_time_limit(220);
		
        $cache= $this->cache;
		
		/*	
		$tempPrivateDirs = __DIR__.'/../../../../cache/rdap/';
		
		$ShutdownTasks = \frdlweb\Thread\ShutdownTasks::mutex();
        $ShutdownTasks(function($cache, $CacheDir, $maxCacheTime){
			$cache->prune();
		    if(is_dir($CacheDir)){	
		      \webfan\hps\patch\Fs::pruneDir($CacheDir, $maxCacheTime, true, true);
		    }
        },$cache, $tempPrivateDirs, 24 * 60 * 60);	 
		*/
		
	//	ob_start();
		$item = $cache->getItem($this->getCacheKey($args['domainName']));
		
	//	$result = json_decode('{"error":"domain is not available"}');
		if (!$item->isHit()) {   
		    $item->expiresAfter(30 * 60);			
			  $result =@$this->authoritativeLookup($args['domainName'], 'domain',120);	
	          if(!$result || (is_object($result) && isset($result->error)) ){
				  $result =@$this->domainProvider->get(DomainName::of($args['domainName']));				  
			
				  if($result && !is_string($result) ){								
					  $result= $this->serializer->serialize($result);  				
				  }			 
			  }
				
			 $item->set($result);
			 $cache->save($item);	
		}else{
		       $result = $item->get();	
		}
		        $serialized = !is_string($result) ?  json_encode($result) : $result;
		  //  ob_end_clean();
             return $response->withHeader('Content-Type', 'application/rdap+json')
               ->withStatus(200)
               ->withBody($this->streamFactory->createStream($serialized));		
    }
}
