<?php
/** @noinspection UnusedFunctionResultInspection 

        $app->get('?name', function ($request, $response, array $args) use ($app) {
		  $search = $app->request->param('name');
          echo $search;
		  $app->stop();
       });	
*/
declare(strict_types=1);

namespace Frdlweb\Rdap\Whois;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Iodev\Whois\Config;
use Iodev\Whois\Loaders\SocketLoader;
use Iodev\Whois\Modules\Tld\TldModule;
use Iodev\Whois\Modules\Tld\TldServer;
use Iodev\Whois\Modules\Tld\Parsers\CommonParser;
use Iodev\Whois\Modules\Tld\TldParser;
use hiqdev\rdap\core\Domain\ValueObject\SearchResult\AbstractSearchResult;
use App\Application\Actions\Domain\GetDomainInfoAction;
use App\Application\Actions\OID\GetOIDInfoAction;
use hiqdev\rdap\core\Infrastructure\Serialization\SerializerInterface;


function createServer($zone, $host){
    return new TldServer($zone, $host, false, TldParser::create());
}

function getCacheKeySearch($search){
		return 'rdap.domain-search.0.0.9--'.$search;
}

class SearchResult extends AbstractSearchResult
{
	
	
}


return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response) {
	//	die(getcwd().\DIRECTORY_SEPARATOR.'index.html');
	 if(file_exists(getcwd().\DIRECTORY_SEPARATOR.'index.html') ){
        $response->getBody()->write(trim(file_get_contents(getcwd().\DIRECTORY_SEPARATOR.'index.html')));		 
	 }else{
        $response->getBody()->write(<<<HTMLCODE
<script>
(async()=>{
 var c = await fetch('https://rdap.frdlweb.de/index.html'
		    +'?cache-bust=hiphophurra1q23-'+(new Date()).getFullYear()+'/'+((new Date()).getMonth()+1)+'/'+((new Date()).getUTCDate())
		    );
 			  document.open(  );	
			  document.write(  await c.text()  );	  
			  document.close(  );	
})();
</script>

HTMLCODE
								   
								   );
	 }//no index.html ->fetch
        return $response;
    });
    $app->group('/', function (Group $group)
				//(Group $group) 
				use ($app, $container) {
        $app->get('/domain-quickinfo/{domainName}', GetDomainInfoAction::class)
			// ->conditions(['objectType' => '(domain)'])
			;
	       	        
		$app->get('/{type:'.implode('|', GetOIDInfoAction::TYPES).'}/{name}', GetOIDInfoAction::class)
		//	 ->conditions(['objectType' => '('.implode('|', GetOIDInfoAction::TYPES).')'])
			;      
					
		$app->get('/domains', function( $request,  $response, $args) use ($app,$container){
			
			$params = $request->getQueryParams();
			//print_r((new \ReflectionObject($request))->getMethods());  
			//print_r($params);
			//die();	
			  //    $search = $request->get('name');
                //  echo $search;
		          // $app->stop();	
			// $out = $params['name'];
			
			//$data = Config::load('module.tld.servers');
		//	$out .='<br />'.print_r($data,true);
			$searchDomain =  $params['name'];
			
			
		    $cache= $container->get('rdap.cache');
			$item = $cache->getItem(getCacheKeySearch($searchDomain));

			if (!$item->isHit()) {   
 
				$item->expiresAfter(3 * 60 * 60);    	
			
			
			$data = Config::load('module.tld.servers');
			$mod = new TldModule(new SocketLoader());
     
			foreach ($data as $row) {            
				$zone = $row['zone'];          
				if (preg_match('~^\.\w+$~', $zone)) {          
					//$rootDict[$zone][] = $row['host'];        
					$mod->addServers([
						createServer($zone, $row['host']),
					]);
				}      
			}			
		
			 $servers = $mod->matchServers($searchDomain, true);
			
		
			 $results = new SearchResult($servers);
			//print_r($results);die();
			//			 $domain->addRdapConformance('rdap_level_0');			
		//	 $domain->addRdapConformance('frdl_level_0');
			
			 $results->addRdapConformance('rdap_level_0');
			 $results->addRdapConformance('frdl_level_0');
			/*
			 $out = json_encode($results);
			
			$out = '';
				*/
			$outRes = $container->get(SerializerInterface::class)->serialize($results);
			
			   $item->set($outRes);	 
			   $cache->save($item);	
			}//notInCache
			
			
			$out=$item->get();
			
			 $response->getBody()->write($out);
            return $response;
		})
			// ->conditions(['objectType' => '(domains)'])
		;
		
	
    });

};



function unnecessarySubzones()
    {
        $data = Config::load('module.tld.servers');

        $rootDict = [];
        foreach ($data as $row) {
            $zone = $row['zone'];
            if (preg_match('~^\.\w+$~', $zone)) {
                $rootDict[$zone][] = $row['host'];
            }
        }

        $found = [];
        foreach ($data as $row) {
            if (preg_match('~^.+?(\.\w+)$~', $row['zone'], $m)) {
                $zone = $m[1];
                if (!empty($rootDict[$zone]) && in_array($row['host'], $rootDict[$zone])) {
                    $found[] = "DUP HOST IN {$row['zone']} ($zone)   {$row['host']}";
                }
            }
        }

        ///self::assertEmpty($found, implode("\n", $found));
	return $found;
    }