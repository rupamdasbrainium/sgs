<x-app-layout>
    @section('title', $data['title'] . ' |')
    @section('style', ';--sub_btn-bg: '.$button->value. ';--sub_btnhover-bg:' .$primary_button_color_hover->value)

    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">
                <div class="content_block accountinfo">
                    <div class="blocktitle2">
                        <h2>{{ __('mybankcards.My_Credit_Card_Bank_Account') }}</h2>
                    </div>
                    <div class="fromdes_view">
                        <div class="fromdes_info user_contentblock">
                            <div class="from_cont_wrap">
                                <div class="cards_des_wrap">
                                        <div class="row">
                                            <h3>{{ __('mybankcards.Credit_Cards') }}:</h3>
                                                @foreach ($data['pay_methods_accc']->data as $value)												
												<div class="col-md-6">
                                                    <div class="cards_desinfo_item ">
                                                        <div class="cards_cont_block">
                                                            <div class="card_cont_des">
                                                                <div class="card_img">
                                                                </div>

                                                                <div class="card_view">
                                                                    <div class="card_item_top">
                                                                        <div class="card_item_head">

                                                                            <h4>{{ $value->owner_name }}</h4>

                                                                            <div class="def_card">
                                                                                <a href="#">{{ __('mybankcards.By_Default') }}</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card_name_opt">
                                                                        <h5>{{ __('mybankcards.Platinum_Mastercard_BNC') }}</h5>
                                                                    </div>
                                                                    <div class="card_optblock">
                                                                        <div class="card_icon_text">

                                                                            <span class="card_opt_text">{{ __('mybankcards.Credit_card_ending') }}</span>
                                                                            <span class="card_opt_pass">**** </span>
                                                                            <span
                                                                                class="card_opt_pass">{{ $value->four_digits_number }}</span>

                                                                        </div>
                                                                        <div class="card_icon">
                                                                            <img src="{{ asset('public/images/card.png') }}"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="exp_info">
                                                                        <div class="exp_text">
                                                                            <img src="{{ asset('public/images/exp.svg') }}"
                                                                                alt="">
                                                                            {{ $value->expire_month }}/{{ $value->expire_year }}
                                                                        </div>
                                                                    </div>
																	<div class="def_btnopt2 frombtn frombtn2" >
																		<a href="{{route('modifyCards', $value->id)}}" type="button" class="sub_btn">{{ __('mybankcards.Modify') }}</a>
																	</div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
												</div>
                                                @endforeach
                                            
                                                <h3>{{ __('mybankcards.Bank_Accounts') }}:</h3>
                                            
                                                @foreach ($data['pay_methods_acc']->data as $values)
												<div class="col-md-6">
                                                    <div class="cards_desinfo_item ">
                                                        <div class="cards_cont_block">
                                                            <div class="card_cont_des">
                                                                <div class="card_img">
                                                                </div>

                                                                <div class="card_view">
                                                                    <div class="card_item_top">
                                                                        <div class="card_item_head">

                                                                            <h4>{{ $values->owner_name }}</h4>

                                                                            <div class="def_card">
                                                                                <a href="#">{{ __('mybankcards.By_Default') }}</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card_name_opt">
                                                                        <h5>{{ __('mybankcards.Platinum_Mastercard_BNC') }}</h5>
                                                                    </div>
                                                                    <div class="card_optblock">
                                                                        <div class="card_icon_text">

                                                                            <span class="card_opt_text">{{ __('mybankcards.Bank_acoount_number_ending') }}
                                                                                 </span>
                                                                            <span class="card_opt_pass">**** </span>
                                                                            <span
                                                                                class="card_opt_pass">{{ $values->account_last_digits }}</span>

                                                                        </div>
                                                                        <div class="card_icon">
                                                                            <img src="{{ asset('public/images/card.png') }}"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="exp_info">
                                                                        <div class="exp_text">
                                                                            <img src="{{ asset('public/images/exp.svg') }}"
                                                                                alt="">

                                                                        </div>
                                                                    </div>
																	<div class="def_btnopt2 frombtn frombtn2">
																		<a href="{{route('modifyBanks', $values->id)}}" type="button" class="sub_btn">{{ __('mybankcards.Modify') }}</a>
																	</div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
												</div>
                                                @endforeach
                                            
                                        </div>
                                </div>
 
                                <div class="frombtn_wrap">
                                    <div class="def_btnopt2 frombtn frombtn2">
                                        <a href="{{ route('front.addPayment') }}" type="button" class="sub_btn">{{ __('mybankcards.Add_Payment_Method') }}
                                        </a>
                                    </div>
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
