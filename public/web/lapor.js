(function () {
  'use strict';
  /* Set DEMO = false setelah submitReport() terhubung ke server. */
  var DEMO = false;
  var MAX_MB = 2;

  var reduce = function () { return window.matchMedia('(prefers-reduced-motion: reduce)').matches || document.documentElement.classList.contains('a11y-calm'); };
  var $ = function (q, r) { return (r || document).querySelector(q); };
  var $$ = function (q, r) { return Array.prototype.slice.call((r || document).querySelectorAll(q)); };
  var ABORT = { abort: true };

  var SECTIONS = [
    { id: 'identitas', label: 'Identitas', intro: 'Kita mulai dari identitas Anda.' },
    { id: 'pelapor', label: 'Pelapor', intro: 'Sekarang, tentang posisi Anda dalam peristiwa ini.' },
    { id: 'terlapor', label: 'Terlapor', intro: 'Berikutnya, pihak yang dilaporkan. Jika belum tahu, Anda boleh melewati.' },
    { id: 'peristiwa', label: 'Peristiwa', intro: 'Terakhir, ceritakan peristiwanya.' }
  ];

  /* Pertanyaan mengikuti field pada form laporan asli.
     req:true = harus diisi; skip = teks tombol untuk melewati. Opsi pilihan adalah perkiraan, sesuaikan. */
  var phoneOk = function (v) { return /^\+?\d{8,15}$/.test(v.replace(/[\s-]/g, '')) || 'Nomor HP harus berupa angka, 8 sampai 15 digit. Boleh diawali +.'; };
  var STEPS = [
    { id: 'nama', sec: 'identitas', label: 'Nama lengkap', q: 'Siapa nama lengkap Anda?', type: 'text', ph: 'Masukkan Nama Lengkap', ac: 'name',
      v: function (v) { return v.length >= 3 || 'Tulis nama lengkap, minimal 3 karakter.'; } },
    { id: 'nik', sec: 'identitas', label: 'Nomor identitas', q: 'Berapa nomor identitas Anda? Isi NIK jika memakai KTP, atau NIM jika memakai KTM.', type: 'text', ph: 'Masukkan Nomor Identitas', ac: 'off',
      v: function (v) { return /^[A-Za-z0-9.\-\/]{5,25}$/.test(v) || 'Nomor identitas terdiri dari 5 sampai 25 huruf, angka, atau tanda . - /.'; } },
    { id: 'fileId', sec: 'identitas', label: 'File identitas', q: 'Unggah foto atau pindaian KTP atau KTM Anda.', type: 'file' },
    { id: 'alamat', sec: 'identitas', label: 'Alamat', q: 'Di mana alamat Anda saat ini?', type: 'text', ph: 'Masukkan Alamat', ac: 'street-address',
      v: function (v) { return v.length >= 5 || 'Tulis alamat dengan lebih lengkap.'; } },
    { id: 'hp', sec: 'identitas', label: 'No HP', q: 'Nomor HP mana yang bisa kami hubungi?', type: 'text', mode: 'tel', ph: 'Masukkan No HP', ac: 'tel', v: phoneOk },
    { id: 'email', sec: 'identitas', label: 'Email', q: 'Alamat email Anda?', type: 'text', mode: 'email', ph: 'Masukkan Email', ac: 'email',
      v: function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v) || 'Format email belum sesuai. Contoh: nama@domain.com'; } },
    { id: 'unit', sec: 'identitas', label: 'Unit kerja/fakultas/instansi', q: 'Dari unit kerja, fakultas, atau instansi mana Anda?', type: 'text', ph: 'Masukkan Nama Unit Kerja/Fakultas/Instansi', ac: 'organization',
      v: function (v) { return v.length >= 2 || 'Tulis nama unit kerja, fakultas, atau instansi.'; } },

    { id: 'statusP', sec: 'pelapor', label: 'Status pelapor', q: 'Apa status Anda?', type: 'choice', options: ['Mahasiswa', 'Dosen', 'Tenaga Kependidikan', 'Masyarakat Umum'] },
    { id: 'kategori', sec: 'pelapor', label: 'Kategori', q: 'Apa posisi Anda dalam peristiwa ini?', type: 'choice', options: ['Korban', 'Pelapor/Saksi'] },

    { id: 'namaT', sec: 'terlapor', label: 'Nama terlapor', q: 'Siapa nama lengkap terlapor?', type: 'text', ph: 'Masukkan Nama Lengkap Terlapor', ac: 'off', skip: 'Tidak tahu',
      v: function (v) { return v.length >= 2 || 'Tulis nama terlapor, atau pilih “Tidak tahu”.'; } },
    { id: 'statusT', sec: 'terlapor', label: 'Status terlapor', q: 'Apa status terlapor?', type: 'choice', options: ['Mahasiswa', 'Dosen', 'Tenaga Kependidikan', 'Masyarakat Umum'] },
    { id: 'hpT', sec: 'terlapor', label: 'No HP terlapor', q: 'Apakah Anda punya nomor HP terlapor?', type: 'text', mode: 'tel', ph: 'Masukkan No HP Terlapor', ac: 'off', skip: 'Tidak tahu', v: phoneOk },

    { id: 'jenis', sec: 'peristiwa', label: 'Jenis peristiwa', q: 'Apa jenis peristiwa yang terjadi? Tulis singkat saja.', type: 'text', ph: 'Masukkan Jenis Peristiwa', ac: 'off',
      v: function (v) { return v.length >= 3 || 'Tulis jenis peristiwa, minimal 3 karakter.'; } },
    { id: 'tanggal', sec: 'peristiwa', label: 'Tanggal peristiwa', q: 'Kapan peristiwa itu terjadi?', type: 'date',
      v: function (v) { return (!!v && v <= todayISO()) || 'Pilih tanggal kejadian. Tanggal tidak boleh di masa depan.'; } },
    { id: 'lokasi', sec: 'peristiwa', label: 'Lokasi peristiwa', q: 'Di mana kejadiannya?', type: 'text', ph: 'Masukkan Lokasi Peristiwa', ac: 'off',
      v: function (v) { return v.length >= 3 || 'Tulis lokasi kejadian, minimal 3 karakter.'; } },
    { id: 'kronologi', sec: 'peristiwa', label: 'Kronologi', q: 'Ceritakan kronologinya dengan kata-kata Anda sendiri. Tulis sebanyak yang Anda nyaman.', type: 'area', ph: 'Masukkan Kronologi Peristiwa',
      v: function (v) { return v.length >= 20 || 'Kronologi perlu sedikit lebih lengkap, minimal 20 karakter.'; } },
    { id: 'bukti', sec: 'peristiwa', label: 'Bukti', q: 'Apakah Anda punya bukti tindakan atau foto lokasi kejadian?', type: 'file', skip: 'Tidak ada bukti' }
  ];

  var ICON_SEND = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 19V5m0 0-6 6m6-6 6 6"/></svg>';
  var ICON_CLIP = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>';

  var root = $('[data-view="lapor"]');
  var log = $('#chat-log'), dock = $('#chat-dock'), bar = $('#chat-bar'), prog = $('#chat-prog');
  var stepsEl = $('#lp-steps'), resetBtn = $('#chat-reset');
  if (DEMO) $('#demo-note').hidden = false;

  var state, runId = 0, lastWho = null, urls = [], started = false;

  function todayISO() { var d = new Date(); return d.getFullYear() + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2); }
  function fmtDate(iso) { var p = iso.split('-'); return new Date(+p[0], +p[1] - 1, +p[2]).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }); }
  function fmtSize(b) { return b < 1048576 ? Math.max(1, Math.round(b / 1024)) + ' KB' : (b / 1048576).toFixed(1) + ' MB'; }
  function sleep(ms) { return new Promise(function (r) { setTimeout(r, ms); }); }
  function stepById(id) { for (var i = 0; i < STEPS.length; i++) if (STEPS[i].id === id) return STEPS[i]; return null; }
  function go(p) { p.catch(function (e) { if (e !== ABORT) console.error(e); }); }
  function el(html) { var t = document.createElement('template'); t.innerHTML = html.trim(); return t.content.firstChild; }

  /* ---------- Log pesan ---------- */
  function scrollDown() { log.scrollTo({ top: log.scrollHeight, behavior: reduce() ? 'auto' : 'smooth' }); }
  function addMsg(who, content, wide) {
    var m = document.createElement('div');
    m.className = 'msg msg--' + who + (lastWho === who ? ' msg--cont' : '');
    if (who === 'bot') m.innerHTML = '<span class="msg__av logo-img" aria-hidden="true"></span>';
    var b = document.createElement('div');
    b.className = 'bubble' + (wide ? ' bubble--wide' : '');
    if (typeof content === 'string') b.textContent = content; else b.appendChild(content);
    m.appendChild(b); log.appendChild(m); lastWho = who; scrollDown();
    return m;
  }
  async function say(content, wide) {
    var id = runId;
    var t = document.createElement('div');
    t.className = 'msg msg--bot' + (lastWho === 'bot' ? ' msg--cont' : '');
    t.innerHTML = '<span class="msg__av logo-img" aria-hidden="true"></span><div class="bubble typing"><i></i><i></i><i></i></div>';
    log.appendChild(t); scrollDown();
    var len = typeof content === 'string' ? content.length : 80;
    await sleep(reduce() ? 0 : Math.min(1300, 350 + len * 9));
    t.remove();
    if (id !== runId) throw ABORT;
    return addMsg('bot', content, wide);
  }

  /* ---------- Kemajuan ---------- */
  function update() {
    var total = STEPS.length, done = STEPS.filter(function (s) { return state.answers[s.id]; }).length;
    var pct = Math.round(done / total * 100);
    bar.firstElementChild.style.width = pct + '%';
    bar.setAttribute('aria-valuenow', String(pct));
    prog.textContent = done + ' dari ' + total + ' pertanyaan dijawab';
    var nextIdx = STEPS.findIndex(function (s) { return !state.answers[s.id]; });
    var curSec = nextIdx < 0 ? null : STEPS[nextIdx].sec;
    stepsEl.innerHTML = SECTIONS.map(function (sec) {
      var all = STEPS.filter(function (s) { return s.sec === sec.id; });
      var n = all.filter(function (s) { return state.answers[s.id]; }).length;
      var cls = n === all.length ? 'is-done' : (sec.id === curSec && state.started ? 'is-current' : '');
      return '<li class="' + cls + '"><span class="lp-dot" aria-hidden="true"></span><span>' + sec.label + (cls === 'is-done' ? '<span class="sr"> selesai</span>' : '') + '</span><span class="lp-count">' + n + '/' + all.length + '</span></li>';
    }).join('');
  }

  /* ---------- Dock (area jawaban) ---------- */
  function setDock(node) {
    dock.innerHTML = ''; state.ready = false;
    if (node) { dock.appendChild(node); state.ready = true; }
  }
  function quick(options, onPick) {
    var w = el('<div class="quick" role="group" aria-label="Pilihan jawaban"></div>');
    options.forEach(function (o) {
      var b = el('<button class="chip" type="button"></button>');
      b.textContent = o; b.setAttribute('aria-pressed', 'false');
      b.addEventListener('click', function () { if (!state.ready) return; b.setAttribute('aria-pressed', 'true'); onPick(o); });
      w.appendChild(b);
    });
    return w;
  }
  function focusFirst() {
    var f = dock.querySelector('input:not([type=file]),textarea,button');
    if (f) f.focus({ preventScroll: true });
  }
  function skipBtn(step) {
    var b = el('<button class="dock__skip" type="button"></button>');
    b.textContent = step.skip;
    b.addEventListener('click', function () { go(answer(step, { skipped: true, text: step.skip }, step.skip)); });
    return b;
  }

  function renderDock(step) {
    var node;
    if (step.type === 'choice') {
      node = quick(step.options, function (o) { go(answer(step, { text: o }, o)); });
    } else if (step.type === 'file') {
      node = el('<div><div class="dock__file"><label class="btn btn--solid filepick">' + ICON_CLIP + '<span>Pilih file</span><input class="sr" type="file" accept=".jpg,.jpeg,.png,.pdf"></label><span class="dock__aux" style="margin:0">Format jpg, jpeg, png, atau pdf. Maksimal ' + MAX_MB + ' MB.</span></div><p class="dock__err" role="alert"></p></div>');
      var inp = node.querySelector('input'), err = node.querySelector('.dock__err');
      inp.addEventListener('change', function () {
        var f = inp.files && inp.files[0]; if (!f) return;
        var ext = (f.name.split('.').pop() || '').toLowerCase();
        if (['jpg', 'jpeg', 'png', 'pdf'].indexOf(ext) < 0) { err.textContent = 'Format file belum didukung. Gunakan jpg, jpeg, png, atau pdf.'; inp.value = ''; return; }
        if (f.size > MAX_MB * 1048576) { err.textContent = 'File terlalu besar. Ukuran maksimal ' + MAX_MB + ' MB.'; inp.value = ''; return; }
        var att = el('<div class="att"></div>');
        if (ext === 'pdf') att.appendChild(el('<span class="att__pdf" aria-hidden="true">PDF</span>'));
        else { var u = URL.createObjectURL(f); urls.push(u); var im = new Image(); im.src = u; im.alt = ''; att.appendChild(im); }
        var info = el('<div><b></b><small></small></div>');
        info.querySelector('b').textContent = f.name; info.querySelector('small').textContent = fmtSize(f.size);
        att.appendChild(info);
        go(answer(step, { file: { name: f.name, size: f.size }, blob: f }, att));
      });
      if (step.skip) { var aux = el('<div class="dock__aux"></div>'); aux.appendChild(skipBtn(step)); node.appendChild(aux); }
    } else {
      node = el('<div><form class="dock__form" novalidate></form><p class="dock__err" role="alert"></p></div>');
      var form = node.querySelector('form'), er = node.querySelector('.dock__err');
      var field;
      if (step.type === 'area') field = el('<textarea class="dock__in" rows="3" id="dock-in"></textarea>');
      else if (step.type === 'date') { field = el('<input class="dock__in" type="date" id="dock-in">'); field.max = todayISO(); }
      else {
        field = el('<input class="dock__in" id="dock-in" type="' + (step.mode === 'email' ? 'email' : step.mode === 'tel' ? 'tel' : 'text') + '">');
        if (step.mode) field.setAttribute('inputmode', step.mode);
      }
      if (step.ph) field.placeholder = step.ph;
      if (step.ac) field.setAttribute('autocomplete', step.ac);
      field.setAttribute('aria-label', step.q);
      var send = el('<button class="send" type="submit" aria-label="Kirim jawaban">' + ICON_SEND + '</button>');
      form.appendChild(field); form.appendChild(send);
      if (step.type === 'area') {
        field.addEventListener('input', function () { field.style.height = 'auto'; field.style.height = Math.min(field.scrollHeight, 160) + 'px'; });
        field.addEventListener('keydown', function (e) { if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) { e.preventDefault(); form.dispatchEvent(new Event('submit', { cancelable: true })); } });
        node.appendChild(el('<div class="dock__aux">Enter untuk baris baru, Ctrl+Enter untuk kirim.</div>'));
      }
      if (step.skip) {
        var ax = node.querySelector('.dock__aux');
        if (!ax) { ax = el('<div class="dock__aux"></div>'); node.appendChild(ax); }
        ax.insertBefore(skipBtn(step), ax.firstChild);
      }
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var val = field.value.trim();
        var r = step.v ? step.v(val) : (val ? true : 'Jawaban ini perlu diisi.');
        if (r !== true) { er.textContent = r; field.focus({ preventScroll: true }); return; }
        er.textContent = '';
        go(answer(step, { text: val }, step.type === 'date' ? fmtDate(val) : val));
      });
      field.addEventListener('input', function () { er.textContent = ''; });
    }
    setDock(node);
    if (step.type !== 'choice') focusFirst();
  }

  /* ---------- Alur ---------- */
  async function ask(i) {
    var id = runId, s = STEPS[i];
    state.i = i; setDock(null);
    if (!state.editing) {
      if (i === 0 || STEPS[i - 1].sec !== s.sec) {
        var sec = SECTIONS.filter(function (x) { return x.id === s.sec; })[0];
        await say(sec.intro);
      }
    }
    await say(s.q);
    if (id !== runId) throw ABORT;
    update();
    renderDock(s);
  }

  async function answer(step, ans, display) {
    setDock(null);
    state.answers[step.id] = ans;
    addMsg('me', display);
    update();
    if (state.editing) {
      state.editing = null;
      await say('Sudah saya perbarui.');
      return summary();
    }
    var n = state.i + 1;
    if (n < STEPS.length) return ask(n);
    return summary();
  }

  function valueText(step, a) {
    if (!a) return '';
    if (a.file) return a.file.name;
    return a.text || '';
  }

  async function summary() {
    state.i = STEPS.length; update();
    $$('.sum', log).forEach(function (x) { x.classList.add('is-stale'); });
    await say('Terima kasih sudah menjawab semuanya. Periksa ringkasan laporan Anda sebelum dikirim.');
    var card = el('<div class="sum"></div>');
    SECTIONS.forEach(function (sec) {
      var g = el('<div><h3></h3></div>');
      g.querySelector('h3').textContent = sec.label;
      STEPS.filter(function (s) { return s.sec === sec.id; }).forEach(function (s) {
        var a = state.answers[s.id], skipped = a && a.skipped;
        var row = el('<div class="sum__row"><span class="sum__k"></span><span class="sum__v"></span><button class="sum__edit" type="button">Ubah</button></div>');
        row.querySelector('.sum__k').textContent = s.label;
        var v = row.querySelector('.sum__v');
        v.textContent = skipped ? s.skip : (s.type === 'date' ? a.text : valueText(s, a));
        if (skipped) v.classList.add('is-skip');
        var eb = row.querySelector('.sum__edit');
        eb.setAttribute('aria-label', 'Ubah ' + s.label);
        eb.addEventListener('click', function () { go(edit(s.id)); });
        g.appendChild(row);
      });
      card.appendChild(g);
    });
    addMsg('bot', card, true);
    setDock(quick(['Kirim laporan'], function () { go(send()); }));
  }

  async function edit(id) {
    if (!state.ready || state.sent) return;
    var idx = STEPS.indexOf(stepById(id)), s = STEPS[idx];
    $$('.sum', log).forEach(function (x) { x.classList.add('is-stale'); });
    state.editing = id; state.i = idx; setDock(null);
    await say('Baik, kita ubah ' + s.label.toLowerCase() + '.');
    await ask(idx);
  }

  /* Kirim ke route web.store; field sama dengan form laporan lama. */
  function submitReport(data) {
    var A = function (id) { var x = data[id]; return x && !x.skipped ? x.text : ''; };
    var fd = new FormData();
    fd.append('nama_lengkap', A('nama'));
    fd.append('nomor_identitas', A('nik'));
    fd.append('file_identitas', data.fileId.blob);
    fd.append('alamat', A('alamat'));
    fd.append('no_hp', A('hp'));
    fd.append('email', A('email'));
    fd.append('nama_unit_kerja_fakultas_instansi', A('unit'));
    fd.append('status_pelapor', A('statusP'));
    fd.append('kategori', A('kategori'));
    fd.append('nama_lengkap_terlapor', A('namaT') || 'Tidak diketahui');
    fd.append('status_terlapor', A('statusT'));
    fd.append('no_hp_terlapor', A('hpT') || '-');
    fd.append('peristiwa', A('jenis'));
    fd.append('tanggal_peristiwa', A('tanggal'));
    fd.append('lokasi_peristiwa', A('lokasi'));
    fd.append('kronologi_peristiwa', A('kronologi'));
    if (data.bukti && data.bukti.blob) fd.append('file_bukti_tindakan', data.bukti.blob);
    var form = document.getElementById('chat-form');
    return fetch(form.getAttribute('action'), {
      method: 'POST', body: fd,
      headers: { 'X-CSRF-TOKEN': form.getAttribute('data-csrf'), 'Accept': 'application/json' }
    }).then(function (r) {
      return r.json().catch(function () { return {}; }).then(function (j) {
        if (r.ok) return j;
        var msg = j.errors ? Object.keys(j.errors).map(function (k) { return j.errors[k][0]; }).join(' ') : j.message;
        throw new Error(msg || 'Laporan belum terkirim. Coba lagi beberapa saat.');
      });
    });
  }

  async function send() {
    var id = runId;
    setDock(null);
    addMsg('me', 'Kirim laporan');
    var res;
    try { res = await submitReport(state.answers); }
    catch (e) {
      if (id !== runId) throw ABORT;
      await say(e.message || 'Laporan belum terkirim. Coba lagi.');
      return setDock(quick(['Kirim laporan'], function () { go(send()); }));
    }
    if (id !== runId) throw ABORT;
    state.sent = true;
    $$('.sum', log).forEach(function (x) { x.classList.add('is-stale'); });
    if (DEMO) await say('Ini pratinjau desain, jadi laporan belum dikirim ke mana pun. Di versi live, kode referensi laporan Anda akan muncul di sini.');
    else await say('Laporan Anda sudah kami teruskan ke Tim Satgas PPK UDINUS. Simpan kode referensi ini: ' + res.ref);
    await say('Terima kasih sudah menyampaikannya. Jika Anda membutuhkan bantuan langsung, hubungi Satgas PPK di +62 888-890-1090.');
    setDock(quick(['Kembali ke beranda', 'Buat laporan baru'], function (o) {
      if (o === 'Kembali ke beranda') { location.href = '/'; } else { go(begin(true)); }
    }));
  }

  async function begin(skipGreeting) {
    runId++;
    urls.forEach(function (u) { URL.revokeObjectURL(u); }); urls = [];
    state = { i: -1, answers: {}, editing: null, ready: false, started: false, sent: false };
    log.innerHTML = ''; lastWho = null; setDock(null); update();
    if (!skipGreeting) {
      await say('Halo, saya asisten pelaporan Satgas PPK UDINUS. Saya akan memandu Anda mengisi laporan lewat beberapa pertanyaan, satu per satu.');
      await say('Ini percakapan terpandu, bukan obrolan langsung dengan petugas. Segala informasi yang Anda sampaikan dijamin kerahasiaannya.');
    }
    await say('Siapkan KTP atau KTM, data terlapor jika ada, dan bukti jika punya. Siap mulai?');
    offerStart();
  }
  function offerStart() {
    setDock(quick(['Mulai melapor', 'Hubungi Satgas lewat telepon'], function (o) {
      go(onStart(o));
    }));
  }
  async function onStart(o) {
    setDock(null);
    addMsg('me', o);
    if (o === 'Mulai melapor') { state.started = true; return ask(0); }
    await say('Anda bisa menghubungi Satgas PPK UDINUS di +62 888-890-1090. Jika Anda dalam bahaya sekarang, hubungi 112.');
    setDock(quick(['Mulai melapor'], function (x) { go(onStart(x)); }));
  }

  resetBtn.addEventListener('click', function () {
    if (resetBtn.getAttribute('data-arm') !== '1') {
      resetBtn.setAttribute('data-arm', '1');
      var span = resetBtn.querySelector('span'), old = span.textContent;
      span.textContent = 'Yakin? Jawaban dihapus';
      resetBtn.setAttribute('aria-label', 'Konfirmasi mulai ulang. Semua jawaban akan dihapus.');
      setTimeout(function () { resetBtn.removeAttribute('data-arm'); span.textContent = old; resetBtn.removeAttribute('aria-label'); }, 3500);
      return;
    }
    resetBtn.removeAttribute('data-arm'); resetBtn.removeAttribute('aria-label');
    resetBtn.querySelector('span').textContent = 'Mulai ulang';
    go(begin(false));
  });

  state = { i: -1, answers: {}, editing: null, ready: false, started: false, sent: false };
  update();

  started = true; go(begin(false));
})();