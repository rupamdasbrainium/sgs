@php
	$locale =  app()->currentLocale();
	if(session()->has('locale')){
		$locale = session()->get('locale');
    }

	if(Session::has('clientToken')){
		if(Session::has('language_id')){
			$language_id = Session::get('language_id');
			if($language_id==2){
				$locale = 'en';
			}
			else {
				$locale = 'fr';
			}
		}
	}
	app()->setLocale($locale);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') {{ config('app.name', 'SGS') }}</title>
        <style>:root{ @yield('style') }</style>
        <!-- Fonts -->
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> -->
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
        <!-- custom css -->
        <link rel="icon" type="image/png" href="{{ asset('public/images/favicon.png') }}"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        @stack('css')
        <!-- Scripts -->
        <script src="{{ asset('public/js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
        <script src="{{ asset('public/js/jquery.min.js')}}"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('public/js/select_optiones.js') }}"></script>
        <script src="{{ asset('public/admin/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('public/js/custom.js') }}"></script>
        @stack('scripts')
        <script type="text/javascript">
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