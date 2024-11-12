<?php
declare(strict_types=1);







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
use Pdp\Domain;
	
class GetOIDInfoAction
{
	
				   //  '\~',
				 //  'web+fan',
	const CACHE_VERSION = '0.2.4';
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
				    'asn',
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
    protected $domainProvider;
	
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
		
		
		
		//DomainProviderInterface::class
		$whois = false;
		$whois = \hiqdev\rdap\core\Domain\ValueObject\DomainName::of($args['domainName']);
		
		return $whois;		
	}//domain
	
	
	
	
	
	
	
	public function getCacheKey($type, $name){
		return 'rdap.dcc34'.$type.'.'.self::CACHE_VERSION.'-'
			//.filemtime(__FILE__).'-'
			.sha1($name).'l'.strlen($name);
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
									preg_match("/System\sID\:\d\sLast\sknown\sURL\:([^\s]+)\s/", $description, $matches);
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
	
	
    
	public function authoritativeLookup(string $name, string $type, ?int $limit = null){
		if(!\Webfan\RDAP\Rdap::isValidType($type)){
		  return false;	
		}
		$result = false;
	    $cache= $this->cache;
		$item = $cache->getItem($this->getCacheKey('authoritative-lookup', $name.':'.$type));
		if (!$item->isHit()) {   
		    $item->expiresAfter(is_int($limit) ? $limit : 3 * 60);
			
			$client = new \Webfan\RDAP\Rdap($type);				
					
			$result =  @$client->search($name);				
		 //  $result = json_encode($result, \JSON_PRETTY_PRINT );
			
            
			$item->set($result);
			$cache->save($item);
		}
		return $item->get();
	}
	
	

	public function siteURL(){
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'].'/';
    return $protocol.$domainName. $_SERVER['REQUEST_URI'];
	}	
	
   protected function frdl_array_unflatten(array $arr, $delimiter = '.', $depth = -1)
    {
        $output = [];
        foreach ($arr as $key => $value) {
        if(($parts = @preg_split($delimiter, $key, -1)) === false){
           //pattern is broken
          $parts = ($depth>0)?explode($delimiter, $key, $depth):explode($delimiter, $key);
           }else{
           //pattern is real

           }
        //$parts = ($depth>0)?explode($delimiter, $key, $depth):explode($delimiter, $key);
        $nested = &$output;
        while (count($parts) > 0) {
          $nested = &$nested[array_shift($parts)];
          if (!is_array($nested)) $nested = [];
        }
        $nested[array_shift($parts)] = $value;
        }
        return $output;
    }

	
	
	protected function frdl_ini_dot_parse(string $text, ?bool $clear = false) : array {
	
	$ext = [];
	$unf = [];
    $find = "/(?P<name>[A-Z0-9\-\_\.\"\']+)(\s|\n)(\:|\=)(\s|\n)(?P<value>[^\s]+)/xs";		          
	preg_match_all($find, $text, $matches, \PREG_PATTERN_ORDER);
	
	if(true === $clear){
      while(preg_match($find, $text)) {
        $text = preg_replace($find, '', $text);
		$text = str_replace('[@]', '', $text);  
      }
	}
		
	foreach($matches[0] as $k => $v){						
		$ext[$matches['name'][$k]] = $matches['value'][$k];				
	}
				         
		            foreach($ext as $ka => $v){
						$k = explode('.', $ka, 2)[0];
					
						if(is_numeric($k) 
						    && intval($k) > 0
						  ){	 
							$unf[$ka] = $v;
						}
					}
 
		            $ext = $this->frdl_array_unflatten($ext, '.', -1);
		
		           foreach($unf as $k => $v){ 
							$ext[$k] = $v; 
					}	      
	return ['data'=>$ext, 'content'=>$text];
   }
	
    public function __invoke(Request $request, Response $response, array $args): Response
    {
	//	ini_set('display_errors', '0');
		ob_start();
        if (empty($args['name'])) {
            throw new \BadMethodCallException('name is missing');
        }
        if (empty($args['type']) || !in_array($args['type'], self::TYPES)) {
            throw new \BadMethodCallException('type is missing or invalid');
        }
       
	 	if('x-oidplus-domain'===$args['type']){
		  $args['type'] = 'domain';	
		}
	 	if('domain'===$args['type']){
		  $args['name'] = strtolower( $args['name']);	
		}		
		
		set_time_limit(180);
		$cacheKey = $this->getCacheKey('ALL-type:'.$args['type'], 'ALL-name:'.$args['name']);
	    $cache= $this->cache;	 
		
		$item = $cache->getItem($cacheKey);
		$itemOidplusInstanceFor = $cache->getItem($this->getCacheKey('RESULT-oidplus-instance-for', $args['type'].':'.$args['name']));

		

			$foundInstanceFor = false;
			$InstanceFor = [];					
		
		
	if (!$item->isHit()) {
		 $item->expiresAfter(8 * 60);
		$authResult=@ $this->authoritativeLookup($args['name'], $args['type'], 8 * 60);		
		if( is_string($authResult) ){	 
	         $authResult = json_decode($authResult);
		}
		if('domain'===$args['type'] && (  is_object($authResult) && isset($authResult->error))){	 
	        $domain =(array) @$this->domain($args); 
		}
		
		if( (  is_object($authResult) && !isset($authResult->error))){	 
	          //OK...
			 	 $authResult = json_encode($authResult);
		}/*elseif(  'domain'===$args['type']){
			try{
		        $authResult = $this->domain($args);
			}catch(\Exception $e){
				 $authResult = false;
			}
			    if( !is_object($authResult) ||  isset($authResult->error) ){
				   $authResult = false;
			   } else{
				  $authResult = $this->serializer->serialize($authResult);	
				}
		 } */
		
	    if(  is_string($authResult) || is_array($authResult) || is_object($authResult) ){	 
		/*	
 return $response
	 ->withHeader('Content-Type', 'application/rdap+json')->withStatus(200)->withBody($this->streamFactory->createStream($authResult));
			*/    
			
			 
			$item->set($authResult);
			$cache->save($item);
			$item = $cache->getItem($cacheKey);
		} 
	}//if (!$item->isHit()) {    [ 1 ]



		
		if (!$item->isHit()) {   
		    $item->expiresAfter(8 * 60);
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
	  
	   $referer = $this->siteURL();
	   $userAgent ='Rdap+Client (Webfan/Frdlweb+'.$_SERVER['HTTP_HOST'].')';
       $options = array(
           'http'=>array(		
	          'ignore_errors' => true,			 
		   'follow_location' => true,
              'method'=>"GET",
              'header'=>"Accept-language: en\r\n" 
		   // ."Cookie: foo=bar\r\n"
                 . "User-Agent: $userAgent\r\n"  
		 ."Referer: $referer\r\n"
            )
        );

	   
         $context = stream_context_create($options);
				
				//$theInfo = @file_get_contents($url, false, $context);
				
				$theInfo2 = @file_get_contents($urlRdap, false, $context);				
				$theInfo = @file_get_contents($url, false, $context);
				
				if(false === $theInfo && false === $theInfo2)continue;
				$theInfo = @json_decode($theInfo);
				//print_r($urlRdap);
				//print_r($theInfo);
				if(is_object($theInfo) && is_object($theInfo2) ){
				 $theInfo = (object) array_merge_recursive((array) $theInfo, (array) $theInfo2);
				}
				if(!is_object($theInfo) 
				  // || null === $theInfo || false === $theInfo
				  || !isset( $theInfo->oidip)
				  )continue;
				
				$_found = 'Found' === $theInfo->oidip->querySection->result
					&& 'Information partially available' !== $theInfo->oidip->objectSection->status;			
				
							
				if('Found' !== $theInfo->oidip->querySection->result
				   && 'Information partially available' !== $theInfo->oidip->objectSection->status){
				  continue;	
				}
				
				if(false===$_found 
				   //&& (isset($_GET['partially']) && $_GET['partially'] === 'first') 
				  
				  ){
					 continue;	
				}
				
				if($_found){
				 $InstanceFor[] = $instance;	
				}
				
				$ext = [];
				
				try{
				  $description = isset($theInfo->oidip->objectSection->description)
					  ? (string)((array)$theInfo->oidip->objectSection)['description']
					  : '';
				}catch(\Exception $e){
					$description = '';
				}
			 
				/*
				$tmpfname = tempnam(\sys_get_temp_dir(), 'rdap-extra-info-from-dec-inilike'); 
				file_put_contents($tmpfname,
								  '\n'.
								  '\n'.
							implode('\n', preg_split("/(\n\r)/",    
								 strip_tags(
								  $description
								 )))
								);
				 
				$extraInfo = \Env\Dotenv::toArray(
					  $tmpfname
					, true, true)
					;
				unlink($tmpfname);
				*/
				$extraInfo = $this->frdl_ini_dot_parse($description)['data'];
				if(0===count($extraInfo)){
				  $extraInfo = false;	
				}
							
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
			
			/*
		 	if('domain'===$args['type']){
		        $domain = (array) $this->domain($args);
			    if( !isset($domain->error) ){
				   $isKnown = true;
			   } 
				
			//	$res = (array) $domain;	
				 
		    } else{
			   $domain = [];	
			}
			*/
			
			
			
			
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
			

			
			$res = array_merge_recursive($res, isset($domain) && is_array($domain)?$domain:[]);
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
		if(!is_string($serialized)){
			$serialized = json_encode($serialized, \JSON_PRETTY_PRINT);
		}
		ob_end_clean();
        return $response->withHeader('Content-Type', 'application/rdap+json')
            ->withStatus(200)
            ->withBody($this->streamFactory->createStream($serialized));
    }
}

}//ns
