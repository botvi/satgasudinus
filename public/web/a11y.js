/* Panel aksesibilitas: ukuran teks, kontras, tautan bergaris bawah, kurangi animasi, font mudah dibaca,
   dikte suara (ucapan → teks) dan baca nyaring. Pilihan disimpan di localStorage. */
(function () {
  'use strict';
  var KEY = 'a11y', SIZES = [100, 112.5, 125, 150], SIZE_LABEL = ['Normal', 'Besar', 'Lebih besar', 'Terbesar'];
  var root = document.documentElement;
  var SR = window.SpeechRecognition || window.webkitSpeechRecognition;
  var TTS = 'speechSynthesis' in window && 'SpeechSynthesisUtterance' in window;
  var st = { size: 0, contrast: false, links: false, calm: false, font: false, dictate: false, read: false };
  try { Object.assign(st, JSON.parse(localStorage.getItem(KEY) || '{}')); } catch (e) {}

  var $ = function (q, r) { return (r || document).querySelector(q); };
  var save = function () { try { localStorage.setItem(KEY, JSON.stringify(st)); } catch (e) {} };
  var announce = function (msg) { live.textContent = ''; setTimeout(function () { live.textContent = msg; }, 30); };

  /* ---------- UI ---------- */
  var ICON = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="4.5" r="2"/><path d="M5 8.5l7 1.5 7-1.5M12 10v5m0 0-3.5 5.5M12 15l3.5 5.5"/></svg>';
  var MIC = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="3" width="6" height="11" rx="3"/><path d="M5 11a7 7 0 0 0 14 0M12 18v3"/></svg>';
  var SPK = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 5 6 9H3v6h3l5 4zM15.5 8.5a5 5 0 0 1 0 7M18.5 5.5a9 9 0 0 1 0 13"/></svg>';

  var SWITCHES = [
    ['contrast', 'Kontras tinggi', 'Warna lebih tegas dan mudah dibedakan.'],
    ['links', 'Garis bawah tautan', 'Semua tautan diberi garis bawah.'],
    ['calm', 'Kurangi animasi', 'Matikan gerak dan animasi 3D.'],
    ['font', 'Font mudah dibaca', 'Memakai font Lexend yang lebih lega.'],
    ['dictate', 'Dikte suara', SR ? 'Tombol mikrofon mengubah ucapan jadi teks di kolom isian.' : 'Belum didukung browser ini. Coba Chrome, Edge, atau Safari.'],
    ['read', 'Baca nyaring', TTS ? 'Membacakan halaman, teks yang dipilih, dan pesan di chat Lapor.' : 'Belum didukung browser ini.']
  ];

  var wrap = document.createElement('div');
  wrap.className = 'a11y';
  wrap.innerHTML =
    '<div class="a11y__tools">' +
      '<button type="button" class="a11y__fab a11y__tool" id="a11y-mic" hidden aria-label="Mulai dikte suara">' + MIC + '</button>' +
      '<button type="button" class="a11y__fab a11y__tool" id="a11y-read" hidden aria-label="Bacakan">' + SPK + '</button>' +
      '<button type="button" class="a11y__fab a11y__main" id="a11y-open" aria-haspopup="dialog" aria-expanded="false" aria-controls="a11y-panel" aria-label="Pengaturan aksesibilitas">' + ICON + '</button>' +
    '</div>' +
    '<div class="a11y__panel" id="a11y-panel" role="dialog" aria-modal="false" aria-labelledby="a11y-title" hidden>' +
      '<div class="a11y__head"><h2 id="a11y-title">Aksesibilitas</h2><button type="button" class="a11y__x" id="a11y-close" aria-label="Tutup">×</button></div>' +
      '<div class="a11y__row"><span id="a11y-sz-l">Ukuran teks</span>' +
        '<div class="a11y__size" role="group" aria-labelledby="a11y-sz-l">' +
          '<button type="button" id="a11y-sm" aria-label="Kecilkan teks">A−</button><output id="a11y-sz" aria-live="polite"></output><button type="button" id="a11y-lg" aria-label="Besarkan teks">A+</button>' +
        '</div></div>' +
      SWITCHES.map(function (s) {
        var off = (s[0] === 'dictate' && !SR) || (s[0] === 'read' && !TTS);
        return '<div class="a11y__row"><div><b id="sw-' + s[0] + '-l">' + s[1] + '</b><small id="sw-' + s[0] + '-d">' + s[2] + '</small></div>' +
          '<button type="button" class="a11y__sw" role="switch" data-k="' + s[0] + '" aria-checked="false" aria-labelledby="sw-' + s[0] + '-l" aria-describedby="sw-' + s[0] + '-d"' + (off ? ' disabled' : '') + '><i></i></button></div>';
      }).join('') +
      '<button type="button" class="a11y__reset" id="a11y-reset">Kembalikan ke bawaan</button>' +
    '</div>' +
    '<p class="sr" id="a11y-live" role="status" aria-live="polite"></p>';
  document.body.appendChild(wrap);

  var live = $('#a11y-live'), panel = $('#a11y-panel'), openBtn = $('#a11y-open');
  var micBtn = $('#a11y-mic'), readBtn = $('#a11y-read');

  /* ---------- Terapkan pengaturan ---------- */
  var fontLoaded = false;
  function apply() {
    root.style.fontSize = st.size ? SIZES[st.size] + '%' : '';
    root.classList.toggle('a11y-contrast', !!st.contrast);
    root.classList.toggle('a11y-links', !!st.links);
    root.classList.toggle('a11y-calm', !!st.calm);
    root.classList.toggle('a11y-font', !!st.font);
    if (st.font && !fontLoaded) {
      fontLoaded = true;
      var l = document.createElement('link'); l.rel = 'stylesheet';
      l.href = 'https://fonts.googleapis.com/css2?family=Lexend:wght@400..700&display=swap';
      document.head.appendChild(l);
    }
    $('#a11y-sz').textContent = SIZE_LABEL[st.size];
    $('#a11y-sm').disabled = st.size === 0; $('#a11y-lg').disabled = st.size === SIZES.length - 1;
    Array.prototype.forEach.call(wrap.querySelectorAll('.a11y__sw'), function (b) {
      b.setAttribute('aria-checked', String(!!st[b.getAttribute('data-k')]));
    });
    readBtn.hidden = !(st.read && TTS);
    if (!st.read) stopSpeak();
    if (!st.dictate) stopDictation();
    refreshMic();
    save();
  }

  function setPanel(open) {
    panel.hidden = !open;
    openBtn.setAttribute('aria-expanded', String(open));
    if (open) { var f = panel.querySelector('button:not([disabled])'); f && f.focus(); }
  }
  openBtn.addEventListener('click', function () { setPanel(panel.hidden); });
  $('#a11y-close').addEventListener('click', function () { setPanel(false); openBtn.focus(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !panel.hidden) { setPanel(false); openBtn.focus(); } });
  document.addEventListener('click', function (e) { if (!panel.hidden && !wrap.contains(e.target)) setPanel(false); });
  $('#a11y-sm').addEventListener('click', function () { st.size = Math.max(0, st.size - 1); apply(); announce('Ukuran teks ' + SIZE_LABEL[st.size]); });
  $('#a11y-lg').addEventListener('click', function () { st.size = Math.min(SIZES.length - 1, st.size + 1); apply(); announce('Ukuran teks ' + SIZE_LABEL[st.size]); });
  wrap.addEventListener('click', function (e) {
    var b = e.target.closest('.a11y__sw'); if (!b || b.disabled) return;
    var k = b.getAttribute('data-k'); st[k] = !st[k]; apply();
  });
  $('#a11y-reset').addEventListener('click', function () {
    st = { size: 0, contrast: false, links: false, calm: false, font: false, dictate: false, read: false };
    apply(); announce('Pengaturan dikembalikan ke bawaan');
  });

  /* ---------- Dikte suara ---------- */
  var target = null, rec = null, listening = false;
  var eligible = function (el) {
    return !!el && el.matches && el.matches('textarea,input:not([type]),input[type=text],input[type=search],input[type=tel]') && !el.readOnly && !el.disabled;
  };
  function refreshMic() {
    var show = st.dictate && !!SR && (listening || (target && document.contains(target)));
    micBtn.hidden = !show;
    micBtn.classList.toggle('is-on', listening);
    micBtn.setAttribute('aria-label', listening ? 'Hentikan dikte suara' : 'Mulai dikte suara');
    micBtn.setAttribute('aria-pressed', String(listening));
  }
  document.addEventListener('focusin', function (e) { if (eligible(e.target)) { target = e.target; refreshMic(); } });
  new MutationObserver(function () { if (target && !document.contains(target) && !listening) { target = null; refreshMic(); } })
    .observe(document.body, { childList: true, subtree: true });
  micBtn.addEventListener('mousedown', function (e) { e.preventDefault(); }); // jaga fokus di kolom isian

  function startDictation() {
    if (!SR || !target) return;
    var field = target, base = field.value, a = field.selectionStart == null ? base.length : field.selectionStart,
      z = field.selectionEnd == null ? a : field.selectionEnd;
    var pre = base.slice(0, a), post = base.slice(z);
    rec = new SR(); rec.lang = 'id-ID'; rec.continuous = true; rec.interimResults = true;
    rec.onresult = function (ev) {
      var t = '';
      for (var i = 0; i < ev.results.length; i++) t += ev.results[i][0].transcript;
      t = t.trim();
      var sep = pre && !/\s$/.test(pre) && t ? ' ' : '';
      field.value = pre + sep + t + post;
      field.dispatchEvent(new Event('input', { bubbles: true }));
    };
    rec.onerror = function (ev) {
      announce(ev.error === 'not-allowed' || ev.error === 'service-not-allowed' ? 'Izin mikrofon ditolak. Aktifkan di pengaturan browser.' : 'Dikte berhenti: ' + ev.error);
    };
    rec.onend = function () { listening = false; rec = null; refreshMic(); if (document.contains(field)) field.focus(); };
    try { rec.start(); listening = true; announce('Mendengarkan. Silakan bicara.'); } catch (e) { rec = null; }
    refreshMic();
  }
  function stopDictation() { if (rec) { try { rec.stop(); } catch (e) {} } }
  micBtn.addEventListener('click', function () { listening ? stopDictation() : startDictation(); });

  /* ---------- Baca nyaring ---------- */
  var voice = null;
  function pickVoice() {
    var v = TTS ? speechSynthesis.getVoices() : [];
    voice = v.filter(function (x) { return /^id([-_]|$)/i.test(x.lang); })[0] || null;
  }
  if (TTS) { pickVoice(); speechSynthesis.addEventListener && speechSynthesis.addEventListener('voiceschanged', pickVoice); }

  function chunks(text) {
    var parts = text.replace(/\s+/g, ' ').trim().match(/[^.!?;:]+[.!?;:]*\s*/g) || [], out = [], cur = '';
    parts.forEach(function (p) {
      if ((cur + p).length > 180 && cur) { out.push(cur); cur = ''; }
      cur += p;
    });
    if (cur.trim()) out.push(cur);
    return out;
  }
  function speak(text, queue) {
    if (!TTS || !text) return;
    if (!queue) speechSynthesis.cancel();
    chunks(text).forEach(function (c, i, all) {
      var u = new SpeechSynthesisUtterance(c);
      u.lang = 'id-ID'; if (voice) u.voice = voice;
      if (i === all.length - 1) u.onend = u.onerror = function () { if (!speechSynthesis.speaking) setReading(false); };
      speechSynthesis.speak(u);
    });
    setReading(true);
  }
  function stopSpeak() { if (TTS) speechSynthesis.cancel(); setReading(false); }
  function setReading(on) {
    readBtn.classList.toggle('is-on', on);
    readBtn.setAttribute('aria-pressed', String(on));
    readBtn.setAttribute('aria-label', on ? 'Hentikan pembacaan' : 'Bacakan halaman');
  }
  readBtn.addEventListener('click', function () {
    if (TTS && speechSynthesis.speaking) return stopSpeak();
    var sel = String(window.getSelection ? window.getSelection() : '').trim();
    var main = document.getElementById('konten');
    speak(sel || (main ? main.innerText : document.body.innerText));
  });
  window.addEventListener('pagehide', function () { if (TTS) speechSynthesis.cancel(); });

  // Pesan bot di chat Lapor dibacakan otomatis bila baca nyaring aktif.
  var log = document.getElementById('chat-log');
  if (log) {
    new MutationObserver(function (list) {
      if (!st.read) return;
      list.forEach(function (m) {
        Array.prototype.forEach.call(m.addedNodes, function (n) {
          if (n.nodeType === 1 && n.classList.contains('msg--bot') && !n.querySelector('.typing')) {
            speak(n.querySelector('.bubble').innerText, true);
          }
        });
      });
    }).observe(log, { childList: true });
  }

  apply();
})();
