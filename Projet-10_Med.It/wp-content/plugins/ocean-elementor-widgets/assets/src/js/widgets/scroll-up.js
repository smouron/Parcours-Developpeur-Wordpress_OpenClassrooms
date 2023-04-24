import { registerWidget } from "../lib/utils";

class OEW_ScrollUp extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                scrollBtn: ".oew-scroll-button a",
                html: "html",
                body: "body",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            scrollBtn: element.querySelector(selectors.scrollBtn),
            html: document.querySelector("html"),
            body: document.body,
        };
    }

    bindEvents() {
        this.elements.scrollBtn.addEventListener("click", this.onScrollBtnClick.bind(this));
    }

    onScrollBtnClick(event) {
        event.preventDefault();

        this.elements.html.scrollTo({
            top: 0,
            behavior: "smooth",
        });

        this.elements.scrollBtn.parentNode.classList.remove("sfHover");
    }
}

registerWidget(OEW_ScrollUp, "oew-scroll-up");
