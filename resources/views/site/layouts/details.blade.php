<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ 'Gestão de Jogos - Luna Sistemas' }}</title>
    
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Logo -->    
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{URL::asset('/imgs/logo.png')}}" alt="profile Pic" height="60" width="60">
                </a> 
            </div>
        </nav>
    </div>

    <div class="container">
        <!-- define um template -->
        @yield('content')
    </div>

</body>
</html>