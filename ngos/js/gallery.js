/* ============================================================
   NGO WEBSITE — GALLERY JS
   Lightbox with keyboard support, prev/next, counter, ESC close.
   ============================================================ */

(function () {
  'use strict';

  let images  = [];
  let current = 0;

  function buildLightbox() {
    if (document.getElementById('lightbox')) return;
    const lb = document.createElement('div');
    lb.id = 'lightbox'; lb.className = 'lightbox';
    lb.setAttribute('role', 'dialog'); lb.setAttribute('aria-modal', 'true'); lb.setAttribute('aria-label', 'Image viewer');
    lb.innerHTML = '<button class="lightbox-prev" id="lb-prev" aria-label="Previous image">&#8592;</button><div class="lightbox-inner"><button class="lightbox-close" id="lb-close" aria-label="Close lightbox">&times;</button><img class="lightbox-img" id="lb-img" src="" alt=""><p class="lightbox-caption" id="lb-caption"></p><p class="lightbox-counter" id="lb-counter"></p></div><button class="lightbox-next" id="lb-next" aria-label="Next image">&#8594;</button>';
    document.body.appendChild(lb);
    document.getElementById('lb-close').addEventListener('click', closeLightbox);
    document.getElementById('lb-prev').addEventListener('click', function () { navigate(-1); });
    document.getElementById('lb-next').addEventListener('click', function () { navigate(1); });
    lb.addEventListener('click', function (e) { if (e.target === lb) closeLightbox(); });
  }

  function collectImages() {
    images = [];
    document.querySelectorAll('.gallery-item[data-src]').forEach(function (el) {
      images.push({ src: el.getAttribute('data-src'), caption: el.getAttribute('data-caption') || '', category: el.getAttribute('data-category') || 'all' });
    });
  }

  function openLightbox(index) {
    if (!images.length) return;
    current = ((index % images.length) + images.length) % images.length;
    const lb = document.getElementById('lightbox');
    if (!lb) return;
    updateLightbox();
    lb.classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(function () { const cb = lb.querySelector('#lb-close'); if (cb) cb.focus(); }, 100);
  }

  function updateLightbox() {
    const img = document.getElementById('lb-img'), caption = document.getElementById('lb-caption'), counter = document.getElementById('lb-counter');
    if (!img) return;
    const item = images[current];
    img.src = item.src; img.alt = item.caption;
    if (caption) caption.textContent = item.caption;
    if (counter) counter.textContent = (current + 1) + ' / ' + images.length;
  }

  function navigate(dir) {
    current = ((current + dir) + images.length) % images.length;
    updateLightbox();
  }

  function closeLightbox() {
    const lb = document.getElementById('lightbox');
    if (lb) lb.classList.remove('open');
    document.body.style.overflow = '';
  }

  function initKeyboard() {
    document.addEventListener('keydown', function (e) {
      const lb = document.getElementById('lightbox');
      if (!lb || !lb.classList.contains('open')) return;
      if (e.key === 'Escape')     closeLightbox();
      if (e.key === 'ArrowLeft')  navigate(-1);
      if (e.key === 'ArrowRight') navigate(1);
    });
  }

  function initGalleryItems() {
    document.querySelectorAll('.gallery-item[data-src]').forEach(function (el, index) {
      el.setAttribute('tabindex', '0');
      el.addEventListener('click', function () { openLightbox(index); });
      el.addEventListener('keydown', function (e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openLightbox(index); } });
    });
  }

  function init() {
    buildLightbox();
    collectImages();
    initGalleryItems();
    initKeyboard();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
