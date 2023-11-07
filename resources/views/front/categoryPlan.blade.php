<x-guest-layout>
    @php
        $lang_id = getLocale();
    @endphp
    @section('title', $data['title'] . ' |')
    @include('header')
    <div class="banner_outer">
        <div class="banner_slider shadowremove">
            <div class="banner_panel">
                <div class="banner_img">
                    <!-- <img src="images/yoav_banner_img.png" alt=""> -->
                    <img src="{{ asset('public/images/home_based_banner1.png') }}" alt="">
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

                            @foreach ($data['category'] as $item)
                                <div class="cat_opt_item">
                                    <h3>{{ $item->title }}</h3>
                                </div>
                            @endforeach
                        </div>

                        <div class="prod_item_wrap owl-carousel owl-theme" id="home_prod_item">

                            @foreach ($data['bestfoursubscriptionplan'] as $key => $values)
                                <div class="prod_item">
                                    <div class="action_opt action_opt_title"
                                        style="background-color: {{ $theme->value }}">

                                        <div class="action_text">

                                            <div class="selectcont ">

                                                <div class="arrowdown2">
                                                    {{-- <i class="far fa-chevron-down"></i> --}}
                                                </div>
                                                <select class="select_opt" title=" {{ $values->name }}">
                                                    <option value="{{ $values->id }}">

                                                        {{ substr($values->name, 0, 14) }}...

                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action_opt adj_height">
                                        <div class="price_text">

                                            @if (isset($values))
                                                @if (count($values->prices_per_durations))
                                                    <div class="selectcont ">
                                                        <div class="arrowdown2">
                                                            <i class="fal fa-chevron-down"></i>
                                                        </div>
                                                        <select class="select_opt">

                                                            @foreach ($values->prices_per_durations as $val)
                                                        
                                                                <option>${{ $val->price_recurant }}<span>/
                                                                        {{ $val->duration_unit_display }}</span> For
                                                                    {{ $val->frequency }}
                                                                    {{ $val->duration_unit_display }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @else
                                                    $0
                                                @endif
                                            @endif
                                        </div>
                                        {{-- <p>{{ __('global.price') }}</p> --}}
                                        {{-- <p>{{ $values->descr }}</p> --}}
                                    </div>
                                    <div class="individual_opt">
                                        <div class="individual_head"
                                            style="background-color: {{ $theme->value }}">
                                            {{ __('global.age') }} : {{ $values->age_min }} to {{ $values->age_max }}
                                        </div>
                                        <div class="individual_des">
                                            <ul>
                                                @if (isset($values))
                                                    @if (isset($values->options))
                                                        @foreach ($values->options as $val)
                                                            <li><span><i
                                                                        class="fal fa-times"></i></span>{{ $val->name }}
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                @endif
                                                {{-- <li>{{ $lang_id == 2 ? $item['descr_english'] : $item['descr_french'] }}</li> --}}
                                            </ul>
                                            <div class="subscribe_btn">
                                                <a href="{{ route('newMembershipfont', [$values->id]) }}"
                                                    class="sub_btn"
                                                    style="background-color: {{ $button->value }}">{{ __('global.subscribe') }}</a>
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


    @include('footer')
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="js/bootstrap.bundle.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/select_optiones.js"></script>

    <script src="js/custom.js"></script>
</x-guest-layout>
