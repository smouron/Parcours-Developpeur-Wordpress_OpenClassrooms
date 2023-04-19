import { registerWidget } from "../lib/utils";

class OEW_AnimatedHeading extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                animatedHeading: ".oew-animated-heading",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            animatedHeading: element.querySelector(selectors.animatedHeading),
            $animatedHeading: this.$element.find(selectors.animatedHeading),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setUserSettings();

        if (this.hasAnimatedHeading) {
            this.initAnimation();
        }
    }

    initAnimation() {
        const settings = this.getSettings();

        if (settings.heading_layout === "animated") {
            this.initMorphext();
        } else {
            this.initTyped();
        }
    }

    initMorphext() {
        const settings = this.getSettings();

        this.elements.$animatedHeading.Morphext({
            animation: settings.heading_animation,
            speed: settings.heading_animation_delay,
        });
    }

    initTyped() {
        const settings = this.getSettings();

        new Typed(settings.selectors.animatedHeading, {
            strings: settings.animated_heading.split(","),
            typeSpeed: settings.type_speed,
            startDelay: settings.start_delay,
            backSpeed: settings.back_speed,
            backDelay: settings.back_delay,
            loop: settings.loop === "yes" ? true : false,
            loopCount: settings.loop_count ? settings.loop_count : 0,
        });
    }

    setUserSettings() {
        const elementSettings = this.getElementSettings();

        this.setSettings(elementSettings);
    }

    hasAnimatedHeading() {
        return this.getSettings("animated_heading").trim() !== "";
    }
}

registerWidget(OEW_AnimatedHeading, "oew-animated-heading");
