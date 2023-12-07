<x-app-layout>
    @section('title', $data['title'] . ' |')
    @section('style', ';--sub_btn-bg: ' . $button->value . ';--sub_btnhover-bg:' . $primary_button_color_hover->value)
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">
                <div class="content_block accountinfo">
                    <div class="blocktitle">
                        <h2 class="addpadding">{{ __('changepassword.Change_Password') }}</h2>
                        <div class="fromdes_view ">
                            <div class="fromdes_info">
                                <div class="from_contentblock">
                                    <form action="{{ route('changePasswordUser') }}" method="post">
                                        @csrf
                                        <div class="inp_row gapadj singcol_opt">
                                            <div class="form-group">
                                                <label> <em class="req_text">*</em>
                                                    {{ __('changepassword.Old_Password') }} </label>
                                                <div class="inp_cont_view">
                                                    <div class="icon_opt">
                                                        <i class="fal fa-eye" id="togglePassword"
                                                            style="cursor: pointer;"></i>
                                                    </div>
                                                    <input class="form-control" type="password" name="old_password"
                                                        placeholder="**************" autocomplete="current-password"
                                                        required="" id="id_password">
                                                </div>
                                                @error('old_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><em class="req_text">*</em>
                                                    {{ __('changepassword.New_Password') }} </label>
                                                <div class="inp_cont_view">
                                                    <div class="icon_opt">
                                                        <i class="fal fa-eye" id="togglePassword2"
                                                            style="cursor: pointer;"></i>
                                                    </div>
                                                    <input class="form-control" type="password" name="new_password"
                                                        placeholder="**************" autocomplete="current-password"
                                                        required="" id="id_password2">
                                                </div>
                                                @error('new_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><em class="req_text">*</em>
                                                    {{ __('changepassword.Confirm_Password') }}</label>
                                                <div class="inp_cont_view">
                                                    <div class="icon_opt">
                                                        <i class="fal fa-eye" id="togglePassword3"
                                                            style="cursor: pointer;"></i>
                                                    </div>
                                                    <input class="form-control" type="password" name="confirm_password"
                                                        placeholder="**************" autocomplete="current-password"
                                                        required="" id="id_password3">
                                                </div>
                                                @error('confirm_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="frombtn_wrap singcol_btn">
                                            <div class="def_btnopt2 frombtn frombtn2">
                                                <button type="submit"
                                                    class="btn2">{{ __('changepassword.Change_Password') }}</button>
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
    @include('footer')
</x-app-layout>
