import { fadeIn, fadeOut, registerWidget } from "../lib/utils";

class OEW_Coupon extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        couponCode: ".oew-coupon-code:not(.oew-copied)",
        couponCopyText: ".oew-coupon-copy-text",
      },
    };
  }

  getDefaultElements() {
    const element = this.$element.get(0);
    const selectors = this.getSettings("selectors");

    return {
      couponCode: element.querySelector(selectors.couponCode),
      couponCopyText: element.querySelector(selectors.couponCopyText),
    };
  }

  onInit(...args) {
    super.onInit(...args);

    this.setupEventListeners();
  }

  setupEventListeners() {
    this.elements.couponCode.addEventListener(
      "click",
      this.copyCode.bind(this)
    );
  }

  copyCode(event) {
    const code = this.elements.couponCode.dataset.couponCode;
    console.log(code);
    this.elements.couponCode.insertAdjacentHTML(
      "beforeend",
      `<input type="text" value="${code}" id="oewCouponInput">`
    );
    const couponInput = document.querySelector("#oewCouponInput");
    couponInput.select();
    document.execCommand("copy");
    couponInput.remove();

    this.elements.couponCode.classList.add("oew-copied");
    fadeOut(this.elements.couponCopyText, {
      callback: () => {
        this.elements.couponCopyText.innerText = "Copied";
        fadeIn(this.elements.couponCopyText);
      },
    });
  }
}

registerWidget(OEW_Coupon, "oew-coupon");
