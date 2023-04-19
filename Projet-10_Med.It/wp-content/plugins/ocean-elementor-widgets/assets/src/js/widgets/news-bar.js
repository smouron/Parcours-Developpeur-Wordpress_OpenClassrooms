import { registerWidget } from "../lib/utils";

class OEW_NewsBar extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        slider: ".oew-swiper-slider",
      },
    };
  }

  getDefaultElements() {
    const element = this.$element.get(0);
    const selectors = this.getSettings("selectors");

    return {
      slider: element.querySelector(selectors.slider),
    };
  }

  onInit(...args) {
    super.onInit(...args);

    this.initSlider();
  }

  initSlider() {
    const options = JSON.parse(
      this.elements.slider.getAttribute("data-slider-settings")
    );

    new Swiper(this.elements.slider, options);
  }
}

registerWidget(OEW_NewsBar, "oew-news-bar");
