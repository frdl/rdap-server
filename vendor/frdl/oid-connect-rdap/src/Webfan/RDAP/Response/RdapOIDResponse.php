<?php

namespace Webfan\RDAP\Response{
use Metaregistrar\RDAP\Responses\RdapResponse as BaseRdapResponse;

use Metaregistrar\RDAP\Data\RdapConformance;
use Metaregistrar\RDAP\Data\RdapEntity;
use Metaregistrar\RDAP\Data\RdapEvent;
use Metaregistrar\RDAP\Data\RdapLink;
use Metaregistrar\RDAP\Data\RdapNameserver;
use Metaregistrar\RDAP\Data\RdapNotice;
use Metaregistrar\RDAP\Data\RdapObject;
use Metaregistrar\RDAP\Data\RdapRemark;
use Metaregistrar\RDAP\Data\RdapSecureDNS;
use Metaregistrar\RDAP\Data\RdapStatus;
use Metaregistrar\RDAP\RdapException;

class RdapOIDResponse//extends BaseRdapResponse
{
    /**
     * @var string|null
     */
    protected $objectClassName;
    /**
     * @var string|null
     */
    protected $ldhName ;
    /**
     * @var string
     */
    protected $handle = '';
    /*
    * @var  string
    */
    protected $name = '';
    /**
     * @var string
     */
    protected $type = '';
    /**
     * @var null|RdapConformance[]
     */
    protected $rdapConformance;
    /**
     * @var null|RdapEntity[]
     */
    protected $entities;
    /**
     * @var null|RdapLink[]
     */
    protected $links;
    /**
     * @var null|RdapRemark[]
     */
    protected $remarks;
    /**
     * @var null|RdapNotice[]
     */
    private $notices;
    /**
     * @var null|RdapEvent[]
     */
    protected $events;
    /**
     * @var null|string
     */
    protected $port43;
    /**
     * @var null|RdapNameserver[]
     */
    protected $nameservers;
    /**
     * @var null|RdapStatus[]
     */
    protected $status;
    /**
     * @var null|RdapSecureDNS[]
     */
    protected $secureDNS;
    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $title;

    /**
     * RdapResponse constructor.
     *
     * @param string $json
     *
     * @throws \Metaregistrar\RDAP\RdapException
     */
    public function __construct(string $json) {
        if ($data = json_decode($json, true)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    // $value is an array
                    foreach ($value as $k => $v) {
                        $this->{$key}[] = RdapObject::KeyToObject($key, $v);
                    }
                } else {
                    // $value is not an array, just create a var with this value (startAddress endAddress ipVersion etc etc)
                    $this->{$key} = $value;
                }
            }
        } else {
            throw new RdapException('Response object could not be validated as proper JSON');
        }
    }

   
    /**
     * @return string
     */
     public function getHandle(): string {
        return $this->handle;
    }

    /**
     * @return RdapConformance[]|null
     */
     public function getConformance(): ?array {
        return $this->rdapConformance;
    }

    /**
     * @return string
     */
     public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
     public function getType(): string {
        return $this->type;
    }

    /**
     * @return RdapEntity[]|null
     */
     public function getEntities(): ?array {
        return $this->entities;
    }

    /**
     * @return RdapLink[]|null
     */
     public function getLinks(): ?array {
        return $this->links;
    }

    /**
     * @return RdapRemark[]|null
     */
     public function getRemarks(): ?array {
        return $this->remarks;
    }

    /**
     * @return RdapNotice[]|null
     */
     public function getNotices(): ?array {
        return $this->notices;
    }

    /**
     * @return string|null
     */
     public function getPort43(): ?string {
        return $this->port43;
    }

    /**
     * @return RdapNameserver[]|null
     */
     public function getNameservers(): ?array {
        return $this->nameservers;
    }

    /**
     * @return RdapStatus[]|null
     */
     public function getStatus(): ?array {
        return $this->status;
    }

    /**
     * @return RdapEvent[]|null
     */
     public function getEvents(): ?array {
        return $this->events;
    }

    /**
     * @return string|null
     */
     public function getClassname(): ?string {
        return $this->objectClassName;
    }

    /**
     * @return string|null
     */
     public function getLDHName(): ?string {
        return $this->ldhName;
    }

    /**
     * @return RdapSecureDNS[]|null
     */
     public function getSecureDNS(): ?array {
        return $this->secureDNS;
    }

    /**
     * @return int|null
     */
     public function getErrorCode(): ?int {
        return $this->errorCode;
    }

    /**
     * @return string|null
     */
     public function getTitle(): ?string {
        return $this->title;
    }

}

}//ns
