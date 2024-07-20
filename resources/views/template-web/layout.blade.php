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
<body class="relative">

  <!-- Loading Spinner -->
  <div id="loading" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="loading-dots">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>

  @include('template-web.navbar')

  <!-- Main Content -->
  <div id="content" class="hidden">
    <div class="container mx-auto max-w-6xl mb-30">
      @yield('content')
    </div>
    @include('template-web.footer')
  </div>

  @include('sweetalert::alert')

  @yield('script')

  <script src="{{ asset('web') }}/script.js"></script>
</body>
</html>
