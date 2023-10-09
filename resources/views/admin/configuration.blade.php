@section('title', $data['title'] . ' |')
<x-admin-layout>
@include('admin.header')
<section class="maincontent_wrap inner_pageouter">
    <div class="inner_page_wrap">
        @include('admin.leftpanel')
        <div class="inner_page_des">
            <div class="content_block accountinfo">
                <div class="blocktitle">
                    <h2 class="addpadding">Admin Configuration</h2>
                    <div class="fromdes_view ">
                        <div class="fromdes_info">
                            <div class="from_contentblock configuration_info">
                                <form method="post" action="{{ route('admin.configuration') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="inp_row">
                                        <div class="form-group">
                                            <label>Identifier <em class="req_text">*</em> </label>
                                            <div class="inp_cont_view noicon_opt">
                                                <input class="form-control" type="password" name="identifier" placeholder="" value="{{ $data['data']['identifier'] }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="inp_row">
                                            <div class="form-group">
                                                <label for="id_password">Password</label>
                                                <div class="inp_cont_view inp_cont_view2">
                                                    <div class="icon_opt">
                                                        <i class="fal fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                                    </div>
                                                    <input class="form-control" type="password" name="password" placeholder="" autocomplete="current-password" id="id_password" value="{{ $data['data']['password'] }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>google key <em class="req_text">*</em> </label>
                                            <div class="inp_cont_view noicon_opt">
                                                <input class="form-control" type="text" name="identifier" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >Google Account Number  </label>
                                            <div class="inp_cont_view noicon_opt">
                                                <input class="form-control" type="text" name="gaccountno" placeholder="It would be used for Google Analytics purpose" value="{{ $data['data']['gaccountno'] }}" >
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
</section>
@include('admin.footer')
</x-admin-layout>