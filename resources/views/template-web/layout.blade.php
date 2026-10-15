<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>@yield('title', 'Satgas PPK UDINUS — Portal Informasi')</title>
<meta name="description" content="Portal Informasi Satgas PPK Universitas Dian Nuswantoro">
<meta name="color-scheme" content="light">
<link rel="icon" type="image/x-icon" href="{{ asset('env') }}/udinus.png">
<script>document.documentElement.classList.add('js');</script>
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
@include('sweetalert::alert')
</body>
</html>
