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
        //Silence is golden
    }

    /**
     * ADD SCRIPTS
     * @author Andrea Cognini
     * @description Add assets on page
     */
    public function addJS() {
        wp_register_script($this->_NAME . '-script', PAYPAL_POPUP_URL . 'asset/js/' . $this->_NAME . '.min.js', '0.0.1', true);
        wp_enqueue_script($this->_NAME . '-script');
    }

    /**
     * ADD STYLES
     * @author Andrea Cognini
     * @description Add assets on page
     */
    public function addCSS() {
        if (defined('PAYPAL_POPUP_NO_CSS') && PAYPAL_POPUP_NO_CSS) {
            wp_register_style($this->_NAME . '-style', PAYPAL_POPUP_URL . 'asset/css/' . $this->_NAME . '.min.css', '0.0.1', 'all');
            wp_enqueue_style($this->_NAME . '-style');
        }
    }

    /**
     * RENDER HTML
     * @author Andrea Cognini
     * @description Echo the html on the page
     */
    public function renderHTML($info_text, $button_text, $paypal_id) {
        /** Insert assets */
        add_action('wp_footer', array(&$this, 'addJS'));
        add_action('wp_head', array(&$this, 'addCSS'));

        $html = '
            <div id="cb-lwa-paypal" class="cb-lwa-modal cb-modal">
                <div class="cb-lwa-modal-inner cb-modal-inner cb-light-loader cb-pre-load cb-font-header clearfix">
                    <div class="lwa lwa-default clearfix" style="text-align: center;">' . wp_kses($info_text, $this->_ALLOWED_HTML) . '
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="' . wp_kses($paypal_id, $this->_ALLOWED_HTML) . '">
                            <input type="submit" name="submit" class="cb-submit-form" value="' . wp_kses($button_text, $this->_ALLOWED_HTML) . '" tabindex="100">
                            <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    </div>
                </div>
            </div>';

        return $html;
    }
}
?>
