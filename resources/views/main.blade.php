<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Reto 2.0' }}</title>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/465500c994.js" crossorigin="anonymous"></script>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bulma/css/bulma.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <script type="text/javascript" src='js/fullcalendar/dist/index.global.js'></script>
</head>

<body>
    <section>
        <main>
            {{ $slot }}
        </main>
    </section>
    <script type="text/javascript" src="js/help.js"></script>
</body>

</html>
