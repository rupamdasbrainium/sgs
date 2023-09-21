<x-guest-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap innermain_content user_information">
	<div class="welcomesection def_padding inner_content_block">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="welcomesec_info inner_heading">
						<div class="round_opt_btn3 modfround1">
							<img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
						</div>
						<h2>User Information</h2>
						<p>Please provide your contact information</p>
					</div>
					<div class="fromdes_info user_contentblock">
						<div class="sidebar_content">
							<div class="sidebar_info">
								<p>Center: <span>Gym Proacif</span></p>
								<p>Address: <span>246st-iccauses,
								saint-iean.9.1j2 j4j</span>
							</p>
							<p>Package: <span>Acti 1</span></p>
						</div>
					</div>
					<div class="from_cont_wrap">
						<form method="post" action="" >
							@csrf
						<div class="inp_row gapadj inp_colm2">
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="First Name *" >
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="Last Name *" >
								</div>
							</div>
						</div>
						<div class="inp_row gapadj inp_colm3">
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="Street Number *" >
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="Street *" >
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="App " >
								</div>
							</div>
						</div>
						<div class="inp_row gapadj inp_colm3">
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="City *" >
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="Postal Code *" >
									<p>Example: j3B 8k7</p>
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<!-- <input type="text" class="form-control" placeholder="AB  " > -->
									<div class="selectcont ">
										<div class="arrowdown2">
											<i class="far fa-chevron-down"></i>
										</div>
										<select class="select_opt" >
											<option value="AB" selected >AB</option>
											<option value="AB" >AB</option>
											<option value="AB"  >AB</option>
											<option value="AB"  >AB</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="inp_row gapadj inp_colm2">
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="Phone Number *" >
									<p>Example: xxx xxx-xxxx</p>
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="Cell *" >
									<p>Example: xxx xxx-xxxx</p>
								</div>
							</div>
						</div>
						<div class="inp_row gapadj inp_colm3">
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="Emergency Phone Number *" >
									<p>Example: xxx xxx-xxxx</p>
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="text" class="form-control" placeholder="Date of birth *" >
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<!-- <input type="text" class="form-control" placeholder="Man " > -->
									<div class="selectcont ">
										<div class="arrowdown2">
											<i class="far fa-chevron-down"></i>
										</div>
										<select class="select_opt" >
											<option value="Man" selected >Man</option>
											<option value="Man">Man</option>
											<option value="Man">Man</option>
											<option value="Man">Man</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="inp_row gapadj inp_colm2">
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="email" class="form-control" placeholder="Email *" >
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input type="email" class="form-control" placeholder="mail Confirmation *" >
								</div>
							</div>
						</div>
						<div class="inp_row gapadj inp_colm2">
							<div class="form-group">
								<div class="inp_cont_view noicon_opt noicon_opt2">
									<div class="icon_opt">
										<i class="fal fa-eye" id="togglePassword" style="cursor: pointer;"></i>
									</div>
									<input class="form-control" type="password" name="password" placeholder="Password *" autocomplete="current-password" required="" id="id_password">
								</div>
							</div>
							<div class="form-group">
								<div class="inp_cont_view  noicon_opt noicon_opt2">
									<div class="icon_opt">
										<i class="fal fa-eye" id="togglePassword2" style="cursor: pointer;"></i>
									</div>
									<input class="form-control" type="password" name="password" placeholder="Password confirmation *" autocomplete="current-password" required="" id="id_password2">
								</div>
							</div>
						</div>
						<div class="inp_row  ">
							<div class="form-group">
								<div class="inp_cont_view noicon_opt">
									<input class="form-control" type="text" placeholder="Referral Code" >
								</div>
							</div>
							
						</div>
						<div class="more_cont_view">
							<!-- <h4>Membership Options/ Add-ons</h4>
							<div class="checkout_optview">
									<div class="inp_row checkoutmore_info">
											<div class="form-group">
													<div class="checkbox">
															<input class="styled-checkbox" id="Option1" type="checkbox" value="value1">
															<label for="Option1">Option1</label>
													</div>
											</div>
											<div class="form-group">
													<div class="checkbox">
															<input class="styled-checkbox" id="Option2" type="checkbox" value="value2">
															<label for="Option2">Option2</label>
													</div>
											</div>
											<div class="form-group">
													<div class="checkbox">
															<input class="styled-checkbox" id="Option3" type="checkbox" value="value3">
															<label for="Option3">Option3</label>
													</div>
											</div>
											<div class="form-group">
													<div class="checkbox">
															<input class="styled-checkbox" id="Option4" type="checkbox" value="value4">
															<label for="Option4">Option4</label>
													</div>
											</div>
											
									</div>
							</div> -->
							<div class="payment_opt_view">
								<!-- <div class="payment_block">
										<h4>Method of Payment</h4>
										<div class="payment_contentblock">
												<div class="radio">
														<input type="radio" id="test1" name="radio-group">
														<label for="test1">Credit Card</label>
												</div>
												
												<div class="radio">
														<input type="radio" id="test2" name="radio-group">
														<label for="test2">Direct Debit</label>
												</div>
												<div class="radio">
														<input type="radio" id="test3" name="radio-group">
														<label for="test3">Prepaid Account</label>
												</div>
										</div>
								</div> -->
								<div class="payment_block">
									<h4>Number of Payments *</h4>
									<div class="payment_contentblock">
										@if(isset($data['subscription_plan']) && isset($data['subscription_plan']->data) && count($data['subscription_plan']->data->prices_per_durations))
											@foreach ($data['subscription_plan']->data->prices_per_durations as $item)
												@if(count($item->installments))
													@foreach ($item->installments as $val)
														<div class="radio">
															<input type="radio" id="{{ $val->id }}" name="radio-group" value="{{ $val->id }}">
															<label for="{{ $val->id }}">{{ $val->number_of_payments }} Payments</label>
														</div>
													@endforeach
												@endif
											@endforeach
										@endif
										
										{{-- <div class="radio">
											<input type="radio" id="testnum2" name="radio-group">
											<label for="testnum2">26 Payments</label>
										</div> --}}
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="inp_row">
							<div class="form-group">
								<label >Where did you hear about us? *</label>
								<div class="inp_cont_view noicon_opt">
									<!-- <input type="email" class="form-control" placeholder="Please choose..." > -->
									<div class="selectcont ">
										<div class="arrowdown2">
											<i class="far fa-chevron-down"></i>
										</div>
										<select class="select_opt" name="" >
											<option value="" selected >Please choose...</option>
											@if(isset($data['opts_references']) && isset($data['opts_references']->data))
											@foreach ($data['opts_references']->data as $item)
												<option value="{{ $item->id }}" selected >{{ $item->display }}</option>
												
											@endforeach
											@endif
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="frombtn_wrap">
							<div class="def_btnopt2 frombtn frombtn2">
								<button type="button" class="btn2" >Save</button>
							</div>
						</div>
						</form>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
	
</div>
<div class="round_opt_btn rount_opt2">
	<img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
</div>
<div class="round_opt_btn rount_opt3">
	<img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
</div>
</section>
@include('footer')
</x-guest-layout>