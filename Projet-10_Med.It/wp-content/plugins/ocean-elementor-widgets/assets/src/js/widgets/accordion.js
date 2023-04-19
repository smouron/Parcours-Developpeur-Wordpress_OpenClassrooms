import { registerWidget, slideUp, slideDown, slideToggle } from "../lib/utils";

class OEW_Accordion extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                accordion: ".oew-accordion",
                accordionItem: ".oew-accordion-item",
                accordionTitle: ".oew-accordion-title",
                accordionContent: ".oew-accordion-content",
            },
            classes: {
                active: "oew-active",
            },
            activeItemIndex: null,
            multiExpand: false,
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            accordion: element.querySelector(selectors.accordion),
            accordionItems: element.querySelectorAll(selectors.accordionItem),
            accordionTitles: element.querySelectorAll(selectors.accordionTitle),
            accordionContents: element.querySelectorAll(selectors.accordionContent),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setUserSettings();
        this.activateDefaultItem();
    }

    setUserSettings() {
        const settings = this.getSettings();
        const userSettings = JSON.parse(this.elements.accordion.getAttribute("data-settings"));

        this.setSettings({
            activeItemIndex: !!userSettings.active_item ? userSettings.active_item : settings.activeItemIndex,
            multiExpand: !!userSettings.multiple ? JSON.parse(userSettings.multiple) : settings.multiExpand,
        });
    }

    activateDefaultItem() {
        const settings = this.getSettings();
        const selectors = settings.selectors;
        const activeItemIndex = settings.activeItemIndex;
        const activeClass = settings.classes.active;

        if (!activeItemIndex) {
            return;
        }

        const activeAccordionItem = this.elements.accordion.querySelector(
            `${selectors.accordionItem}:nth-child(${activeItemIndex})`
        );

        activeAccordionItem.classList.remove(activeClass);

        this.changeActiveItem(activeAccordionItem);
    }

    bindEvents() {
        this.elements.accordionTitles.forEach((accordionTitle) => {
            accordionTitle.addEventListener("click", this.onTitleClick.bind(this));
        });
    }

    onTitleClick(event) {
        const enableMultiExpand = this.getSettings("multiExpand");
        const accordionTitle = event.currentTarget;
        const accordionItem = accordionTitle.parentNode;

        if (!!enableMultiExpand) {
            this.toggleMultiExpandItem(accordionItem);
        } else {
            this.changeActiveItem(accordionItem);
        }
    }

    toggleMultiExpandItem(accordionItem) {
        const activeClass = this.getSettings("classes.active");
        const accordionContent = this.getAccordionContent(accordionItem);

        accordionItem.classList.toggle(activeClass);
        slideToggle(accordionContent, 300);
    }

    changeActiveItem(accordionItem) {
        if (this.isActiveItem(accordionItem)) {
            this.deactiveItem(accordionItem);
        } else {
            this.elements.accordionItems.forEach((_accordionItem) => {
                if (_accordionItem !== accordionItem) {
                    this.deactiveItem(_accordionItem);
                }
            });

            this.activateItem(accordionItem);
        }
    }

    activateItem(accordionItem) {
        const activeClass = this.getSettings("classes.active");
        const accordionContent = this.getAccordionContent(accordionItem);

        accordionItem.classList.add(activeClass);
        slideDown(accordionContent, 300);
    }

    deactiveItem(accordionItem) {
        const activeClass = this.getSettings("classes.active");
        const accordionContent = this.getAccordionContent(accordionItem);

        accordionItem.classList.remove(activeClass);
        slideUp(accordionContent, 300);
    }

    isActiveItem(accordionItem) {
        return accordionItem.classList.contains(this.getSettings("classes.active"));
    }

    getAccordionContent(accordionItem) {
        return accordionItem.querySelector(this.getSettings("selectors.accordionContent"));
    }
}

registerWidget(OEW_Accordion, "oew-accordion");
