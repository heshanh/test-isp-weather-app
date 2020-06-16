<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link href={{ asset('css/main.css') }} rel="stylesheet" />
</head>

<body>

<div class="box-content p-4 border-4 border-gray-400 bg-gray-200" id="app"></div>

<script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>

<script src="{{ asset('js/app.js')}}"></script>

@yield('scripts')

</body>

</html>
