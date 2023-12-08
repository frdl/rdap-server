# RDAP Server in PHP
This RDAP Server is [OIDplus](https://oidplus.com/) aware and provides a WHOIS result in the remarks of a RDAP result.

## Installation
- Install the dependencies:
````
composer require frdl/rdap-server
````
- Make the `cache` and `logs` directory and their subdirectories writable.

### Customization
- Edit the file `public/index.html` to change the index page
- The Infos are requested from OIDplus instance for the `domain` route per default. This produces overhead, [see this issue for more info](https://startforum.de/comment/perma?id=555). To change this behavior edit the file `app/routes.php` to switch back to RDAP-only domain route.

#### DEMO
[This demo](https://rdap.frdl.de/oid/1.3.6.1.4.1.37476.30.9) shows the way and where we get all the OIDplus instances.


##### ToDo
- move Env\Dotenv to composer deps
- const for isnstances root instance/OID
- Instead of requesting all instances in a sequence, can we start asynchronous requests/threads (by e.g. exec, AMP framework, ...) and wait/collect (like Promise.all) for them in the main thread, to speed up the over all request response time for the end user???
