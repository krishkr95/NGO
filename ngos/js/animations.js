/* ============================================================
   NGO WEBSITE — ANIMATIONS JS
   IntersectionObserver-driven scroll reveals, counter animation,
   bar chart growth, and carousel logic.
   ============================================================ */

(function () {
  'use strict';

  /* ── Scroll Reveal ─────────────────────────────────────── */
  function initReveal() {
    const els = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    if (!els.length) return;

    const io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    els.forEach(function (el) { io.observe(el); });
  }

  /* ── Counter Animation ─────────────────────────────────── */
  // Elements: <span class="counter" data-count="500" data-suffix="+">
  // [Configurable] data-count & data-suffix are read from HTML
  function animateCounter(el) {
    const target   = parseInt(el.getAttribute('data-count'), 10) || 0;
    const suffix   = el.getAttribute('data-suffix') || '+';
    const duration = 1800; // ms
    const startTime = performance.now();

    function update(now) {
      const elapsed  = now - startTime;
      const progress = Math.min(elapsed / duration, 1);
      // Ease out cubic
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.round(eased * target);
      el.textContent = current.toLocaleString('en-IN') + suffix;
      if (progress < 1) requestAnimationFrame(update);
    }

    requestAnimationFrame(update);
  }

  function initCounters() {
    const counters = document.querySelectorAll('.counter');
    if (!counters.length) return;

    const io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });

    counters.forEach(function (el) { io.observe(el); });
  }

  /* ── CSS Bar Chart ─────────────────────────────────────── */
  function initBarChart() {
    const bars = document.querySelectorAll('.bar-fill');
    if (!bars.length) return;

    const io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 });

    bars.forEach(function (bar) { io.observe(bar); });
  }

  /* ── Donation transparency bars ────────────────────────── */
  function initTransparencyBars() {
    const fills = document.querySelectorAll('.donut-bar-fill');
    if (!fills.length) return;

    const io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          const el = entry.target;
          el.style.width = el.getAttribute('data-width') || '0%';
          io.unobserve(el);
        }
      });
    }, { threshold: 0.3 });

    fills.forEach(function (el) {
      el.style.width = '0';
      io.observe(el);
    });
  }

  /* ── Testimonial Auto-Carousel ─────────────────────────── */
  function initTestiCarousels() {
    document.querySelectorAll('.testi-carousel').forEach(function (carousel) {
      const track  = carousel.querySelector('.testi-track');
      const slides = carousel.querySelectorAll('.testi-slide');
      const dotsEl = carousel.querySelector('.testi-dots');
      if (!track || !slides.length) return;

      let current = 0;
      let autoTimer = null;

      // Create dots
      if (dotsEl) {
        slides.forEach(function (_, i) {
          const dot = document.createElement('button');
          dot.className = 'testi-dot' + (i === 0 ? ' active' : '');
          dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
          dot.addEventListener('click', function () { goTo(i); });
          dotsEl.appendChild(dot);
        });
      }

      function goTo(index) {
        current = (index + slides.length) % slides.length;
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
        if (dotsEl) {
          dotsEl.querySelectorAll('.testi-dot').forEach(function (d, i) {
            d.classList.toggle('active', i === current);
          });
        }
      }

      function next() { goTo(current + 1); }

      function startAuto() {
        clearInterval(autoTimer);
        autoTimer = setInterval(next, 4500);
      }

      carousel.addEventListener('mouseenter', function () { clearInterval(autoTimer); });
      carousel.addEventListener('mouseleave', startAuto);

      startAuto();
    });
  }

  /* ── Accordion ─────────────────────────────────────────── */
  function initAccordions() {
    document.querySelectorAll('.accordion-trigger').forEach(function (btn) {
      btn.addEventListener('click', function () {
        const content = btn.nextElementSibling;
        const isOpen  = btn.classList.contains('active');

        // Close all in same group
        const parent = btn.closest('.accordion-group');
        if (parent) {
          parent.querySelectorAll('.accordion-trigger.active').forEach(function (b) {
            b.classList.remove('active');
            const c = b.nextElementSibling;
            if (c) c.classList.remove('open');
          });
        }

        if (!isOpen) {
          btn.classList.add('active');
          if (content) content.classList.add('open');
        }
      });
    });
  }

  /* ── Navbar scroll class ───────────────────────────────── */
  function initNavbar() {
    const nav = document.querySelector('.navbar');
    if (!nav) return;
    function onScroll() {
      nav.classList.toggle('scrolled', window.scrollY > 40);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ── Mobile menu ───────────────────────────────────────── */
  function initMobileMenu() {
    const toggle = document.getElementById('nav-toggle');
    const menu   = document.getElementById('mobile-menu');
    if (!toggle || !menu) return;

    toggle.addEventListener('click', function () {
      const open = menu.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open);
      document.body.style.overflow = open ? 'hidden' : '';
    });

    // Close on link click
    menu.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        menu.classList.remove('open');
        document.body.style.overflow = '';
      });
    });

    // Close on outside click
    document.addEventListener('click', function (e) {
      if (menu.classList.contains('open') && !menu.contains(e.target) && e.target !== toggle) {
        menu.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  }

  /* ── Story / Gallery filter ────────────────────────────── */
  function initFilter(barSelector, itemSelector) {
    const bar = document.querySelector(barSelector);
    if (!bar) return;

    bar.addEventListener('click', function (e) {
      const btn = e.target.closest('.filter-btn');
      if (!btn) return;

      bar.querySelectorAll('.filter-btn').forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');

      const cat = btn.getAttribute('data-filter') || 'all';
      document.querySelectorAll(itemSelector).forEach(function (item) {
        const itemCat = item.getAttribute('data-category') || '';
        const show = cat === 'all' || itemCat === cat;
        item.style.display = show ? '' : 'none';
        // re-trigger reveal
        if (show) {
          setTimeout(function () { item.classList.add('visible'); }, 50);
        }
      });
    });
  }

  /* ── Init all ──────────────────────────────────────────── */
  function init() {
    initNavbar();
    initMobileMenu();
    initReveal();
    initCounters();
    initBarChart();
    initTransparencyBars();
    initTestiCarousels();
    initAccordions();
    initFilter('.story-filter-bar', '.story-card[data-category]');
    initFilter('.gallery-filter-bar', '.gallery-item[data-category]');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
