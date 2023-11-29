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
                                    @if($lang_id == 2)
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
                    <div class="videos_css">
                        {{-- <div class="round_opt1">
                            <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                        </div> --}}

                        {{-- <div class="video_btn">
                            <div class="play_btn">
                                <a href="{{$video->value}}">Video</a>
                            </div>
                        </div> --}}
                        {{-- <div class="video_btn">
                            <div class="play_btn">
                                <i class="fas fa-play"></i>
                            </div>
                        </div> --}}
                        <div class="categories_addblock">
                            <div class="add_video activevideo">
                                <iframe width="412.28" height="300.30" src="{{$video->value}}" >
                                    {{-- <source  type="video/mp4"> --}}
                                </iframe>
                            </div>
                          
                        </div>
                      
                    </div>
                    @else
                    <div class="categories_video_wrap">
                        <div class="round_opt1">
                            <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                        </div>

                        <div class="video_btn">
                            <div class="play_btn">
                                <a href="">Video</a>
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
                                    <a href="{{ route('categoryplan', ['category_id'=>$item->id,'name'=>$item->title]) }}">
                                        <div class="cat_opt_img">
                                            @if ($item->logo == null)
                                                <img src="{{ asset('public/images/cat_icon3.svg') }}" alt=""> 
                                            @else
                                                <img src="data:image/png;base64,{{ $item->logo }}" alt="">
                                            @endif
                                        
                                        </div> 
                                    </a> 
                                    {{-- <div class="cat_opt_img">
                                        @if ($item->logo == null)
                                        <a href="{{ route('categoryplan', ['category_id'=>$item->id,'name'=>$item->title]) }}"> <img src="{{ asset('public/images/cat_icon3.svg') }}" alt=""> </a>
                                        @else
                                            <a href="{{ route('categoryplan', ['category_id'=>$item->id,'name'=>$item->title]) }}"> <img src="{{ $item->logo }}" alt=""> </a>
                                        @endif
                                        
                                    </div> --}}
                                    <h3><a href="{{route('categoryplan', ['category_id'=>$item->id,'name'=>$item->title])}}">{{$item->title}}</a></h3>
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
