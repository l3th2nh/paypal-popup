<?php
/** SECURITY CHECK */
if (!defined('PAYPAL_POPUP_SECRET') || PAYPAL_POPUP_SECRET !== 'secret_key')
    exit();

/**
 * WP SETTING PAYPAL POPUP
 * @author Andrea Cognini
 * @description Add custom options in Wp Settings Page
 */
class WPSettingPaypalPopup extends PaypalPopup {
    /**
     * __CONSTRUCT
     * @author Andrea Cognini
     * @description Initialize
     */
    public function __construct() {
        add_action('admin_init', array($this, 'addSettings'));
        add_action('admin_menu', array($this, 'addMenuPage'));
    }

    /**
     * ADD SETTINGS
     * @author Andrea Cognini
     * @description Add settings in admins
     */
    public function addSettings () {
        add_settings_section(
            'paypalPopup_settingsSection_paypalIdentifier',
            __('Paypal Identifier', 'paypal-popup'),
            array($this, 'paypalPopup_settingsSection_paypalIdentifier_callback'),
            'paypal-popup'
        );
        add_settings_field(
            'paypalPopup_settingsField_paypalID',
            __('Paypal ID', 'paypal-popup'),
            array($this, 'paypalPopup_settingsField_paypalID_callback'),
            'paypal-popup',
            'paypalPopup_settingsSection_paypalIdentifier'
        );
        register_setting('paypal-popup', 'paypalPopup_settingsField_paypalID');

        add_settings_section(
            'paypalPopup_settingsSection_popupTexts',
            __('Paypal Texts', 'paypal-popup'),
            array($this, 'paypalPopup_settingsSection_popupTexts_callback'),
            'paypal-popup'
        );
        add_settings_field(
            'paypalPopup_settingsField_popupMainText',
            __('Popup Main Text', 'paypal-popup'),
            array($this, 'paypalPopup_settingsField_popupMainText_callback'),
            'paypal-popup',
            'paypalPopup_settingsSection_popupTexts'
        );
        register_setting('paypal-popup', 'paypalPopup_settingsField_popupMainText');
        add_settings_field(
            'paypalPopup_settingsField_buttonText',
            __('Popup Main Text', 'paypal-popup'),
            array($this, 'paypalPopup_settingsField_buttonText_callback'),
            'paypal-popup',
            'paypalPopup_settingsSection_popupTexts'
        );
        register_setting('paypal-popup', 'paypalPopup_settingsField_buttonText');
    }

    /**
     * SETTINGS SECTION
     */
    public function paypalPopup_settingsSection_paypalIdentifier_callback() {
?>
        <p><?php _e('Every account has the identifier informations', 'paypal-popup'); ?></p>
<?php
    }

    /**
     * SETTINGS SECTION
     */
    public function paypalPopup_settingsSection_popupTexts_callback() {
?>
        <p><?php _e('All texts to show in Paypal popup', 'paypal-popup'); ?></p>
<?php
    }

    /**
     * SETTINGS FIELD
     */
    public function paypalPopup_settingsField_paypalID_callback() {
?>
        <input name="paypalPopup_settingsField_paypalID" id="paypalPopup_settingsField_paypalID" type="text" value="<?php echo get_option('paypalPopup_settingsField_paypalID'); ?>" />
<?php
    }

    /**
     * SETTINGS FIELD
     */
    public function paypalPopup_settingsField_popupMainText_callback() {
?>
    <textarea name="paypalPopup_settingsField_popupMainText" id="paypalPopup_settingsField_popupMainText" class="large-text" rows="10" cols="50"><?php echo get_option('paypalPopup_settingsField_popupMainText'); ?></textarea>
<?php
    }

    /**
     * SETTINGS FIELD
     */
    public function paypalPopup_settingsField_buttonText_callback() {
?>
        <input name="paypalPopup_settingsField_buttonText" id="paypalPopup_settingsField_buttonText" type="text" value="<?php echo get_option('paypalPopup_settingsField_buttonText'); ?>" />
<?php
    }

    public function addMenuPage() {
        add_menu_page(
            'Paypal Popup Settings',
            'Paypal Popup',
            'manage_options',
            'paypal-popup',
            array($this, 'settingsPage')
        );
    }

    public function settingsPage() {
?>
        <div class="wrap">
            <h1><?php _e('Paypal Popup Settings', 'paypal-popup') ?></h1>
            <form method="post" action="options.php">
<?php
                settings_fields('paypal-popup');
                do_settings_sections('paypal-popup');
                submit_button();
?>
            </form>
        </div>
<?php
    }
}
?>
