import { fadeIn, fadeOut, fadeToggle, registerWidget } from "../lib/utils";

class OEW_SearchIcon extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                dropdownSearch: ".oew-search-dropdown",
                dropdownSearchIcon: ".oew-search-icon-dropdown",
                dropdownSearchIconLink: ".oew-dropdown-link",
                dropdownSearchInput: ".oew-search-dropdown input.field",
                overlaySearch: ".oew-search-overlay",
                overlaySearchForm: ".oew-search-overlay form",
                overlaySearchIcon: ".oew-search-icon-overlay",
                overlaySearchIconLink: "a.oew-overlay-link",
                overlaySearchInput: "input.oew-search-overlay-input",
                overlaySearchCloseBtn: "a.oew-search-overlay-close",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            dropdownSearch: element.querySelector(selectors.dropdownSearch),
            dropdownSearchIcon: element.querySelector(selectors.dropdownSearchIcon),
            dropdownSearchIconLink: element.querySelector(selectors.dropdownSearchIconLink),
            dropdownSearchInput: element.querySelector(selectors.dropdownSearchInput),
            overlaySearch: element.querySelector(selectors.overlaySearch),
            overlaySearchForm: element.querySelector(selectors.overlaySearchForm),
            overlaySearchIcon: element.querySelector(selectors.overlaySearchIcon),
            overlaySearchIconLink: element.querySelector(selectors.overlaySearchIconLink),
            overlaySearchInput: element.querySelector(selectors.overlaySearchInput),
            overlaySearchCloseBtn: element.querySelector(selectors.overlaySearchCloseBtn),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        if (this.getSearchType() === "overlay") {
            this.initOverlaySearch();
        }

        this.setupEventListeners();
    }

    initOverlaySearch() {
        document.querySelectorAll(`#oew-search-${this.getID()}`).forEach((overlaySearch) => {
            if (this.elements.overlaySearch !== overlaySearch) {
                overlaySearch.remove();
            }
        });

        document.body.insertAdjacentElement("beforeend", this.elements.overlaySearch);

        if (this.elements.overlaySearchInput.value.length) {
            this.elements.overlaySearchForm.classList.add("search-filled");
        }
    }

    setupEventListeners() {
        if (this.getSearchType() === "overlay") {
            this.elements.overlaySearchIconLink.addEventListener("click", this.openOverlaySearch.bind(this));
            this.elements.overlaySearchCloseBtn.addEventListener("click", this.closeOverlaySearch.bind(this));
            this.elements.overlaySearchInput.addEventListener("keyup", this.toggleInputPlaceholder.bind(this));
            this.elements.overlaySearchInput.addEventListener("blur", this.toggleInputPlaceholder.bind(this));
        } else {
            this.elements.dropdownSearchIconLink.addEventListener("click", this.toggleDropdownSearch.bind(this));
            document.addEventListener("click", this.onDocumentClick.bind(this));
        }
    }

    toggleDropdownSearch(event) {
        event.preventDefault();
        event.stopPropagation();

        fadeToggle(this.elements.dropdownSearch, {
            duration: 200,
        });
        this.elements.dropdownSearchIcon.classList.toggle("active");
        this.elements.dropdownSearchInput.focus();
    }

    openOverlaySearch(event) {
        event.preventDefault();

        this.elements.overlaySearch.classList.add("active");
        fadeIn(this.elements.overlaySearch, {
            duration: 200,
        });
        this.elements.overlaySearchInput.focus();

        setTimeout(() => {
            document.querySelector("html").style.overflow = "hidden";
        }, 400);
    }

    closeOverlaySearch(event) {
        event.preventDefault();

        this.elements.overlaySearch.classList.remove("active");
        if( jQuery(this.elements.overlaySearch).is(':visible') ) {
            fadeOut(this.elements.overlaySearch, {
                duration: 200,
            });
        }
        setTimeout(() => {
            document.querySelector("html").style.overflow = "visible";
        }, 400);
    }

    toggleInputPlaceholder(event) {
        if (this.elements.overlaySearchInput && this.elements.overlaySearchInput.value.length > 0) {
            this.elements.overlaySearchForm.classList.add("search-filled");
        } else {
            this.elements.overlaySearchForm.classList.remove("search-filled");
        }
    }

    onDocumentClick(event) {
        // Close Dropdown Search
        if (!event.target.closest(this.getSettings("selectors.dropdownSearch"))) {
            this.elements.dropdownSearchIcon.classList.remove("show");
            if( jQuery(this.elements.dropdownSearch).is(':visible') ) {
                fadeOut(this.elements.dropdownSearch, {
                    duration: 200,
                });
            }
        }
    }

    getSearchType() {
        return !!this.elements.overlaySearchIcon ? "overlay" : "dropdown";
    }
}

registerWidget(OEW_SearchIcon, "oew-search-icon");
