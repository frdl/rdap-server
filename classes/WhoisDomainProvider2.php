<?php

namespace hiqdev\rdap\WhoisProxy\Provider;

use hiqdev\rdap\core\Domain\Constant\EventAction;
use hiqdev\rdap\core\Domain\Constant\Role;
use hiqdev\rdap\core\Domain\Constant\Status;
use hiqdev\rdap\core\Domain\Entity\Domain;
use hiqdev\rdap\core\Domain\Entity\Entity;
use hiqdev\rdap\core\Domain\Entity\Nameserver;
use hiqdev\rdap\core\Domain\ValueObject\DomainName;
use hiqdev\rdap\core\Domain\ValueObject\Event;
use hiqdev\rdap\core\Infrastructure\Provider\DomainProviderInterface;
use Iodev\Whois\Modules\Tld\DomainInfo;
use Iodev\Whois\Whois;
use JeroenDesloovere\VCard\VCard;
use hiqdev\rdap\core\Domain\ValueObject\Notice;

class WhoisDomainProvider2 implements DomainProviderInterface
{
    /**
     * @var Whois
     */
    private $whois;

    public function __construct(Whois $whois)
    {
        $this->whois = $whois;
    }

    public function get(DomainName $domainName): Domain
    {
        /** @var DomainInfo $domainInfo */
        $domainInfo = $this->whois->loadDomainInfo($domainName->toLDH());
        if (!$domainInfo) {
            throw new \Exception('domain is not available');
        }
		
        $domain = new Domain(DomainName::of($domainInfo->getDomainName()));
        foreach ($domainInfo->getNameServers() as $nameServer) {
            $domain->addNameserver(new Nameserver(DomainName::of($nameServer)));
        }
        $statuses = $domainInfo->getStates();
        foreach ($statuses as $state) {
            $domain->addStatus(Status::byName(strtoupper($state)));
        }

		//	 $domain->addRdapConformance('rdap_level_0');
			// $domain->addRdapConformance('frdl_level_0');
		
		
		
        $creationDate = $domainInfo->getCreationDate();
        $expirationDate = $domainInfo->getExpirationDate();
        $registrarInfo = $domainInfo->getRegistrar();
        $ownerInfo = $domainInfo->getOwner();

		if($creationDate){
          $creationEvent = Event::occurred(EventAction::REGISTRATION(), \DateTimeImmutable::createFromMutable((new \DateTime())->setTimestamp($creationDate)));
          $domain->addEvent($creationEvent);
		}
		
		if($expirationDate){
        $expirationEvent = Event::occurred(EventAction::EXPIRATION(), \DateTimeImmutable::createFromMutable((new \DateTime())->setTimestamp($expirationDate)));
        $domain->addEvent($expirationEvent);
		}
		
        $whoisServer = $domainInfo->getWhoisServer();
        $domain->setPort43(DomainName::of($whoisServer));

       if($ownerInfo){
		   $domain->addEntity($this->getEntity(Role::REGISTRANT(), $ownerInfo));
	   }
		
		if($registrarInfo){
         $domain->addEntity($this->getEntity(Role::REGISTRAR(), $registrarInfo));
		}
		
/*
		print_r(array_filter(preg_split("/[\r\n]/", $domainInfo->getResponse()->getText()),function($v){
			return !empty($v);
		}));
		die();
		*/
		 $domain->addNotice(new Notice('Whois-Result', 'remark', array_values(array_filter(preg_split("/[\r\n]/", $domainInfo->getResponse()->getText()),function($v){
			return !empty($v);
		}))));
		
        return $domain;
    }

    private function getEntity(Role $role, string $personInfo): Entity
    {
        $personEntity = new Entity();
        $personVcard = new VCard();
        $personVcard->addCompany($personInfo);
        $personEntity->addVcard($personVcard);
        $personEntity->addRole($role);
        return $personEntity;
    }
}
