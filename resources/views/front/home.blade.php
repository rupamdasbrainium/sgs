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
                    @if(isset($banner))
                    <img src="{{ asset('public/upload/banner/' . $banner->value) }}" style="width: 1349px; height:659.73px;" alt="">
                    @else
                    <img src="{{ asset('public/images/yoav_banner_img.png') }}" alt="">
                    @endif
                </div>
                <div class="banner_cont">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="banner_info">
                                    <h1>{{ $title->value }}</h1>
                                    <h2>{{ $subtitle->value}}</h2>
                                    {{-- <h1>Elevate Your <span>Fitness,</span></h1> --}}
                                    {{-- <h2>Ignite Your Potential!</h2> --}}
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
                                <h3>{{ $home_title->value}}</h3>
                            </div>
                            <h2>{{ $home_magicplan->value}}</h2>
                            {{-- <p>Transform Your Body, Transform Your Life at Fitness Gym</p> --}}
                            <p>{{ $home_body->value}}</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="prod_viewsection_outer">
                <div class="round_opt1">
                    <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                </div>

                <div class="prod_viewsection">

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
                                            {{-- $franchise->address_province_id --}}
                                            <select class="select_opt" id="franchises_address" title="{{ $franchise->address_civic_number }}{{ $franchise->address_street }}{{ $franchise->address_city }}">
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
                                        {{-- <button type="button" class="btn2" id="home_continue">Continue</button> --}}
                                        <button type="button" style="background-color: {{$button->value}}" class="btn2" id="home_continue">{{ __('global.continue') }}</button>
                                    </div>


                                </div>
                                <div class="prod_item_wrap owl-carousel owl-theme" id="home_prod_item">

                                    {{-- @dd($data['best_four_plan_details']) --}}

                                    {{-- @foreach ($data['best_four_plan_details'] as $key => $values) --}}
                                    @foreach ($data['all_plan_data'] as $key => $values)
                                    {{-- @php
                                        $item = $data['all_plan_data'][$key];
                                    @endphp --}}
                                        <div class="prod_item">
                                            <div class="action_opt action_opt_title" style="background-color: {{$theme->value}}">

                                                <div class="action_text">

                                                    <div class="selectcont ">
                                                        
                                                        <div class="arrowdown2">
                                                            {{-- <i class="far fa-chevron-down"></i> --}}
                                                        </div>
                                                        <select class="select_opt" title=" {{ $values->name }}">
                                                            <option value="{{$values->id}}" >

                                                                {{ $values->name }}

                                                            </option>
                                                            {{-- <option value="Action2">Action 2</option>
                                                            <option value="Action3">Action 3</option>
                                                            <option value="Action4">Action 4</option> --}}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action_opt adj_height">
                                                <div class="price_text">

                                                    @if (isset($values))
                                                        @if (count($values->priceBydurations))
                                                            <div class="selectcont ">
                                                                <div class="arrowdown2">
                                                                    <i class="fal fa-chevron-down"></i>
                                                                </div>
                                                                <select class="select_opt">

                                                                    @foreach ($values->priceBydurations as $val)
                                                                        {{-- ${{ $val->price_recurant }}<span>/
                                                                            {{ $val->duration_unit_display }}</span> For {{ $val->frequency }} {{ $val->duration_unit_display }}
                                                                            @if(!$loop->last)
                                                                                <br>
                                                                            @endif --}}
                                                                        <option>${{ $val->price }}<span>/
                                                                            {{ $val->typeDuration }}</span> For {{ $val->frequency }} {{ $val->typeDuration }}
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
                                                <p>{{ $values->descr }}</p>
                                            </div>
                                            <div class="individual_opt">
                                                <div class="individual_head" style="background-color: {{$theme->value}}">
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
                                                        {{-- <li>{{ $lang_id == 2 ? $item['descr_english'] : $item['descr_french'] }}</li> --}}
                                                    </ul>
                                                    <div class="subscribe_btn">
                                                        <a href="{{ route('newMembershipfont', [$values->id]) }}"
                                                            class="sub_btn" style="background-color: {{$button->value}}" >{{ __('global.subscribe') }}</a>
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

        <div class="subscribe_content" >
            <div class="outer_shape1">
            </div>
            <div class="subscribe_info" id="findGym">
                <div class="sub_text_info" >
                    <h2>{{ __('global.sub_text_info') }}</h2>
                    <p>{{ __('global.sub_text_info_p') }}.
                    </p>
                    <div class="sub_from">
                        
                        <div class="form-group">
                            <input type="email" class="form-control" id="starting_point" placeholder="{{ __('global.find_gym_placeholder') }}">
                            <button type="button" class="searchicon_opt" id="search_btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="subscribe_map">
                    <!-- <img src="{{ asset('public/images/map.png') }}" alt=""> -->
                    <div class="mapopt" id="map" style="height: 400px;">
                        {{-- <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.1220591551264!2d88.43105637416711!3d22.574537732901522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275af0f72e607%3A0x7b8571e4cca5cae4!2s60%2C%20Street%20Number%2018%2C%20EN%20Block%2C%20Sector%20V%2C%20Bidhannagar%2C%20Kolkata%2C%20West%20Bengal%20700091!5e0!3m2!1sen!2sin!4v1690264798361!5m2!1sen!2sin"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
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

        // $("#home_continue").click(function(){
        //     console.log("first")
            document.getElementById("home_continue").addEventListener("click", function() {
                console.log("first")
// var selected_value = $("select[name= 'franchise_name']").val();
// var url = '{{route("homepage")}}'
// window.location.href = url+"/"+selected_value;

var plan_value = $("select[name= 'franchise_plan']").val();
var url = '{{route("homepage")}}'
window.location.href = url+"/new-membership/"+plan_value;
        })
    </script>
    {{-- <script src="http://localhost/sgs/public/js/custom.js"></script> --}}
    @include('footer')
    
    @push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('map.map_api_key') }}&libraries=places&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var geocoder = new google.maps.Geocoder();
            var address = "{{ $data['franchise_address'] }}";
            new google.maps.places.Autocomplete(document.getElementById('starting_point'));
            var map
            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            
            geocoder.geocode({ 'address': address }, function(results, status) {
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
                    // allowStartingPointSelection(map);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });

            document.getElementById("search_btn").addEventListener("click", () => {
                starting_point = $("#start_point").val();
                if(starting_point=='')
                {
                    alert('Please set starting point first to proceed.');
                }else{
                    var originAddress = document.getElementById("starting_point").value; // Origin address
                    var destinationAddress = '{{ $data['franchise_address'] }}'; // Destination address
                    // Remove existing markers and directions
                    directionsRenderer.setMap(null);

                    // Add a marker for the selected starting point
                    // var startingPointMarker = new google.maps.Marker({
                    //     position: event.latLng,
                    //     map: map,
                    //     title: 'Starting Point Marker'
                    // });

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
                // });
                }
            });

            // Call a function to allow the user to select a starting point
            
            
                    // calculateAndDisplayRoute(directionsService, directionsRenderer);
                    
                

            // // Create a new map centered at a specific location
            // var map = new google.maps.Map(document.getElementById('map'), {
            //     center: { lat: 40.7128, lng: -74.0060 }, // New York City coordinates
            //     zoom: 12
            // });

            // // Create a marker and set its position
            // var marker = new google.maps.Marker({
            //     position: { lat: 40.7128, lng: -74.0060 }, // Marker position (New York City)
            //     map: map, // Associate the marker with a map
            //     title: 'New York City' // Marker tooltip text
            // });
        }

        // function allowStartingPointSelection(map) {
        //     var directionsService = new google.maps.DirectionsService();
        //     var directionsRenderer = new google.maps.DirectionsRenderer();
        //     directionsRenderer.setMap(map);

        //     // Listen for click events on the map
        //     // google.maps.event.addListener(map, 'click', function(event) {
        //     document.getElementById("search_btn").addEventListener("click", () => {
        //         starting_point = $("#start_point").val();
        //         if(starting_point=='')
        //         {
        //             alert('Please set starting point first to proceed.');
        //         }else{
        //             var originAddress = document.getElementById("starting_point").value; // Origin address
        //             var destinationAddress = '{{ $data['franchise_address'] }}'; // Destination address
        //             // Remove existing markers and directions
        //             directionsRenderer.setMap(null);

        //             // Add a marker for the selected starting point
        //             // var startingPointMarker = new google.maps.Marker({
        //             //     position: event.latLng,
        //             //     map: map,
        //             //     title: 'Starting Point Marker'
        //             // });

        //             // Request and display directions from the starting point to the fixed address
        //             directionsService.route({
        //                 origin: originAddress,
        //                 destination: destinationAddress,
        //                 travelMode: 'DRIVING'
        //             }, function(response, status) {
        //                 if (status === 'OK') {
        //                     directionsRenderer.setDirections(response);
        //                     // Add markers for the origin and destination addresses
        //                     var originMarker = new google.maps.Marker({
        //                         position: response.routes[0].legs[0].end_location,
        //                         map: directionsRenderer.getMap(),
        //                         title: destinationAddress
        //                     });
        //                 } else {
        //                     window.alert('Directions request failed due to ' + status);
        //                 }
        //             });
        //         // });
        //         }
        //     });
            
        // }

    </script>
    @endpush
</x-guest-layout>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#franchises_address").on('change', function() {
                console.log($('#franchises_address').val());
                var url = '{{ route('homepage') }}';
                url = url+'/'. $this.val()
                window.location.href = url;
            });

            $('#franchises_name').on('change', function() {
        console.log($('#franchises_name').val());
                var url = '{{ route('homepage') }}';
                url = url+'/'. $(this).attr('rel')
                window.location.href = url;
            });
            // $.ajax({
            //     type: "POST",
            //     url: searchURI,
            //     dataType: "json",
            //     data: {
            //         _token: $('meta[name="csrf-token"]').attr("content"),
            //         query: request.term,
            //         date_range: $("#departure_date").val(),
            //     },
            //     success: function(data) {
            //         if (!data.length) {
            //             var result = [{
            //                 label: noMatch,
            //                 value: response.term,
            //             }, ];
            //             response(result);
            //         } else {
            //             response(data);
            //         }
            //     },
            // });
        })
    </script>
    <script>
    $('.carousel.carousel-multi .item').each(function () {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().attr("aria-hidden", "true").appendTo($(this));
    
        if (next.next().length > 0) {
            next.next().children(':first-child').clone().attr("aria-hidden", "true").appendTo($(this));
        }
        else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });
    </script>

   
    
@endpush
