<?php
if(preg_replace('/^([^?]+)\?(.*)$/', '$1', $_SERVER['REQUEST_URI']) == '/index.php') {
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: /');
    exit;
}
ob_start();
$subdomain = '';
if(!defined('SUBDOMAIN')){
    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
    if(count($domainParts) > 2){
        array_splice($domainParts, -2);
        foreach($domainParts as $part){
            $subdomain .= "{$part}.";
        }
    }
}

define('SUBDOMAIN', $subdomain);

const LOCALE = 'ru';
const DS = DIRECTORY_SEPARATOR;

defined('APP_IS_ADMIN_AREA') || define('APP_IS_ADMIN_AREA', preg_match('/(admin|cp)/i', $_SERVER['REQUEST_URI']));
defined('LAZYLOAD_SRC') || define('LAZYLOAD_SRC', '//cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js');

error_reporting(0);
ini_set('display_errors', 'off');

$isLocal = (strpos($_SERVER['SERVER_NAME'], 'local') !== false) || (strpos($_SERVER['SERVER_NAME'], '127.0.0.1') !== false);
defined('D_MODE_LOCAL') || define('D_MODE_LOCAL', $isLocal);

if(D_MODE_LOCAL) {
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING); // ~E_WARNING - Fix PHP 7.0 deprecateds.
    ini_set('display_errors', 'on');
    defined('YII_DEBUG') || define('YII_DEBUG', true);
    defined('YII_TRACE_LEVEL') || define('YII_TRACE_LEVEL', 3);
}

ini_set('default_charset', 'utf8');
ini_set('short_open_tag', 'on');

date_default_timezone_set('Asia/Novosibirsk');
mb_internal_encoding('utf-8');
header('Content-Type: text/html; charset=utf-8');

$yii = false;
$autoload = realpath(__DIR__ . "/vendor/autoload.php");
if(is_file($autoload)){
    $yii = include_once $autoload;
} else {
    // for compatibility with frontenders
    require_once(dirname(__FILE__).'/protected/components/helpers/HCMS.php');
    $yii = HCMS::getYiiFile();
    if(!$yii){
        die('Framework not found !');
    }
    require_once($yii);
}

if(!$yii){
    die('Framework not found !');
}

$config = dirname(__FILE__).'/protected/config/main.php';

Yii::createWebApplication($config)->run();

HCMS::robots();

if(APP_IS_ADMIN_AREA || !D::cms('system_lazyload', true, true)) { ob_end_flush(); }
else {
//    // lazy load
//    $content=ob_get_clean();
//    echo preg_replace_callback('#<img([^>]*?) src="([^\s>]+)"([^>]*?)>#i', function($m) {
//        if(preg_match('#data-lazyload-disable#', $m[0]) || !preg_match('#^/(images|uploads)/.*$#', $m[2])) { return $m[0]; }
//        return '<img'.$m[1].' src="/images/dot-loader.gif" data-lazyload="1" data-src="'.$m[2].'"'.$m[3].'>';
//    }, $content);
}