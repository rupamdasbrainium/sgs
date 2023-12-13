@php
    $locale = app()->currentLocale();
    if (session()->has('locale')) {
        $locale = session()->get('locale');
    }
    if (Session::has('clientToken')) {
        if (Session::has('language_id')) {
            $language_id = Session::get('language_id');
            if ($language_id == 2) {
                $locale = 'en';
            } else {
                $locale = 'fr';
            }
        }
    }
    app()->setLocale($locale);
@endphp
<header class="header_outer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header_info">
                    <div class="logoinfo ">
                        <a href="{{ route('homepage', ['short_code' => 'CentreDemo']) }}" class="def_logo">
                            @if (isset($logo))
                                <img src="{{ asset('public/upload/banner/' . $logo->value) }}"
                                     alt="">
                            @else
                                <img src="{{ asset('public/images/logo.svg') }}" alt="">
                            @endif
                        </a>
                    </div>
                    <div class="header_right_info">
                        <div class="mob_user_icon">
                            <span class="accountinfo"><img src="{{ asset('public/images/icon1.svg') }}"
                                    alt=""></span>
                            <span class="close_info"><i class="fa fa-times"></i></span>
                        </div>
                        <nav class="navbar navbar-expand-lg ">
                            <button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse menucont" id="navbarSupportedContent">
                                <div class="mobileheader">
                                    <div class="mob_logo_add logoinfo">
                                        <a href="javascript:void(0)"><img src="{{ asset('public/images/logo.svg') }}"
                                                alt=""></a>
                                    </div>
                                    <div class="closeicon">
                                        <i class="fa fa-times"></i>
                                    </div>
                                </div>
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item {{ Request::is('CentreDemo') ? 'active' : '' }}">
                                        <a class="nav-link"
                                            href="{{ route('homepage', ['short_code' => 'CentreDemo']) }}">{{ __('header.memberships') }}</a>
                                    </li>
                                    <li class="nav-item {{ Request::is('CentreDemo#findGym') ? 'active' : '' }}">
                                        <a class="nav-link"
                                            href="{{ url('/CentreDemo#findGym') }}">{{ __('header.gym') }}</a>
                                    </li>
                                    @if (Session::has('clientToken'))
                                        <li class="nav-item" {{ Session::get('clientToken') }}>
                                            <a class="nav-link" href="{{ route('myProfile') }}">
                                                {{ __('header.profile') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('userLogout') }}">
                                                {{ __('header.logout') }}</a>
                                        </li>
                                    @else
                                        <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                                            <a class="nav-link"
                                                href="{{ route('login') }}">{{ __('header.Login') }}</a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="count_opt">
                                    <div class="cont_icon">
                                        <img src="{{ asset('public/images/worldmap.svg') }}" alt="">
                                    </div>

                                    <div class="cont_leng">
                                        <a href="{{ url('language/en') }}"
                                            class="{{ $locale == 'en' ? 'active_leng' : '' }}">En</a>
                                        <a href="{{ url('language/fr') }}"
                                            class="{{ $locale == 'fr' ? 'active_leng' : '' }}">Fr</a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
