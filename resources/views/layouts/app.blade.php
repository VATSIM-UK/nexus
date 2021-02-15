<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="We pride ourselves in providing regular and high quality air traffic control for our pilots as part of the VATSIM network.">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <title>VATSIM UK - Nexus</title>

    @livewireStyles
  </head>
  <body class="h-screen overflow-hidden bg-gray-100 dark:bg-gray-900">
    {{ $slot }}

    @livewireScripts
    <script src="{{ mix('/js/app.js') }}" defer></script>
  </body>
</html>
