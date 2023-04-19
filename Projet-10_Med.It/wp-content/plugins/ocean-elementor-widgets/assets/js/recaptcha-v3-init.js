(function () {

	let $form = jQuery('.oew-form');

	function Validate(events) {
		if (!jQuery(events.target).hasClass('validated')) {
			events.preventDefault();
			grecaptcha.ready(function () {
				grecaptcha.execute(RecaptchaV3InitParam.key, { action: 'submit' }).then(function (token) {
					console.log(token);
					jQuery(events.target).find('.g-recaptcha-response').remove();
					jQuery(events.target).append(jQuery('<textarea>', {
						id: 'g-recaptcha-response',
						class: 'g-recaptcha-response',
						name: 'g-recaptcha-response',
						style: 'width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;',
					}).val(token));
					jQuery(events.target).addClass('validated').trigger('submit');
				});
			});
		}
	}

	if (typeof RecaptchaV3InitParam != RecaptchaV3InitParam.key) {
		$form.on('submit', Validate);
	}

})();