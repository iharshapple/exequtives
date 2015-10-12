<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');
/* End of file constants.php */
/* Location: ./application/config/constants.php */
/* Site Path and Urls */
define('_PATH', substr(dirname(__FILE__), 0, -25));
define('_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(_PATH))));
define('SITE_PATH', _PATH . "/");
define('SITE_URL', _URL . "/");
define('WEBSITE_URL', SITE_URL . '/');
 
define('DOMAIN_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/executive/');
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/executive/');
define('BASEURL', DOMAIN_URL);
define('gmapkey', '');
define('MAINTITLE', 'Executive');
/* Site Path and Urls */

/* URL AND PATH FOR IMAGES  */
define('IMAGE_PATH', DOC_ROOT . "images/");
define('IMAGE_URL', DOMAIN_URL . "images/");
/* URL AND PATH FOR IMAGES  */
/* URL FOR CSS AND JS */
define('CSS_IMAGE_URL', DOMAIN_URL . "bootstrap/img/");
define('CSS_URL', DOMAIN_URL. "bootstrap/css/");
define('JS_URL', DOMAIN_URL. "bootstrap/js/");
define('PLUGIN_URL', BASEURL . "plugins/"); 
/* URLS FOR FILE UPLOADED */
define('UPLOADS', DOC_ROOT . "/images/");
define('UPLOADS_URL', DOMAIN_URL . "/images/");

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */

define('CAT_IMAGE_PATH', IMAGE_PATH . "categoryImage/");
define('CAT_IMAGE_URL', IMAGE_URL . "categoryImage/");
