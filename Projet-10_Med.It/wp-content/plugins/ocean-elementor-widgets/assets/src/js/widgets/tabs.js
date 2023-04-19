import { registerWidget } from "../lib/utils";

class OEW_Tabs extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                tabs: ".oew-tabs",
                tabTitle: ".oew-tab-title",
                tabContent: ".oew-tab-content",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            tabs: element.querySelector(selectors.tabs),
            tabTitles: element.querySelectorAll(selectors.tabTitle),
            tabContents: element.querySelectorAll(selectors.tabContent),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setUserSettings();
        this.initTabs();
        this.setupEventListeners();
    }

    initTabs() {
        const settings = this.getSettings();
        const activeTab = !!settings.active_item ? settings.active_item : 1;

        this.elements.tabs.querySelector(`.oew-tab-title[data-tab="${activeTab}"]`).classList.add("oew-active");
        this.elements.tabs.querySelector(`#oew-tab-content-${activeTab}`).classList.add("oew-active");
    }

    setupEventListeners() {
        this.elements.tabTitles.forEach((tabTitle) => {
            tabTitle.addEventListener("click", this.openTab.bind(this));
        });
    }

    openTab(event) {
        event.preventDefault();

        const activeTab = event.currentTarget.dataset.tab;

        this.elements.tabTitles.forEach((tabTitle) => {
            tabTitle.classList.remove("oew-active");
        });

        this.elements.tabContents.forEach((tabContent) => {
            tabContent.classList.remove("oew-active");
        });

        this.elements.tabs.querySelector(`.oew-tab-title[data-tab="${activeTab}"]`).classList.add("oew-active");
        this.elements.tabs.querySelector(`#oew-tab-content-${activeTab}`).classList.add("oew-active");
    }

    setUserSettings() {
        const elementSettings = this.getElementSettings();

        this.setSettings(elementSettings);
    }
}

registerWidget(OEW_Tabs, "oew-tabs");
