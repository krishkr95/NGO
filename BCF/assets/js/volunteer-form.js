/**
 * Bhopal Cares Forum (BCF) - Volunteer Onboarding Engine
 * FR-6: 3-Step Interactive Onboarding Modal + Validation + WhatsApp Community Connect
 */

(function () {
  'use strict';

  // Indian Mobile Regex: starts with 6, 7, 8, or 9 and has 10 digits
  const PHONE_REGEX = /^[6-9]\d{9}$/;
  const WHATSAPP_COMMUNITY_URL = 'https://chat.whatsapp.com/invite/bhopal-cares-community';

  let currentStep = 1;
  const totalSteps = 3;

  const volunteerModal = document.getElementById('volunteerModal');
  const volunteerForm = document.getElementById('volunteerForm');
  const progressLine = document.getElementById('stepProgressLine');
  const stepItems = document.querySelectorAll('.step-item');
  const formSteps = document.querySelectorAll('.form-step');

  const btnPrevStep = document.getElementById('btnPrevStep');
  const btnNextStep = document.getElementById('btnNextStep');
  const btnSubmitStep = document.getElementById('btnSubmitStep');

  // Input elements
  const inputName = document.getElementById('volName');
  const inputPhone = document.getElementById('volPhone');
  const inputArea = document.getElementById('volArea');
  const inputOtherArea = document.getElementById('volOtherArea');
  const groupOtherArea = document.getElementById('groupOtherArea');

  function openVolunteerModal(prefillActivity) {
    if (!volunteerModal) return;
    volunteerModal.classList.add('active');
    document.body.style.overflow = 'hidden';

    // If prefilling an activity from card click
    if (prefillActivity) {
      const checkbox = document.querySelector(`input[name="activity"][value="${prefillActivity}"]`);
      if (checkbox) {
        checkbox.checked = true;
        const card = checkbox.closest('.choice-card');
        if (card) card.classList.add('selected');
      }
    }

    goToStep(1);
    if (inputName) inputName.focus();
  }

  function closeVolunteerModal() {
    if (!volunteerModal) return;
    volunteerModal.classList.remove('active');
    document.body.style.overflow = '';
  }

  function updateStepUI() {
    // Update step numbers and active classes
    stepItems.forEach((item, index) => {
      const stepNum = index + 1;
      item.classList.remove('active', 'completed');
      if (stepNum === currentStep) {
        item.classList.add('active');
      } else if (stepNum < currentStep) {
        item.classList.add('completed');
      }
    });

    // Update progress line width
    if (progressLine) {
      const percent = ((currentStep - 1) / (totalSteps - 1)) * 100;
      progressLine.style.width = `calc(${percent}% - 60px * ${1 - percent / 100})`;
    }

    // Toggle form steps
    formSteps.forEach(step => {
      const sNum = parseInt(step.getAttribute('data-step'), 10);
      if (sNum === currentStep) {
        step.classList.add('active');
      } else {
        step.classList.remove('active');
      }
    });

    // Toggle navigation buttons
    if (currentStep === 1) {
      if (btnPrevStep) btnPrevStep.style.visibility = 'hidden';
      if (btnNextStep) btnNextStep.style.display = 'inline-flex';
      if (btnSubmitStep) btnSubmitStep.style.display = 'none';
    } else if (currentStep === totalSteps) {
      if (btnPrevStep) btnPrevStep.style.visibility = 'visible';
      if (btnNextStep) btnNextStep.style.display = 'none';
      if (btnSubmitStep) btnSubmitStep.style.display = 'inline-flex';
    } else {
      if (btnPrevStep) btnPrevStep.style.visibility = 'visible';
      if (btnNextStep) btnNextStep.style.display = 'inline-flex';
      if (btnSubmitStep) btnSubmitStep.style.display = 'none';
    }
  }

  function goToStep(step) {
    if (step < 1 || step > totalSteps) return;
    currentStep = step;
    updateStepUI();
  }

  function validateStep(step) {
    let isValid = true;

    if (step === 1) {
      // Validate Name
      const nameVal = inputName ? inputName.value.trim() : '';
      const nameGroup = inputName ? inputName.closest('.form-group') : null;
      if (!nameVal || nameVal.length < 2) {
        if (inputName) inputName.classList.add('is-invalid');
        if (nameGroup) nameGroup.classList.add('has-error');
        isValid = false;
      } else {
        if (inputName) inputName.classList.remove('is-invalid');
        if (nameGroup) nameGroup.classList.remove('has-error');
      }

      // Validate Phone (Indian regex)
      const phoneVal = inputPhone ? inputPhone.value.trim().replace(/\D/g, '') : '';
      const phoneGroup = inputPhone ? inputPhone.closest('.form-group') : null;
      if (!PHONE_REGEX.test(phoneVal)) {
        if (inputPhone) inputPhone.classList.add('is-invalid');
        if (phoneGroup) phoneGroup.classList.add('has-error');
        isValid = false;
      } else {
        if (inputPhone) inputPhone.classList.remove('is-invalid');
        if (phoneGroup) phoneGroup.classList.remove('has-error');
      }

      // Validate Area
      const areaVal = inputArea ? inputArea.value : '';
      const areaGroup = inputArea ? inputArea.closest('.form-group') : null;
      if (!areaVal) {
        if (inputArea) inputArea.classList.add('is-invalid');
        if (areaGroup) areaGroup.classList.add('has-error');
        isValid = false;
      } else {
        if (inputArea) inputArea.classList.remove('is-invalid');
        if (areaGroup) areaGroup.classList.remove('has-error');
      }
    } else if (step === 2) {
      // Validate at least 1 activity selected
      const selectedActivities = document.querySelectorAll('input[name="activity"]:checked');
      const activityGroup = document.getElementById('activityCardsGroup');
      const activityError = document.getElementById('activityError');

      if (selectedActivities.length === 0) {
        if (activityError) activityError.style.display = 'block';
        isValid = false;
      } else {
        if (activityError) activityError.style.display = 'none';
      }
    } else if (step === 3) {
      // Step 3 has radio chips with default selections, but check availability
      const availability = document.querySelector('input[name="availability"]:checked');
      const availError = document.getElementById('availError');
      if (!availability) {
        if (availError) availError.style.display = 'block';
        isValid = false;
      } else {
        if (availError) availError.style.display = 'none';
      }
    }

    return isValid;
  }

  function handleFormSubmit(e) {
    e.preventDefault();

    if (!validateStep(3)) return;

    // Collect Data
    const name = inputName ? inputName.value.trim() : 'Volunteer';
    const phone = inputPhone ? inputPhone.value.trim() : '';
    const area = inputArea && inputArea.value === 'Other' && inputOtherArea 
      ? inputOtherArea.value.trim() 
      : (inputArea ? inputArea.value : 'Bhopal');

    const activities = Array.from(document.querySelectorAll('input[name="activity"]:checked'))
      .map(el => el.value);

    const availability = document.querySelector('input[name="availability"]:checked') 
      ? document.querySelector('input[name="availability"]:checked').value 
      : 'This Sunday';

    const tShirt = document.querySelector('input[name="tshirt"]:checked')
      ? document.querySelector('input[name="tshirt"]:checked').value
      : 'L';

    const volunteerPayload = {
      name,
      phone,
      area,
      activities,
      availability,
      tShirt,
      timestamp: new Date().toISOString()
    };

    // Store in localStorage for instant retrieval and offline persistence
    try {
      const existingList = JSON.parse(localStorage.getItem('bcf_volunteers') || '[]');
      existingList.push(volunteerPayload);
      localStorage.setItem('bcf_volunteers', JSON.stringify(existingList));
    } catch (err) {
      console.warn('Storage save error:', err);
    }

    // Build personalized WhatsApp redirect link
    const waText = encodeURIComponent(
      `Hi Bhopal Cares Forum! 🌿 I just registered to volunteer on the platform.\n` +
      `*Name:* ${name}\n` +
      `*Area:* ${area}\n` +
      `*Interests:* ${activities.join(', ')}\n` +
      `*Availability:* ${availability}\n` +
      `Ready to join the next Sunday drive!`
    );
    const personalizedWhatsAppLink = `https://wa.me/919425000000?text=${waText}`;

    // Render Success Screen inside Modal
    renderSuccessScreen(name, personalizedWhatsAppLink);
  }

  function renderSuccessScreen(userName, waLink) {
    const modalBody = document.querySelector('#volunteerModal .modal-body');
    const modalTracker = document.querySelector('#volunteerModal .step-tracker');
    const modalStepNav = document.querySelector('#volunteerModal .modal-step-nav');

    if (modalTracker) modalTracker.style.display = 'none';
    if (modalStepNav) modalStepNav.style.display = 'none';

    if (modalBody) {
      modalBody.innerHTML = `
        <div class="form-success-card">
          <div class="form-success-card__icon-wrap">✓</div>
          <h3 class="form-success-card__title">Welcome to the BCF Family, ${userName}!</h3>
          <p class="form-success-card__subtitle">
            Your volunteer onboarding profile is confirmed. You're now part of Bhopal's largest lake and urban ecology movement.
          </p>

          <div class="whatsapp-card-box">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
              <span style="font-size: 1.5rem;">📲</span>
              <div>
                <strong style="font-family: var(--font-display); font-size: 1rem; color: #166534;">Final Step: Join Sunday Volunteer Group</strong>
                <p style="font-size: 0.82rem; color: #15803d; margin: 0;">Get real-time meeting pin coordinates, route maps, and weather updates directly on WhatsApp.</p>
              </div>
            </div>
          </div>

          <div style="display: flex; flex-direction: column; gap: 12px; margin-top: var(--space-lg);">
            <a href="${waLink}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg" style="width: 100%;">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.299.144.347.491 1.2.534 1.288.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.087-.179.182-.077.357.101.174.45 0.744.966 1.204.664.593 1.224.776 1.397.863.173.087.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.144.39-.087s1.011.477 1.184.564.289.13.332.202c.043.072.043.419-.101.824z"/>
              </svg>
              Join Bhopal Cares WhatsApp Community
            </a>
            <button type="button" class="btn btn-secondary" onclick="BCFVolunteer.closeVolunteerModal();">
              Done & Return to Homepage
            </button>
          </div>
        </div>
      `;
    }

    if (window.BCFApp && window.BCFApp.showToast) {
      window.BCFApp.showToast('🎉 Volunteer registration successful!');
    }
  }

  function init() {
    // Setup area dropdown toggle for "Other"
    if (inputArea && groupOtherArea) {
      inputArea.addEventListener('change', () => {
        if (inputArea.value === 'Other') {
          groupOtherArea.style.display = 'block';
          if (inputOtherArea) inputOtherArea.focus();
        } else {
          groupOtherArea.style.display = 'none';
        }
      });
    }

    // Choice cards interactivity
    const choiceCards = document.querySelectorAll('.choice-card');
    choiceCards.forEach(card => {
      const input = card.querySelector('input');
      card.addEventListener('click', (e) => {
        if (e.target !== input) {
          input.checked = !input.checked;
        }
        if (input.checked) {
          card.classList.add('selected');
        } else {
          card.classList.remove('selected');
        }
        const activityError = document.getElementById('activityError');
        if (activityError) activityError.style.display = 'none';
      });
    });

    // Navigation buttons
    if (btnNextStep) {
      btnNextStep.addEventListener('click', () => {
        if (validateStep(currentStep)) {
          goToStep(currentStep + 1);
        }
      });
    }

    if (btnPrevStep) {
      btnPrevStep.addEventListener('click', () => {
        goToStep(currentStep - 1);
      });
    }

    if (volunteerForm) {
      volunteerForm.addEventListener('submit', handleFormSubmit);
    }

    // Modal close button
    const closeBtn = document.getElementById('volunteerModalClose');
    if (closeBtn) closeBtn.addEventListener('click', closeVolunteerModal);

    if (volunteerModal) {
      volunteerModal.addEventListener('click', (e) => {
        if (e.target === volunteerModal) closeVolunteerModal();
      });
    }

    // Triggers across the page
    document.querySelectorAll('[data-trigger-volunteer]').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const activity = btn.getAttribute('data-activity') || '';
        openVolunteerModal(activity);
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  window.BCFVolunteer = {
    openVolunteerModal,
    closeVolunteerModal,
    goToStep
  };
})();
