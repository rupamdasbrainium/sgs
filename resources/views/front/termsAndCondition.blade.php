<x-guest-layout>
    @php
        $lang_id = getLocale();
    @endphp
    @section('title', $data['title'] . ' |')
    @include('header')
    <div class="banner_outer inner_banner">
        <div class="banner_slider">
            <div class="banner_panel">
                <div class="banner_cont">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner_outer_shape">
        </div>
    </div>
    <section class="maincontent_wrap innermain_content user_information">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="inner_def_cont">
                            <div class="welcomesec_info inner_heading">
                                <div class="round_opt_btn3">
                                    {{-- <img src="{{ asset('public/images/roundopt2.jpg') }}" alt=""> --}}
                                </div>
                                @if ($lang_id == 2)
                                    <h2>{{ $terms->title_en }}</h2>
                                @else
                                    <h2>{{ $terms->title_fr }}</h2>
                                @endif
                                <p>{{ __('footer.Effective_Date') }}: {{ date('Y-m-d', strtotime($terms->created_at)) }}
                                </p>
                            </div>
                            @if ($lang_id == 2)
                                {!! $terms->body_en !!}
                            @else
                                {!! $terms->body_fr !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="round_opt_btn rount_opt2">
            <img src="images/roundopt2.jpg" alt="">
        </div>
        <div class="round_opt_btn rount_opt3">
            <img src="images/roundopt2.jpg" alt="">
        </div>
    </section>
    @include('footer')
</x-guest-layout>
