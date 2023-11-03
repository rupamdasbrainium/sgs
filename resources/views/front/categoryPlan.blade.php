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
                        {{-- @if ($data_plan['categoryPlan']->data == null)
                            <center><p>No Plan is available</p></center>
                        @else
                            @foreach ($data_plan['categoryPlan'] as $plan)
                                {{$plan->data}}                                
                            @endforeach
                        @endif --}}
                        @if (!empty($planData))
                            <div class="prod_item_wrap owl-carousel owl-theme" id="home_prod_item">
                                @foreach ($planData as $plan)
                                    {{-- @php
                                    $subscription_plan = APICall("/SubscriptionPlans/type/".$plan."?language_id=2","get",'{}')
                                @endphp --}}
                                    <div class="prod_item">
                                        <div class="action_opt action_opt_title" style="background-color: #ff0000">

                                            <div class="action_text">

                                                <div class="selectcont ">

                                                    <div class="arrowdown2">

                                                    </div>
                                                    <select class="select_opt" title=" M2Move GYM accès 12 mois">
                                                        <option value="474">

                                                            M2Move GYM ...

                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action_opt adj_height">
                                            <div class="price_text">

                                                <div class="selectcont ">
                                                    <div class="arrowdown2">
                                                        <i class="fal fa-chevron-down"></i>
                                                    </div>
                                                    <select class="select_opt">


                                                        <option>$23.94/
                                                            Two weeks For 26 Two weeks
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <p></p>
                                        </div>
                                        <div class="individual_opt">
                                            <div class="individual_head" style="background-color: #ff0000">
                                                Age restriction : 0 to 120
                                            </div>
                                            <div class="individual_des">
                                                <ul>
                                                    <li><span><i class="fal fa-times"></i></span>18/7 access
                                                    </li>
                                                    <li><span><i class="fal fa-times"></i></span>30 minutes consultation
                                                        with a trainer
                                                    </li>
                                                    <li><span><i class="fal fa-times"></i></span>Access to Movaxion (20
                                                        centers in Quebec)
                                                    </li>

                                                </ul>
                                                <div class="subscribe_btn">
                                                    <a href="http://localhost/sgs/new-membership/474" class="sub_btn"
                                                        style="background-color: #c600e0">Subscribe</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <center>
                                <p>No Plan is available</p>
                            </center>
                        @endif

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
