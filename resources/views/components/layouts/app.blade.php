<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="We pride ourselves in providing regular and high quality air traffic control for our pilots as part of the VATSIM network.">
    @vite(['resources/css/app.css'])
    <title>VATSIM UK - Nexus</title>

    @livewireStyles
  </head>
  <body class="h-screen bg-gray-100 dark:bg-gray-900 container mx-auto">
    {{ $slot }}

    @livewireScripts
    @vite(['resources/js/app.js'])
  </body>
</html>
