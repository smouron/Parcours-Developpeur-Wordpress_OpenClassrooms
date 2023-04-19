import { fadeIn, fadeOut, registerWidget } from "../lib/utils";

class OEW_Newsletter extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                subscribeForm: "#mc-embedded-subscribe-form",
                submitBtn: "button",
                emailField: ".email",
                emailFieldError: ".email-err",
                GDPRField: ".gdpr",
                GDPRFieldError: ".gdpr-err",
                responseMessage: ".res-msg",
                errorMessage: ".err-msg",
                require: ".req",
                notValid: ".not-valid",
                success: ".success",
                failed: ".failed",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            subscribeForm: element.querySelector(selectors.subscribeForm),
            submitBtn: element.querySelector(selectors.submitBtn),
            emailField: element.querySelector(selectors.emailField),
            GDPRField: element.querySelector(selectors.GDPRField),
            responseMessages: element.querySelectorAll(selectors.responseMessage),
            errorMessages: element.querySelectorAll(selectors.errorMessage),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setupEventListeners();
    }

    setupEventListeners() {
        this.elements.subscribeForm?.addEventListener("submit", this.onSubmitSubscribeForm.bind(this));
    }

    onSubmitSubscribeForm(event) {
        event.preventDefault();

        const isFormAllowedSubmitted = this.checkFormFields();

        if (isFormAllowedSubmitted) {
            const element = this.$element.get(0);
            const selectors = this.getSettings("selectors");
            const emailAdress = this.elements.emailField.value.trim();

            this.elements.submitBtn.disabled = true;

            const formData = new FormData();
            formData.append("action", "oew_newsletter_form");
            formData.append("nonce", newsletterData.nonce);
            formData.append("email", emailAdress);

            axios.post(newsletterData.ajax_url, formData).then(({ data }) => {
                const message = data.status
                    ? element.querySelector(`${selectors.responseMessage}${selectors.success}`)
                    : element.querySelector(`${selectors.responseMessage}${selectors.failed}`);

                fadeIn(message);
                this.elements.submitBtn.disabled = false;

                setTimeout(() => {
                    fadeOut(message);
                }, 5000);
            });
        }
    }

    checkFormFields() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");
        const emailAdress = this.elements.emailField.value.trim();
        let isFormAllowedSubmitted = true;

        this.elements.errorMessages.forEach((errorMessage) => {
            errorMessage.style.display = "none";
        });

        this.elements.responseMessages.forEach((responseMessage) => {
            responseMessage.style.display = "none";
        });

        if (emailAdress === "") {
            element.querySelector(`${selectors.emailFieldError}${selectors.require}`).style.display = "block";
            isFormAllowedSubmitted = false;
        } else if (!this.isEmailAddressValid(emailAdress)) {
            element.querySelector(`${selectors.emailFieldError}${selectors.notValid}`).style.display = "block";
            isFormAllowedSubmitted = false;
        }

        if (!!this.elements.GDPRField && this.elements.GDPRField.checked === false) {
            element.querySelector(`${selectors.GDPRFieldError}${selectors.errorMessage}`).style.display = "block";
            isFormAllowedSubmitted = false;
        }

        return isFormAllowedSubmitted;
    }

    isEmailAddressValid(emailAddress) {
        const emailAddressPattern = new RegExp(
            /^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i
        );

        return emailAddressPattern.test(emailAddress);
    }
}

registerWidget(OEW_Newsletter, "oew-newsletter");
