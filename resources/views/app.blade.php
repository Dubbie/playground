<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title inertia>{{ config('app.name', 'Playground') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/fontin" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/css/app.css', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>


<body class="font-sans antialiased">
    @inertia
</body>

</html>
