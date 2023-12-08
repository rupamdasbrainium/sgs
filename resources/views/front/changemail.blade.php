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
                        <h2 class="addpadding">{{ __('mycontactinformatiion.email_change') }}</h2>
                        <div class="fromdes_view ">
                            <div class="fromdes_info">
                                <div class="from_contentblock">
                                    <form method="POST" action="{{ route('changemail') }}">
                                        @csrf
                                        <div class="inp_row gapadj singcol_opt">
                                            <div class="form-group">
                                                <label> <em class="req_text">*</em>
                                                    {{ __('mycontactinformatiion.oldmail') }} </label>
                                                <div class="inp_cont_view">
                                                    <div class="icon_opt">
                                                        <i class="fal fa-envelope"
                                                            style="cursor: pointer;"></i>
                                                    </div>
                                                    <input class="form-control" type="email" value="{{ $client->email }}" name="oldEmail"
                                                        placeholder="" 
                                                        required>
                                                </div>
                                                @if ($errors->has('oldEmail'))
                                                    <div class="text-danger mt-3">{{ $errors->first('oldEmail') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label><em class="req_text">*</em>
                                                    {{ __('mycontactinformatiion.newmail') }} </label>
                                                <div class="inp_cont_view">
                                                    <div class="icon_opt">
                                                        <i class="fal fa-envelope" 
                                                            style="cursor: pointer;"></i>
                                                    </div>
                                                    <input class="form-control" type="email" name="newEmail"
                                                        placeholder=""
                                                        required>
                                                </div>
                                                @if ($errors->has('newEmail'))
                                                    <div class="text-danger mt-3">{{ $errors->first('newEmail') }}</div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="frombtn_wrap singcol_btn">
                                            <div class="def_btnopt2 frombtn frombtn2">
                                                <button type="submit"
                                                    class="btn2">{{ __('mycontactinformatiion.Save') }}</button>
                                                  
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
