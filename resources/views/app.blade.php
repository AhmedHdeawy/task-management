<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Task Management</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset("css/app.css") }}">
        <link rel="stylesheet" href="{{ asset("css/custom.css") }}">

        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body class="antialiased">
        
        <div id="app"></div>

        <script src="{{ asset("js/app.js") }}"></script>

    </body>
</html>
