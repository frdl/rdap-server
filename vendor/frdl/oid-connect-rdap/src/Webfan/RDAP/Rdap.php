<?php 
declare(strict_types=1);

namespace Webfan\RDAP{

use Metaregistrar\RDAP\RdapException;
//use Metaregistrar\RDAP\Rdap as BaseRdapClient;
use Metaregistrar\RDAP\Responses\RdapAsnResponse;
use Metaregistrar\RDAP\Responses\RdapIpResponse;
use Webfan\RDAP\Response\RdapOIDResponse;
use Metaregistrar\RDAP\Responses\RdapResponse;
	

	
class Rdap // extends BaseRdapClient
{
  
    public const ASN    = 'asn';
    public const IPV4   = 'ipv4';
    public const IPV6   = 'ipv6';
    public const NS     = 'ns';
    public const DOMAIN = 'domain';
    public const SEARCH = 'search';
    public const HOME   = 'home'; 
    public const EMPTY   = 'empty'; 
    public const SERVICES   = 'services'; 
 
  
    public const OID = 'oid';
  /*
    public const WEID = 'weid';
    public const PEN = 'iana-pen';
    public const CARA = 'cara';
    public const RA = 'ra';
    public const SERVICE = 'service';
    public const NODE = 'node';
    public const WEBFINGER = 'webfinger';
    public const HANDLE = '@';
  
   public const UNBOUND = 'unbound';
   public const MULTI = 'multi';
  
   public const CONNECT = 'oid-connect';
  */

    public $userAgent = 'RDAPClient/0.1 (Webfan) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/0.0.1';
	
    protected static $protocols = [
        'ipv4'   => [self::HOME => 'https://data.iana.org/rdap/ipv4.json', self::SEARCH => 'ip/', self::SERVICES => [] ],
        'domain' => [self::HOME => 'https://data.iana.org/rdap/dns.json', self::SEARCH => 'domain/', self::SERVICES => [] ],
        'ns'     => [self::HOME => 'https://data.iana.org/rdap/dns.json', self::SEARCH => 'nameserver/', self::SERVICES => [] ],
        'ipv6'   => [self::HOME => 'https://data.iana.org/rdap/ipv6.json', self::SEARCH => 'ip/', self::SERVICES => [] ],
        'asn'    => [self::HOME => 'https://data.iana.org/rdap/asn.json', self::SEARCH => 'autnum/', self::SERVICES => [] ],  
        'oid'    => [self::HOME => 'https://www.oid.zone/rdap/data/oid.json', self::SEARCH => 'oid/', self::SERVICES => [],
	              self::EMPTY => 'https://www.oid.zone/rdap/data/oid.empty.json',
	            ],
    ];
	
 
	
    private $protocol;
    private $publicationdate = '';
    private $version         = '';
    private $description     = '';

    /**
     * Rdap constructor.
     *
     * @param string $protocol
     *
     * @throws \Metaregistrar\RDAP\RdapException
     */
    public function __construct(string $protocol) {
    //    if (($protocol !== self::ASN) && ($protocol !== self::IPV4) && ($protocol !== self::IPV6) && ($protocol !== self::DOMAIN)) {
    //        throw new RdapException('Protocol ' . $protocol . ' is not recognized by this rdap client implementation');
    //    }
        if (!self::isValidType($protocol) ) {
            throw new RdapException('Protocol ' . $protocol . ' is not recognized by this rdap client implementation');
        }
        $this->protocol = $protocol;
    }
	
    public static function isValidType(string $protocol): bool {
        return isset(self::$protocols[$protocol]) && is_array(self::$protocols[$protocol]) && isset(self::$protocols[$protocol][self::HOME]);
    }

	
    public function addService(string $protocol, string | array $servers) : self {
        if (!self::isValidType($protocol) ) {
            throw new RdapException('Protocol ' . $protocol . ' is not recognized by this rdap client implementation');
        }    
        self::$protocols[$protocol][self::SERVICES][] = $servers;
	    
        return $this;
    }


    public function readServices(?string $protocol = null): array {
	if(!is_string($protocol)){
           $protocol = $this->protocol;
	}
        if (!self::isValidType($protocol) ) {
            throw new RdapException('Protocol ' . $protocol . ' is not recognized by this rdap client implementation');
        }
	    
        $services = [];
	$servers =  self::$protocols[$protocol][self::SERVICES];  
	foreach($servers as $s){
           if(is_string($s)){
             $as = @file_get_contents($s);
	     $s = false === $as ? [] : json_decode($as, false);	   
	     $s=(array)$s;
	     if(isset($s['services'])){
               $s=$s['services'];
	     }
	   } 		
	  foreach($s as $_s){
              array_push($services, $_s);
	   }
	}
     return $services;
    }

    public function dumpServices(?string $protocol = null, ?bool $withRootServerBootstrap = true, ?bool $set = true): array {
	if(!is_string($protocol)){
           $protocol = $this->protocol;
	}
        if (!self::isValidType($protocol) ) {
            throw new RdapException('Protocol ' . $protocol . ' is not recognized by this rdap client implementation');
        }
	    
        $rdap = @file_get_contents(false === $withRootServerBootstrap && isset(self::$protocols[$protocol][self::EMPTY])
				   ? self::$protocols[$protocol][self::EMPTY]
				   : self::$protocols[$protocol][self::HOME]);
         $json =is_string($rdap)
		 ? json_decode($rdap, false)
		 : new \stdclass;

	    
     if($set){	   
	$date = new \DateTimeImmutable();
	$json->publication = $date->format('c');	     
        $this->setDescription($json->description);
        $this->setPublicationdate($json->publication);
        $this->setVersion($json->version);
     }
	if(!isset($json->services)){
           $json->services = [];
	}
	foreach($this->readServices($protocol) as $s){
          array_push($json->services, $s);
	}       

	   $json->services = array_values( $this->add_services($json->services,[]) ); 
	    
       return (array)$json;
    }	

	protected function add_services(array $services, ?array $out = []) : array {
	    foreach($services as $instance){
		        $url =  $instance[1][0];
		        $p = parse_url($url);
		        if(false === $p || !isset($p['host'])){
                        //  continue;
				throw new \Exception(sprintf('Invalid url: %s in %s', $url, __METHOD__));
			}
			if(!isset($out[$url])){
				$out[$url] = [];
			}
			if(!isset($out[$url][0])){
				$out[$url][0] = [];
			}		
			if(!isset($out[$url][1])){
				$out[$url][1] = [];
			}	
			
			if (!in_array($url, $out[$url][1])) {   
                             $out[$url][1][]=$url;
			}  

		      foreach($instance[0] as $prefix){
			if (!in_array($prefix, $out[$url][0])) {   
                            $out[$url][0][]=$prefix;
			}      
		      }
		}		
		return $out;
	}
	
 

	
    /**
     * @return array
     */
    public function readRoot(?string $protocol = null): array {
	if(!is_string($protocol)){
           $protocol = $this->protocol;
	}

        if (!self::isValidType($protocol) ) {
            throw new RdapException('Protocol ' . $protocol . ' is not recognized by this rdap client implementation');
        }
	    
        $rdap = file_get_contents(self::$protocols[$protocol][self::HOME]);
                $json =is_string($rdap)
		 ? json_decode($rdap, false)
		 : new \stdclass;
        $this->setDescription($json->description);
        $this->setPublicationdate($json->publication);
        $this->setVersion($json->version);
	if(!isset($json->services)){
           $json->services = [];
	}
        return $json->services;
    }

    public function readEmptyRoot(?string $protocol = null): array {
	if(!is_string($protocol)){
           $protocol = $this->protocol;
	}
		
        $rdap = @file_get_contents(isset(self::$protocols[$protocol][self::EMPTY])
				   ? self::$protocols[$protocol][self::EMPTY]
				   : self::$protocols[$protocol][self::HOME]);
                
	    $json =is_string($rdap)
		 ? json_decode($rdap, false)
		 : new \stdclass;
	    
         $json->services = [];
	    
	    $date = new \DateTimeImmutable();
	    $json->publication = $date->format('c');
	    
            $this->setDescription($json->description);
            $this->setPublicationdate($json->publication);
            $this->setVersion($json->version);

        return $json->services;
    }
	
    /**
     * @return string
     */
    public function getPublicationdate(): string {
        return $this->publicationdate;
    }

    /**
     * @param string $publicationdate
     */
    public function setPublicationdate(string $publicationdate): void {
        $this->publicationdate = $publicationdate;
    }

    /**
     * @return string
     */
    public function getVersion(): string {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void {
        $this->description = $description;
    }
   
	
public function siteURL(){
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'].'/';
    return $protocol.$domainName. $_SERVER['REQUEST_URI'];
}


   public function rdap(string $search, ?bool $raw = false)  {
	  $skipRefererBounce = true;   
	  $searchLocalOnly = false;	
	if($_SERVER['SERVER_ADDR'] === $_SERVER['REMOTE_ADDR'] 
	   || (isset( $_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['SERVER_ADDR'] ===  $_SERVER['HTTP_X_FORWARDED_FOR'] )
	   || (isset( $_SERVER['HTTP_CLIENT_IP']) && $_SERVER['SERVER_ADDR'] ===  $_SERVER['HTTP_CLIENT_IP'] )){
          $skipRefererBounce = true;
	  $searchLocalOnly = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']=== $this->siteURL();	
	}
     return $this->searchServers($search, $searchLocalOnly,$skipRefererBounce, $raw);
   }

   public function search(string $search, ?bool $searchLocalOnly = false, ?bool $skipRefererBounce = true, ?bool $raw = true){
	  $skipRefererBounce = false;   
	  $searchLocalOnly = false;	
     return $this->searchServers($search, $searchLocalOnly,$skipRefererBounce, $raw);
   }
    /**
     *
     *
     * @param string $search
     *
     * @return \Metaregistrar\RDAP\Responses\RdapAsnResponse|\Metaregistrar\RDAP\Responses\RdapIpResponse|\Metaregistrar\RDAP\Responses\RdapResponse|null
     * @throws \Metaregistrar\RDAP\RdapException
     */
    public function searchServers(string $search, ?bool $searchLocalOnly = false, ?bool $skipRefererBounce = true, ?bool $raw = true)  {
        if (!isset($search) || ($search === '')) {
            throw new RdapException('Search parameter may not be empty');
        }


	 $userAgent = $this->userAgent;
	$ua = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : 'Rdap+OID.ZONE (Webfan/Frdlweb+'.$_SERVER['HTTP_HOST'].')';//$userAgent;
        $referer = $this->siteURL();
        $options = array(
           'http'=>array(
              'method'=>"GET",
              'header'=>"Accept-language: en\r\n" 
		   // ."Cookie: foo=bar\r\n"
                 . "User-Agent: $userAgent\r\n"  
		 ."Referer: $referer\r\n"
            )
        );

	   
         $context = stream_context_create($options);
	    
        $search = trim($search);
      /*
        if ($this->getProtocol() !== self::ASN && (!is_string($search)) && in_array($this->getProtocol(), [
              self::DOMAIN, self::NS, self::IPV4, self::IPV6, self::OID, self::PEN,
              self::CARA, self::SERVICE, self::NODE, self::HANDLE
                                                                                    ], true)) {
            throw new RdapException('Search parameter must be a string for ipv4, ipv6, domain or nameserver searches');
        }

        if ((!is_numeric($search)) && ($this->getProtocol() === self::ASN)) {
            throw new RdapException('Search parameter must be a number or a string with numeric info for asn searches');
        }
*/
        $parameter = $this->prepareSearch($search);
        $services  = true===$searchLocalOnly ? $this->readEmptyRoot($this->protocol) : $this->readRoot($this->protocol);
	
	foreach($this->readServices($this->protocol) as $s){
          array_push($services, $s);
	}

          $services = array_values( $this->add_services($services,[]) ); 

	    
        $moreServices = [];
	    
        foreach ($services as $service) {
									
            foreach ($service[0] as $number) { 
		    // check for slash as last character in the server name, if not, add it
                        if ($service[1][0][strlen($service[1][0]) - 1] !== '/') {
                            $service[1][0] .= '/';
                        }
		    $rdapServerUrlBase = $service[1][0] . self::$protocols[$this->protocol][self::SEARCH];
		    $rdapServerUrlForSearch = $rdapServerUrlBase. $search;

                   if($skipRefererBounce && isset($_SERVER['HTTP_REFERER'])
		      && ($_SERVER['HTTP_REFERER']=== $this->siteURL() 
			  || $_SERVER['HTTP_REFERER']===$rdapServerUrlBase
			  || $_SERVER['HTTP_REFERER']===$rdapServerUrlForSearch 
			  || str_contains($ua, 'rdap')
			  || str_contains($ua, 'webfan')
			  || str_contains($ua, 'frdlweb')
			 )
		     ){
					   
		     continue;
		   }
      
				
		
				
                if (strpos($number, '-') > 0) {
                    [$start, $end] = explode('-', $number);
                    if (($parameter >= $start) && ($parameter <= $end)) {
                        $moreServices[$number]= $rdapServerUrlForSearch;	
                    }
                } elseif ($number === $parameter || str_contains($parameter, $number) || str_contains($search, $number) ) {
			$moreServices[$number]= $rdapServerUrlForSearch;	
                }elseif($number === substr($search, 0, strlen($number)) ){
                      $moreServices[$number]= $rdapServerUrlForSearch;					
		}
            }//$service[0]
        }//$services

         krsort($moreServices);
         foreach($moreServices as $number => $url){          			
		 $rdap = @file_get_contents($url, false, $context); 
			 
		  if($rdap && $raw){                   
		    return $rdap;				
		 }elseif($rdap && !$raw){                   
		    return $this->createResponse($this->getProtocol(), $rdap);				
		 }		
	 }	    
        return null;
    }

    /**
     * @return string
     */
    public function getProtocol(): string {
        return $this->protocol;
    }

    private function prepareSearch(string $string): string {
        switch ($this->getProtocol()) {
            case self::IPV4:
                [$start] = explode('.', $string);

                return $start . '.0.0.0/8';
            case self::DOMAIN:
                $extension = explode('.', $string, 2);

                return $extension[1];
            default:
                return $string;
        }
    }


    /**
     *
     *
     * @param string $protocol  RdapOIDResponse
     * @param string $json
     *
     * @return \Metaregistrar\RDAP\Responses\RdapResponse
     * @throws \Metaregistrar\RDAP\RdapException
     */
    protected function createResponse(string $protocol, string $json) {
	 	return json_decode($json);
	 /*
        switch ($protocol) {
            case self::IPV4:
                return new RdapIpResponse($json);
            case self::ASN:
                return new RdapAsnResponse($json);
		 	case self::OID:
	    		return new RdapOIDResponse($json);
            default:
                return new RdapResponse($json);
        }
		*/
    }

    public function case(): void {
    }
}
	
}//ns