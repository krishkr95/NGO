/**
 * Bhopal Cares Forum (BCF) - Core Application Scripts
 * Navigation, Smooth Scrollspy, Drive Scheduler, Modals & Toast System
 */

(function () {
  'use strict';

  /* ==========================================================================
     1. Toast Notification System
     ========================================================================== */
  function showToast(message, duration = 3500) {
    let container = document.querySelector('.toast-container');
    if (!container) {
      container = document.createElement('div');
      container.className = 'toast-container';
      document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#52b788" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
        <polyline points="22 4 12 14.01 9 11.01"></polyline>
      </svg>
      <span>${message}</span>
    `;

    container.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(10px)';
      toast.style.transition = 'all 0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, duration);
  }

  /* ==========================================================================
     2. Sticky Header & Mobile Drawer
     ========================================================================== */
  function initNavigation() {
    const header = document.querySelector('.site-header');
    const mobileToggle = document.querySelector('.mobile-nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const navBackdrop = document.getElementById('navBackdrop');
    const navLinks = document.querySelectorAll('.nav-link');

    // Sticky glass transition on scroll
    window.addEventListener('scroll', () => {
      if (window.scrollY > 20) {
        header.classList.add('is-scrolled');
      } else {
        header.classList.remove('is-scrolled');
      }
    }, { passive: true });

    function openMobileDrawer() {
      if (!navMenu) return;
      navMenu.classList.add('is-open');
      if (mobileToggle) {
        mobileToggle.classList.add('is-open');
        mobileToggle.setAttribute('aria-expanded', 'true');
      }
      if (navBackdrop) navBackdrop.classList.add('is-active');
      document.body.classList.add('nav-open');
    }

    function closeMobileDrawer() {
      if (!navMenu) return;
      navMenu.classList.remove('is-open');
      if (mobileToggle) {
        mobileToggle.classList.remove('is-open');
        mobileToggle.setAttribute('aria-expanded', 'false');
      }
      if (navBackdrop) navBackdrop.classList.remove('is-active');
      document.body.classList.remove('nav-open');
    }

    // Toggle button handler
    if (mobileToggle && navMenu) {
      mobileToggle.addEventListener('click', () => {
        if (navMenu.classList.contains('is-open')) {
          closeMobileDrawer();
        } else {
          openMobileDrawer();
        }
      });
    }

    // Backdrop click closes menu
    if (navBackdrop) navBackdrop.addEventListener('click', closeMobileDrawer);

    // Close menu when clicking actions inside mobile drawer
    const drawerActionButtons = document.querySelectorAll('.drawer-actions button, .drawer-actions a');
    drawerActionButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        closeMobileDrawer();
      });
    });

    // Smooth scrolling & active state on navigation link clicks
    navLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        const href = link.getAttribute('href');
        if (href && href.startsWith('#')) {
          const targetEl = document.querySelector(href);
          if (targetEl) {
            e.preventDefault();
            const wasOpen = navMenu && navMenu.classList.contains('is-open');
            closeMobileDrawer();

            const headerOffset = 70;
            const elementPosition = targetEl.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            const performScroll = () => {
              window.scrollTo({
                top: Math.max(0, offsetPosition),
                behavior: 'smooth'
              });
            };

            // Allow layout unlock to settle before scrolling on mobile
            if (wasOpen) {
              setTimeout(performScroll, 50);
            } else {
              performScroll();
            }

            navLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');

            if (history.pushState) {
              history.pushState(null, null, href);
            }
          }
        }
      });
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && navMenu && navMenu.classList.contains('is-open')) {
        closeMobileDrawer();
      }
    });

    // Scrollspy active state
    const sections = document.querySelectorAll('section[id]');
    function checkActiveSection() {
      const scrollPos = window.scrollY + 110;
      sections.forEach(sec => {
        const top = sec.offsetTop;
        const height = sec.offsetHeight;
        const id = sec.getAttribute('id');
        if (scrollPos >= top && scrollPos < top + height) {
          navLinks.forEach(link => {
            if (link.getAttribute('href') === `#${id}`) {
              link.classList.add('active');
            } else {
              link.classList.remove('active');
            }
          });
        }
      });
    }

    window.addEventListener('scroll', checkActiveSection, { passive: true });
    checkActiveSection();
  }

  /* ==========================================================================
     3. Next Drive Live Countdown Timer
     ========================================================================== */
  function initCountdown() {
    const daysEl = document.getElementById('cdDays');
    const hoursEl = document.getElementById('cdHours');
    const minsEl = document.getElementById('cdMins');
    const secsEl = document.getElementById('cdSecs');

    if (!daysEl || !hoursEl || !minsEl || !secsEl) return;

    // Target the next upcoming Sunday 7:00 AM IST
    function getNextSundayDrive() {
      const now = new Date();
      const nextSunday = new Date(now);
      const day = now.getDay();
      const diff = (7 - day) % 7; // days to next Sunday

      nextSunday.setDate(now.getDate() + (diff === 0 && now.getHours() >= 10 ? 7 : diff));
      nextSunday.setHours(7, 0, 0, 0);

      if (nextSunday <= now) {
        nextSunday.setDate(nextSunday.getDate() + 7);
      }
      return nextSunday;
    }

    const targetDate = getNextSundayDrive();

    function updateTimer() {
      const now = new Date().getTime();
      const distance = targetDate.getTime() - now;

      if (distance < 0) {
        daysEl.textContent = '00';
        hoursEl.textContent = '00';
        minsEl.textContent = '00';
        secsEl.textContent = '00';
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      daysEl.textContent = String(days).padStart(2, '0');
      hoursEl.textContent = String(hours).padStart(2, '0');
      minsEl.textContent = String(minutes).padStart(2, '0');
      secsEl.textContent = String(seconds).padStart(2, '0');
    }

    updateTimer();
    setInterval(updateTimer, 1000);
  }

  /* ==========================================================================
     4. Interactive Drive Map & Location Selector (FR-6)
     ========================================================================== */
  const driveLocations = {
    upper_lake: {
      name: 'Upper Lake (Bada Talab) - VIP Road Pier',
      type: 'Lake Cleaning & Aquatic Shore Restoration',
      date: 'Next Sunday, 7:00 AM – 9:30 AM',
      assembly: 'Raja Bhoj Statue Viewpoint, VIP Road',
      coordinates: '23.2505° N, 77.3820° E',
      gear: 'Gloves & jute collection bags provided. Wear closed sports shoes.',
      mapsUrl: 'https://maps.google.com/?q=23.2505,77.3820+(Upper+Lake+Bhopal+VIP+Road)',
      drivesCount: '78 Drives Completed'
    },
    kaliyasot: {
      name: 'Kaliyasot Dam Shoreline & Green Belt',
      type: 'Debris Segregation & Waterbody Care',
      date: 'Second Sunday of Month, 6:45 AM',
      assembly: 'Kaliyasot Spillway Parking, Kolar Link Rd',
      coordinates: '23.1892° N, 77.4011° E',
      gear: 'Boots advised, reusable water bottles, sun cap.',
      mapsUrl: 'https://maps.google.com/?q=23.1892,77.4011+(Kaliyasot+Dam+Bhopal)',
      drivesCount: '34 Drives Completed'
    },
    shahpura: {
      name: 'Shahpura Lake Promenade',
      type: 'Plastic Clean & Native Sapling Care',
      date: 'Alternate Saturdays, 7:30 AM',
      assembly: 'Shahpura Lake Park Gate No. 2, Sector C',
      coordinates: '23.2081° N, 77.4285° E',
      gear: 'Watering cans, organic mulch, litter grabbers provided.',
      mapsUrl: 'https://maps.google.com/?q=23.2081,77.4285+(Shahpura+Lake+Bhopal)',
      drivesCount: '26 Drives Completed'
    },
    tekri: {
      name: 'Manuabhan Tekri Hill Ridges',
      type: 'Pre-Monsoon Seed Ball Dispersal',
      date: 'Monsoon Kickoff Special, 6:30 AM',
      assembly: 'Tekri Base Ropeway Parking Area',
      coordinates: '23.2845° N, 77.3712° E',
      gear: 'Sturdy trekking shoes, shoulder backpacks for seed balls.',
      mapsUrl: 'https://maps.google.com/?q=23.2845,77.3712+(Manuabhan+Tekri+Bhopal)',
      drivesCount: '16 Drives Completed'
    }
  };

  function initLocationSelector() {
    const locationItems = document.querySelectorAll('.location-item');
    const spotTitle = document.getElementById('spotlightTitle');
    const spotType = document.getElementById('spotlightType');
    const spotTime = document.getElementById('spotlightTime');
    const spotAssembly = document.getElementById('spotlightAssembly');
    const spotCoords = document.getElementById('spotlightCoords');
    const spotGear = document.getElementById('spotlightGear');
    const spotMapsBtn = document.getElementById('spotlightMapsBtn');

    if (!locationItems.length || !spotTitle) return;

    locationItems.forEach(item => {
      item.addEventListener('click', () => {
        locationItems.forEach(i => i.classList.remove('is-selected'));
        item.classList.add('is-selected');

        const locKey = item.getAttribute('data-location-key');
        const loc = driveLocations[locKey];
        if (!loc) return;

        spotTitle.textContent = loc.name;
        if (spotType) spotType.textContent = loc.type;
        if (spotTime) spotTime.textContent = loc.date;
        if (spotAssembly) spotAssembly.textContent = loc.assembly;
        if (spotCoords) spotCoords.textContent = loc.coordinates;
        if (spotGear) spotGear.textContent = loc.gear;
        if (spotMapsBtn) spotMapsBtn.href = loc.mapsUrl;

        showToast(`📍 Selected: ${loc.name}`);
      });
    });
  }

  /* ==========================================================================
     5. Pillar Card Accordion Toggles (FR-4.2)
     ========================================================================== */
  function initPillarAccordions() {
    const accordions = document.querySelectorAll('.pillar-details');
    accordions.forEach(acc => {
      const trigger = acc.querySelector('.pillar-accordion-trigger');
      if (trigger) {
        trigger.addEventListener('click', () => {
          const isExpanded = acc.classList.toggle('is-expanded');
          trigger.setAttribute('aria-expanded', isExpanded);
        });
      }
    });
  }

  /* ==========================================================================
     6. Video / BTS Preview Modal (FR-2.3)
     ========================================================================== */
  function initVideoModal() {
    const videoModal = document.getElementById('btsVideoModal');
    const videoOpenBtns = document.querySelectorAll('[data-trigger-bts]');
    const videoCloseBtn = document.getElementById('btsVideoClose');

    if (!videoModal) return;

    function openModal() {
      videoModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      videoModal.classList.remove('active');
      document.body.style.overflow = '';
      const iframe = videoModal.querySelector('iframe');
      if (iframe) {
        // Reset src to stop audio if video was playing
        const src = iframe.src;
        iframe.src = src;
      }
    }

    videoOpenBtns.forEach(btn => btn.addEventListener('click', openModal));
    if (videoCloseBtn) videoCloseBtn.addEventListener('click', closeModal);

    videoModal.addEventListener('click', (e) => {
      if (e.target === videoModal) closeModal();
    });
  }

  /* ==========================================================================
     7. CSR / Donation UPI Modal (Persona B)
     ========================================================================== */
  function initDonateModal() {
    const donateModal = document.getElementById('donateModal');
    const donateOpenBtns = document.querySelectorAll('[data-trigger-donate]');
    const donateCloseBtn = document.getElementById('donateModalClose');
    const copyUpiBtn = document.getElementById('copyUpiBtn');
    const upiText = 'bhopalcares@upi';

    if (!donateModal) return;

    function openModal() {
      donateModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      donateModal.classList.remove('active');
      document.body.style.overflow = '';
    }

    donateOpenBtns.forEach(btn => btn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal();
    }));

    if (donateCloseBtn) donateCloseBtn.addEventListener('click', closeModal);

    donateModal.addEventListener('click', (e) => {
      if (e.target === donateModal) closeModal();
    });

    if (copyUpiBtn) {
      copyUpiBtn.addEventListener('click', () => {
        navigator.clipboard.writeText(upiText).then(() => {
          showToast('📋 UPI ID copied: bhopalcares@upi');
          copyUpiBtn.textContent = 'Copied!';
          setTimeout(() => { copyUpiBtn.textContent = 'Copy UPI ID'; }, 2000);
        }).catch(() => {
          showToast('UPI ID: bhopalcares@upi');
        });
      });
    }

    // CSR report download simulator
    const downloadReportBtn = document.getElementById('btnDownloadReport');
    if (downloadReportBtn) {
      downloadReportBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showToast('📄 Generating 2025-2026 Annual Audit & CSR Impact Report...');
        setTimeout(() => {
          showToast('✅ BCF_Impact_Report_2025_26.pdf ready for download!');
        }, 1200);
      });
    }
  }

  /* ==========================================================================
     8. Newsletter Signup Simulation
     ========================================================================== */
  function initNewsletter() {
    const form = document.getElementById('newsletterForm');
    if (form) {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const emailInput = form.querySelector('input[type="email"]');
        if (emailInput && emailInput.value.includes('@')) {
          showToast(`🌱 Thank you! Weekend drive alerts sent to ${emailInput.value}`);
          emailInput.value = '';
        } else {
          showToast('⚠️ Please enter a valid email address');
        }
      });
    }
  }

  /* ==========================================================================
     Main Init
     ========================================================================== */
  function init() {
    initNavigation();
    initCountdown();
    initLocationSelector();
    initPillarAccordions();
    initVideoModal();
    initDonateModal();
    initNewsletter();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  window.BCFApp = { showToast };
})();
