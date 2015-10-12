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


/*
define('DOMAIN_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/stol');

define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/stol/');

*/

define('DOMAIN_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/2014/stol');

define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/2014/stol/');



define('BASEURL', DOMAIN_URL . '/ws/');

define('gmapkey', '');

define('MAINTITLE', 'stol');

/* Site Path and Urls */





/* ######################## Harsh Constants  ################################### */


define('PROFILE_PIC_ROOT',DOC_ROOT.'profile_pic/');
define('PROFILE_PIC_URL',DOMAIN_URL.'/profile_pic/');

define('OUTLET_PIC_URL',DOMAIN_URL.'/outlet_pic/');
define('OUTLET_GALLERY_PIC_URL',DOMAIN_URL.'/outlet_gallery/');
define('OFFER_PIC_URL',DOMAIN_URL.'/offer_pic/');
define('ITEM_PIC_URL',DOMAIN_URL.'/item_pic/');


 
/* ############################################################################# */

/* URLS FOR FILE UPLOADED */

define('UPLOADS', DOC_ROOT . "uploads/");

define('UPLOADS_URL', DOMAIN_URL . "/uploads/");


/*

  |--------------------------------------------------------------------------

  | CONSTANT MEASSAGES

  |--------------------------------------------------------------------------

  |

 */





/* * **************************************************

 * *                INFO MEASSAGE

 * ************************************************** */

define('EMAIL_INFO', 'Email Sent Successfully. Please check your indbox.');









