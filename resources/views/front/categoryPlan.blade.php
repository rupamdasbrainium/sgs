<x-guest-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @php
        $lang_id = getLocale();
    @endphp
    @section('title', $data['title'] . ' |')
    @section('style', '--sub_btnhover-bg: ' . $primary_button_color_hover->value . ';--sub_btn-bg: ' . $button->value .
        ';--hover_bg:' . $theme_color_hover->value . ';--sushover-bg:' . $secondary_theme_color_hover->value .
        ';--theme-bg:' . $theme->value . ';--secondary_theme:' . $theme->value)
        @include('header')
        <div class="banner_outer">
            <div class="banner_slider shadowremove">
                <div class="banner_panel">
                    <div class="banner_img">
                        @if (isset($banner))
                            <img src="{{ asset('public/upload/banner/' . $banner->value) }}"
                                style="width: 1349px; height:659.73px;" alt="">
                        @else
                            <img src="{{ asset('public/images/yoav_banner_img.png') }}" alt="">
                        @endif
                    </div>
                    <div class="banner_cont">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="banner_info">
                                        <h1>{{ __('global.banner_info_h1') }}
                                            <span>{{ __('global.banner_info_h1_span') }}</span>
                                        </h1>
                                        <h2>{{ __('global.banner_info_h2') }}!</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner_outer_shape">
            </div>
        </div>
        <section class="maincontent_wrap home_based_category">
            <div class="welcomesection def_padding ">
            </div>
            <div class="categories_option">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_title">
                                <div class="cat_opt_item">
                                    <h3>{{ $category_name }}</h3>
                                </div>
                            </div>
                            <div class="prod_item_wrap owl-carousel owl-theme" id="home_prod_item">
                                @foreach ($data['all_plan_data'] as $key => $values)
                                    <div class="prod_item" style="--hover_bg: {{ $theme_color_hover->value }}">
                                        <div class="action_opt action_opt_title noBgcolor" style="--sushover-bg:{{ $secondary_theme_color_hover->value }}; background-color: {{ $theme->value }}">
                                            <div class="action_text">
                                                <div class="selectcont ">
                                                    <div class="arrowdown2">
                                                    </div>
                                                    <select class="select_opt js-example-basic-single" title=" {{ $values->name }}">
                                                        <option value="{{ $values->id }}">
                                                            {{$values->name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action_opt adj_height">
                                            <div class="price_text">
                                                @if (isset($values))
                                                    @if (count($values->priceBydurations))
                                                        <div class="selectcont ">
                                                            <div class="arrowdown2 d-none">
                                                                <i class="fal fa-chevron-down"></i>
                                                            </div>
                                                            <select class=" js-example-basic-single">
                                                                @foreach ($values->priceBydurations as $val)
                                                                    <option>{{ number_format($val->price,2) }}$<span>/
                                                                            {{ $val->typeDuration }}</span>
                                                                        {{ __('global.For') }}
                                                                        {{ $val->frequency }}
                                                                        {{ $val->typeDuration }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                        0.00$
                                                    @endif
                                                @endif
                                            </div>
                                            <p>{{ $values->descr }}</p>
                                        </div>
                                        <div class="individual_opt">
                                            <div class="individual_head" style="background-color: {{ $theme->value }}">
                                                {{ __('global.age') }} : {{ $values->ageLimit }}
                                            </div>
                                            <div class="individual_des">
                                                <ul>
                                                    @if (isset($values))
                                                        @if (isset($values->marketingBools))
                                                            @foreach ($values->marketingBools as $val)
                                                                <li><span><i
                                                                            class="fal fa-times"></i></span>{{ $val->description }}
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </ul>
                                                <div class="subscribe_btn">
                                                       @if (session()->has('clientToken'))
                                                            <a href="{{ route('newMembershipSteptwo', [$values->id]) }}"
                                                                class="sub_btn">{{ __('global.subscribe') }}</a>
                                                       @else
                                                            <a href="{{ route('newMembershipfont', [$values->id]) }}"
                                                                class="sub_btn">{{ __('global.subscribe') }}</a>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
     
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
               $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        </script>
    @include('footer')
   
    </x-guest-layout>
