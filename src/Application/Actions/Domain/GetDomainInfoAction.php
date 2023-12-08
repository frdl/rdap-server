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

    public function __construct(ContainerInterface $container, DomainProviderInterface $domainProvider, SerializerInterface $serializer, StreamFactoryInterface $streamFactory)
    {
		$this->container=$container;
        $this->domainProvider = $domainProvider;
        $this->serializer = $serializer;
        $this->streamFactory = $streamFactory;
    }

	public function getCacheKey($domainName){
		return 'rdap.domain.'.self::CACHE_VERSION.'--'.filemtime(__FILE__).'--'.$domainName;
	}
	
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (empty($args['domainName'])) {
            throw new \BadMethodCallException('Domain name is missing');
        }

       
		set_time_limit(220);
		
        $cache= $this->container->get('rdap.cache');
		
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
		
		
		$item = $cache->getItem($this->getCacheKey($args['domainName']));
		if (!$item->isHit()) {   
		    $item->expiresAfter(30 * 60);
			
			$manager = $this->container->get('manager.pdp');
			$rules = $manager->getRules();
			
			$value = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			
			
			$href = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$linkSelf = new Link($href);
			$linkSelf->setValue($value);
			$linkSelf->setTitle($args['domainName'].' - Information');
			$linkSelf->setRel('self');
			$linkSelf->setType('application/rdap+json');
			
		try{	
			$domainRules = $rules->resolve($args['domainName'], '');
			
			$FQN = $domainRules->toAscii()->getContent();            //returns 'nl.shop.bébé.faketld'->getDomain()
			$root = $domainRules->getPublicSuffix();      //returns 'faketld'
			$registrable = $domainRules->getRegistrableDomain(); //returns 'bébé.faketld'
			$subdomain = $domainRules->getSubDomain();         //returns 'nl.shop'
			$isKnown = $domainRules->isKnown();              //returns false
		}catch(\Exception $e3){
			$isKnown=false;
			$registrable=false;
			$linkReg=false;
		}
			
			
			$Notice = new Notice('Availability', 'remark', [($isKnown) ? 'The domain is known.' : 'The domain is unknown.']);
			
			
		if($registrable){		
			$href = 'https://'.$_SERVER['SERVER_NAME'].'/domain/'.$registrable;
			$linkReg = new Link($href);
			$linkReg->setValue($value);
			$linkReg->setTitle('Registrable domain');
			$linkReg->setRel('reg');
			$linkReg->setType('application/rdap+json');	
		}
			
			$href = 'https://'.$_SERVER['SERVER_NAME'].'/domain/'.$root;
			$linkRoot = new Link($href);
			$linkRoot->setValue($value);
			$linkRoot->setTitle('Root tld');
			$linkRoot->setRel('root');
			$linkRoot->setType('application/rdap+json');			
						
			
	 $linkUp = false;		
	 if($registrable && $registrable !== $FQN){
			$href = 'https://'.$_SERVER['SERVER_NAME'].'/domain/'.$registrable;
			$linkUp = new Link($href);
			$linkUp->setValue($value);
			$linkUp->setTitle('Superior domain');
			$linkUp->setRel('up');
			$linkUp->setType('application/rdap+json');				
	 }
			/*
		$manager->refreshRules();
//the rules are saved to the database for 1 day
//the rules are fetched using GuzzlClient

$rules = $manager->getRules();
$domainRules = $rules->resolve('nl.shop.bébé.faketld');
$domainRules->getDomain();            //returns 'nl.shop.bébé.faketld'
$domainRules->getPublicSuffix();      //returns 'faketld'
$domainRules->getRegistrableDomain(); //returns 'bébé.faketld'
$domainRules->getSubDomain();         //returns 'nl.shop'
$domainRules->isKnown();              //returns false


Link:: __construct(string $href)
 setTitle(string $title)
 setValue(string $value)
 setType(string $type)
 setRel(string $rel
setMedia(string $media)
*/		
			
			
			
			
	
			try{
			 $domain = $this->domainProvider->get(DomainName::of($args['domainName']));		
			// $statuses = $domainRules->getStates();  
			 $domain->addRdapConformance('rdap_level_0');			
			 //$domain->addRdapConformance('frdl_level_0');			
				//  "frdlweb_level_0"
				
		//	 $domain->addRdapConformance('frdlweb_level_0');
				
			 $domain->addLink($linkSelf);					
			 $domain->addLink($linkReg);						
			 $domain->addLink($linkRoot);				
									
				if(false !== $linkUp){
			      $domain->addLink($linkUp);		
				}
				
				$domain->addNotice($Notice);
				
		   	$result = $this->serializer->serialize($domain);			
				
			}catch(RdapException $e2){			
				$domain = DomainName::of($args['domainName']);
			//	 $statuses = $domain->getStates();  
				$domain->error = $e2->getMessage();
			
				
				
			if($linkReg && $isKnown && isset($domain->statuses) && is_array($domain->statuses)  && !in_array('invalid', $domain->statuses)){
				$domain->links = [json_decode($this->serializer->serialize($linkSelf)),
								 json_decode( $this->serializer->serialize($linkReg)),
								 json_decode( $this->serializer->serialize($linkRoot))];
				
									
				if(false !== $linkUp){
			      $domain->links[]=json_decode($this->serializer->serialize($linkUp));		
				}
				
				$domain->remarks=[json_decode($this->serializer->serialize($Notice))];
			}//$isKnown
				
			    $result =json_encode($domain);
			}catch(\Exception $e){			
				//$domain =  $this->domainProvider->get(($registrable) ?  DomainName::of($registrable) : DomainName::of($linkRoot));
				$domain = DomainName::of($args['domainName']);
				// $statuses = $domain->getStates();  
				$domain->error = $e->getMessage();
			
				
			if($linkReg && $isKnown && isset($domain->statuses)  && is_array($domain->statuses) && !in_array('invalid', $domain->statuses)){	
				$domain->links = [json_decode($this->serializer->serialize($linkSelf)),
								 json_decode( $this->serializer->serialize($linkReg)),
								 json_decode( $this->serializer->serialize($linkRoot))];
				
									
				if(false !== $linkUp){
			      $domain->links[]=json_decode($this->serializer->serialize($linkUp));		
				}
				
				$domain->remarks=[json_decode($this->serializer->serialize($Notice))];
			}//$isKnown
				
			    $result =json_encode($domain);
			}
          
					
            
					
		
			$result = json_decode($result);
			$res = [];
		  if(!isset($result->error) 
			// && $isKnown 
			 && isset($domain->statuses)  
			// && is_array($domain->statuses)
			 
			// && !in_array('invalid', $result->statuses)
			){
			$res['rdapConformance'] = [
			      'rdap_level_0',
			       'frdlweb_level_0',
			];
		  }else{
			$res['rdapConformance'] = [
			      'rdap_level_0',
			  'frdlweb_level_0',
			];
		  }
			foreach($result as $k => $v){
			  $res[$k] = $v;	
			}
			
			$res['frdlweb']=[];
				     $url = 'https://registry.frdl.de/' . 'plugins/viathinksoft/publicPages/100_whois/whois/webwhois.php?query='
					  .urlencode( 'domain:'.$args['domainName']  )
					.'$format=json';
			$c=@file_get_contents($url);
	 if(false!==$c){		
			$theInfo = json_decode($c);
			$_found = is_object($theInfo) && !is_null($theInfo) && 'Found' === $theInfo->oidip->querySection->result && 'Information partially available' !== $theInfo->oidip->objectSection->status;	
		 
		 if($_found){
		        $Info = [
				'sub'=>[
					'id'=>$args['domainName'],
				    'handle'=> 'domain:'.$args['domainName'].'@'.'oid:1.3.6.1.4.1.37476.30.9.1494410075',
				],
				'found'=>$_found,
				'ns'=>[
					'id'=>'oid:1.3.6.1.4.1.37476.30.9.1494410075',
					'url'=>'https://registry.frdl.de/',
					'name'=>'Frdlweb Registration Authority and Webfan Registry',
				 ],
				'ra'=>(array)$theInfo->oidip->raSection,
				'object'=>(array)$theInfo->oidip->objectSection,
			];	

	    	$res['frdlweb']=[$Info];
		 }//$_found
	 } 
			
		/*	
			$c=file_get_contents(
			//	'https://rdap.frdl.de/host/'.$args['domainName']
				sprintf('https://registry.frdl.de/plugins/frdl/publicPages/1276945_rdap/rdap/rdap.php?query=%s', 
						'domain%3A'.$args['domainName'])
			);
			
			
			
			
			//oidplus_oidip
			//if(!preg_match("/unknown/", $c) ){
			if(isset($domainRegINfo->oidplus_oidip)){
				$domainRegINfo=(array)$domainRegINfo->oidplus_oidip->oidip;
			//	unset($domainRegINfo['objectClassName']);
				$res['frdl_oidplus'] =[
					   'ra'=>$domainRegINfo['raSection'],
					   'object'=>$domainRegINfo['objectSection'],
					];
			
			}else{
				$res['frdl_oidplus'] = false;
			}
			*/
			
			
	/*	
				
				$domainRegINfo = [
					'oidplus_oidip'=>$domainRegINfo,
				];
				$res = array_merge_recursive($res, $domainRegINfo);
			
		    	$domainRegINfo = $domainRegINfo->oidplus_oidip->oidip;
				unset($domainRegINfo->rdapConformance);
				unset($domainRegINfo->name);
				unset($domainRegINfo->objectClassName);
				$domainRegINfoAddon = new \stdclass;
				$domainRegINfoAddon->title = 'Frdlweb IO4 Extensions';
			//	$domainRegINfoAddon->type = 'remark';
				$domainRegINfoAddon->type = 'oidip';
				$domainRegINfoAddon->value = $domainRegINfo;//->objectSection;
			    $res['notices'][] = $domainRegINfoAddon;	  
				
				*/
			$result = json_encode($res, \JSON_PRETTY_PRINT );
		/*		*/
            $item->set($result);
			$cache->save($item);
		}//notInCache
		
		$serialized = $item->get();
		
        return $response->withHeader('Content-Type', 'application/rdap+json')
            ->withStatus(200)
            ->withBody($this->streamFactory->createStream($serialized));
    }
}
