<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>表单组件示例</title>

    <!-- Fonts -->
{{--    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">--}}

    <link href="{{ asset('css/app_.css') }}" rel="stylesheet">
</head>
<body class="antialiased">
<div id="app" class="container">
    <form-component></form-component>
    <example-component></example-component>
</div>
<script src="{{ asset('js/app_1.js') }}" type="text/javascript"></script>
</body>
</html>
