import { registerWidget } from "../lib/utils";

class OEW_Hotspots extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        hotspots: ".oew-hotspot-inner",
      },
      toolTip: {
        fadeInDuration: 200,
        fadeOutDuration: 100,
      },
    };
  }

  getDefaultElements() {
    const element = this.$element.get(0);
    const selectors = this.getSettings("selectors");

    return {
      hotspots: element.querySelectorAll(selectors.hotspots),
    };
  }

  onInit(...args) {
    super.onInit(...args);

    if (
      Array.from(this.elements.hotspots).some(({ classList }) =>
        classList.contains("oew-hotspot-tooltip")
      )
    ) {
      this.setUserSettings();
      this.initTippyTooltip();
    }
  }

  initTippyTooltip() {
    const settings = this.getSettings();
    const self = this;

    this.elements.hotspots.forEach(hotspot => {
      if (!hotspot.classList.contains("oew-hotspot-tooltip")) {
        return;
      }

      tippy(hotspot, {
        allowHTML: true,
        duration: [
          settings.tooltip.fadeInDuration,
          settings.tooltip.fadeOutDuration,
        ],
        content: reference => reference.getAttribute("aria-label"),
        placement: self.getTippyTooltipPlacement(hotspot.classList),
        onMount: instance => {
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

      default:
        return "top";
        break;
    }
  }

  setUserSettings() {
    const settings = this.getSettings();
    const elementSettings = this.getElementSettings();

    this.setSettings({
      tooltip: {
        fadeInDuration: !!elementSettings.fade_in_time.size
          ? elementSettings.fade_in_time.size
          : settings.tooltip.fadeInDuration,

        fadeOutDuration: !!elementSettings.fade_out_time.size
          ? elementSettings.fade_out_time.size
          : settings.tooltip.fadeOutDuration,
      },
    });
  }
}

registerWidget(OEW_Hotspots, "oew-hotspots");
