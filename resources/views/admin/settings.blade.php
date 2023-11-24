@section('title', $data['title'] . ' |')
<x-admin-layout>
    @include('admin.header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('admin.leftpanel')
            <div class="inner_page_des">
                <div class="content_block accountinfo">
                    <div class="blocktitle">
                        <h2 class="addpadding">{{ __('admin.Admin_Settings') }}</h2>
                        <div class="fromdes_view ">
                            <div class="admin_des">
                                <div class="fromdes_info">
                                    <div class="from_contentblock configuration_info">
                                        <form method="post" action="{{ route('admin.settings') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="inp_row">
                                                <div class="form-group">
                                                    <label>{{ __('admin.Banner_Image') }} </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <div class="adminbanner adhight"
                                                            style="background: url({{ $data['data']['banner_image'] }})no-repeat center center;">
                                                            <div class="edit_btn banneredit"
                                                                style="background-color: {{ $button->value }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </div>
                                                        </div>
                                                        <input type="file" name="banner_image" id="banner_image"
                                                            class="hidden" accept="image/*">
                                                    </div>
                                                    @error('banner_image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Banner_Title') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="title"
                                                            placeholder="{{ __('admin.Banner_Title') }}"
                                                            value="{{ $title->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Banner_Title_fr') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="title_fr"
                                                            placeholder="{{ __('admin.Banner_Title_fr') }}"
                                                            value="{{ $title_fr->value}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Banner_subtitle') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="subtitle"
                                                            placeholder="{{ __('admin.Banner_subtitle') }}"
                                                            value="{{ $subtitle->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Banner_subtitle_fr') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="subtitle_fr"
                                                            placeholder="{{ __('admin.Banner_subtitle_fr') }}"
                                                            value="{{ $subtitle_fr->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Home_Title') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="home_title"
                                                            placeholder="{{ __('admin.Home_Title') }}"
                                                            value="{{ $home_title->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Home_Title_fr') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="home_title_fr"
                                                            placeholder="{{ __('admin.Home_Title_fr') }}"
                                                            value="{{ $home_title_fr->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Home_Magic_Plan') }} <em
                                                            class="req_text">*</em> </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="home_magicplan"
                                                            placeholder="{{ __('admin.Home_Magic_Plan') }}"
                                                            value="{{ $home_magicplan->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Home_Magic_Plan_fr') }} <em
                                                            class="req_text">*</em> </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="home_magicplan_fr"
                                                            placeholder="{{ __('admin.Home_Magic_Plan_fr') }}"
                                                            value="{{ $home_magicplan_fr->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Home_Body') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="home_body"
                                                            placeholder="{{ __('admin.Home_Body') }}"
                                                            value="{{ $home_body->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Home_Body_fr') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="home_body"
                                                            placeholder="{{ __('admin.Home_Body_fr') }}"
                                                            value="{{ $home_body_fr->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Video') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="video"
                                                            placeholder="{{ __('admin.Video') }}"
                                                            value="{{$video->value}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Phone') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="admin_phone"
                                                            placeholder="{{ __('admin.Phone') }}"
                                                            value="{{ $admin_phone->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Address') }} <em class="req_text">*</em>
                                                    </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <input type="text" class="form-control" name="admin_address"
                                                            placeholder="{{ __('admin.Address') }}"
                                                            value="{{ $admin_address->value }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('admin.Logo_Image') }} </label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <div class="admin_logoadd adhight"
                                                            style="background: url({{ $data['data']['logo_image'] }})no-repeat center center;">
                                                            <div class="edit_btn logoedit"
                                                                style="background-color: {{ $button->value }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </div>
                                                        </div>
                                                        <input type="file" name="logo_image" id="logo_image"
                                                            class="hidden" accept="image/*">
                                                    </div>
                                                    @error('logo_image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{{ __('admin.Color_Settings') }}</label>
                                                    <div class="inp_cont_view noicon_opt">
                                                        <div class="color_Settings">
                                                            <div class="color_opt_block">
                                                                <div class="color_opt_text">
                                                                    {{ __('admin.Theme_Color') }} <span
                                                                        class="req_text">*</span>
                                                                </div>
                                                                <div class="color_opt_inp">
                                                                    <!-- <input class="inpcolor_opt" type="color" id="theme_color" name="favcolor" value="#5ADFC2"> -->
                                                                    <input type="color" name="theme_color"
                                                                        class="inpcolor_opt" id="theme_color"
                                                                        value="{{ $data['data']['theme_color'] }}">
                                                                    <input readonly type="text"
                                                                        class="inpcolor_opt inpres" id="theme_color_res"
                                                                        value="#5ADFC2">
                                                                </div>
                                                            </div>
                                                            <div class="color_opt_block">
                                                                <div class="color_opt_text">
                                                                    {{ __('admin.theme_color_hover') }} <span
                                                                        class="req_text">*</span>
                                                                </div>
                                                                <div class="color_opt_inp">
                                                                    <!-- <input class="inpcolor_opt" type="color" id="theme_color" name="favcolor" value="#5ADFC2"> -->
                                                                    <input type="color" name="theme_color_hover"
                                                                        class="inpcolor_opt" id="theme_color_hover"
                                                                        value="{{ $data['data']['theme_color_hover'] }}">
                                                                    <input readonly type="text"
                                                                        class="inpcolor_opt inpres" id="theme_color_hover_res"
                                                                        value="#5ADFC2">
                                                                </div>
                                                            </div>
                                                            <div class="color_opt_block">
                                                                <div class="color_opt_text">
                                                                    {{ __('admin.Primary_Button_Color') }} <span
                                                                        class="req_text">*</span>
                                                                </div>
                                                                <div class="color_opt_inp">
                                                                    <!-- <input class="inpcolor_opt" type="color" id="pri_btncolor" name="favcolor" value="#1D1D1B"> -->
                                                                    <input name="primary_button_color" type="color"
                                                                        class="inpcolor_opt" id="pri_btncolor"
                                                                        value="{{ $data['data']['primary_button_color'] }}">
                                                                    <input readonly type="text"
                                                                        class="inpcolor_opt inpres"
                                                                        id="pri_btncolor_res" value="#5ADFC2">
                                                                </div>
                                                            </div>
                                                            {{-- <div class="color_opt_block">
                                                                <div class="color_opt_text">
                                                                    {{ __('admin.Secondary_Button_Color') }} <span
                                                                        class="req_text">*</span>
                                                                </div>
                                                                <div class="color_opt_inp">
                                                                    <!-- <input class="inpcolor_opt" type="color" id="btncolor" name="favcolor" value="#FFB11A"> -->
                                                                    <input name="secondary_button_color"
                                                                        type="color" class="inpcolor_opt"
                                                                        id="sec_btncolor"
                                                                        value="{{ $data['data']['secondary_button_color'] }}">
                                                                    <input readonly type="text"
                                                                        class="inpcolor_opt inpres"
                                                                        id="sec_btncolor_res" value="#FFB11A">
                                                                </div>
                                                            </div> --}}
                                                            <div class="color_opt_block">
                                                                <div class="color_opt_text">
                                                                    {{ __('admin.Text_Color') }} <span
                                                                        class="req_text">*</span>
                                                                </div>
                                                                <div class="color_opt_inp">
                                                                    <!-- <input class="inpcolor_opt" type="color" id="textcolor" name="favcolor" value="#575757"> -->
                                                                    <input name="text_button_color" type="color"
                                                                        class="inpcolor_opt" id="textcolor"
                                                                        value="{{ $data['data']['text_button_color'] }}">
                                                                    <input readonly type="text"
                                                                        class="inpcolor_opt inpres" id="textcolor_res"
                                                                        value="#575757">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="frombtn_wrap singcol_btn">
                                                <div class="def_btnopt2 frombtn frombtn2">
                                                    <button type="submit" class="btn2"
                                                        style="background-color: {{ $button->value }}">{{ __('admin.Save') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.footer')
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('.banneredit').on('click', function() {
                    $('#banner_image').trigger('click');
                });
                $('.logoedit').on('click', function() {
                    $('#logo_image').trigger('click');
                });
                $(document).on('change', '#banner_image, #logo_image', function(e) {
                    var target_ele = '.adminbanner';
                    if ($(this).attr('id') == 'logo_image') {
                        target_ele = '.admin_logoadd';
                    }
                    if (e.target.files) {
                        for (var i = 0; i < e.target.files.length; i++) {
                            var reader = new FileReader();
                            reader.onload = function(ev) {
                                $(target_ele).css('background', 'url(' + ev.target.result +
                                    ')no-repeat center center');
                            }
                            reader.readAsDataURL(e.target.files[i]);
                        }
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>
