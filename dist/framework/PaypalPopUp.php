<?php
/** SECURITY CHECK */
if (!defined('PAYPAL_POPUP_SECRET') || PAYPAL_POPUP_SECRET !== 'secret_key')
    exit();

/**
 * PAYPAL POPUP
 * @author Andrea Cognini
 * @description Class for managing paypal popup
 */
class PaypalPopup {
    protected $_NAME = 'paypal-popup';
    protected $_VERSION = '0.0.1';
    protected $_ALLOWED_HTML = array(
        'p' => array(
            'id' => array(),
            'class' => array()
        ),
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'b' => array(),
        'i' => array(),
    );

    /**
     * __CONSTRUCT
     * @author Andrea Cognini
     * @description Initialize the plugin
     */
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'registerJS'));
        add_action('wp_enqueue_scripts', array($this, 'registerCSS'));
    }

    /**
     * REGISTER JS
     * @author Andrea Cognini
     * @description Add assets on page
     */
    public function registerJS() {
        if (!wp_script_is($this->_NAME . '-script')) {
            wp_register_script($this->_NAME . '-script', PAYPAL_POPUP_URL . 'asset/js/' . $this->_NAME . '.min.js', $this->_VERSION, true);
            wp_enqueue_script($this->_NAME . '-script');
        }
    }

    /**
     * REGISTER CSS
     * @author Andrea Cognini
     * @description Add assets on page
     */
    public function registerCSS() {
        if (PAYPAL_POPUP_CSS) {
            if (!wp_script_is($this->_NAME . '-style')) {
                wp_register_style($this->_NAME . '-style', PAYPAL_POPUP_URL . 'asset/css/' . $this->_NAME . '.min.css', $this->_VERSION, 'all');
                wp_enqueue_style($this->_NAME . '-style');
            }
        }
    }

    /**
     * RENDER HTML
     * @author Andrea Cognini
     * @description Echo the html on the page
     */
    public function renderHTML() {
        $html = '
            <div id="cb-lwa-paypal" class="cb-lwa-modal cb-modal">
                <div class="cb-lwa-modal-inner cb-modal-inner cb-light-loader cb-pre-load cb-font-header clearfix">
                    <div class="lwa lwa-default clearfix" style="text-align: center;">' . get_option('paypalPopup_settingsField_popupMainText') . '
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="' . get_option('paypalPopup_settingsField_paypalID') . '">
                            <input type="submit" name="submit" class="cb-submit-form" value="' . get_option('paypalPopup_settingsField_buttonText') . '" tabindex="100">
                            <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    </div>
                </div>
            </div>';

        return $html;
    }
}
?>
