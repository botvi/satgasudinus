<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Masuk Admin — Satgas PPK UDINUS</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/x-icon" href="{{ asset('env') }}/udinus.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('web/site.css') }}?v={{ filemtime(public_path('web/site.css')) }}">
<style>
body{min-height:100vh;display:grid;place-items:center;padding:24px var(--gutter);background:linear-gradient(160deg,var(--brand-deep),var(--brand) 55%,var(--brand-bright))}
.auth{width:min(440px,100%)}
.auth__brand{display:flex;align-items:center;justify-content:center;gap:14px;margin-bottom:24px;color:#fff;text-decoration:none;font:700 1.25rem/1.15 var(--font-display)}
.auth__brand .logo-img{width:52px;height:52px;flex:none}
.auth__card{background:var(--surface);border-radius:20px;padding:clamp(24px,5vw,36px);box-shadow:0 30px 60px -20px rgba(5,12,40,.5)}
.auth__card h1{margin:0 0 6px;font:700 1.6rem/1.2 var(--font-display);letter-spacing:-.01em}
.auth__card>p{margin:0 0 24px;color:var(--muted);font-size:.98rem;line-height:1.5}
.field{display:block;margin-bottom:18px}
.field>span{display:block;margin-bottom:6px;font-weight:600;font-size:.92rem}
.field input[type=text],.field input[type=password]{width:100%;min-height:48px;padding:0 14px;border:1.5px solid var(--line);border-radius:12px;background:var(--surface);color:var(--ink);font:inherit;transition:border-color .2s}
.field input:hover{border-color:var(--brand-bright)}
.pw{position:relative}
.pw input{padding-right:48px!important}
.pw button{position:absolute;right:4px;top:4px;width:40px;height:40px;border:0;border-radius:8px;background:none;color:var(--muted);cursor:pointer;display:grid;place-items:center}
.pw button:hover{background:var(--sky)}
.pw svg{width:20px;height:20px}
.remember{display:flex;align-items:center;gap:10px;margin:0 0 22px;font-size:.95rem;cursor:pointer}
.remember input{width:18px;height:18px;accent-color:var(--brand)}
.auth .btn{width:100%;justify-content:center}
.auth__back{display:block;margin-top:20px;text-align:center;color:#fff;font-weight:600;text-decoration:none;opacity:.9}
.auth__back:hover{opacity:1;text-decoration:underline}
</style>
</head>
<body>
<main class="auth">
  <a class="auth__brand" href="/" aria-label="Ke beranda Satgas PPK UDINUS">
    <span class="logo-img" role="img" aria-label="Logo Satgas PPKS UDINUS"></span>
    <span>Satuan Tugas<br>PPK UDINUS</span>
  </a>

  <div class="auth__card">
    <h1>Masuk Admin</h1>
    <p>Masuk untuk mengelola kegiatan, dokumen, galeri, dan laporan.</p>

    <form action="{{ route('login') }}" method="POST">
      @csrf
      <label class="field">
        <span>Username</span>
        <input type="text" name="username" autocomplete="username" placeholder="Masukkan username" autofocus required>
      </label>
      <label class="field">
        <span>Password</span>
        <div class="pw">
          <input type="password" name="password" id="password" autocomplete="current-password" placeholder="Masukkan password" required>
          <button type="button" id="pw-toggle" aria-label="Tampilkan password" aria-pressed="false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </label>
      <label class="remember"><input type="checkbox" name="remember" value="1"> Ingat saya</label>
      <button class="btn btn--solid btn--lg" type="submit">Masuk</button>
    </form>
  </div>

  <a class="auth__back" href="/">← Kembali ke situs</a>
</main>
@include('sweetalert::alert')
<script>
(function () {
  var i = document.getElementById('password'), b = document.getElementById('pw-toggle');
  b.addEventListener('click', function () {
    var show = i.type === 'password';
    i.type = show ? 'text' : 'password';
    b.setAttribute('aria-pressed', String(show));
    b.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
  });
})();
</script>
</body>
</html>
