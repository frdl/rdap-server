<?php

namespace hiqdev\rdap\WhoisProxy\tests\unit\Provider;

use hiqdev\rdap\core\Domain\ValueObject\DomainName;
use hiqdev\rdap\WhoisProxy\Provider\WhoisDomainProvider;
use Iodev\Whois\Whois;

class WhoisDomainProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $whois = Whois::create();
        $whoisDomainProvider = new WhoisDomainProvider($whois);
        $resultSearch = $whoisDomainProvider->get(DomainName::of('google.com'));
        $this->assertTrue(true);
    }
}
