<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>E-LNU-IDS</title>    
     <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/images/logo/lnu_logo.png') }}" type="image/png" nonce="{{ csp_nonce() }}">
    @vite('resources/sass/app.scss')
    @vite('resources/css/app.css')
</head>
<body>
    <div class="wrapper">
        <div class="content-wrapper" id="app">
            <router-view></router-view>
        </div>
    </div>
    
</body>
@vite('resources/js/app.js')
</html>