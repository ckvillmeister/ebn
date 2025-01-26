<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="{{ asset('templates/login-form/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('templates/login-form/assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('templates/login-form/assets/css/fontawsom-all.min.css') }}" rel="stylesheet" >
        <link href="{{ asset('images/trinidad-logo.png') }}" rel="icon">

        <!-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{ $slot }}
        <!-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div style="margin-top: -100px">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                
            </div>
        </div> -->
    </body>
    <script src="{{ asset('templates/login-form/assets/js/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('templates/login-form/assets/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templates/login-form/assets/popper.min.js') }}"></script>
    <script>
        $( document ).ready(function() {
            var arr = ['bg_1.jpg','bg_2.jpg','bg_3.jpg'];
            
            var i = 0;
            setInterval(function(){
                if(i == arr.length - 1){
                    i = 0;
                }else{
                    i++;
                }
                var img = 'url(../assets/images/'+arr[i]+')';
                $(".full-bg").css('background-image',img); 
             
            }, 4000)

        });

    </script>
</html>
