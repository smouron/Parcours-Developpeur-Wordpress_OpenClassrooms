import ResponsiveAutoHeight from "responsive-auto-height";
import { registerWidget } from "../lib/utils";

class OEW_BlogGrid extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        blogGrid: ".oew-blog-grid",
        blogMasonry: ".oew-blog-grid.oew-masonry",
      },
    };
  }

  getDefaultElements() {
    const element = this.$element.get(0);
    const selectors = this.getSettings("selectors");

    return {
      blogGrid: element.querySelector(selectors.blogGrid),
      blogMasonry: element.querySelector(selectors.blogMasonry),
    };
  }

  onInit(...args) {
    super.onInit(...args);

    if (this.isMasonry()) {
      this.initMasonry();
    }

    if (this.isEqualHeight()) {
      this.initEqualHeight();
    }
  }

  initMasonry() {
    if (this.isEdit) {
      salvattore.init();
    }
  }

  initEqualHeight() {
    const blogGridItemsSelector = `${
      this.getSettings("selectors").blogGrid
    } .oew-grid-inner`;

    new ResponsiveAutoHeight(blogGridItemsSelector);
  }

  isMasonry() {
    if (document.body.classList.contains("no-isotope")) {
      return false;
    }

    return !!this.elements.blogMasonry;
  }

  isEqualHeight() {
    return this.elements.blogGrid?.classList.contains("match-height-grid");
  }
}

registerWidget(OEW_BlogGrid, "oew-blog-grid");
