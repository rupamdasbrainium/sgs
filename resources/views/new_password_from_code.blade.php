<x-guest-layout>
    @section('title', $data['title'] . ' |')
    @section('style', ';--sub_btn-bg: '.$button->value. ';--sub_btnhover-bg:' .$primary_button_color_hover->value)
    @include('header')
    <div class="banner_outer inner_banner">
        <div class="banner_slider">
            <div class="banner_panel">
                <div class="banner_img">
                    <img src="{{ asset('public/images/passwordadd.png') }}" style=" filter: grayscale(100%);" alt="">
                </div>
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
    <section class="maincontent_wrap innermain_content">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcomesec_info inner_heading">
                            <div class="round_opt_btn3">
                                <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                            </div>
                            
                            <div class="heading_info sublogo ">
                                <img  src="{{ asset('public/images/logo.svg') }}" alt="">
                            </div>
                            <h2>{{ __('forgetpassword.Set_newPassword') }}</h2>
                            <p>{{ __('forgetpassword.Fear_not_msg') }}</p>
                        </div>
                        <div class="fromdes_info">
                            <form method="POST" action="{{ route('update_password_from_mail') }}">
                                @csrf
                                <div class="from_cont_wrap">
                                    <div class="inp_row rowopt2">
                                        <div class="form-group">
                                            <label for="user_name">{{ __('forgetpassword.Email') }}</label>
                                            <div class="rowopt2_wrap1">
                                                <div class="inp_cont_view">
                                                    <div class="icon_opt">
                                                        <i class="fal fa-user"></i>
                                                    </div>
                                            <input type="text" class="form-control" name="userName"  placeholder="" required>
                                                </div>
                                            <label for="user_name">{{ __('forgetpassword.tempCode') }}</label>
                                            <div class="rowopt2_wrap1">
                                                <div class="inp_cont_view">
                                                    <div class="icon_opt">
                                                        <i class="fal fa-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" name="tempCode"  placeholder="" required>
                                                    </div>
                                                <label for="user_name">{{ __('forgetpassword.newpassword') }}</label>
                                                <div class="rowopt2_wrap1">
                                                    <div class="inp_cont_view">
                                                        <div class="icon_opt">
                                                            <i class="fal fa-key"></i>
                                                        </div>
                                                <input type="text" class="form-control" name="newPassword"  placeholder="********" required>
                                                    </div>
                                                <div class="def_btnopt2 frombtn">
                                                    <button type="submit" class="btn2" >{{ __('forgetpassword.Reset_Password') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="round_opt_btn">
            <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
        </div>
    </section>
    @include('footer')
    </x-guest-layout>