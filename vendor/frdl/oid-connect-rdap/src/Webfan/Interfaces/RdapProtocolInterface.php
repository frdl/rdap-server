<?php
declare(strict_types=1);

namespace Webfan\RDAPClient\Interfaces;

use Webfan\RDAPClient\Interfaces\RdapClientInterface;

use ArrayAccess\RdapClient\Interfaces\RdapServiceInterface;
use ArrayAccess\RdapClient\Interfaces\RdapRequestInterface;
use ArrayAccess\RdapClient\Interfaces\RdapResponseInterface;

interface RdapProtocolInterface
{
    const IPV4_URI = 'https://data.iana.org/rdap/ipv4.json';
    const IPV6_URI = 'https://data.iana.org/rdap/ipv6.json';
    const ASN_URI = 'https://data.iana.org/rdap/asn.json';
    const DOMAIN_URI = 'https://data.iana.org/rdap/dns.json';

    const NS_URI = self::DOMAIN_URI;

    const OBJECT_TAGS_URI = 'https://data.iana.org/rdap/object-tags.json';

    const OID_URI = 'https://oid.zone/rdap/data/oid.json';
    const BOOTSTRAP_URI = 'https://oid.zone/rdap/bootstrap/%s/%s';

    public function __construct(RdapClientInterface $client);

    public function getName() : string;

    public function getService() : RdapServiceInterface;

    public function getFindURL(string $target) : ?string;

    public function find(string $target) : ?RdapRequestInterface;

    public function getSearchPath() : string;

    public function createResponse(
        string $response,
        RdapRequestInterface $request
    ) : RdapResponseInterface;
}
