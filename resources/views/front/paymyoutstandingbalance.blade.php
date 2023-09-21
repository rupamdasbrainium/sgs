<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">

			<div class="content_block paymentinfo">
				<h2 class="head_opt"><span>Total outstanding balance: $90.64</span>Payment Details</h2>
				<div class="table_description_view oddoreven_opt">
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
						  <tr  class="evenitem">
							<td data-label="TYPE"> 
								<div class="pay_view_opt">
									<div class="checkbox">
										<input class="styled-checkbox" id="Option1" type="checkbox" value="value1">
										<label for="Option1">&nbsp;</label>
									</div> 
									Payments
								</div>
								
							</td>
							<td data-label="PAYMENT DATE">2023-7-18</td>
							<td data-label="PAYMENT">$45.32</td>
							<td data-label="STATUS">Unpaid</td>
						  </tr>
						  <tr class="odditem"> 
							<td data-label="TYPE">
								<div class="pay_view_opt">
									<div class="checkbox">
										<input class="styled-checkbox" id="Option2" type="checkbox" value="value1">
										<label for="Option2">&nbsp;</label>
									</div> 
									Payments
								</div>

							</td>
							<td data-label="PAYMENT DATE">2023-7-18</td>
							<td data-label="PAYMENT">$45.32</td>
							<td data-label="STATUS">Unpaid</td>
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
						
						</tbody>
					  </table>
				</div>
			</div>

			<div class="content_block more_cont_view">
				<h2>Method of Payment</h2>
				<div class="checkout_optview payment_opt_details">
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

						<div class="frombtn_wrap select_optblock">
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
						</div>
						<div class="aboundopt">
							<p>Amount to be paid: $90.64</p>
						</div>
						<div class="frombtn_wrap">
							<div class="def_btnopt2 frombtn frombtn2">
								<button type="button" class="btn2" >Pay Now</button>
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