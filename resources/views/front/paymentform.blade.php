<x-guest-layout>
	@section('title', $data['title'] . ' |')
	@include('header')
	<section class="maincontent_wrap innermain_content payment_content">
		<div class="welcomesection def_padding inner_content_block">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="welcomesec_info inner_heading">
							<div class="round_opt_btn3 ">
								<img src="images/roundopt2.jpg" alt="">
							</div>
							
							<h2>Payment</h2>
						</div>
						<div class="fromdes_info user_contentblock">
							<div class="sidebar_content">
								<div class="sidebar_info">
									<p>Center: 
										
										<span>{{ $data['membership_details']->data->franchise}}</span></p>
									{{-- <p>Address: 
										<span>{{ $data['franchise']->address_civic_number}} {{ $data['franchise']->address_street}} {{ $data['franchise']->address_city }} {{ $data['franchise']->address_postal_code }}</span> --}}
								</p>
								<p>Package: <span>
									{{-- @if(isset($data['subscription_plan']) && isset($data['subscription_plan']->data))
									{{ $data['subscription_plan']->data->name }}
									@endif --}}
									{{ $data['membership_details']->data->subscriptionPlan}}
								</span></p>
							</div>
						</div>
						<div class="from_cont_wrap">
							
							<div class="fromdes_info">
								<div class="from_cont_wrap">
									<div class="inp_row">
										<div class="form-group">
											<label for="promocode">Promo/Reward Code </label>
											<div class="inp_cont_view noicon_opt">
												
												<input type="text" class="form-control" name="code_promo" id="promocode" placeholder="Promo/Reward Code " >
											</div>
										</div>
									</div>
									
									<div class="summary_content">
										<h3>Summary of your subscription</h3>
										<div class="summary_cont_wrap">
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Center
												</div>
												<div class="sum_inp_right">
													{{-- {{ $data['franchise']->name}} --}}
													{{ $data['membership_details']->data->franchise}}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Package/Plan Name
												</div>
												<div class="sum_inp_right">
													{{-- @if(isset($data['subscription_plan']) && isset($data['subscription_plan']->data))
														{{ $data['subscription_plan']->data->name }}
													@endif --}}
													{{ $data['membership_details']->data->subscriptionPlan}}
												</div>
											</div>
											
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Package
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->initial_subtotal }} $
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Number of Payments
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->number_of_payments }} Payments
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													End of the contract
												</div>
												<div class="sum_inp_right">
													{{ date("Y-m-d",strtotime($data['membership_details']->data->end)) }}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Duration
												</div>
												<div class="sum_inp_right">
													{{ date("Y-m-d",strtotime($data['membership_details']->data->duration_unit)) }}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Duration
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->duration_unit }}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Membership options/Add-ons
												</div>
												<div class="sum_inp_right">
													Option1, Option3
												</div>
											</div>
											
										</div>
									</div>
									
									<div class="summary_content">
										<h3>The period of validity of the contract is of fixed duration</h3>
										<div class="summary_cont_wrap">
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Package Name
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->subscriptionPlan}}
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Membership Option(s)
												</div>
												<div class="sum_inp_right">
													Option1, Option3
												</div>
											</div>
											
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Duration
												</div>
												<div class="sum_inp_right">
													{{ $data['membership_details']->data->duration_unit }}
												</div>
											</div>
											
										</div>
									</div>
									
									<div class="summary_content">
										<h3>1st Payment (1x)</h3>
										<div class="summary_cont_wrap">
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Fee per Payment
												</div>
												<div class="sum_inp_right">
													39.99$
												</div>
											</div>
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Subtotal
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
													{{ $item->legal_name}}
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
													{{ $item2->legal_name}}
												</div>
												<div class="sum_inp_right">
													{{ $item2->amount }}$
												</div>
											</div>
											@endforeach
											{{-- <div class="sum_inp_cont">
												<div class="sum_inp_left">
													TPS 12345RT0010
												</div>
												<div class="sum_inp_right">
													2.00$
												</div>
											</div> --}}
											{{-- <div class="sum_inp_cont">
												<div class="sum_inp_left">
													TVQKI255887
												</div>
												<div class="sum_inp_right">
													3.99$
												</div>
											</div> --}}
											
											<div class="sum_inp_cont">
												<div class="sum_inp_left">
													Total
												</div>
												<div class="sum_inp_right">
													{{ $total }}$
												</div>
											</div>
											
											
										</div>
									</div>
									
									<div class="summary_content">
										
										<div class="content_block paymentinfo">
											<h2 class="head_opt">Payment Details</h2>
											<div class="table_description_view oddoreven_opt oddoreven_opt2">
												<table class="table">
													<thead>
														<tr>
															<th>TYPE</th>
															<th>PAYMENT DATE</th>
															<th>PAYMENT</th>
															<th>STATUS</th>
														</tr>
													</thead>
													<tbody>
														
														<tr class="activeitem">
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	Payments
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">Paid</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	Payments
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">Paid</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	Payments
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">Paid</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	<!-- <div class="checkbox">
																				<input class="styled-checkbox" id="Option1" type="checkbox" value="value1">
																				<label for="Option1">&nbsp;</label>
																	</div>  -->
																	Payments
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">Paid</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	Payments
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">Paid</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	Payments
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">Paid</td>
														</tr>
														<tr>
															<td data-label="TYPE">
																<div class="pay_view_opt">
																	Payments
																</div>
															</td>
															<td data-label="PAYMENT DATE">2023-7-18</td>
															<td data-label="PAYMENT">$45.32</td>
															<td data-label="STATUS">Paid</td>
														</tr>
														
													</tbody>
												</table>
											</div>
										</div>
										
										<div class="content_block more_cont_view">
											<h2>Method of Payment</h2>
											<div class="checkout_optview payment_opt_details payment_opt2">
												<div class="inp_row">
													<div class="form-group">
														<div class="memberships_nam radio">
															<input type="radio" id="payment_opt1" name="radio-group_pay" checked>
															<label for="payment_opt1">Credit Card</label>
														</div>
														
														<div class="memberships_nam radio">
															<input type="radio" id="payment_opt2" name="radio-group_pay">
															<label for="payment_opt2">Debit Card</label>
														</div>
														
														<div class="memberships_nam radio">
															<input type="radio" id="payment_opt3" name="radio-group_pay">
															<label for="payment_opt3">Prepaid Account Card</label>
														</div>
														
													</div>
													
													
												</div>
											</div>
										</div>
									</div>
									
									<div class="from_contentblock">
										
										<div class="inp_row">
											<div class="form-group">
												<label>Direct Debit</label>
												<div class="card_add">
													<img src="images/voided.png" alt="" />
												</div>
											</div>
										</div>
										
										<div class="inp_row">
											<div class="form-group">
												<label >Transit Number <em class="req_text">*</em></label>
												<div class="inp_cont_view noicon_opt" id="incdec">
													
													<input type="text" name="transit_number" class="form-control" placeholder="" value="0"  >
													<i class="fas fa-sort-up" id="up" ></i>
													<i class="fas fa-sort-down" id="down" ></i>
													
												</div>
											</div>
										</div>
										
										<div class="inp_row">
											<div class="form-group">
												<label>Branch Number <em class="req_text">*</em></label>
												<div class="inp_cont_view noicon_opt">
													<input type="text" name="institution" class="form-control"  placeholder="" >
												</div>
											</div>
										</div>
										<div class="inp_row">
											<div class="form-group">
												<label>Account Number <em class="req_text">*</em></label>
												<div class="inp_cont_view noicon_opt">
													<input type="text" name="account_number" class="form-control"  placeholder="" >
												</div>
											</div>
										</div>
										
										<div class="inp_row">
											<div class="form-group">
												<label>Account Name Holder <em class="req_text">*</em></label>
												<div class="inp_cont_view noicon_opt">
													<input type="text" name="owner_name" class="form-control"  placeholder="" >
												</div>
											</div>
										</div>
										{{-- @dd( $data['membership_details']); --}}
										<input type="hidden" name="subscription_plan_id" value="{{ $data['membership_details']->data->subscriptionPlan_id }}">
										<input type="hidden" name="duration_id" value="{{ Session::get('duration_id')}}">
										
										{{-- <input type="hidden" name="subscription_plan_id" value="{{ $data['membership_details']->data->subscriptionPlan_id }}">
										<input type="hidden" name="subscription_plan_id" value="{{ $data['membership_details']->data->subscriptionPlan_id }}"> --}}
									</div>
									
									
									<div class="checkbox_block">
										<div class="inp_row remember_opt">
											<div class="form-group">
												<div class="checkbox">
													<!-- <label><input type="checkbox"> Remember me</label> -->
													
													<input class="styled-checkbox" type="checkbox" value="value2">
													<label >I have read an accept  <a href="#">the terms & conditions</a></label>
												</div>
												
											</div>
											
											<div class="form-group">
												<div class="checkbox">
													<!-- <label><input type="checkbox"> Remember me</label> -->
													
													<input class="styled-checkbox" type="checkbox" value="value2">
													<label >I have read an accept  <a href="#">the suitability for physical activity form</a></label>
												</div>
												
											</div>
										</div>
										
									</div>
									
									<div class="frombtn_wrap">
										<div class="def_btnopt2 frombtn">
											<button type="button" class="btn2" >Sign up!</button>
											<button type="button" class="btn2 backbutton" >Back</button>
										</div>
									</div>
									
								</div>
							</div>
							
						</div>
						
					</div>
					
					
				</div>
			</div>
		</div>
		
	</div>
	<div class="round_opt_btn rount_opt1">
		<img src="images/roundopt2.jpg" alt="">
	</div>
	<div class="round_opt_btn rount_opt2">
		<img src="images/roundopt2.jpg" alt="">
	</div>
	<div class="round_opt_btn rount_opt3">
		<img src="images/roundopt2.jpg" alt="">
	</div>
	</section>
	@include('footer')
	</x-guest-layout>