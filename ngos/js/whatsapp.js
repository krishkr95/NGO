/* ============================================================
   NGO WEBSITE — WHATSAPP HELPER
   Reads data-whatsapp attributes and opens wa.me links.
   ============================================================ */

(function () {
  'use strict';

  /**
   * Build a WhatsApp URL.
   * @param {string} number  - WhatsApp number (digits only, incl. country code)
   * @param {string} message - Pre-filled message text
   * @returns {string} URL
   */
  function buildWaUrl(number, message) {
    const encoded = encodeURIComponent(message || '');
    return `https://wa.me/${number}?text=${encoded}`;
  }

  /**
   * Open WhatsApp with a given message.
   * Falls back to NGO_CONFIG.whatsapp if no number is provided.
   */
  function openWhatsApp(message, number) {
    const num = number || (typeof NGO_CONFIG !== 'undefined' ? NGO_CONFIG.whatsapp : '');
    if (!num) { console.warn('[WA] WhatsApp number not configured in config.js'); return; }
    window.open(buildWaUrl(num, message), '_blank', 'noopener');
  }

  /**
   * Wire up all elements with [data-whatsapp] attribute.
   * The value of data-whatsapp is used as the message.
   * Optional: data-wa-number overrides the default number.
   */
  function initWhatsAppButtons() {
    document.querySelectorAll('[data-whatsapp]').forEach(function (el) {
      el.addEventListener('click', function (e) {
        e.preventDefault();
        const msg = el.getAttribute('data-whatsapp') || '';
        const num = el.getAttribute('data-wa-number') || '';
        openWhatsApp(msg, num);
      });
    });
  }

  // ── Floating WhatsApp button (if present) ─────────────────
  function initFloatingButton() {
    const fab = document.getElementById('wa-fab');
    if (!fab) return;
    fab.addEventListener('click', function () {
      const msg = (typeof NGO_CONFIG !== 'undefined')
        ? NGO_CONFIG.messages.general
        : 'Hello! I would like to know more.';
      openWhatsApp(msg);
    });
  }

  // ── Public API ────────────────────────────────────────────
  window.WA = { open: openWhatsApp, buildUrl: buildWaUrl };

  // ── Init on DOM ready ─────────────────────────────────────
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      initWhatsAppButtons();
      initFloatingButton();
    });
  } else {
    initWhatsAppButtons();
    initFloatingButton();
  }
})();
