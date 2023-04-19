import { registerWidget } from "../lib/utils";

class OEW_Clipboard extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        clipboardButton: ".oew-clipboard-button",
        clipboardValue: ".oew-clipboard-value",
      },
    };
  }

  getDefaultElements() {
    const element = this.$element.get(0);
    const selectors = this.getSettings("selectors");

    return {
      clipboardButton: element.querySelector(selectors.clipboardButton),
      clipboardValue: element.querySelector(selectors.clipboardValue),
    };
  }

  onInit(...args) {
    super.onInit(...args);

    this.setupEventListeners();
  }

  setupEventListeners() {
    this.elements.clipboardButton.addEventListener(
      "click",
      this.copy.bind(this)
    );
  }

  copy(event) {
    const data = this.elements.clipboardValue.dataset.clipboardTarget;
    this.elements.clipboardButton.insertAdjacentHTML(
      "beforeend",
      `<input type="text" value="${data}" id="oewClipboardInput" />`
    );
    const clipboardInput = document.querySelector("#oewClipboardInput");
    clipboardInput.select();
    document.execCommand("copy");
    clipboardInput.remove();
  }
}

registerWidget(OEW_Clipboard, "oew-clipboard");
