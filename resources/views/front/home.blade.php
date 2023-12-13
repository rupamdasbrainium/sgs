<x-guest-layout>
    @php
        $lang_id = getLocale();
    @endphp
    @section('title', $data['title'] . ' |')
    @include('header')
    <div class="banner_outer">
        <div class="banner_slider">
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
                                    @if ($lang_id == 2)
                                        <h1>{{ $title->value }}</h1>
                                        <h2>{{ $subtitle->value }}</h2>
                                    @else
                                        <h1>{{ $title_fr->value }}</h1>
                                        <h2>{{ $subtitle_fr->value }}</h2>
                                    @endif
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
    <section class="maincontent_wrap">
        <div class="welcomesection def_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcomesec_info">
                            <div class="round_opt_btn3">
                                <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                            </div>
                            <div class="heading_info ">
                                @if ($lang_id == 2)
                                    <h3>{{ $home_title->value }}</h3>
                                @else
                                    <h3>{{ $home_title_fr->value }}</h3>
                                @endif
                            </div>
                            @if ($lang_id == 2)
                                <h2>{{ $home_magicplan->value }}</h2>
                                <p>{{ $home_body->value }}</p>
                            @else
                                <h2>{{ $home_magicplan_fr->value }}</h2>
                                <p>{{ $home_body_fr->value }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="prod_viewsection_outer">
                <div class="round_opt1">
                    <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                </div>
                <div class="prod_viewsection" style="--hover_bg: {{ $theme_color_hover->value }};">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="select_opr_block">
                                    <div class="selectcont_wrap">
                                        <div class="selectcont">
                                            <div class="arrowdown2">
                                                <i class="fal fa-chevron-down"></i>
                                            </div>
                                            <input type="hidden" id="homeurl" value="{{ route('homepage') }}">
                                            <select class="select_opt" id="franchises_name" name="franchise_name">
                                                @isset($data['franchises'])
                                                    @foreach ($data['franchises']->data as $franchise)
                                                        <option value="{{ $franchise->shortCode }}"
                                                            {{ $franchise->id == $franchise_id ? 'selected="selected"' : '' }}>
                                                            {{ $franchise->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="selectcont ">
                                            <div class="arrowdown2">
                                                <i class="fal fa-chevron-down"></i>
                                            </div>
                                            <select class="select_opt" id="franchises_address"
                                                title="{{ $franchise->address_civic_number }}{{ $franchise->address_street }}{{ $franchise->address_city }}">
                                                @isset($data['franchises'])
                                                    @foreach ($data['franchises']->data as $franchise)
                                                        <option value="{{ $franchise->shortCode }}"
                                                            {{ $franchise->id == $franchise_id ? 'selected="selected"' : '' }}>
                                                            {{ $franchise->address_civic_number }}{{ $franchise->address_street }}{{ $franchise->address_city }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="selectcont ">
                                            <div class="arrowdown2">
                                                <i class="fal fa-chevron-down"></i>
                                            </div>
                                            <select class="select_opt" id="franchises_type" name="franchise_plan">
                                                @foreach ($data['franchisesPlanType']->data as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="def_btnopt2">
                                        <button type="button" style="background-color: {{ $button->value }}"
                                            class="btn2" id="home_continue">{{ __('global.continue') }}</button>
                                    </div>
                                </div>
                                <div class="prod_item_wrap owl-carousel owl-theme" id="home_prod_item">
                                    @foreach ($data['all_plan_data'] as $key => $values)
                                        <div class="prod_item">
                                            <div class="action_opt action_opt_title"
                                                style="background-color: {{ $theme->value }}">
                                                <div class="action_text">
                                                    <div class="selectcont ">
                                                        <div class="arrowdown2">
                                                        </div>
                                                        <select class="select_opt" title=" {{ $values->name }}">
                                                            <option value="{{ $values->id }}">
                                                                {{ substr($values->name, 0, 14) }}...
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action_opt adj_height"  style="--secondary_theme: {{ $theme->value }}">
                                                <div class="price_text">
                                                    @if (isset($values))
                                                        @if (count($values->priceBydurations))
                                                            <div class="selectcont ">
                                                                <div class="arrowdown2 d-none">
                                                                    <i class="fal fa-chevron-down"></i>
                                                                </div>
                                                                <select class="js-example-basic-single"
                                                                   >
                                                                    @foreach ($values->priceBydurations as $val)
                                                                        <option>${{ $val->price }}<span>/
                                                                                {{ $val->typeDuration }}</span>
                                                                            {{ __('global.For') }}
                                                                            {{ $val->frequency }}
                                                                            {{ $val->typeDuration }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @else
                                                            $0
                                                        @endif
                                                    @endif
                                                </div>
                                                <p>{{ $values->descr }}</p>
                                            </div>
                                            <div class="individual_opt">
                                                <div class="individual_head"
                                                    style="background-color: {{ $theme->value }}">
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
            </div>
            <div class="subscribe_content">
                <div class="outer_shape1">
                </div>
                <div class="subscribe_info" id="findGym">
                    <div class="sub_text_info">
                        <h2>{{ __('global.sub_text_info') }}</h2>
                        <p>{{ __('global.sub_text_info_p') }}.
                        </p>
                        <div class="sub_from">
                            <div class="form-group">
                                <input type="email" class="form-control" id="starting_point"
                                    placeholder="{{ __('global.find_gym_placeholder') }}">
                                <button type="button" class="searchicon_opt" id="search_btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="subscribe_map">
                        <div class="mapopt" id="map" style="height: 400px;">
                        </div>
                        <div class="round_opt_btn">
                            <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                        </div>
                        <div class="round_opt_btn2">
                            <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        document.getElementById("home_continue").addEventListener("click", function() {
            console.log("first")
            var plan_value = $("select[name= 'franchise_plan']").val();
            var url = '{{ route('homepage') }}'
            window.location.href = url + "/new-membership/" + plan_value;
        })
    </script>
    @include('footer')
    @push('scripts')
        <script
            src="https://maps.googleapis.com/maps/api/js?key={{ config('map.map_api_key') }}&libraries=places&callback=initMap"
            async defer></script>
        <script>
            function initMap() {
                var geocoder = new google.maps.Geocoder();
                var address = "{{ $data['franchise_address'] }}";
                new google.maps.places.Autocomplete(document.getElementById('starting_point'));
                var map
                var directionsService = new google.maps.DirectionsService();
                var directionsRenderer = new google.maps.DirectionsRenderer();
                geocoder.geocode({
                    'address': address
                }, function(results, status) {
                    if (status === 'OK') {
                        map = new google.maps.Map(document.getElementById('map'), {
                            center: results[0].geometry.location,
                            zoom: 15
                        });
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title: address
                        });
                        directionsRenderer.setMap(map);
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
                document.getElementById("search_btn").addEventListener("click", () => {
                    starting_point = $("#start_point").val();
                    if (starting_point == '') {
                        alert('Please set starting point first to proceed.');
                    } else {
                        var originAddress = document.getElementById("starting_point").value; // Origin address
                        var destinationAddress = '{{ $data['franchise_address'] }}'; // Destination address
                        // Remove existing markers and directions
                        directionsRenderer.setMap(null);
                        // Request and display directions from the starting point to the fixed address
                        directionsService.route({
                            origin: originAddress,
                            destination: destinationAddress,
                            travelMode: 'DRIVING'
                        }, function(response, status) {
                            if (status === 'OK') {
                                directionsRenderer.setDirections(response);
                                // Add markers for the origin and destination addresses
                                var originMarker = new google.maps.Marker({
                                    position: response.routes[0].legs[0].end_location,
                                    map: directionsRenderer.getMap(),
                                    title: destinationAddress
                                });
                            } else {
                                window.alert('Directions request failed due to ' + status);
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
</x-guest-layout>
@push('scripts')
    <script>
        $(document).ready(function() {
            $("#franchises_address").on('change', function() {
                console.log($('#franchises_address').val());
                var url = '{{ route('homepage') }}';
                url = url + '/'.$this.val()
                window.location.href = url;
            });
            $('#franchises_name').on('change', function() {
                console.log($('#franchises_name').val());
                var url = '{{ route('homepage') }}';
                url = url + '/'.$(this).attr('rel')
                window.location.href = url;
            });
        })
    </script>
    <script>
        $('.carousel.carousel-multi .item').each(function() {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().attr("aria-hidden", "true").appendTo($(this));
            if (next.next().length > 0) {
                next.next().children(':first-child').clone().attr("aria-hidden", "true").appendTo($(this));
            } else {
                $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
@endpush
