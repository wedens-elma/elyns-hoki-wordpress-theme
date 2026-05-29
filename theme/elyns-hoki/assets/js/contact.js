(function () {
  'use strict';

  var form = document.querySelector('[data-elyns-contact-form]');
  if (!form || typeof elynsSiteData === 'undefined') return;

  var status = form.querySelector('[data-form-status]');
  var button = form.querySelector('button[type="submit"]');
  var defaultButtonText = button ? button.textContent : '';

  form.addEventListener('submit', function (event) {
    event.preventDefault();

    var data = new FormData(form);
    data.append('action', 'elyns_contact');
    data.append('nonce', elynsSiteData.nonce);

    if (button) {
      button.disabled = true;
      button.textContent = 'Sending...';
    }
    if (status) {
      status.textContent = '';
      status.className = 'form-status';
    }

    fetch(elynsSiteData.ajaxUrl, {
      method: 'POST',
      credentials: 'same-origin',
      body: data
    })
      .then(function (response) { return response.json(); })
      .then(function (result) {
        if (status) {
          status.textContent = result && result.data && result.data.message ? result.data.message : 'Thank you. Your inquiry has been submitted.';
          status.className = 'form-status ' + (result.success ? 'success' : 'error');
        }
        if (result.success) form.reset();
      })
      .catch(function () {
        if (status) {
          status.textContent = 'Message could not be sent. Please try WhatsApp or email us directly.';
          status.className = 'form-status error';
        }
      })
      .finally(function () {
        if (button) {
          button.disabled = false;
          button.textContent = defaultButtonText;
        }
      });
  });
})();
