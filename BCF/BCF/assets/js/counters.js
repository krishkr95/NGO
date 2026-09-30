/**
 * Bhopal Cares Forum (BCF) - Counter Engine
 * FR-3: IntersectionObserver animated counters with smooth easing & fallback
 */

(function () {
  'use strict';

  // Smooth easing function: easeOutExpo
  function easeOutExpo(x) {
    return x === 1 ? 1 : 1 - Math.pow(2, -10 * x);
  }

  // Format numbers with comma separators (e.g. 4,260)
  function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  }

  function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'), 10);
    if (isNaN(target)) return;

    const duration = 1500; // 1.5 seconds per FR-3.2
    const startTime = performance.now();

    function step(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const easedProgress = easeOutExpo(progress);
      const currentVal = Math.floor(easedProgress * target);

      element.textContent = formatNumber(currentVal);

      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        element.textContent = formatNumber(target);
      }
    }

    requestAnimationFrame(step);
  }

  function initCounters() {
    const counterElements = document.querySelectorAll('[data-counter]');
    if (!counterElements.length) return;

    // Check for IntersectionObserver support (FR-3.3 graceful fallback)
    if (!('IntersectionObserver' in window)) {
      counterElements.forEach(el => {
        const target = el.getAttribute('data-target');
        if (target) el.textContent = formatNumber(target);
      });
      return;
    }

    const observerOptions = {
      root: null,
      rootMargin: '0px 0px -50px 0px',
      threshold: 0.2
    };

    const counterObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target); // Animate only once
        }
      });
    }, observerOptions);

    counterElements.forEach(el => {
      // Initialize with 0 per FR-3.1
      el.textContent = '0';
      counterObserver.observe(el);
    });
  }

  // Auto initialize on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCounters);
  } else {
    initCounters();
  }

  window.BCFCounters = { initCounters, formatNumber };
})();
