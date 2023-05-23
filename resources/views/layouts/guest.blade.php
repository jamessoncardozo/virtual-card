<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Laravel') }}</title>

      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
      @livewireStyles

      <!-- Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased min-h-screen bg-gradient-to-t from-gray-200 via-gray-100 to-gray-50 dark:from-gray-900 dark:to-gray-800">
        <div>
          {{ $slot }}
        </div>

        <!-- Livewire Scripts -->
        @livewireScripts
        <script>
          function takeScreenshot() {
            // Captura o elemento "captura" e converte em imagem
            html2canvas(document.getElementById("businesscard")).then(function(canvas) {
              // Cria um link para fazer o download da imagem
              var link = document.createElement("a");
              document.body.appendChild(link);
              link.download = "screenshot.png";
              link.href = canvas.toDataURL("image/png");
              link.click();
            });
          }
        </script>
    </body>
</html>

