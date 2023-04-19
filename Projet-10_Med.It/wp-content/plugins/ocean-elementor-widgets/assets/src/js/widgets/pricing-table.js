import { registerWidget } from "../lib/utils";

class OEW_PricingTable extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                pricingTableTooltip: ".oew-pricing-table-tooltip",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            pricingTableTooltips: element.querySelectorAll(selectors.pricingTableTooltip),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        if (this.hasTooltip()) {
            this.initTippyTooltip();
        }
    }

    initTippyTooltip() {
        const self = this;

        this.elements.pricingTableTooltips.forEach((pricingTableTooltip) => {
            tippy(pricingTableTooltip, {
                allowHTML: true,
                duration: [300, 200],
                content: (reference) => reference.getAttribute("title"),
                placement: self.getTippyTooltipPlacement(pricingTableTooltip.classList),
                onMount: (instance) => {
                    instance.popper.classList.add(`oew-hotspot-powertip-${self.getID()}`);
                },
            });
        });
    }

    getTippyTooltipPlacement(classList) {
        switch (true) {
            case classList.contains("oew-tooltip-n"):
                return "top";
                break;
            case classList.contains("oew-tooltip-ne-alt"):
                return "top-start";
                break;
            case classList.contains("oew-tooltip-ne"):
                return "top-end";
                break;
            case classList.contains("oew-tooltip-e"):
                return "right";
                break;
            case classList.contains("oew-tooltip-se-alt"):
                return "right-start";
                break;
            case classList.contains("oew-tooltip-se"):
                return "right-end";
                break;
            case classList.contains("oew-tooltip-s"):
                return "bottom";
                break;
            case classList.contains("oew-tooltip-sw-alt"):
                return "bottom-start";
                break;
            case classList.contains("oew-tooltip-sw"):
                return "bottom-end";
                break;
            case classList.contains("oew-tooltip-w"):
                return "left";
                break;
            case classList.contains("oew-tooltip-nw-alt"):
                return "left-start";
                break;
            case classList.contains("oew-tooltip-nw"):
                return "left-end";
                break;
        }
    }

    hasTooltip() {
        return !!this.elements.pricingTableTooltips;
    }
}

registerWidget(OEW_PricingTable, "oew-pricing-table");
