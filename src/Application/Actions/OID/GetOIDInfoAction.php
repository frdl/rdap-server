<?php
declare(strict_types=1);


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




namespace App\Application\Actions\OID{

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

class GetOIDInfoAction
{
	
				   //  '\~',
				 //  'web+fan',
	const CACHE_VERSION = '0.2.2';
	const TYPES = ['oid', 
				   'weid', 
				   'doi',
				   'gs1', 
				   'guid', 
				   'ipv4', 
				   'ipv6', 
				   'java',
				   'other',
				   'aid', 
				   'mac', 
				   
				   'php',
				   'fourcc',
				   'java',
				   'uri',
				   'circuit', 
				   'domain',
				 //  'x-oidplus-domain',
				 ];
	
	const INSTANCES_URL = 'https://hosted.oidplus.com/viathinksoft/plugins/viathinksoft/publicPages/100_whois/whois/webwhois.php?query=oid%3A1.3.6.1.4.1.37476.30.9$format=json';
	
   
    /**
     * @var SerializerInterface
     */
    protected $serializer;
    /**
     * @var StreamFactoryInterface
     */
    protected $streamFactory;
	
	protected $container;
	
	protected $cache;

    public function __construct(ContainerInterface $container, DomainProviderInterface $domainProvider, SerializerInterface $serializer, StreamFactoryInterface $streamFactory)
    {
		$this->container=$container;
        $this->serializer = $serializer;
        $this->streamFactory = $streamFactory;
		$this->cache= $this->container->get('rdap.cache');
		$this->domainProvider = $domainProvider;
    }

	
	protected function domain($args){
		
		    if(!isset($args['domainName']) && isset($args['name'])){
				$args['domainName'] = $args['name'];
			}
		
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
				
			   // $result =json_encode($domain);
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
				
			    //$result =json_encode($domain);
				$result =$domain;
			}
          
					return is_string($result) ? json_decode($result) : $result;
	}
	
	
	
	public function getCacheKey($type, $name){
		return 'rdap.v655555'.$type.'.'.self::CACHE_VERSION.'-'.sha1_file(__FILE__).'-'
			.sha1($name).'l'.strlen($name).md5(@$_GET['partially'] !== 'include' ? '-' : @$_GET['partially']);
	}
	
	
	public function getInstances(){
	    $cache= $this->cache;
		$item = $cache->getItem($this->getCacheKey('oidplus', 'instances'));
		if (!$item->isHit()) {   
		    $item->expiresAfter(1 * 60 * 60);
			$res = [];
	         $inst=json_decode(file_get_contents(self::INSTANCES_URL));
			 $subs = $inst->oidip->objectSection->subordinate;
			 foreach($subs as $sub){
				 $sub=explode(' ', $sub);
				 $sub=$sub[0]; 
				 try{
				 $instanceInfo = json_decode(file_get_contents('https://hosted.oidplus.com/viathinksoft/plugins/viathinksoft/publicPages/100_whois/whois/webwhois.php?query='.urlencode($sub).'$format=json'));
					 
					 
					 
				 	              $description = $instanceInfo->oidip->objectSection->description;
							      $registryName = $instanceInfo->oidip->objectSection->name;							
									preg_match("/System\sID\:6175446Last\sknown\sURL\:([^\s]+)\s/", $description, $matches);
					 if(!isset($matches[1])){
						 preg_match("/URL\:([^\s]+)\s/", $description, $matches);
					 }
									$url = $matches[1];
				 
					 
				 }catch(\Exception $e){	
				
					 continue;							
				 }
				$res[]=[
					   'registryName' => $registryName,
					 //  'description' => $description,
					   'url' => $url,
					   'id'=>$sub,
					];
			 }
			
		//	$result = json_encode($res);
			$result = $res;
			$item->set($result);
			$cache->save($item);			
		}
		//$Instances = json_decode($item->get());
		$Instances = $item->get();
		shuffle($Instances);
		return $Instances;
	}
	
	
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (empty($args['name'])) {
            throw new \BadMethodCallException('name is missing');
        }
        if (empty($args['type']) || !in_array($args['type'], self::TYPES)) {
            throw new \BadMethodCallException('type is missing or invalid');
        }
       
	 	if('x-oidplus-domain'===$args['type']){
		  $args['type'] = 'domain';	
		}
		
		set_time_limit(180);
	   
	    $cache= $this->cache;
		
	 
		
		$item = $cache->getItem($this->getCacheKey('type:'.$args['type'], 'name:'.$args['name']));
		$itemOidplusInstanceFor = $cache->getItem($this->getCacheKey('oidplus-instance-for', $args['type'].':'.$args['name']));


		
		if (!$item->isHit()) {   
		    $item->expiresAfter(30 * 60);
           $frdlweb=[   ];
			
			$value = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			
			
			$href = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$linkSelf = new Link($href);
			$linkSelf->setValue($value);
			$linkSelf->setTitle('Information about the '.$args['type'].' '.$args['name']);
			$linkSelf->setRel('self');
			$linkSelf->setType('application/rdap+json');
	
			
			$isKnown = false;
			$remarks = [];
			
			
				
		if( $itemOidplusInstanceFor->isHit() ){
			$foundInstanceFor = true;
			$InstanceFor = $itemOidplusInstanceFor->get();
			$searchInstances = $InstanceFor;
		}else{
			$foundInstanceFor = false;
			$InstanceFor = [];
			$itemOidplusInstanceFor->expiresAfter(1 * 60 * 60);
			$searchInstances = $this->getInstances();
		}
			
			foreach($searchInstances as $instance){
				set_time_limit(180);
			
				$url = $instance['url'] . 'plugins/viathinksoft/publicPages/100_whois/whois/webwhois.php?query='
					  .urlencode(
					     'weid' === $args['type']
					          ? $args['name']
					          : $args['type'].':'.$args['name']
				      )
					.'$format=json';
				
				
						
				$urlRdap = $instance['url'] . 'plugins/frdl/publicPages/1276945_rdap/rdap/rdap.php?query='
					  .urlencode(
					     'weid' === $args['type']
					          ? $args['name']
					          : $args['type'].':'.$args['name']
				      );	
				
				
				/*$url = $theInfo->oidip[1]->url; 
				
				$url =$instance['url'].'$format=json';
				 	 die('<pre>'.print_r($url,true));
					 */
					   
				$theInfo = @file_get_contents($url);
				if(false === $theInfo)continue;
				$theInfo = @json_decode($theInfo);
				if(!is_object($theInfo) || null === $theInfo)continue;
				$_found = 'Found' === $theInfo->oidip->querySection->result
					&& 'Information partially available' !== $theInfo->oidip->objectSection->status;			
				
							
				if('Found' !== $theInfo->oidip->querySection->result && 'Information partially available' !== $theInfo->oidip->objectSection->status){
				  continue;	
				}
				
				if(!$_found && (!isset($_GET['partially']) || $_GET['partially'] !== 'include') ){
					 continue;	
				}
				
				if($_found){
				 $InstanceFor[] = $instance;	
				}
				
				$ext = [];
				
				$tmpfname = tempnam(\sys_get_temp_dir(), 'rdap-extra-info-from-dec-inilike'); 
				file_put_contents($tmpfname,
								  '\n'.
								  '\n'.
							implode('\n', preg_split("/(\n\r)/",    
								 strip_tags(
								  (string)((array)$theInfo->oidip->objectSection)['description']
								 )))
								);
				 
				$extraInfo = \Env\Dotenv::toArray(
					  $tmpfname
					, true, true)
					;
				unlink($tmpfname);
				
				
							
				if(!$extraInfo && (!isset($_GET['partially']) || $_GET['partially'] !== 'include') ){
					 
				}else{
				    $ext[]=[
					   'type'=>'1.3.6.1.4.1.37476.9000.108.1276945.19361.24174',
					   'description'=>'Parsed ini file like data in description',
					   'data'=>$extraInfo,
				    ];
				}
				
				
			    $Info = [
				'status'=>true === $_found ? 200 : 404,
				'found'=>$_found,
				'sub'=>[
					'id'=>$args['name'],
				    'handle'=>'weid' === $args['type']
					          ? $args['name']
					          : $args['type'].':'.$args['name'].'@'.$instance['id'],
				],
				'ns'=>[
					'id'=>$instance['id'],
					'url'=>$instance['url'],
					'name'=>$instance['registryName'],
				 ],
				'ra'=>(array)$theInfo->oidip->raSection,
				'object'=>(array)$theInfo->oidip->objectSection,
				'ext'=>$ext,
			];		
				if('Information partially available' === $theInfo->oidip->objectSection->status){
					array_push($frdlweb, $Info);
				}elseif($_found){
					array_unshift($frdlweb, $Info);
				}
		
				
				if( $_found ){
					$isKnown = true;
				

							 
			                    $link = new Link($url);
			                    $link->setValue($url);
		                    	$link->setTitle(('weid'===$args['type']
												 ? $args['name']
												 : $args['type'].':'.$args['name'])
												.' @ '.$instance['registryName']);
			                    $link->setRel('alternate');
			                    $link->setType('application/json');
					
				                   
					
					            $linkRdap = new Link($urlRdap);
			                    $linkRdap->setValue($urlRdap);
		                    	$linkRdap->setTitle('rdap://'.('weid'===$args['type']
												 ? $args['name']
												 : $args['type'].':'.$args['name'])
												.' @ '.$instance['registryName']);
			                    $linkRdap->setRel('alternate');
			                    $linkRdap->setType('application/rdap+json');	
					
					
					
					            $_url =$url. '?goto='.urlencode($args['type'].':'.$args['name']);
							    $link2 = new Link($_url);
			                    $link2->setValue($_url);
		                    	$link2->setTitle('Object Information about '.$args['name'].' at '.$instance['registryName']);
			                    $link2->setRel('alternate');
			                    $link2->setType('text/html');	
					
					
					$Notice = new Notice('OID-Whois Result', 'remark',
										 ['The '.strtoupper($args['type']).' '.$args['name'].' was found at '.$instance['registryName'].'.'], 
										[$link, $link2,
										// $linkRdap
										]);
					
		        	array_push($remarks, json_decode($this->serializer->serialize($Notice)));
				}
			}
			
			
			//RESULT--->
			$res = [];
			
			
		 	if('domain'===$args['type']){
		        $domain = (array) $this->domain($args);
			    if( !isset($domain->error) ){
				   $isKnown = true;
			   } 
				
			//	$res = (array) $domain;	
				 
		    } else{
			   $domain = [];	
			}
			
			
			
			
			
			$Notice = new Notice('Availability', 'remark', [($isKnown) 
															? 'The '.strtoupper($args['type']).' '.$args['name'].' is known.' 
															: 'The '.strtoupper($args['type']).' '.$args['name'].' is unknown.']);
			array_unshift($remarks, json_decode($this->serializer->serialize($Notice)));

			
			
			$res['rdapConformance'] = [
                       "rdap_level_0",
                     //  "oidplus_level_0",
                       "frdlweb_level_0"
			];		
			$res['objectClassName'] = $args['type'];
			$res['name'] = $args['name'];
			$res['links'] = [
				                json_decode($this->serializer->serialize($linkSelf)),
							//	 json_decode( $this->serializer->serialize($linkReg)),
								// json_decode( $this->serializer->serialize($linkRoot))
							];			
			

			
			$res = array_merge_recursive($res, $domain);
			$res['objectClassName'] = is_array($res['objectClassName']) ? array_pop($res['objectClassName']) : $res['objectClassName'] ;
			
			if(isset($linkRdap)){
				$res['links'][] =   json_decode($this->serializer->serialize($linkRdap));
			}
			
			if(isset($link)){
				$res['links'][] =   json_decode($this->serializer->serialize($link));
			}		
					
			if(isset($link2)){
				$res['links'][] =   json_decode($this->serializer->serialize($link2));
			}
			
						
			$res['remarks']=isset($res['remarks']) ? array_merge($res['remarks'], $remarks) : $remarks;
			$res['frdlweb']=isset($res['frdlweb']) ? array_merge($res['frdlweb'], $frdlweb) : $frdlweb;
			
			
			//$res = array_merge_recursive($res, $domain);
			
			
			$result = json_encode($res, \JSON_PRETTY_PRINT );
			
            $item->set($result);
			$cache->save($item);
		}//notInCache
		
		if(!$foundInstanceFor){
			$itemOidplusInstanceFor->set($InstanceFor);
		    $cache->save($itemOidplusInstanceFor);
		}
		$serialized = $item->get();
		
        return $response->withHeader('Content-Type', 'application/rdap+json')
            ->withStatus(200)
            ->withBody($this->streamFactory->createStream($serialized));
    }
}

}//ns
