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
                                        <span>{{ __('global.banner_info_h1_span') }}</span></h1>
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

            <div class="welcomesec_info">
                <div class="round_opt_btn3">
                    <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                </div>

                <div class="categories_outer prod_viewsection_outer">
                    <div class="heading_title">
                        <h2>{{ __('global.Visit_of_Our_Center') }}</h2>
                    </div>
                    @if(isset($video))
                    <div class="categories_video_wrap">
                        <div class="round_opt1">
                            <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                        </div>

                        {{-- <div class="video_btn">
                            <div class="play_btn">
                                <a href="{{$video->value}}">Video</a>
                            </div>
                        </div> --}}
                        <div class="video_btn">
                            <div class="play_btn">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                        <div class="categories_addblock">
                            <div class="add_video activevideo">
                                <img src="{{ asset('public/images/videoadd1.png') }}" alt="">
                            </div>
                            <div class="add_video">
                                <img src="{{ asset('public/images/videoadd2.png') }}" alt="">
                            </div>
                        </div>
                        <video height="200px" src="{{$video->value}}"></video>
                    </div>
                    @else
                    <div class="categories_video_wrap">
                        <div class="round_opt1">
                            <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                        </div>

                        <div class="video_btn">
                            <div class="play_btn">
                                <a href="{{$video->value}}">Video</a>
                            </div>
                        </div>
                        <div class="categories_addblock">
                            <div class="add_video activevideo">
                                <img src="{{ asset('public/images/videoadd1.png') }}" alt="">
                            </div>
                            <div class="add_video">
                                <img src="{{ asset('public/images/videoadd2.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="categories_option">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading_title">
                            <h2>{{ __('global.List_of_Categories') }}</h2>
                        </div>
                        <div class="categories_des">
                            {{-- <div class="cat_opt_item">
                                <div class="cat_opt_img">
                                    <a href="#"><img src="{{ asset('public/images/cat_icon1.svg') }}"
                                            alt=""> </a>
                                </div>
                                <h3><a href="#">{{ __('global.Gym_Access') }}</a></h3>
                                <div class="cat_opt_text">
                                    <p>{{ __('global.Gym_Access_refers') }} <span class="more_content_text">+</span></p>

                                </div>
                            </div>
                            <div class="cat_opt_item">
                                <div class="cat_opt_img">
                                    <a href="#"><img src="{{ asset('public/images/cat_icon2.svg') }}"
                                            alt=""> </a>
                                </div>
                                <h3><a href="#">{{ __('global.Private_Training') }}</a></h3>
                                <div class="cat_opt_text">
                                    <p>{{ __('global.Private_Training_con') }}
                                        <span class="more_content_text">+</span></p>

                                </div>
                            </div>
                            <div class="cat_opt_item">
                                <div class="cat_opt_img">
                                    <a href="#"><img src="{{ asset('public/images/cat_icon3.svg') }}"
                                            alt=""> </a>
                                </div>
                                <h3><a href="#">{{ __('global.Group_Class') }}</a></h3>
                                <div class="cat_opt_text">
                                    <p>{{ __('global.Group_Class_under') }}<span class="more_content_text">+</span></p>

                                </div>
                            </div> --}}
                            @foreach ($data['category'] as $item)
                                <div class="cat_opt_item">
                                    <div class="cat_opt_img">
                                        @if ($item->logo == null)
                                        <a href="{{route('categoryplan')}}"> <img src="{{ asset('public/images/cat_icon3.svg') }}" alt=""> </a>
                                        @else
                                            <img src="{{ $item->logo }}" alt="">
                                        @endif
                                        
                                    </div>
                                    <h3><a href="{{route('categoryplan')}}">{{$item->title}}</a></h3>
                                    <div class="cat_opt_text">
                                        <p>{{$item->description}}<span class="more_content_text">+</span></p>

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
