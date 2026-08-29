/* ============================================================
   NGO WEBSITE — MAIN JS
   General page utilities: active nav link, smooth anchor links,
   back-to-top, floating WhatsApp button injection.
   ============================================================ */

(function () {
  'use strict';

  /* ── Mark active nav link ──────────────────────────────── */
  function markActiveNav() {
    const page = window.location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.nav-links a, .mobile-menu a').forEach(function (a) {
      const href = a.getAttribute('href') || '';
      if (href === page || (page === '' && href === 'index.html')) {
        a.classList.add('active');
      }
    });
  }

  /* ── Smooth scroll for anchor links ────────────────────── */
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function (a) {
      a.addEventListener('click', function (e) {
        const id = a.getAttribute('href').slice(1);
        const target = document.getElementById(id);
        if (!target) return;
        e.preventDefault();
        const offset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--nav-height'), 10) || 76;
        const top = target.getBoundingClientRect().top + window.scrollY - offset - 16;
        window.scrollTo({ top: top, behavior: 'smooth' });
      });
    });
  }

  /* ── Back-to-top button ────────────────────────────────── */
  function initBackToTop() {
    const btn = document.createElement('button');
    btn.id = 'back-to-top';
    btn.setAttribute('aria-label', 'Back to top');
    btn.innerHTML = '&#8679;';
    btn.style.cssText = [
      'position:fixed', 'bottom:90px', 'right:22px',
      'width:44px', 'height:44px',
      'background:var(--primary)', 'color:#fff',
      'border:none', 'border-radius:50%',
      'font-size:1.4rem', 'cursor:pointer',
      'display:none', 'align-items:center', 'justify-content:center',
      'z-index:900', 'box-shadow:0 4px 16px rgba(31,111,84,.35)',
      'transition:all .3s ease'
    ].join(';');

    document.body.appendChild(btn);

    window.addEventListener('scroll', function () {
      btn.style.display = window.scrollY > 400 ? 'flex' : 'none';
    }, { passive: true });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ── Inject floating WhatsApp FAB ──────────────────────── */
  function initWaFab() {
    if (document.getElementById('wa-fab')) return;
    const fab = document.createElement('a');
    fab.id = 'wa-fab';
    fab.setAttribute('aria-label', 'Chat on WhatsApp');
    fab.setAttribute('target', '_blank');
    fab.setAttribute('rel', 'noopener');

    const num = (typeof NGO_CONFIG !== 'undefined') ? NGO_CONFIG.whatsapp : '';
    const msg = (typeof NGO_CONFIG !== 'undefined') ? NGO_CONFIG.messages.general : 'Hello!';
    fab.href = 'https://wa.me/' + num + '?text=' + encodeURIComponent(msg);

    fab.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.555 4.116 1.527 5.847L.057 23.994l6.305-1.654A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.003-1.368l-.36-.214-3.737.979 1-3.636-.234-.374A9.818 9.818 0 1112 21.818z"/></svg>';

    fab.style.cssText = [
      'position:fixed', 'bottom:22px', 'right:22px',
      'width:54px', 'height:54px',
      'background:#25d366', 'border-radius:50%',
      'display:flex', 'align-items:center', 'justify-content:center',
      'z-index:900',
      'box-shadow:0 4px 20px rgba(37,211,102,.45)',
      'transition:transform .3s ease, box-shadow .3s ease'
    ].join(';');

    fab.addEventListener('mouseenter', function () { fab.style.transform = 'scale(1.1)'; });
    fab.addEventListener('mouseleave', function () { fab.style.transform = 'scale(1)'; });

    document.body.appendChild(fab);
  }

  /* ── Init ──────────────────────────────────────────────── */
  function init() {
    markActiveNav();
    initSmoothScroll();
    initBackToTop();
    initWaFab();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
