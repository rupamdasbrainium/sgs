<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') {{ config('app.name', 'SGS') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Custom Styles -->
        <link rel="icon" type="{{ asset('admin/image/png') }}" href="{{ asset('admin/images/favicon.png') }}"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
        <link rel="stylesheet" href="{{ asset('admin/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="{{ asset('admin/css/owl.theme.default.min.css') }}">
        @stack('css')
        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    </head>
    <body class="admin_content_view">
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <!-- Custom Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="{{ asset('admin/js/select_optiones.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        @stack('scripts')
        <script src="{{ asset('admin/js/custom.js') }}"></script>
        <script type="text/javascript">
        $(document).ready(function() {
          var cur_url = location.href;
          var qpos = cur_url.lastIndexOf('?');
          if (qpos > 0) {
            cur_url = cur_url.substr(0, qpos);
          }
          $('.left_sidebar .innersidebar_cont ul li a[href="' + cur_url + '"]').parent().addClass('activepage');
        });

        @if(Session::has('message'))
            var type = "{{ Session::get('message_type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
        </script>
    </body>
</html>