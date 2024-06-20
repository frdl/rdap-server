<?php
declare(strict_types=1);

namespace Webfan\RDAPClient\Interfaces;

interface RdapClientInterface
{
  
    const OID = 'oid';
    const CONNECT = 'connect';  //oid:1.3.6.1.4.1.37553.8.1.8.1.33061  ....
  /*
    //const ORSPLUS = 'dns-query';
    const ORSPLUS = 'dnsors';
  const APPS = 'apps';
   const API = 'api';
   const DATA = 'data';
    const ROOT_RDAP = 'bootstrap'; //oid:1.3.6.1.4.1.37553.8.1.8.1.33061.1276945 (oid-rdap)

  // const OIDIP = 'oidip';
    const WEID = 'weid';
    const HANDLE = 'handle';

  
    const ANY = 'unbound';  //local IDs, hashes, uuid, etc. ...
    const CARA = 'cara';  //1.3.6.1.4.1.37553.8.1.8.1.33061.573814 (co-accredited-registration-authority)

     // /.well-known/... webfingers ...
    const NODE = 'node';  //oid:1.3.6.1.4.1.37553.8.1.8.1.33061.1104674 (oid-meta,subordinate: oid-node, oid-webfingers)
    const SERVICE = 'service'; //oid:1.3.6.1.4.1.37553.8.1.8.1.33061.61843251614 (oid-service)

    const REGISTRY = 'registry';
    const RA = 'ra';
    */
  /*  RA is oneOf   (property/type)
           oid:1.3.6.1.4.1.37553.8.1.8.1.33061.2019381338979
             (oid-provider)
           oid:1.3.6.1.4.1.37553.8.1.8.1.33061.2147306420158
             (oid-registry)
            oid:1.3.6.1.4.1.37553.8.1.8.1.33061.77303031124851
              (oid-registrar)
           oid:1.3.6.1.4.1.37553.8.1.8.1.33061.2782909120494521
              (oid-registrant)
*/  
}
 
