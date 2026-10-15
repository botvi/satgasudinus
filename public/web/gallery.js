(function () {
  'use strict';
  var reduce = function () { return window.matchMedia('(prefers-reduced-motion: reduce)').matches || document.documentElement.classList.contains('a11y-calm'); };
  var $$ = function (q, r) { return Array.prototype.slice.call((r || document).querySelectorAll(q)); };
  var $ = function (q, r) { return (r || document).querySelector(q); };
  var rootEl = $('.gal');
  if (!rootEl) return;
      var track = $('.gal__track', rootEl); if (!track) return;
      var slides = $$('.gal__slide', track), dots = $$('.gal__dot', rootEl), btns = $$('.gal__btn', rootEl), count = $('.gal__count', rootEl);
      var raf = 0, drag = null;
      function cur() {
        var l = track.scrollLeft;
        if (l + track.clientWidth >= track.scrollWidth - 4) return slides.length - 1;
        var best = 0, min = 1e9;
        slides.forEach(function (sl, i) { var d = Math.abs(sl.offsetLeft - l); if (d < min) { min = d; best = i; } });
        return best;
      }
      function go(i) {
        i = Math.max(0, Math.min(slides.length - 1, i));
        track.scrollTo({ left: slides[i].offsetLeft, behavior: reduce() ? 'auto' : 'smooth' });
      }
      function paint() {
        raf = 0;
        var i = cur();
        count.textContent = (i + 1) + ' / ' + slides.length;
        dots.forEach(function (d, k) { if (k === i) d.setAttribute('aria-current', 'true'); else d.removeAttribute('aria-current'); });
        btns[0].disabled = i === 0; btns[1].disabled = i === slides.length - 1;
      }
      track.addEventListener('scroll', function () { if (!raf) raf = requestAnimationFrame(paint); }, { passive: true });
      btns.forEach(function (b) { b.addEventListener('click', function () { go(cur() + parseInt(b.getAttribute('data-dir'), 10)); }); });
      dots.forEach(function (d, k) { d.addEventListener('click', function () { go(k); }); });
      track.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowRight') { e.preventDefault(); go(cur() + 1); }
        if (e.key === 'ArrowLeft') { e.preventDefault(); go(cur() - 1); }
      });
      /* geser dengan mouse (sentuhan sudah ditangani scroll-snap bawaan) */
      track.addEventListener('pointerdown', function (e) {
        if (e.pointerType !== 'mouse' || e.button !== 0 || e.target.closest('video')) return;
        drag = { x: e.clientX, l: track.scrollLeft };
        track.classList.add('is-drag'); track.setPointerCapture(e.pointerId);
      });
      track.addEventListener('pointermove', function (e) { if (drag) track.scrollLeft = drag.l - (e.clientX - drag.x); });
      function endDrag() { if (!drag) return; drag = null; track.classList.remove('is-drag'); go(cur()); }
      track.addEventListener('pointerup', endDrag);
      track.addEventListener('pointercancel', endDrag);
      paint();
})();
