/**
 * PAYPAL POPUP
 * @description Required script for managin popup
 * @see https://github.com/heavybeard/paypal-popup
 */

+function() {
    'use strict';

    /** Global functions */
    var clickCloseFn,
        readyOpenFn;

    /**
     * PAYPALPOPUP
     * @description Create paypalPopup object
     */
    function PaypalPopup(elementID) {
        this._window = window;
        this._document = document;
        this._element = {};
        this._open = false;
    }

    /**
     * PAYPALPOPUP INIT
     * @description Initialize
     * @param string elementID The id element to assign the class
     */
    PaypalPopup.prototype.init = function (elementID, open) {
        /** Get the element */
        this._getElement(elementID);
        this._setOpen(open);

        clickCloseFn = this.closePopup.bind(this);
        readyOpenFn = this.openPopup.bind(this);

        /** Add events */
        this._document.addEventListener('DOMContentLoaded', readyOpenFn);
        this._element.addEventListener('click', clickCloseFn);

        /** Close the popup */
        clickCloseFn();
    };

    /**
     * PAYPALPOPUP GET ELEMENT
     * @description Assign paypalPopup to a DOM element
     * @param string elementID The id element to assign the class
     */
    PaypalPopup.prototype._getElement = function (elementID) {
        /** Stop if parameter is not a string */
        if (typeof elementID !== 'string')
            return;

        this._element = this._document.getElementById(elementID);

        /** Stop if selected element not exist */
        if (this._element.length <= 1)
            return;
    };

    /**
     * PAYPALPOPUP SET OPEN
     * @description For setting popup open status
     * @param bool open True or False for open or close
     * @return bool
     */
    PaypalPopup.prototype._setOpen = function (open) {
        if (open === true)
            this._open = true;
        else
            this._open = false;
    };

    /**
     * PAYPALPOPUP IS OPEN
     * @description For knowing if popup is open
     * @return bool
     */
    PaypalPopup.prototype.isOpen = function () {
        if (this._open === true)
            return true;
        else
            return false;
    };

    /**
     * PAYPALPOPUP OPEN POPUP
     * @description Open the popoup
     */
    PaypalPopup.prototype.openPopup = function() {
        /** Stop if is open */
        if (this.isOpen())
            return;

        /** DOM */
        this._element.classList.remove('paypal-popup-close');
        this._element.classList.add('paypal-popup-open');

        setOpen(true);
    };

    /**
     * PAYPALPOPUP CLOSE POPUP
     * @description Close the popoup
     */
    PaypalPopup.prototype.closePopup = function() {
        /** Stop if is close */
        if (!this.isOpen())
            return;

        /** DOM */
        this._element.classList.remove('paypal-popup-open');
        this._element.classList.add('paypal-popup-close');

        setOpen(false);
    };

    var paypalPopup1 = new PaypalPopup().init('cb-lwa-paypal', true);

}(); // jshint ignore:line
