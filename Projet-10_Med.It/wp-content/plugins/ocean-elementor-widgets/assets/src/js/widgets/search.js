import { fadeIn, fadeOut, registerWidget, slideDown, slideUp } from "../lib/utils";

class OEW_Search extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                search: ".oew-search-wrap",
                searchForm: "form.oew-ajax-search",
                searchInput: ".oew-ajax-search input.field",
                searchResults: ".oew-search-results",
                searchLoadingSpinner: ".oew-search-wrap .oew-ajax-loading",
            },
            ajaxSearchTimeoutID: null,
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            search: element.querySelector(selectors.search),
            searchForm: element.querySelector(selectors.searchForm),
            searchInput: element.querySelector(selectors.searchInput),
            searchResults: element.querySelector(selectors.searchResults),
            searchLoadingSpinner: element.querySelector(selectors.searchLoadingSpinner),
        };
    }

    bindEvents() {
        this.elements.searchInput?.addEventListener("keyup", this.ajaxSearch.bind(this));
        this.elements.searchForm?.addEventListener("submit", this.onSearchFormSubmit.bind(this));
        this.elements.searchForm?.addEventListener("click", this.onSearchFormClick.bind(this));
        document.addEventListener("click", this.onDocumentClick.bind(this));
    }

    ajaxSearch(event) {
        const searchValue = this.elements.searchInput.value;

        clearTimeout(this.getSettings("ajaxSearchTimeoutID"));

        if (searchValue.length > 2) {
            const ajaxSearchTimeoutID = setTimeout(() => {
                axios.interceptors.request.use((config) => {
                    slideUp(this.elements.searchResults, 200);

                    setTimeout(() => {
                        fadeIn(this.elements.searchLoadingSpinner, {
                            duration: 200,
                        });
                    }, 150);

                    return config;
                });

                const formData = new FormData();
                formData.append("action", "oew_ajax_search");
                formData.append("nonce", searchData.nonce);
                formData.append("search", searchValue);

                axios.post(searchData.ajax_url, formData).then(({ data }) => {
                    data = !(data == "0" || data === 0) ? data : "";

                    this.elements.searchResults.innerHTML = data;
                    fadeOut(this.elements.searchLoadingSpinner, {
                        duration: 200,
                    });

                    setTimeout(() => {
                        slideDown(this.elements.searchResults, 400);
                        this.elements.searchResults.classList.add("filled");
                    }, 200);
                });
            }, 400);

            this.setSettings({
                ajaxSearchTimeoutID: ajaxSearchTimeoutID,
            });
        }
    }

    onSearchFormSubmit(event) {
        event.preventDefault();
    }

    onSearchFormClick(event) {
        const searchResults = this.elements.search.querySelector(`${this.getSettings("selectors.searchResults")}.filled`);

        if (searchResults) {
            slideDown(searchResults, 400);
        }
    }

    onDocumentClick(event) {
        // Close search results
        const searchArea = event.target.closest(this.getSettings("selectors.searchForm"));
        const searchResultsArea = event.target.closest(this.getSettings("selectors.searchResults"));

        if (!(searchArea || searchResultsArea)) {
            slideUp(this.elements.searchResults, 200);
        }
    }
}

registerWidget(OEW_Search, "oew-search");
