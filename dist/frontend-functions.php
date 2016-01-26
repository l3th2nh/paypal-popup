<?php
/** SECURITY CHECK */
if (!defined('PAYPAL_POPUP_SECRET') || PAYPAL_POPUP_SECRET !== 'secret_key')
    exit();

/**
 * FRONTEND FUNCTIONS
 * @author Andrea Cognini
 * @description All functions here can calls
 */

/**
 * PAYPAL POPUP
 * @description Call this for render the paypal popup
 * @param string $info_text The long text for describe the popup
 * @param string $button_text The short call to action for button
 * @param string $paypal_id The account paypal ID
 */
function payPal_popup() {
    global $PaypalPopup;

    echo $PaypalPopup->renderHTML();
}
?>
