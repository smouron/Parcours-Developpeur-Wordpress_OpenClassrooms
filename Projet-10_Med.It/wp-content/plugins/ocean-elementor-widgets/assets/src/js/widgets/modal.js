import { fadeIn, fadeOut, registerWidget } from "../lib/utils";

class OEW_Modal extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        modal: ".oew-modal-wrap",
        openModalButton: ".oew-modal-button a",
        closeModalElements: ".oew-modal-close, .oew-modal-overlay",
      },
    };
  }

  getDefaultElements() {
    const element = this.$element.get(0);
    const selectors = this.getSettings("selectors");

    return {
      modal: element.querySelector(selectors.modal),
      openModalButton: element.querySelector(selectors.openModalButton),
      closeModalElements: element.querySelectorAll(
        selectors.closeModalElements
      ),
      body: document.body,
      html: document.querySelector("html"),
    };
  }

  onInit(...args) {
    super.onInit(...args);

    this.moveModalToEndOfBody();
    this.setupEventListeners();
  }

  moveModalToEndOfBody() {
    document.querySelectorAll(`#oew-modal-${this.getID()}`).forEach(modal => {
      if (this.elements.modal !== modal) {
        modal.remove();
      }
    });

    document.body.insertAdjacentElement("beforeend", this.elements.modal);
  }

  setupEventListeners() {
    this.elements.openModalButton?.addEventListener(
      "click",
      this.openModal.bind(this)
    );
    this.elements.closeModalElements?.forEach(closeModalElement => {
      closeModalElement.addEventListener("click", this.closeModal.bind(this));
    });
  }

  openModal(event) {
    event.preventDefault();

    const openModalButton = event.currentTarget;
    const targetID = openModalButton.getAttribute("href");
    const modal = document.querySelector(targetID);

    modal.classList.remove("oew-temp-styles");

    const initialHTMLInnerWidth = this.elements.html.innerWidth;
    this.elements.html.style.overflow = "hidden";

    const afterInitialHTMLInnerWidth = this.elements.html.innerWidth;
    this.elements.html.style.marginRight =
      afterInitialHTMLInnerWidth - initialHTMLInnerWidth + "px";

    fadeIn(modal);
  }

  closeModal(event) {
    const closeModalElements = event.currentTarget;
    const modal = closeModalElements.closest(".oew-modal-wrap");

    this.elements.html.style.overflow = "";
    this.elements.html.style.marginRight = "";

    fadeOut(modal);
  }
}

registerWidget(OEW_Modal, "oew-modal");
