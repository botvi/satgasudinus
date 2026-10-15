<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>@yield('title', 'Satgas PPK UDINUS — Portal Informasi')</title>
<meta name="description" content="Portal Informasi Satgas PPK Universitas Dian Nuswantoro">
<meta name="color-scheme" content="light">
<link rel="icon" type="image/x-icon" href="{{ asset('env') }}/udinus.png">
<script>document.documentElement.classList.add('js');try{var a=JSON.parse(localStorage.getItem('a11y')||'{}'),c=document.documentElement;a.contrast&&c.classList.add('a11y-contrast');a.links&&c.classList.add('a11y-links');a.calm&&c.classList.add('a11y-calm');a.font&&c.classList.add('a11y-font');a.size&&(c.style.fontSize=[100,112.5,125,150][a.size]+'%')}catch(e){}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500..800&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('web/site.css') }}?v={{ filemtime(public_path('web/site.css')) }}">
</head>
<body>
@include('template-web.navbar')

<main id="konten">
@yield('content')
</main>

@include('template-web.footer')

@yield('script')
<script src="{{ asset('web/site.js') }}?v={{ filemtime(public_path('web/site.js')) }}"></script>
<script src="{{ asset('web/a11y.js') }}?v={{ filemtime(public_path('web/a11y.js')) }}"></script>
@include('sweetalert::alert')
</body>
</html>
