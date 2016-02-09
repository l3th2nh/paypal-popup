/* global jQuery:false, console:false, document:false, window:false */

/**
 * PAYPAL POPUP
 * @description Required script for managin popup
 * @see https://github.com/heavybeard/paypal-popup
 */

'use strict'; // jshint ignore:line

/**
 * PAYPALPOPUP
 * @description Create paypalPopup object
 */
function PaypalPopup(elementID) {
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
    window.paypalPopup1.openPopup();

    this._element.addEventListener('click', this.closePopup.bind(this));
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

    this._element = document.getElementById(elementID);

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
    this._element.classList.remove('paypal-popup-modal-close');
    this._element.classList.add('paypal-popup-modal-open');

    this._setOpen(true);
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
    this._element.classList.remove('paypal-popup-modal-open');
    this._element.classList.add('paypal-popup-modal-close');

    this._setOpen(false);
};

document.addEventListener("DOMContentLoaded", function() {
    window.paypalPopup1 = new PaypalPopup();
    window.paypalPopup1.init('paypal-popup', true);
});
