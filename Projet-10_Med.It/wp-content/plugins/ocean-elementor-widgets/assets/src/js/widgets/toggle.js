import { registerWidget } from "../lib/utils";

class OEW_Toggle extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                toggle: ".oew-switch-container",
                toggleSwitcher: ".oew-switch-wrap",
                toggleSwitcherLabel: ".oew-switch-label",
                togglePrimaryContent: ".oew-switch-primary-wrap",
                toggleSecondaryContent: ".oew-switch-secondary-wrap",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            toggle: element.querySelector(selectors.toggle),
            toggleSwitcher: element.querySelector(selectors.toggleSwitcher),
            toggleSwitcherLabel: element.querySelector(selectors.toggleSwitcherLabel),
            togglePrimaryContent: element.querySelector(selectors.togglePrimaryContent),
            toggleSecondaryContent: element.querySelector(selectors.toggleSecondaryContent),
        };
    }

    bindEvents() {
        this.elements.toggleSwitcherLabel.addEventListener("click", this.toggleSwitcher.bind(this));
    }

    toggleSwitcher(event) {
        event.preventDefault();

        this.elements.toggleSwitcher.classList.toggle("oew-switch-on");

        ["hide", "show"].forEach((className) => {
            this.elements.togglePrimaryContent.classList.toggle(className);
            this.elements.toggleSecondaryContent.classList.toggle(className);
        });

        this.productCarousel();
    }

    productCarousel() {
        const element = this.$element.get(0);

        if (
            !document.body.classList.contains("no-carousel") &&
            !!element.querySelector(".woo-entry-image.product-entry-slider")
        ) {
            oceanwp.theme.owSlider.flickity?.forEach((flickity) => {
                flickity.destroy();
            });

            oceanwp.theme.owSlider.start();
        }
    }
}

registerWidget(OEW_Toggle, "oew-toggle");
