import { registerWidget } from "../lib/utils";

class OEW_OffCanvas extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                offCanvas: ".oew-off-canvas-wrap",
                offCanvasOpenBtn: ".oew-off-canvas-button a",
                offCanvasCloseElems: ".oew-off-canvas-close, .oew-off-canvas-overlay",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            offCanvas: element.querySelector(selectors.offCanvas),
            offCanvasOpenBtn: element.querySelector(selectors.offCanvasOpenBtn),
            offCanvasCloseElems: element.querySelectorAll(selectors.offCanvasCloseElems),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.moveModalToEndOfBody();
        this.setupEventListeners();
    }

    moveModalToEndOfBody() {
        document.querySelectorAll(`#oew-off-canvas-${this.getID()}`).forEach((offCanvas) => {
            if (this.elements.offCanvas !== offCanvas) {
                offCanvas.remove();
            }
        });

        document.body.insertAdjacentElement("beforeend", this.elements.offCanvas);
    }

    setupEventListeners() {
        this.elements.offCanvasOpenBtn?.addEventListener("click", this.openCanvas.bind(this));

        this.elements.offCanvasCloseElems?.forEach((offCanvasCloseElem) => {
            offCanvasCloseElem.addEventListener("click", this.closeCanvas.bind(this));
        });
    }

    openCanvas(event) {
        event.preventDefault();

        const targetID = this.elements.offCanvasOpenBtn.getAttribute("href");
        const offCanvas = document.querySelector(targetID);

        offCanvas.classList.toggle("show");
    }

    closeCanvas(event) {
        const offCanvasCloseElem = event.currentTarget;

        offCanvasCloseElem.closest(".oew-off-canvas-wrap").classList.remove("show");
    }
}

registerWidget(OEW_OffCanvas, "oew-off-canvas");
