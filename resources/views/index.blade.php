<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/ebn.png') }}" type="image/x-icon">
    <link href="{{ asset('architectui/architectui/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/uploader/css/uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/cropper/css/cropper.min.css') }}">
    @stack('css')
    <style>
        #loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
</head>

<body>
    
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('admin-panel-components.navbar')
        <div class="app-main">
            @include('admin-panel-components.sidebar')
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div id="loading-overlay" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                    </div>
                    @yield('content')   
                </div>
                <br><br>
                <!-- Footer Here -->
            </div>
        </div>
    </div>
    
</body>

<footer>
    <script src="{{ asset('architectui/architectui/assets/scripts/main.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('plugins/uploader/js/uploader.js') }}"></script>
    <script src="{{ asset('plugins/cropper/js/cropper.min.js') }}"></script>
    <script src="{{ asset('plugins/chartjs/chart.js') }}"></script>
    <script>
        $('.btn-close-layout-options').on('click', function(){
            $('.ui-theme-settings').removeClass('settings-open');
        });
    </script>
    @stack('scripts')
</footer>
</html>

@stack('modal')
