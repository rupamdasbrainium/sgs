<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">

                <div class="content_block memberships">
                    <h2>Memberships</h2>
                    <div class="memberships_content memberships2">
                        <div class="memberships_item_block activecheckopt ">
                            <div class="memberships_opt ">
                                <div class="memberships_nam radio">
                                    @foreach ($data['membership']->data as $item)
                                        <input type="radio" id="testnum{{$loop->iteration}}" name="radio-group" checked>
                                        <label for="testnum{{$loop->iteration}}">Act1 Membership - davable {{ $item->recurantCharge }} per
                                            Month</label>
                                    @endforeach
                                </div>
                                <div class="memberships_method_view">
                                    <div class="memberships_method">Method of payment:</div>
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
                                    <div class="memberships_method_date">End date: 2023/02/04 </div>
                                    <div class="ren_opt"><a href="#">Upgrade</a> </div>
                                </div>
                            </div>
							
                            <div class="more_content_block ">
                                <div class="content_block more_cont_view">
                                    <h2>Membership Options/ Add-ons</h2>
                                    <div class="optionwrap_block">
                                        @if (isset($data['membership']))
                                            @foreach ($data['membership']->data as $item)
                                                <div class="optionitem_add">
                                                    <h3>Option 1</h3>
                                                    <div class="optionitem_block">
                                                        <div class="opt_add">
                                                            <img src="{{ asset('public/images/prod_img1.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="optionitem_des">
                                                            <p>{{ $item->type }}</p>
                                                            <div class="price_opt_add">{{ $item->recurantCharge }}</div>
                                                            <div class="optionitem_prod">
                                                                <span>6 private training</span>
                                                                <span>Quantity: 1 X 6</span>
                                                                <span>Price: 179.40</span>
                                                            </div>
                                                            <div class="optionitem_checkopt">
                                                                <div class="form-group">
                                                                    <div class="checkbox">
                                                                        <input name="add_on[]"
                                                                                class="styled-checkbox2"
                                                                                id="Option{{ $loop->iteration }}"
                                                                                {{-- value="{{ $item->id }}" --}}
                                                                                type="checkbox">
                                                                            <label for="Option{{ $loop->iteration }}">
                                                                               
                                                                                    {{ __('newMembership.initial_fee') }}
                                                                                    <em>(
                                                                                        {{ __('newMembership.onetime') }})</em>
                                                                               
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
											{{-- @dump($data['subscription_plan']); --}}
											@if(isset($data['subscription_plan']) && isset($data['subscription_plan']->data) && count($data['subscription_plan']->data->prices_per_durations))
												@foreach ($data['subscription_plan']->data->prices_per_durations as $item)
												
													@if(count($item->installments))
														@foreach ($item->installments as $val)
														{{-- @dump( $item->duration_id,$val->id); --}}
															<div class="radio">
																<input type="radio" id="{{ $val->id }}" name="installments" value="{{ $item->duration_id}}|{{$val->id }}" {{ $loop->index==0? 'required':'' }}>
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
                                            <button type="button" class="btn2">Pay Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="memberships_item_block ">
						<div class="memberships_opt">
							<div class="memberships_nam radio">
								<input type="radio" id="testnum2" name="radio-group">
								<label for="testnum2">Act1 Membership - davable $39.99 per Month</label>
								
							</div>
							<div class="memberships_method_view">
								<div class="memberships_method">Method of  payment:</div>
								<div class="memberships_method_opt">
									<div class="selectcont ">
										<div class="arrowdown2">
											<i class="far fa-chevron-down"></i>
										</div>
										<select class="select_opt" >
											<option value="visa" selected >xxx xxx xxxx 4242 visa</option>
											<option value="visa" >xxx xxx xxxx 4242 visa</option>
											<option value="visa"  >xxx xxx xxxx 4242 visa</option>
											<option value="visa"  >xxx xxx xxxx 4242 visa</option>
										</select>
									</div>
								</div>
							</div>
							<div class="ranew_opt_block">
								<div class="memberships_method_date">End date: 2023/02/04 </div>
								<div class="ren_opt"><a href="#">Upgrade</a> </div>
							</div>
						</div>
						<div class="more_content_block">
							<div class="content_block more_cont_view">
								<h2>Membership Options/ Add-ons</h2>
								<div class="optionwrap_block">
									<div class="optionitem_add">
										<h3>Option 1</h3>
										<div class="optionitem_block">
											<div class="opt_add">
												<img src="{{ asset('public/images/prod_img1.png') }}" alt="">
											</div>
											<div class="optionitem_des">
												<p>Stainless Steel Elliptical
												Exercise Equipment,</p>
												<div class="price_opt_add">$179.40</div>
												<div class="optionitem_prod">
													<span>6 private training</span>
													<span>Quantity: 1 X 6</span>
													<span>Price: 179.40</span>
												</div>
												<div class="optionitem_checkopt">
													<div class="form-group">
														<div class="checkbox">
															<input class="styled-checkbox2" id="Option5" type="checkbox" value="value1">
															<label for="Option5">Added to initial fee
															<em>( one time)</em></label>
															
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									<div class="optionitem_add">
										<h3>Option 2</h3>
										<div class="optionitem_block">
											<div class="opt_add">
												<img src="{{ asset('public/images/prod_img2.png') }}" alt="">
											</div>
											<div class="optionitem_des">
												<p>Zorex HGZ-1001 Home
												Gym Machine</p>
												<div class="price_opt_add">$179.40</div>
												<div class="optionitem_prod">
													<span>6 private training</span>
													<span>Quantity: 1 X 6</span>
													<span>Price: 179.40</span>
												</div>
												<div class="optionitem_checkopt">
													<div class="form-group">
														<div class="checkbox">
															<input class="styled-checkbox2" id="Option6" type="checkbox" value="value2">
															<label for="Option6">Added to initial fee
															<em>( one time)</em></label>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									<div class="optionitem_add">
										<h3>Option 3</h3>
										<div class="optionitem_block">
											<div class="opt_add">
												<img src="{{ asset('public/images/prod_img3.png') }}" alt="">
											</div>
											<div class="optionitem_des">
												<p>Treadmills - Buy Online
												Treadmill </p>
												<div class="price_opt_add">$179.40</div>
												<div class="optionitem_prod">
													<span>6 private training</span>
													<span>Quantity: 1 X 6</span>
													<span>Price: 179.40</span>
												</div>
												<div class="optionitem_checkopt">
													<div class="form-group">
														<div class="checkbox">
															<input class="styled-checkbox2" id="Option7" type="checkbox" value="value3">
															<label for="Option7">Added to initial fee
															<em>( one time)</em></label>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									<div class="optionitem_add">
										<h3>Option 4</h3>
										<div class="optionitem_block">
											<div class="opt_add">
												<img src="{{ asset('public/images/prod_img4.png') }}" alt="">
											</div>
											<div class="optionitem_des">
												<p>Stainless Steel Elliptical
												Exercise Equipment,</p>
												<div class="price_opt_add">$179.40</div>
												<div class="optionitem_prod">
													<span>6 private training</span>
													<span>Quantity: 1 X 6</span>
													<span>Price: 179.40</span>
												</div>
												<div class="optionitem_checkopt">
													<div class="form-group">
														<div class="checkbox">
															<input class="styled-checkbox2" id="Option8" type="checkbox" value="value4">
															<label for="Option8">Added to initial fee
															<em>( one time)</em></label>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								
								<div class="frombtn_wrap">
									<div class="def_btnopt2 frombtn frombtn2">
										<button type="button" class="btn2" >Pay Now</button>
									</div>
								</div>
							</div>
						</div>
					</div> --}}


                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('footer')
</x-app-layout>
