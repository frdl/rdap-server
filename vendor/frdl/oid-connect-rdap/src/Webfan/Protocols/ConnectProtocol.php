<?php
declare(strict_types=1);

namespace Webfan\RDAPClient\Protocols;


use Webfan\RDAPClient\Services\ConnectService;

use Webfan\RDAPClient\Response\ConnectResponse;
use Webfan\RDAPClient\Interfaces\RdapClientInterface;

use ArrayAccess\RdapClient\Protocols\AbstractRdapProtocol;

use ArrayAccess\RdapClient\Exceptions\MismatchProtocolBehaviorException;
//use ArrayAccess\RdapClient\Interfaces\RdapClientInterface;
use ArrayAccess\RdapClient\Interfaces\RdapRequestInterface;
use ArrayAccess\RdapClient\Interfaces\RdapResponseInterface;
use ArrayAccess\RdapClient\Response\DomainResponse;
use ArrayAccess\RdapClient\Services\DomainService;
use Exception;
use function get_class;
use function sprintf;

class ConnectProtocol extends AbstractRdapProtocol
{
    public function __construct(RdapClientInterface $client, ?ConnectService $service = null)
    {
        parent::__construct($client);
        if ($service) {
            $this->services = $service;
        }
    }

    public function setService(ConnectService $service): void
    {
        $this->services = $service;
    }

    /**
     * @throws Exception
     */
    public function getService(): ConnectService
    {
        return $this->services ??= ConnectService::fromURL(self::DOMAIN_URI);
    }

    /**
     * @return string
     * @link https://datatracker.ietf.org/doc/html/rfc7482#section-3.1.3
     */
    public function getSearchPath(): string
    {
        return '/connect';
    }

    public function createResponse(string $response, RdapRequestInterface $request): RdapResponseInterface
    {
        if ($request->getProtocol() !== $this) {
            throw new MismatchProtocolBehaviorException(
                sprintf(
                    'Protocol object "%s" from request is mismatch with protocol object "%s"',
                    get_class($request->getProtocol()),
                    $this::class
                )
            );
        }

        return new ConnectResponse($response, $request, $this);
    }
}
