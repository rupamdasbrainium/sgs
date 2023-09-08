@section('title', $data['title'] . ' |')
<x-admin-layout>
@include('admin.header')
<section class="maincontent_wrap inner_pageouter">
    <div class="inner_page_wrap">
        @include('admin.leftpanel')
        <div class="inner_page_des">
            <div class="content_block accountinfo">
                <div class="blocktitle">
                    <h2 class="addpadding">Admin Settings</h2>
                    <div class="fromdes_view ">
                        <div class="admin_des">
                            <div class="fromdes_info">
                                <div class="from_contentblock configuration_info">
                                    <form method="post" action="{{ route('admin.settings') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="inp_row">
                                            <div class="form-group">
                                                <label>Banner Image </label>
                                                <div class="inp_cont_view noicon_opt">
                                                    <div class="adminbanner adhight" style="background: url({{ $data['data']['banner_image'] }})no-repeat center center;">
                                                        <div class="edit_btn banneredit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="banner_image" id="banner_image" class="hidden" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Logo Image </label>
                                                <div class="inp_cont_view noicon_opt">
                                                    <div class="admin_logoadd adhight" style="background: url({{ $data['data']['logo_image'] }})no-repeat center center;">
                                                        <div class="edit_btn logoedit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="logo_image" id="logo_image" class="hidden" accept="image/*">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Color Settings</label>
                                                <div class="inp_cont_view noicon_opt">
                                                    <div class="color_Settings">
                                                        <div class="color_opt_block">
                                                            <div class="color_opt_text">
                                                                Theme Color <span class="req_text">*</span>
                                                            </div>
                                                            <div class="color_opt_inp">
                                                                <!-- <input class="inpcolor_opt" type="color" id="theme_color" name="favcolor" value="#5ADFC2"> -->
                                                                <input type="color" name="theme_color" class="inpcolor_opt" id="theme_color" value="{{ $data['data']['theme_color'] }}">
                                                                <input readonly type="text" class="inpcolor_opt inpres" id="theme_color_res" value="#5ADFC2">
                                                            </div>
                                                        </div>
                                                        <div class="color_opt_block">
                                                            <div class="color_opt_text">
                                                                Primary Button Color  <span class="req_text">*</span>
                                                            </div>
                                                            <div class="color_opt_inp">
                                                                <!-- <input class="inpcolor_opt" type="color" id="pri_btncolor" name="favcolor" value="#1D1D1B"> -->
                                                                <input name="primary_button_color" type="color" class="inpcolor_opt" id="pri_btncolor" value="{{ $data['data']['primary_button_color'] }}">
                                                                <input readonly type="text" class="inpcolor_opt inpres" id="pri_btncolor_res" value="#5ADFC2">
                                                            </div>
                                                        </div>
                                                        <div class="color_opt_block">
                                                            <div class="color_opt_text">
                                                                Secondary Button Color  <span class="req_text">*</span>
                                                            </div>
                                                            <div class="color_opt_inp">
                                                                <!-- <input class="inpcolor_opt" type="color" id="btncolor" name="favcolor" value="#FFB11A"> -->
                                                                <input name="secondary_button_color" type="color" class="inpcolor_opt" id="sec_btncolor" value="{{ $data['data']['secondary_button_color'] }}">
                                                                <input readonly type="text" class="inpcolor_opt inpres" id="sec_btncolor_res" value="#FFB11A">
                                                            </div>
                                                        </div>
                                                        <div class="color_opt_block">
                                                            <div class="color_opt_text">
                                                                Text Color <span class="req_text">*</span>
                                                            </div>
                                                            <div class="color_opt_inp">
                                                                <!-- <input class="inpcolor_opt" type="color" id="textcolor" name="favcolor" value="#575757"> -->
                                                                <input name="text_button_color" type="color" class="inpcolor_opt" id="textcolor" value="{{ $data['data']['text_button_color'] }}">
                                                                <input readonly type="text" class="inpcolor_opt inpres" id="textcolor_res" value="#575757">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="frombtn_wrap singcol_btn">
                                            <div class="def_btnopt2 frombtn frombtn2">
                                                <button type="submit" class="btn2">Save</button>
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
                        $(target_ele).css('background', 'url(' + ev.target.result + ')no-repeat center center');
                    }
                    reader.readAsDataURL(e.target.files[i]);
                }
            }
        });
    });
</script>
@endpush
</x-admin-layout>