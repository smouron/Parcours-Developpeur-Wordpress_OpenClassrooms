import { registerWidget, fadeOut } from "../lib/utils";

class OEW_Alert extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                alert: ".oew-alert",
                alertCloseBtn: ".oew-alert-close-btn",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            alert: element.querySelector(selectors.alert),
            alertCloseBtn: element.querySelector(selectors.alertCloseBtn),
        };
    }

    bindEvents() {
        this.elements.alertCloseBtn?.addEventListener("click", this.onCloseBtnClick.bind(this));
    }

    onCloseBtnClick(event) {
        fadeOut(this.elements.alert);
    }
}

registerWidget(OEW_Alert, "oew-alert");
