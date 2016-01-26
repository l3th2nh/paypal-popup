<?php
/*
Plugin Name: Paypal Popup
Plugin URI:  https://github.com/heavybeard/paypal-popup
Version: 0.0.1
Description: Wordpress plugin for displaing a Paypal Donate popup
Author: Heavybeard
Author URI: http://heavybeard.it
License: https://github.com/heavybeard/paypal-popup/blob/master/LICENSE
Text Domain: paypal-popup
*/


/** Defines */
define('PAYPAL_POPUP_SECRET', 'secret_key');
define('PAYPAL_POPUP_PATH', plugin_dir_path(__FILE__));
define('PAYPAL_POPUP_URL', plugin_dir_url(__FILE__));
define('PAYPAL_POPUP_CSS', true);

/** Security check */
if (!defined('PAYPAL_POPUP_SECRET') || PAYPAL_POPUP_SECRET !== 'secret_key')
    exit();

/** Require classes */
require_once(PAYPAL_POPUP_PATH . 'framework/PaypalPopup.php');
require_once(PAYPAL_POPUP_PATH . 'framework/PaypalPopupWPSetting.php');

/** Init */
$PaypalPopup = new PaypalPopup();
$WPSettingPaypalPopup = new WPSettingPaypalPopup();

/** Require frontend functions */
require_once(PAYPAL_POPUP_PATH . 'frontend-functions.php');
?>
