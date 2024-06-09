<?php

namespace Webfan\Webfat;

trait getWebfatTrait
{
    public static $_stub_download_url = 'https://raw.githubusercontent.com/frdlweb/webfat/main/public/index.php';
    public static $StubRunner = null;
    public static $_stub_autoload_done = false;
    public static $_stub_run_done = false;

    public static function getWebfatTraitSingletonClass()
    {
        if(\class_exists(\IO4\Webfat::class)){
         return \IO4\Webfat::class;
         }else{
           return static::class;
         }
    }

    public static function getStubRunner()
    {
        $class = static::getWebfatTraitSingletonClass();
        return \call_user_func_array([new $class, 'getWebfat'], func_get_args());
    }

    public function setStubDownloadUrl(string $url)
    {
        $class = static::getWebfatTraitSingletonClass();
         $class::$_stub_download_url = $url;
    }

    public function getWebfat(
        string $file = null,
        bool $load = true,
        bool $serveRequest = false,
        bool|int $autoupdate = 2592000,
        ?string $download_url = null,
    ): \frdlweb\StubRunnerInterface {
        $class = static::getWebfatTraitSingletonClass();
        $webfatFile =$file ?? getcwd().\DIRECTORY_SEPARATOR.'webfat.php';
         if(//null===self::$StubRunner &&
            ( !file_exists($webfatFile)
                                   || (
                                        $autoupdate && filemtime($webfatFile) < time() -( $autoupdate===true ? 30*24*60*60 : $autoupdate)
                                      )

            )
           ){
             file_put_contents( $webfatFile, file_get_contents($download_url ?? $class::$_stub_download_url));
         }

        //if (!in_array($webfatFile, \get_included_files())) {
        if (null===$class::$StubRunner) {
            $class::$StubRunner = require_once $webfatFile;
        }

        if($load && !$class::$_stub_autoload_done){
            $class::$_stub_autoload_done = true;
            $class::$StubRunner-> autoload();
            $class::$StubRunner-> autoloading();
        }


        if($serveRequest && !$class::$_stub_run_done){
            $class::$_stub_run_done =true;
            $class::$StubRunner->runAsIndex(true);
        }

        return $class::$StubRunner;
    }
}
__halt_compiler();----SIGNATURE:----BVL0gDZsFkzcR6WRJ01Ph1JpSxzmvCTSNE1g43bvgURjSKndOgLsUMP5dtSfNBq3/uBMMGa4QdjVbf3EFvXb6MSsB4kwQxg46OezlwAZ5RNaWwwB6pTR0Pal3+uXDxKX2VlXwy4fdoB6XWGCikheKMgFepgX8g6NzQWcaPaUl50Lw4pSuDRewsBs6Vszx0OrJ13SorQ5o40DasldLzp8E1SCnyopYCDYWCWigprMVQixi0KItEMRtbwAQwBudavnv6Qy+TBmbx5mRxmO5KQc5tTUJO4+QZmWyM2EmweHybiYcDPpbVwUG1hIb/HmbeN6SOb6XtIl/Qaclo+kK/ENeXLFRVzLUV4mj3jI99qXi0E1qnSfvXCVz7F/zAHR/lSHORcx6btCMqwGEtJlycRWWfLv/5GcTG45xtzmMz48BfgXxDzHaPyWt8xRpx5fw7qqhctm1ST7x+i0oj9CNyNOff0YMbRDSCnwQcCBVD73BnKtKkHphSf1NJIMRlIPKv9Ia8FZpDNOXq0t4AzlXx34pblB/WKTx/IR6Z7WLH4/PveDmRqP2b/rYFcAEZzmnwWd4924xO/jLNd2czYz8Kiis0Qb/lm/I6WXPlKsOl0Qa1OzB/V/6nYQne+YJbWZX9c3zMAg1N+1Ml50X0s4t9hLs4WKBapGmSor0f+BYemFTsA=----ATTACHMENT:----NTQyODQ0NzQ3NTEzMTQxMyA2Mzc1MjU2ODgwOTIyNDEwIDU4MzMwMzgwNjA5Njk2NTE=