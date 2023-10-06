<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">

                <div class="content_block memberships">
                    <h2>{{ __('upgrademembership.Memberships') }}</h2>
                    <div class="memberships_content memberships2">
                        @foreach ($data['membership']->data as $item)
                        <div class="memberships_item_block activecheckopt ">
                            <div class="memberships_opt ">
                                <div class="memberships_nam radio">                                  
                                        <input type="radio" id="testnum{{$loop->iteration}}" name="radio-group" checked>
                                        <label for="testnum{{$loop->iteration}}">{{ __('upgrademembership.Act1_Membership_davable') }} ${{ $item->recurantCharge }} {{ __('upgrademembership.per_Month') }}
                                        </label>
                                    
                                </div>
                                <div class="memberships_method_view">
                                    <div class="memberships_method">{{ __('upgrademembership.Method_of_payment') }}:</div>
                                    <div class="memberships_method_opt">
                                        <div class="selectcont ">
                                            <div class="arrowdown2">
                                                <i class="far fa-chevron-down"></i>
                                            </div>
                                            <select class="select_opt">
                                                @foreach ($data['pay_methods_card']->data as $card)
                                                    <option value="{{ $card->id }}">XXX XXX XXXX
                                                        {{ $card->four_digits_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="ranew_opt_block">
                                    <div class="memberships_method_date">{{ __('upgrademembership.End_date') }}: 2023/02/04 </div>
                                    <div class="ren_opt"><a href="#">{{ __('upgrademembership.Upgrade') }}</a> </div>
                                </div>
                            </div>
							
                            <div class="more_content_block ">
                                <div class="content_block more_cont_view">
                                    <h2>{{ __('upgrademembership.Membership_Options_Add-ons') }}</h2>
                                    <div class="optionwrap_block">
                                        @php
                                       $subscription_plan = json_decode(APICall("SubscriptionPlans/type/" . $item->typeId."?language_id=".$item->languageId, "get", "{}" ,"client_app"));
                                       
                                        @endphp                                      
                                       @if (isset($subscription_plan) && isset($subscription_plan->data) && count($subscription_plan->data->options))                                      
                                            @foreach ($subscription_plan->data->options as $item)
                                                <div class="optionitem_add">
                                                    <h3>{{ __('upgrademembership.Option') }} </h3>
                                                    <div class="optionitem_block">
                                                        <div class="opt_add">
                                                            <img src="{{ asset('public/images/prod_img1.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="optionitem_des">
                                                            <p>{{ $item->name }}</p>
                                                            <div class="price_opt_add">${{ $item->price }}</div>
                                                            <div class="optionitem_prod">
                                                                <span>{{ __('newMembership.training') }}</span>
                                                                <span>{{ __('upgrademembership.Quantity') }}: {{ $item->quantity }} X {{ $item->deliverable_quantity }}</span>
                                                                <span>{{ __('upgrademembership.Price') }}:{{$item->price}} </span>
                                                            </div>
                                                            <div class="optionitem_checkopt">
                                                                <div class="form-group">
                                                                    <div class="checkbox">
                                                                        <input name="add_on[]"
                                                                                class="styled-checkbox2"
                                                                                id="Option{{ $loop->iteration }}"  value="{{ $item->id }}"
                                                                                type="checkbox">
                                                                            <label for="Option{{ $loop->iteration }}">
                                                                                @if($item->is_initial)
                                                                                    {{ __('newMembership.initial_fee') }}
                                                                                    <em>({{ __('newMembership.onetime') }})</em>
                                                                                @endif
                                                                            </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
									<div class="payment_block">
										<h4>{{ __('suscription.nop') }} *</h4>
										<div class="payment_contentblock">
											
											@if(isset($subscription_plan) && isset($subscription_plan->data) && count($subscription_plan->data->prices_per_durations))
												@foreach ($subscription_plan->data->prices_per_durations as $item1)
												
													@if(count($item1->installments))
														@foreach ($item1->installments as $val)
														
															<div class="radio">
																<input type="radio" id="{{ $val->id }}" name="installments" value="{{ $item1->duration_id}}|{{$val->id }}" {{ $loop->index==0? 'required':'' }}>
																<label for="{{ $val->id }}">{{ $val->number_of_payments }} {{ __('suscription.payments') }}</label>
															</div>
														@endforeach
													@endif
												@endforeach
											@endif
										</div>
									</div>
                                    <div class="frombtn_wrap">
                                        <div class="def_btnopt2 frombtn frombtn2">
                                            <button type="button" class="btn2">{{ __('upgrademembership.Pay_Now') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('footer')
</x-app-layout>
