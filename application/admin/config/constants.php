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
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/stol');
 
define('BASEURL', DOMAIN_URL . '/admin/');
*/
define('DOMAIN_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/executive');
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/executive');
define('BASEURL', DOMAIN_URL . '/admin/');
define('gmapkey', '');
define('MAINTITLE', 'petshare');
/* Site Path and Urls */
/* Admin Site Path and Urls */
define('ADMIN_URL', SITE_URL . '/');
define('ADMIN_PATH', SITE_PATH . "/");
define('ADMIN_IMAGE_URL', DOMAIN_URL . '/admin/images/');
define('PROFILE_IMAGE_URL_MEDIUM', DOMAIN_URL . '/images/profilepictures/medium/');
define('PROFILE_IMAGE_URL_ORIGINAL', DOMAIN_URL . '/images/profilepictures/original/');
define('PROFILE_IMAGE_URL_THUMB', DOMAIN_URL . '/images/profilepictures/thumb/');
define('EVENT_IMAGE_URL', DOMAIN_URL . '/images/eventpictures/');
/* Admin Site Path and Urls */
/* URL AND PATH FOR IMAGES  */
define('IMAGE_PATH', DOMAIN_URL . "/images/");
define('IMAGE_URL', DOMAIN_URL . "/images/");

define('CSS_IMAGE_PATH', ADMIN_PATH . "css/");
define('CSS_IMAGE_URL', BASEURL . "css/");
/* URL AND PATH FOR IMAGES  */
/* URL FOR CSS AND JS */
define('CSS_URL', BASEURL);
define('PLUGIN_URL', BASEURL . "plugins/");
define('JS_URL', BASEURL);
define('JS_URL_GEO', BASEURL. "js/");
define('DESIGN_PLUGIN_URL', BASEURL . "plugins/");
/* URLS FOR FILE UPLOADED */
define('UPLOADS', DOC_ROOT . "uploads/");
define('UPLOADS_URL', DOMAIN_URL . "/uploads/");
define('SERVICE_IMAGE_PATH', UPLOADS_URL . "Service_pic/thumb");
define('TECHNICIAN_IMAGE_PATH', UPLOADS_URL . "Technician_pic/");
define('SHOP_IMAGE_PATH', UPLOADS_URL . "Shop_pic/");
define('COVER_PIC', 'https://s3-us-west-2.amazonaws.com/pictures-event/');


/*
  |--------------------------------------------------------------------------
  | Custom constant
  |--------------------------------------------------------------------------
  |
 */
define('CAT_IMAGE_PATH', IMAGE_PATH . "categoryImage/");
define('CAT_IMAGE_URL', IMAGE_URL . "categoryImage/");

/*
  |--------------------------------------------------------------------------
  | CONSTANT MEASSAGES
  |--------------------------------------------------------------------------
  |
 */
/* * **************************************************
 * *                ERROR MEASSAGE
 * ************************************************** */
define('ACCOUNT_NOT_ACTIVE', 'Your account is not activated.');
define('LOGIN_ERROR', '<strong>Username</strong> and/or <strong>Password</strong> are wrong');
define('ACTIVATED_ERROR', 'Your account is already activated.');
define('ADMIN_ERROR', 'No user exists with this email.');
define('ACTIVE_ERROR', 'You have not activated your account yet. Please go to your inbox and activate your account first.');
define('ACCESS_ERROR', 'Access not authorized for this account.');
define('SETTING_NOT_FOUND', 'Settings not found.');
define('SETTINGS_NOT_CHANGED', 'Problem changing Settings, Please try again.');
define('OLD_PASSWORD_NOT_OK', 'Old Password you have entered is not correct.');
define('PASSWORD_SENT', 'An email has been sent to your email address <br /> which is the registered address for your account. Please reset your password.');
define('PASSWORD_NOT_CHANGED', 'Problem changing password, Please try again.');
define('ACTIVE_ACCOUNT', 'Your co-brick account activated successfully.');
define('PASSWORD_CONFIRM_NOT_MATCH', 'New Password and Re-type New Password do not match.');
/* * **************************************************
 * *                SUCCESS MEASSAGE
 * ************************************************** */
define('SETTINGS_CHANGED', 'Settings Changed successfully.');
define('PASSWORD_CHANGED', 'Your Password changed successfully.');
/* * **************************************************
 * *                INFO MEASSAGE
 * ************************************************** */
define('EMAIL_INFO', 'Email Sent Successfully. Please check your indbox.');
define('PROFILE_PIC_ROOT',DOC_ROOT.'profile_pic/');
define('PROFILE_PIC_URL',DOMAIN_URL.'/profile_pic/');
define('OUTLET_PIC_URL',DOMAIN_URL.'/outlet_pic/');
define('RESTAURANT_PIC_URL',DOMAIN_URL.'/rest_pic/');
define('ITEM_PIC_URL',DOMAIN_URL.'/item_pic/');
define('OFFER_PIC_URL',DOMAIN_URL.'/offer_pic/');

/* Admin Settings */
define('ADMIN_ADDED', 'Admin Added successfully.');
define('ADMIN_EDITED', 'Admin Edited successfully.');
define('ADMIN_DELETED', 'Admin Removed successfully.');
define('ADMIN_NOT_ADDED', 'Problem adding Admin, Please try again.');
define('ADMIN_NOT_EDITED', 'Problem editing Admin, Please try again.');
define('ADMIN_NOT_DELETED', 'Problem removing Admin, Please try again.');
define('ADMIN_EXISTS', 'Admin already exists with this email/username.');
/* Admin Settings */

/* User Settings */
define('USER_ADDED', 'User details are successfully added');
define('USER_NOT_ADDED', 'Failed to add user details, Please try again!');
define('USER_EXISTS', 'Email ID already exist!');
define('USER_USERNAME_EXISTS', 'Username already exist!');
define('USER_EDITED', 'User details are successfully updated');
define('USER_NOT_EDITED', 'Failed to update user details, Please try again!');
define('USER_DELETED', 'User removed successfully');
define('USER_NOT_DELETED', 'Failed to remove user, Please try again!');
define('USER_IMPORT', 'Users successfully added');
define('USER_NOT_IMPORT', 'Failed to imports user details, Please try again!');
define('USER_EXCEL_ERROR', 'Please Select Valid Excel file!');
define('USER_IMAGE_PATH', DOMAIN_URL . "images/user/");
define('TEMP_FILE_PATH', ADMIN_PATH . "images/tempfiles/");
/* User Settings */

/* Category Settings */
define('CATEGORY_ADDED', 'Category details are successfully added');
define('CATEGORY_NOT_ADDED', 'Failed to add category details, Please try again!');
define('CATEGORY_EXISTS', 'Category ID already exist!');
define('CATEGORY_EDITED', 'Category details are successfully updated');
define('CATEGORY_NOT_EDITED', 'Failed to update category details, Please try again!');
define('CATEGORY_DELETED', 'Category removed successfully');
define('CATEGORY_NOT_DELETED', 'Failed to remove category, Please try again!');
define('CATEGORY_IMPORT', 'Categorys successfully imported.');
define('CATEGORY_NOT_IMPORT', 'Failed to imports category details, Please try again!');
/* User Settings */

/* Category Settings */
define('SUBCATEGORY_ADDED', 'Subcategory details are successfully added');
define('SUBCATEGORY_NOT_ADDED', 'Failed to add subcategory details, Please try again!');
define('SUBCATEGORY_EXISTS', 'Subcategory ID already exist!');
define('SUBCATEGORY_EDITED', 'Subcategory details are successfully updated');
define('SUBCATEGORY_NOT_EDITED', 'Failed to update subcategory details, Please try again!');
define('SUBCATEGORY_DELETED', 'Subcategory removed successfully');
define('SUBCATEGORY_NOT_DELETED', 'Failed to remove subcategory, Please try again!');
define('SUBCATEGORY_IMPORT', 'Subcategorys successfully imported.');
define('SUBCATEGORY_NOT_IMPORT', 'Failed to imports subcategory details, Please try again!');
/* User Settings */

/* Category Settings */
define('MENU_ADDED', 'Menu details are successfully added');
define('MENU_NOT_ADDED', 'Failed to add Menu details, Please try again!');
define('MENU_EXISTS', 'Menu ID already exist!');
define('MENU_EDITED', 'Menu details are successfully updated');
define('MENU_NOT_EDITED', 'Failed to update Menu details, Please try again!');
define('MENU_DELETED', 'Menu removed successfully');
define('MENU_NOT_DELETED', 'Failed to remove Menu, Please try again!');
define('MENU_IMPORT', 'Menus successfully imported.');
define('MENU_NOT_IMPORT', 'Failed to imports Menu details, Please try again!');

define('ADPLAN_ADDED', 'Adplan details are successfully added');
define('ADPLAN_NOT_ADDED', 'Failed to add Adplan details, Please try again!');
define('ADPLAN_EXISTS', 'Adplan ID already exist!');
define('ADPLAN_EDITED', 'Adplan details are successfully updated');
define('ADPLAN_NOT_EDITED', 'Failed to update Adplan details, Please try again!');
define('ADPLAN_DELETED', 'Adplan removed successfully');
define('ADPLAN_NOT_DELETED', 'Failed to remove Adplan, Please try again!');
define('ADPLAN_IMPORT', 'Adplans successfully imported.');
define('ADPLAN_NOT_IMPORT', 'Failed to imports Adplan details, Please try again!');
/* User Settings */

/* Page Content */
define('PAGECONTENT_ADDED', 'Sub Category successfully added'); 
define('PAGECONTENT_NOT_ADDED', 'Failed to add sub category , Please try again!');
define('PAGECONTENT_EXISTS', 'Sub category already exist!');
define('PAGECONTENT_NAME_EXISTS', 'Sub category name already exist!');
define('PAGECONTENT_EDITED', 'Page details are successfully updated');
define('PAGECONTENT_NOT_EDITED', 'Failed to update sub page details, Please try again!');
define('PAGECONTENT_DELETED', 'Sub Category removed successfully');
define('PAGECONTENT_NOT_DELETED', 'Failed to remove sub category, Please try again!');
define('PAGECONTENT_IMAGE_PATH', DOMAIN_URL . "images/user/");
/* Page Content */

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */