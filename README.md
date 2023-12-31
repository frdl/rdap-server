# RDAP Server in PHP
This RDAP Server is [OIDplus](https://oidplus.com/) aware and provides a WHOIS result in the remarks of a RDAP result.

## Installation
- Install the dependencies:
````
composer require frdl/rdap-server
````
OR move into the directory and
````
composer install
````
- Make the `cache` and `logs` directory and their subdirectories writable.

### Customization
- Edit the file `public/index.html` to change the index page
- The Infos are requested from OIDplus instance for the `domain` route per default. This produces overhead, [see this issue for more info](https://startforum.de/comment/perma?id=555). To change this behavior edit the file `app/routes.php` to switch back to RDAP-only domain route.

#### DEMO
[This demo](https://rdap.frdl.de/oid/1.3.6.1.4.1.37476.30.9) shows the way and where we get all the OIDplus instances.


##### ToDo
- move Env\Dotenv to composer deps
- const for root instance/OID of the local RDAP instance/bootstrap
- Instead of requesting all instances in a sequence, can we start asynchronous requests/threads (by e.g. exec, AMP framework, ...) and wait/collect (like Promise.all) for them in the main thread, to speed up the over all request response time for the end user???
- And can we introduce a more powerful caching/proxy/index system, like and/or a global INDEX??? (global meaning global in the focus of the instance building a web/federation-index)
- RDAP-Conformance also for OIDplus objectTypes ???
- test
- IO4/OIDplus/... - Plugable Adapters (for local instance)

## Reference notes
- based on [hiqdev/rdap](https://github.com/hiqdev/rdap/)
- ...[significant file so far](https://github.com/frdl/rdap-server/blob/main/src/Application/Actions/OID/GetOIDInfoAction.php)...
