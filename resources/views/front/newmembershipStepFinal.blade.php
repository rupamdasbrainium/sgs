<x-app-layout>
	@section('title', $data['title'] . ' |')
	@include('header')
	<section class="maincontent_wrap inner_pageouter">
		<div class="inner_page_wrap">
			@include('layouts.sidebar')
			<div class="inner_page_des">
	
				{{-- <h2>{{ $data['title'] }}</h2> --}}
				<div class="prod_item_wrap" id="home_prod_item">
					
					{{-- <div class="from_cont_wrap" style="flex: 0 100%;"> --}}
						<form method="POST" name="myform" action="{{ route('newMembershipFinalsave') }}" onsubmit="return validfunc()">
							@csrf
							<div class="fromdes_info">
								<div class="from_cont_wrap">
									<div class="inp_row">
										<div class="form-group">
											<label for="promocode">{{ __('paymentForm.promo') }} </label>
											<div class="inp_cont_view noicon_opt">

												<input type="text" class="form-control" name="code_promo"
													id="promocode" placeholder="Promo/Reward Code ">
											</div>
										</div>
									</div>

									<div class="summary_content">
										<h3>{{ __('paymentForm.summary') }}</h3>
										<div class="summary_cont_wrap">
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.center') }}
												</div>
												<div class="sum_inp_right">

													{{ $data['membership_details']->data->franchise }}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.package_plan_Name') }}
												</div>
												<div class="sum_inp_right">
													
													{{ $data['membership_details']->data->subscriptionPlan }}
												</div>
											</div>

											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.package') }}
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->initial_subtotal }} $
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.number_of_payments') }}
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->number_of_payments }}
													{{ __('paymentForm.payments') }}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.begin_of_the_contract') }}
												</div>
												<div class="sum_inp_right">
													{{ date('Y-m-d', strtotime($data['membership_details']->data->begin)) }}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.end_of_the_contract') }}
												</div>
												<div class="sum_inp_right">
													{{ date('Y-m-d', strtotime($data['membership_details']->data->end)) }}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.duration') }}
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->duration_unit }}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.membership') }}
												</div>
												<div class="sum_inp_right">
													{{ __('paymentForm.option') }}
												</div>
											</div>

										</div>
									</div>

									<div class="summary_content">
										<h3>{{ __('paymentForm.period_of_validity') }}</h3>
										<div class="summary_cont_wrap">
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.package_name') }}
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->subscriptionPlan }}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.membership_opt') }}
												</div>
												<div class="sum_inp_right">
													{{-- @dd($data['subscription_plan']); --}}
													{{-- @if (isset($data['subscription_plan']) && isset($data['subscription_plan']->data))
														@foreach ($data['subscription_plan']->data->options as $val)
															{{ $val->name }}
														@endforeach
													@endif --}}
												</div>
											</div>

											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.duration') }}
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->duration_unit }}
												</div>
											</div>

										</div>
									</div>

									<div class="summary_content">
										<h3>{{ __('paymentForm.1st_pay') }}</h3>
										<div class="summary_cont_wrap">
											{{-- <div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.fee') }}
												</div>
												<div class="sum_inp_right">
													39.99$
												</div>
											</div> --}}
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.subtotal') }}
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->initial_subtotal }}
												</div>
											</div>
											@php
												$total = $data['membership_details']->data->initial_subtotal;
											@endphp
											@foreach ($data['membership_details']->data->initial_taxes as $item)
												@php
													$total += $item->amount;
												@endphp
												<div class="sum_inp_cont">
													<div class="sum_inp_left">
														{{ $item->legal_name }}
													</div>
													<div class="sum_inp_right">
														{{ $item->amount }}$
													</div>
												</div>
											@endforeach
											@foreach ($data['membership_details']->data->recurant_taxes as $item2)
												@php
													$total += $item2->amount;
												@endphp
												<div class="sum_inp_cont">
													<div class="sum_inp_left">
														{{ $item2->legal_name }}
													</div>
													<div class="sum_inp_right">
														{{ $item2->amount }}$
													</div>
												</div>
											@endforeach
											
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													{{ __('paymentForm.total') }}
												</div>
												<div class="sum_inp_right">
													{{ $total }}$
												</div>
											</div>
										</div>
									</div>

									{{-- <div class="summary_content">

										<div class="content_block paymentinfo">
											<h2 class="head_opt">{{ __('paymentForm.payment_details') }}</h2>
											<div class="table_description_view oddoreven_opt oddoreven_opt2">
												<table class="table">
													<thead>
														<tr>
															<th>{{ __('paymentForm.type') }}</th>
															<th>{{ __('paymentForm.pay_date') }}</th>
															<th>{{ __('paymentForm.pay') }}</th>
															<th>{{ __('paymentForm.status') }}</th>
														</tr>
													</thead>
													<tbody>

														<tr class="activeitem">
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	{{ __('paymentForm.payments') }}
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">{{ __('paymentForm.paid') }}</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	{{ __('paymentForm.payments') }}
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">{{ __('paymentForm.paid') }}</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	{{ __('paymentForm.payments') }}
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">{{ __('paymentForm.paid') }}</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	
																{{ __('paymentForm.payments') }}
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">{{ __('paymentForm.paid') }}</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	{{ __('paymentForm.payments') }}
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">{{ __('paymentForm.paid') }}</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	{{ __('paymentForm.payments') }}
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">{{ __('paymentForm.paid') }}</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	{{ __('paymentForm.payments') }}
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">{{ __('paymentForm.paid') }}</td>
														</tr>

													</tbody>
												</table>
											</div>
										</div>--}}

										{{-- <div class="content_block more_cont_view">
											<h2>{{ __('paymentForm.method_of_payment') }}</h2>
											<div class="checkout_optview payment_opt_details payment_opt2">
												<div class="inp_row">
													<div class="form-group">

														<div class="memberships_nam radio">
															<input type="radio" id="payment_opt1"
																name="radio_group_pay" class="radio1"
																value="credit_acc" onclick="showA();">
															<label for="payment_opt1">{{ __('paymentForm.Credit_Card') }}</label>
														</div>

														<div class="memberships_nam radio">
															<input type="radio" id="payment_opt2"
																name="radio_group_pay" class="radio2"
																value="credit_acc" onclick="showA();">
															<label for="payment_opt2">{{ __('paymentForm.Debit_Card') }}</label>
														</div>

														<div class="memberships_nam radio">
															<input type="radio" id="payment_opt3"
																name="radio_group_pay" onclick="show();"
																value="bank_acc" checked>
															<label for="payment_opt3">{{ __('paymentForm.Bank_Account') }}</label>
														</div>

													</div>


												</div>
											</div>
										</div> --}}
										<form method="post" action="{{ route('newMembershipFinalsave')}}">
											@csrf
											<div class="content_block more_cont_view">
												<h2>Method of Payment</h2>
												<div class="checkout_optview payment_opt_details">
													<div class="inp_row">
														<div class="form-group">
															<div class="memberships_nam radio">
																<input type="radio" id="payment_opt1" name="radio-group_pay" value="credit" checked>
																<label for="payment_opt1">Credit Card</label>
															</div>
													
															<div class="memberships_nam radio">
																<input type="radio" id="payment_opt2" name="radio-group_pay" value="debit">
																<label for="payment_opt2">Debit Card</label>
															</div>
															
															<div class="memberships_nam radio">
																<input type="radio" id="payment_opt3" name="radio-group_pay" value="bank">
																<label for="payment_opt3"> {{ __('paymentForm.Bank_Account') }}</label>
															</div>
														
														</div>

														<div id="bank_details">
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.Direct_Debit') }}</label>
																	<div class="card_add">
																		
																		<img src="images/voided.png" alt="" />
																	</div>
																</div>
															</div>
				
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.Transit_Number') }} <em class="req_text">*</em></label>
																	<div class="inp_cont_view noicon_opt" id="incdec">
				
																		<input type="text" name="transit_number"
																			class="form-control" placeholder=""
																			value="">
																	</div>
																</div>
															</div>
				
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.Branch_Number') }} <em class="req_text">*</em></label>
																	<div class="inp_cont_view noicon_opt">
																		<input type="text" name="institution"
																			class="form-control" placeholder="">
																	</div>
																</div>
															</div>
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.Account_Number') }} <em class="req_text">*</em></label>
																	<div class="inp_cont_view noicon_opt">
																		<input type="text" name="account_number"
																			class="form-control" placeholder="">
																	</div>
																</div>
															</div>
				
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.Account_Name_Holder') }} <em
																			class="req_text">*</em></label>
																	<div class="inp_cont_view noicon_opt">
																		<input type="text" name="owner_names"
																			class="form-control" placeholder="bank">
																	</div>
																</div>
															</div>
														</div>

														<div id="credit_details">
															<div class="selectcont ">
				
																<div class="arrowdown2">
																	<i class="far fa-chevron-down"></i>
																</div>
																<select class="select_opt" name="type_id">
																	@foreach ($data['card_types'] as $cardtype)
																		<option value="{{ $cardtype->id }}">
																			{{ $cardtype->name }}</option>
																	@endforeach
																</select>
				
															</div><br>
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.Account_Name_Holder') }} <em
																			class="req_text">*</em></label>
																	<div class="inp_cont_view noicon_opt">
																		<input type="text" name="owner_name"
																			class="form-control" placeholder="">
																	</div>
																</div>
															</div>
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.credit_card_number') }} <em
																			class="req_text">*</em></label>
																	<div class="inp_cont_view noicon_opt" id="incdec">
				
																		<input type="text" name="token"
																			class="form-control" placeholder=""
																			value="">
																		
																	</div>
																</div>
															</div>
				
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.Expiry_Month') }} <em class="req_text">*</em></label>
																	<div class="inp_cont_view noicon_opt">
																		<input type="text" name="expiry_month"
																			class="form-control" placeholder="">
																	</div>
																</div>
															</div>
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.Expiry_Year') }} <em class="req_text">*</em></label>
																	<div class="inp_cont_view noicon_opt">
																		<input type="text" name="expiry_year"
																			class="form-control" placeholder="">
																	</div>
																</div>
															</div>
															<div class="inp_row">
																<div class="form-group">
																	<label>{{ __('paymentForm.CVV') }}<em class="req_text">*</em></label>
																	<div class="inp_cont_view noicon_opt">
																		<input type="text" name="four_digits_number"
																			class="form-control" placeholder="">
																	</div>
																</div>
															</div>
				
														</div>

														<input type="hidden" name="subscription_plan_id" value="{{ $data['membership_details']->data->subscriptionPlan_id }}">
														<input type="hidden" name="duration_id" value="{{ Session::get('duration_id') }}">
														<input type="hidden" name="date_begin" value="{{ $data['membership_details']->data->begin }}">
														<input type="hidden" name="processed_amount" value="{{ $total }}">
														<input type="hidden" name="new_key" id="new_key" value="0">
								

														{{-- <div class="frombtn_wrap select_optblock">
															<div class="select_card_opt">
								
																<div class="form-group">
																	<div class="inp_cont_view noicon_opt">
								
																		<div class="selectcont ">
																			<div class="arrowdown2">
																				<i class="far fa-chevron-down"></i>
																			</div>
																			<select class="select_opt" >
																				<option value="AB" selected >XXX   XXX   XXXX  4589  visa</option>
																				<option value="AB" >AB</option>
																				<option value="AB"  >AB</option>
																				<option value="AB"  >AB</option>
																			</select> 
																		</div>
								
																	</div>
																</div>
								
															</div>
															<div class="def_btnopt2 frombtn frombtn2">
																<button type="button" class="btn2" >Add a Payment Method</button>
															</div>
														</div> --}}

														<div class="frombtn_wrap select_optblock">
															<div class="select_card_opt">
								
																<div class="form-group">
																	<div class="inp_cont_view noicon_opt">
								
																		<div class="selectcont ">
																			<div class="arrowdown2">
																				<i class="far fa-chevron-down"></i>
																			</div>
																			<div id="old_card">
																			<select class="select_opt" name="old_card">
																				@foreach($data['pay_methods_card']->data as $card)
																				<option value="{{ $card->id }}">XXX XXX XXXX {{$card->four_digits_number }}</option>
																				@endforeach
																			</select>
																			</div>
																			<div id="old_acc">
																			<select class="select_opt"  name="old_acc">
																				@foreach($data['pay_methods_acc']->data as $acc)
																				<option value="{{ $acc->id }}" selected >XXX XXX XXXX {{$acc->account_last_digits }}</option>
																				@endforeach
																				
																			</select> 
																			</div>
																		</div>
								
																	</div>
																</div>
								
															</div>
															{{-- <div class="def_btnopt2 frombtn frombtn2">
																<button type="button" class="btn2" id="add_pay_method" >Add a Payment Method</button>
															</div> --}}
														</div>
														<div class="aboundopt">
															<p>Amount to be paid: ${{ $total }}</p>
														</div>
														<div class="frombtn_wrap">
															<div class="def_btnopt2 frombtn frombtn2">
																<button type="submit" class="btn2" >Pay Now</button>
															</div>
														</div>
								
														
													</div>
								
												</div>
								
							
											</div>
										</form>
									</div> 

									

									

									{{-- <div class="frombtn_wrap">
										<div class="def_btnopt2 frombtn">
											<button type="submit" value="submit" class="btn2"
												id="myButton" disabled>{{ __('paymentForm.sign_up') }}!</button>
											<button type="button" class="btn2 backbutton">{{ __('paymentForm.back') }}</button>
										</div>
									</div> --}}

								</div>
							</div>
						</form>
						
					{{-- </div> --}}
				</div>
			</div>
		</div>
	</section>
	@include('footer')
	@push('scripts')
		<script>
			$( document ).ready(function() {
				$('#bank_details').hide();
				$('#credit_details').hide();
				$('#old_card').show();
				$('#old_acc').hide();

				$('#add_pay_method').click(function(){
					$("#new_key").val(1);
					let radio_group_pay = $('input[name="radio-group_pay"]:checked').val();
					if(radio_group_pay=='bank'){
						$('#bank_details').show();
						$('#credit_details').hide();
						$('#old_card').hide();
						$('#old_acc').hide();
					} else if(radio_group_pay=='debit' || radio_group_pay=='credit'){
						$('#bank_details').hide();
						$('#credit_details').show();
						$('#old_card').hide();
						$('#old_acc').hide();
					} else {
						console.log('not selected radio'+radio_group_pay);
					}
				});

				$('input[type=radio][name=radio-group_pay]').change(function() {
					$("#new_key").val(0);
					if (this.value == 'bank') {
						$('#bank_details').hide();
						$('#credit_details').hide();
						$('#old_card').hide();
						$('#old_acc').show();
					}
					else {
						$('#bank_details').hide();
						$('#credit_details').hide();
						$('#old_card').show();
						$('#old_acc').hide();
					}
				});
			});
		</script>
	@endpush
	
	</x-app-layout>
