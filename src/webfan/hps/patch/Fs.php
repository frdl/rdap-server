<?php

namespace webfan\hps\patch;

use DirectoryIterator;
use SplFileInfo;
use Webfan\Traits\WithContextDirectories as DirectoriesTrait;

class Fs
{
    use DirectoriesTrait;

    public static function chmod($path, $filemode, $dirmode, $r = true, &$log = null)
    {
        if(null === $log){
           $log = [];
        }
        if (is_dir($path) ) {
        if (!chmod($path, $dirmode)) {
            $dirmode_str=decoct($dirmode);
            $e =[\E_USER_ERROR,  new \Exception("Failed applying filemode '$dirmode_str' on directory '$path'\n"
                                  . "  `-> the directory '$path' will be skipped from recursive chmod\n")];
            $log[] = $e;
            return $e;
        }
           if(true === $r){
        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if($file != '.' && $file != '..') {
                $fullpath = $path.'/'.$file;
                self::chmod($fullpath, $filemode,$dirmode, true, $log);
            }
        }
        closedir($dh);
           }

            $dirmode_str=decoct($dirmode);
            $e =[\E_USER_NOTICE,  "Done applying filemode '$dirmode_str' on directory '$path'\n"];
            $log[] = $e;
            return $e;

        } else {
        if (is_link($path)) {
            $e = [\E_USER_NOTICE, new \Exception("link '$path' is skipped\n")];
            $log[] = $e;
            return $e;
        }
        if (!chmod($path, $filemode)) {
            $filemode_str=decoct($filemode);
            $e = [\E_USER_ERROR, new \Exception("Failed applying filemode '$filemode_str' on file '$path'\n")];
            $log[] = $e;
            return $e;
        }


            $filemode_str=decoct($filemode);
            $e =[\E_USER_NOTICE,  "Done applying filemode '$filemode_str' on file '$path'\n"];
            $log[] = $e;
            return $e;
        }
    }

    public static function mostRecentModified(
        string $dirName,
        bool $doRecursive = null,
        array $extensions = null,
        array $excludeExtensions = null,
    ) {
        $d = dir($dirName);
        if(null === $extensions){
        $extensions=['*'];
        }
        if(null === $excludeExtensions){
        $excludeExtensions=[];
        }
        if(null===$doRecursive){
        $doRecursive=true;
        }
        $lastModified = [0, null,null];
        while($entry = $d->read()) {
        if ($entry != "." && $entry != "..") {
            if (!is_dir($dirName."/".$entry)) {
        $fileInfo = new SplFileInfo($dirName."/".$entry);
                $currentModified = ['filemtime'=>$fileInfo->getMTime(), 'path'=>$fileInfo->getPathname(), 'extension'=>$fileInfo->getExtension()];
            } else if (true===$doRecursive && is_dir($dirName."/".$entry)) {
                $currentModified = self::mostRecentModified($dirName."/".$entry,true,$extensions,$excludeExtensions);
            }
            if ($currentModified['filemtime'] > $lastModified['filemtime']
            && (in_array('*', $extensions) || in_array($currentModified['extension'], $extensions))
            && !in_array($currentModified['extension'], $excludeExtensions)){
                $lastModified = $currentModified;
            }
        }
        }
        $d->close();
        return $lastModified;
    }

    public static function recursiveCopyDir($srcDir, $destDir)
    {
        foreach (new DirectoryIterator($srcDir) as $fileInfo) {
        if ($fileInfo->isDot()) {
            continue;
        }

        if (!file_exists($destDir)) {
           shell_exec('mkdir -p '.$destDir);
        }

        $copyTo = $destDir . '/' . $fileInfo->getFilename();

        copy($fileInfo->getRealPath(), $copyTo);
        }
    }

    public static function copyFileToDir($src, $desDir)
    {
        if (!file_exists($desDir)) {
        shell_exec('mkdir -p '.$desDir);
        }

        $fileInfo = new SplFileInfo($src);

        $copyTo = $desDir . '/' . $fileInfo->getFilename();

        copy($fileInfo->getRealPath(), $copyTo);
    }

    public static function copy($src, $desDir)
    {
        if(is_dir($src)){
         self::copy($src, $desDir);
         }elseif(is_file($src)){
         self::copyFileToDir($src, $desDir);
         }
    }

    public static function remove($dir)
    {
        shell_exec('rm -rf '.$dir);
    }

    public static function compress($buffer)
    {
        /* remove comments */
        $buffer = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $buffer);
        /* remove tabs, spaces, newlines, etc. */
        $buffer = str_replace(array("\r\n","\r","\t","\n",'  ','    ','     '), '', $buffer);
        /* remove other spaces before/after ) */
        $buffer = preg_replace(array('(( )+\))','(\)( )+)'), ')', $buffer);
        return $buffer;
    }

    public static function filePrune($filename, $maxfilesize = 4096, $pruneStart = true)
    {
        if(filesize($filename) < $maxfilesize){
        return;
         }

         $maxfilesize = min($maxfilesize, filesize($filename));
         $maxfilesize = max($maxfilesize, 0);

         if(true!==$pruneStart){
         $fp = fopen($filename, "r+");
         ftruncate($fp, $maxfilesize);
         fclose($fp);
         return;
         }

        $size=filesize($filename);
        if ($size<$maxfilesize*1.0) return;
        $maxfilesize=$maxfilesize*0.5; //we don't want to do it too often...
        $fh=fopen($filename,"r+");
        $start=ftell($fh);
        fseek($fh,-$maxfilesize,SEEK_END);
        $drop=fgets($fh);
        $offset=ftell($fh);
        for ($x=0;$x<$maxfilesize;$x++){
            fseek($fh,$x+$offset);
            $c=fgetc($fh);
            fseek($fh,$x);
            fwrite($fh,$c);
        }
        ftruncate($fh,$maxfilesize-strlen($drop));
        fclose($fh);
    }

    public static function getRootDir($path = null)
    {
        if(null===$path){
        $path = $_SERVER['DOCUMENT_ROOT'];
        }


         if(''!==dirname($path) && '/'!==dirname($path) //&& @chmod(dirname($path), 0755)
        &&  true===@is_writable(dirname($path))
        ){
             return self::getRootDir(dirname($path));
         }else{
             return $path;
         }
    }

    public static function getPathUrl($dir = null, $absolute = true)
    {
        if(null===$dir){
        //    $dir = dirname($_SERVER['PHP_SELF']);
        $dir = getcwd();
        }elseif(is_file($dir)){
          $dir = dirname($dir);
        }

        $root = "";
        $dir = str_replace('\\', '/', realpath($dir));

        //HTTPS or HTTP
        $root .= ($absolute) ? (!empty($_SERVER['HTTPS']) ? 'https' : 'http') : '';

        //HOST
        $root .= ($absolute) ? '://' . $_SERVER['HTTP_HOST'] : '';

        //ALIAS
        if(!empty($_SERVER['CONTEXT_PREFIX'])) {
        $root .= $_SERVER['CONTEXT_PREFIX'];
        $root .= substr($dir, strlen($_SERVER[ 'CONTEXT_DOCUMENT_ROOT' ]));
        } else {
        $root .= substr($dir, strlen($_SERVER[ 'DOCUMENT_ROOT' ]));
        }

        $root .= '/';

        return $root;
    }

    public static function getRelativePath($from, $to)
    {
        // some compatibility fixes for Windows paths
          //   $from = is_dir($from) ? rtrim($from, \DIRECTORY_SEPARATOR) .  \DIRECTORY_SEPARATOR : $from;
          //   $to   = is_dir($to)   ? rtrim($to,  \DIRECTORY_SEPARATOR) .  \DIRECTORY_SEPARATOR   : $to;

        $from = str_replace('\\',  \DIRECTORY_SEPARATOR, $from);
        $to   = str_replace('\\',  \DIRECTORY_SEPARATOR, $to);

        $from     = explode( \DIRECTORY_SEPARATOR, $from);
        $to       = explode( \DIRECTORY_SEPARATOR, $to);
        $relPath  = $to;

        foreach($from as $depth => $dir) {
        // find first non-matching dir
        if($dir === $to[$depth]) {
            // ignore this directory
            array_shift($relPath);
        } else {
            // get number of remaining dirs to $from
            $remaining = count($from) - $depth;
            if($remaining > 1) {
                // add traversals up to first matching dir
                $padLength = (count($relPath) + $remaining - 1) * -1;
                $relPath = array_pad($relPath, $padLength, '..');
                break;
            } else {
                $relPath[0] = '.'. \DIRECTORY_SEPARATOR . $relPath[0];
            }
        }
        }
        return implode( \DIRECTORY_SEPARATOR, $relPath);
    }

    public static function pruneDir($dir, $limit, $skipDotFiles = true, $remove = false)
    {
        $iterator = new DirectoryIterator($dir);
         $c = 0;
         $all = 0;
         foreach ($iterator as $fileinfo) {
        if ($fileinfo->isFile()) {
        $c++;
        if(true===$skipDotFiles && '.'===substr($fileinfo->getFilename(),0,1))continue;
             // if($fileinfo->getMTime() < time() - $limit){
        if(filemtime($fileinfo->getPathname()) < time() - $limit){
            if(file_exists($fileinfo->getPathname()) && is_file($fileinfo->getPathname())
                && strlen(realpath($fileinfo->getPathname())) > strlen(realpath($dir))
              ){
                //  echo $fileinfo->getPathname();
            //  @chmod(dirname($fileinfo->getPathname()), 0775);
            //  @chmod($fileinfo->getPathname(), 0775);
                unlink($fileinfo->getPathname());
                $c=$c-1;
            }
        }
        }elseif ($fileinfo->isDir()){
             $firstToken = substr(basename($fileinfo->getPathname()),0,1);
               if('.'===$firstToken)continue;

            $subdir = rtrim($fileinfo->getPathname(),'/ ') . DIRECTORY_SEPARATOR;
            $all += self::pruneDir($subdir, $limit, $skipDotFiles, true);

        }
         }//foreach ($iterator as $fileinfo)

        if(true === $remove && 0 === max($c, $all)){
         @rmdir($dir);
        }

        return $c;
    }

    public static function rglob($pattern, $flags = 0, $traversePostOrder = false)
    {
        // Keep away the hassles of the rest if we don't use the wildcard anyway
        if (strpos($pattern, '/**/') === false) {
        $files = glob($pattern, $flags);
         return (!is_array($files)) ? [] : $files;
        }

        $patternParts = explode('/**/', $pattern);

        // Get sub dirs
        $dirs = glob(array_shift($patternParts) . '/*', \GLOB_ONLYDIR | \GLOB_NOSORT);

        // Get files for current dir
        $files = glob($pattern, $flags);

        $files =  (!is_array($files)) ? [] : $files;

        foreach ($dirs as $dir) {
        $subDirContent = self::rglob($dir . '/**/' . implode('/**/', $patternParts), $flags, $traversePostOrder);

        if (!$traversePostOrder) {
            $files = array_merge($files, $subDirContent);
        } else {
            $files = array_merge($subDirContent, $files);
        }
        }

        return (!is_array($files)) ? [] : $files;
    }

    public static function rglob2($root, $pattern = "*")
    {
        $fname=$pattern;
        $result=[];
        foreach(self::globdirs($root) as $dir) {
        $match=glob($dir.'/'.$fname,GLOB_NOSORT);
        if(!$match) continue;
        $result=array_merge($result,$match);
        }
        return $result;
    }

    public static function globdirs($start)
    {
        $dirStack=[$start];
        while($dir=array_shift($dirStack)) {
        $ar=glob($dir.'/*',\GLOB_ONLYDIR|\GLOB_NOSORT);
        if(!$ar) continue;

        $dirStack=array_merge($dirStack,$ar);
        foreach($ar as $DIR)
            yield $DIR;
        }
    }
}
