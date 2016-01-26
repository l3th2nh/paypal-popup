<?php
/*
Plugin Name: Paypal Popup
Version: 0.0.1
Description: Wordpress plugin for displaing a Paypal Donate popup
Author: Heavybeard
Author URI: http://heavybeard.it
*/


/** Defines */
define('PAYPAL_POPUP_SECRET', 'secret_key');
define('PAYPAL_POPUP_PATH', plugin_dir_path(__FILE__));
define('PAYPAL_POPUP_URL', plugin_dir_url(__FILE__));

/** Security check */
if (!defined('PAYPAL_POPUP_SECRET') || PAYPAL_POPUP_SECRET !== 'secret_key')
    exit();

/** Require class */
require_once(PAYPAL_POPUP_PATH . 'framework/PaypalPopup.php');

/** Init */
$PaypalPopup = new PaypalPopup();

/** Require frontend functions */
require_once(PAYPAL_POPUP_PATH . 'frontend-functions.php');


/**
 * PAYPAL BANNER
 * Add a banner only in homepage with paypal link
 * @author Andrea Cognini - info@heavybeard.it
 */
/*add_action('wp_footer', 'banner_paypal');
function banner_paypal () {
    $html = '';
    $lang = qtrans_getLanguage();
    $text = array(
        array(
            'it' => '<p>Costituitosi nel 2005, Digicult è un progetto editoriale indipendente che non riceve fondi e sovvenzioni da alcuna istituzione o società, né pubblica né privata. I suoi contenuti sono del tutto gratuiti e disponibili, perché crediamo nella cultura aperta e nella condivisione p2p. Ecco perché il vostro supporto è fondamentale. Aiutateci, cliccando su questo banner e donando anche una piccola cifra</p>',
            'en' => '<p>Established in 2005, Digicult is an independent editorial project that receives no funds from any institution or company, neither public or private. Its content is freely available to all, because we believe in open culture and p2p sharing. That is why your support is invaluable. Please donate! Just clicking on this banner. No amount is too small.</p>'
        ),
        array(
            'it' => 'Dona con Paypal',
            'en' => 'Donate with Paypal',
        ),
    );
    if (is_home() || is_front_page()) {
        $html .= '
        <div id="cb-lwa-paypal" class="cb-lwa-modal cb-modal">
            <div class="cb-lwa-modal-inner cb-modal-inner cb-light-loader cb-pre-load cb-font-header clearfix">
                <div class="lwa lwa-default clearfix" style="text-align: center;">' . $text[0][$lang] . '
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="2PK6QYQ55TYY4">
                        <input type="submit" name="submit" class="cb-submit-form" value="' . $text[1][$lang] . '" tabindex="100">
                        <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </div>
            </div>
        </div>';
    }
    echo $html;
}*/
?>
