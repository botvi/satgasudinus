<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('env') }}/udinus.png" />
  <title>Satgas PPKS</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('web') }}/styles.css">
  @yield('style')

</head>
<body>

  @include('template-web.navbar')

  @yield('content')

  @include('template-web.footer')
  
  @include('sweetalert::alert')

@yield('script')

<script src="{{ asset('web') }}/script.js"></script>
</body>
</html>
