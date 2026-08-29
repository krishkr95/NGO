/* ============================================================
   NGO WEBSITE — FORMS JS
   Comprehensive form validation and WhatsApp message generator
   ============================================================ */

(function () {
  'use strict';

  function getVal(form, name) {
    const el = form.querySelector('[name="' + name + '"]');
    return el ? el.value.trim() : '';
  }

  function showError(form, name, msg) {
    const el = form.querySelector('[name="' + name + '"]');
    if (!el) return;
    el.classList.add('form-error');
    let errEl = el.parentElement.querySelector('.form-error-msg');
    if (!errEl) {
      errEl = document.createElement('span');
      errEl.className = 'form-error-msg';
      el.parentElement.appendChild(errEl);
    }
    errEl.textContent = msg;
    errEl.style.display = 'block';
  }

  function clearErrors(form) {
    form.querySelectorAll('.form-error').forEach(function (el) { el.classList.remove('form-error'); });
    form.querySelectorAll('.form-error-msg').forEach(function (el) { el.style.display = 'none'; });
  }

  function isValidPhone(p) {
    return /^[6-9]\d{9}$/.test(p.replace(/\s+/g, ''));
  }

  function isValidEmail(e) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e);
  }

  function sendToWa(message) {
    const num = (typeof NGO_CONFIG !== 'undefined') ? NGO_CONFIG.whatsapp : '';
    if (!num) {
      alert('WhatsApp number not configured. Please update js/config.js');
      return;
    }
    window.open('https://wa.me/' + num + '?text=' + encodeURIComponent(message), '_blank', 'noopener');
  }

  // 1. Contact Form
  function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      clearErrors(form);
      let valid = true;
      const name = getVal(form, 'name');
      const phone = getVal(form, 'phone');
      const email = getVal(form, 'email');
      const subject = getVal(form, 'subject');
      const message = getVal(form, 'message');

      if (!name) { showError(form, 'name', 'Please enter your full name.'); valid = false; }
      if (!phone || !isValidPhone(phone)) { showError(form, 'phone', 'Please enter a valid 10-digit phone number.'); valid = false; }
      if (email && !isValidEmail(email)) { showError(form, 'email', 'Please enter a valid email address.'); valid = false; }
      if (!subject) { showError(form, 'subject', 'Please select an enquiry subject.'); valid = false; }
      if (!message) { showError(form, 'message', 'Please enter your message.'); valid = false; }

      if (!valid) return;
      const msg = `Hello EmpowerHer!\n\nName: ${name}\nPhone: ${phone}${email ? '\nEmail: ' + email : ''}\nSubject: ${subject}\n\nMessage:\n${message}\n\nPlease get back to me. Thank you!`;
      sendToWa(msg);
    });
  }

  // 2. Volunteer Form
  function initVolunteerForm() {
    const form = document.getElementById('volunteer-form');
    if (!form) return;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      clearErrors(form);
      let valid = true;
      const name = getVal(form, 'name');
      const phone = getVal(form, 'phone');
      const email = getVal(form, 'email');
      const city = getVal(form, 'city');
      const area = getVal(form, 'area');
      const skills = getVal(form, 'skills');
      const availability = getVal(form, 'availability');
      const message = getVal(form, 'message');

      if (!name) { showError(form, 'name', 'Please enter your name.'); valid = false; }
      if (!phone || !isValidPhone(phone)) { showError(form, 'phone', 'Please enter a valid 10-digit phone.'); valid = false; }
      if (!area) { showError(form, 'area', 'Please select an area of interest.'); valid = false; }

      if (!valid) return;
      const parts = [
        'Hello EmpowerHer! I would like to volunteer.',
        '',
        'Name        : ' + name,
        'Phone       : ' + phone
      ];
      if (email) parts.push('Email       : ' + email);
      if (city) parts.push('City        : ' + city);
      if (area) parts.push('Area        : ' + area);
      if (skills) parts.push('Skills      : ' + skills);
      if (availability) parts.push('Availability: ' + availability);
      if (message) parts.push('', 'Message:', message);
      parts.push('', 'Please share details. Thank you!');
      sendToWa(parts.join('\n'));
    });
  }

  // 3. CSR / Corporate Form
  function initCsrForm() {
    const form = document.getElementById('csr-form') || document.getElementById('corporate-form');
    if (!form) return;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      clearErrors(form);
      let valid = true;
      const org = getVal(form, 'organization');
      const contact = getVal(form, 'contact') || getVal(form, 'name');
      const phone = getVal(form, 'phone');
      const email = getVal(form, 'email');
      const area = getVal(form, 'area');
      const message = getVal(form, 'message');

      if (!org) { showError(form, 'organization', 'Please enter your organization name.'); valid = false; }
      if (!contact) { showError(form, 'contact', 'Please enter contact person name.'); valid = false; }
      if (!phone || !isValidPhone(phone)) { showError(form, 'phone', 'Please enter a valid phone.'); valid = false; }

      if (!valid) return;
      const parts = [
        'Hello EmpowerHer! We are interested in a partnership / CSR collaboration.',
        '',
        'Organization  : ' + org,
        'Contact Person: ' + contact,
        'Phone         : ' + phone
      ];
      if (email) parts.push('Email         : ' + email);
      if (area) parts.push('Partnership   : ' + area);
      if (message) parts.push('', 'Message:', message);
      parts.push('', 'Please connect with us. Thank you!');
      sendToWa(parts.join('\n'));
    });
  }

  // 4. Story Submission Form
  function initStoryForm() {
    const form = document.getElementById('story-form');
    if (!form) return;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      clearErrors(form);
      let valid = true;
      const name = getVal(form, 'name');
      const phone = getVal(form, 'phone');
      const training = getVal(form, 'training');
      const story = getVal(form, 'story');
      const consent = form.querySelector('[name="consent"]');

      if (!name) { showError(form, 'name', 'Please enter your name.'); valid = false; }
      if (!phone || !isValidPhone(phone)) { showError(form, 'phone', 'Please enter a valid phone.'); valid = false; }
      if (!story) { showError(form, 'story', 'Please share your story.'); valid = false; }
      if (consent && !consent.checked) { alert('Please give your consent to proceed.'); valid = false; }

      if (!valid) return;
      const parts = [
        `Hello EmpowerHer! My name is ${name} and I would like to share my story.`,
        '',
        'Phone             : ' + phone
      ];
      if (training) parts.push('Training Completed: ' + training);
      parts.push('', 'My Story:', story, '', 'I give my consent to share this story. Thank you!');
      sendToWa(parts.join('\n'));
    });
  }

  // 5. Talk To Us Form (Homepage Lead Capture)
  function initTalkForm() {
    const form = document.getElementById('talk-form');
    if (!form) return;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      clearErrors(form);
      let valid = true;
      const name = getVal(form, 'name');
      const phone = getVal(form, 'phone');
      const email = getVal(form, 'email');
      const interest = getVal(form, 'interest');
      const message = getVal(form, 'message');

      if (!name) { showError(form, 'name', 'Please enter your name.'); valid = false; }
      if (!phone || !isValidPhone(phone)) { showError(form, 'phone', 'Please enter a valid phone.'); valid = false; }
      if (!interest) { showError(form, 'interest', 'Please select what you are interested in.'); valid = false; }

      if (!valid) return;
      const parts = [
        'Hello EmpowerHer! I would like to connect.',
        '',
        'Name        : ' + name,
        'Phone       : ' + phone
      ];
      if (email) parts.push('Email       : ' + email);
      if (interest) parts.push('Interest    : ' + interest);
      if (message) parts.push('', 'Message:', message);
      parts.push('', 'Please share details. Thank you!');
      sendToWa(parts.join('\n'));
    });
  }

  // 6. Training Enquiry Form
  function initTrainingForm() {
    const form = document.getElementById('training-form');
    if (!form) return;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      clearErrors(form);
      let valid = true;
      const name = getVal(form, 'name');
      const phone = getVal(form, 'phone');
      const city = getVal(form, 'city');
      const program = getVal(form, 'program');
      const message = getVal(form, 'message');

      if (!name) { showError(form, 'name', 'Please enter your name.'); valid = false; }
      if (!phone || !isValidPhone(phone)) { showError(form, 'phone', 'Please enter a valid phone.'); valid = false; }
      if (!program) { showError(form, 'program', 'Please select a program of interest.'); valid = false; }

      if (!valid) return;
      const parts = [
        'Hello EmpowerHer! I am interested in enrolling for vocational training.',
        '',
        'Name        : ' + name,
        'Phone       : ' + phone
      ];
      if (city) parts.push('City/Area   : ' + city);
      if (program) parts.push('Program     : ' + program);
      if (message) parts.push('', 'Message:', message);
      parts.push('', 'Please share program timings, eligibility, and fee structure details. Thank you!');
      sendToWa(parts.join('\n'));
    });
  }

  // 7. Production / Garment Enquiry Form
  function initProductionForm() {
    const form = document.getElementById('production-form') || document.getElementById('garment-form');
    if (!form) return;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      clearErrors(form);
      let valid = true;
      const name = getVal(form, 'name');
      const org = getVal(form, 'organization');
      const phone = getVal(form, 'phone');
      const email = getVal(form, 'email');
      const product = getVal(form, 'product');
      const quantity = getVal(form, 'quantity');
      const message = getVal(form, 'message');

      if (!name) { showError(form, 'name', 'Please enter your name.'); valid = false; }
      if (!phone || !isValidPhone(phone)) { showError(form, 'phone', 'Please enter a valid phone.'); valid = false; }
      if (!product) { showError(form, 'product', 'Please select product category.'); valid = false; }

      if (!valid) return;
      const parts = [
        'Hello EmpowerHer! I would like to enquire about garment production / custom orders.',
        '',
        'Contact Person: ' + name
      ];
      if (org) parts.push('Organization  : ' + org);
      parts.push('Phone         : ' + phone);
      if (email) parts.push('Email         : ' + email);
      if (product) parts.push('Product Type  : ' + product);
      if (quantity) parts.push('Approx Qty    : ' + quantity);
      if (message) parts.push('', 'Requirements:', message);
      parts.push('', 'Please share quotation and catalog. Thank you!');
      sendToWa(parts.join('\n'));
    });
  }

  // 8. Donation Amount Selector
  function initDonationSelector() {
    const cards = document.querySelectorAll('.amount-card');
    const customInput = document.getElementById('custom-amount-input');
    const donateBtn   = document.getElementById('donate-wa-btn');
    if (!cards.length) return;
    let selectedAmount = '1000'; // default selected amount
    
    // Check initial active card
    const initialActive = document.querySelector('.amount-card.active');
    if (initialActive) {
      selectedAmount = initialActive.getAttribute('data-amount');
    }

    cards.forEach(function (card) {
      card.addEventListener('click', function () {
        cards.forEach(function (c) { c.classList.remove('active'); });
        card.classList.add('active');
        const val = card.getAttribute('data-amount');
        if (val === 'custom') {
          if (customInput) {
            customInput.style.display = 'block';
            customInput.focus();
          }
          selectedAmount = '';
        } else {
          if (customInput) customInput.style.display = 'none';
          selectedAmount = val;
        }
      });
    });

    if (donateBtn) {
      donateBtn.addEventListener('click', function (e) {
        e.preventDefault();
        let amount = selectedAmount;
        if (!amount && customInput) amount = customInput.value.trim();
        if (!amount) {
          alert('Please select or enter a donation amount.');
          return;
        }
        sendToWa('Hello EmpowerHer! I would like to donate \u20b9' + amount + ' to support your training and livelihood mission. Please share bank/UPI details and guidance. Thank you!');
      });
    }
  }

  function init() {
    initContactForm();
    initVolunteerForm();
    initCsrForm();
    initStoryForm();
    initTalkForm();
    initTrainingForm();
    initProductionForm();
    initDonationSelector();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
