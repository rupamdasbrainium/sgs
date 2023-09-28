<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">
			<div class="content_block accountinfo">
				<div class="blocktitle2">
					<h2>My Credit Card/Bank Account</h2>
				</div>
				<div class="fromdes_view">
					<div class="titleopt2">
						<h3>Cards and accounts</h3>
					</div>
					<div class="fromdes_info user_contentblock">
						<div class="from_cont_wrap">
							<div class="cards_des_wrap">
								<div class="cards_des_row">
								
									@foreach ($data['pay_methods_accc']->data as $value)
									<div class="cards_desinfo_item ">
										<div class="cards_cont_block">
											<div class="card_cont_des">
												<div class="card_img">
												</div>

												<div class="card_view">
													<div class="card_item_top">
														<div class="card_item_head">

															<h4>{{$value->owner_name}}</h4>

															<div class="def_card">
																<a href="#">By Default</a>
															</div>
														</div>
													</div>
													<div class="card_name_opt">
														<h5>Platinum Mastercard BNC</h5>
													</div>
													<div class="card_optblock">
														<div class="card_icon_text">
															{{-- @dd($data['pay_methods_accc']) --}}


															<span class="card_opt_text">Credit card ending with </span>
															<span class="card_opt_pass">**** </span>
															<span class="card_opt_pass">{{$value->four_digits_number}}</span>

														</div>
														<div class="card_icon">
															<img src="{{ asset('public/images/card.png') }}" alt="">
														</div>
													</div>
													<div class="exp_info">
														<div class="exp_text">
															<img src="{{ asset('public/images/exp.svg') }}" alt="">
														{{$value->expire_month}}/{{$value->expire_year}}
														</div>
													</div>
												</div>

											</div>
										</div>
									</div>
									@endforeach

									@foreach ($data['pay_methods_acc']->data as $values)
									<div class="cards_desinfo_item ">
										<div class="cards_cont_block">
											<div class="card_cont_des">
												<div class="card_img">
												</div>
												
												<div class="card_view">
													<div class="card_item_top">
														<div class="card_item_head">
															
															<h4>{{$values->owner_name}}</h4>
																													
															<div class="def_card">
																<a href="#">By Default</a>
															</div>
														</div>
													</div>
													<div class="card_name_opt">
														<h5>Platinum Mastercard BNC</h5>
													</div>
													<div class="card_optblock">
														<div class="card_icon_text">
															{{-- @dd($data['pay_methods_accc']) --}}
															
															
															<span class="card_opt_text">Bank acoount number ending with </span>
															<span class="card_opt_pass">**** </span>
															<span class="card_opt_pass">{{$values->account_last_digits}}</span>
														
														</div>
														<div class="card_icon">
															<img src="{{ asset('public/images/card.png') }}" alt="">
														</div>
													</div>
													<div class="exp_info">
														<div class="exp_text">
															<img src="{{ asset('public/images/exp.svg') }}" alt="">
													
														</div>
													</div>
												</div>
												
											</div>
										</div>
									</div>
									@endforeach
									
								</div>
								<div class="cards_des_row modf_card">
									<div class="cards_desinfo_item ">
										<div class="cards_cont_block">
											<div class="card_cont_des">
												<div class="card_img">
													<h5>Mastercard</h5>
													<div class="card_optblock">
														<div class="card_icon_text">
															<span class="card_opt_pass">**** </span>
															<span class="card_opt_pass">4584</span>
														</div>
														<div class="card_icon">
															<img src="{{ asset('public/images/card.png') }}" alt="">
														</div>
													</div>
													<p>Isma Microsolution</p>
												</div>
												<div class="card_view">
													<div class="card_item_top">
														<div class="card_item_head">
															<h4>John Doe</h4>
															<div class="def_card">
																<a href="#">By Default</a>
															</div>
														</div>
													</div>
													<div class="card_name_opt">
														<h5>Platinum Mastercard BNC</h5>
													</div>
													<div class="card_optblock">
														<div class="card_icon_text">
															<span class="card_opt_text">Credit card ending with </span>
															<span class="card_opt_pass">**** </span>
															<span class="card_opt_pass">4584</span>
														</div>
														<div class="card_icon">
															<img src="{{ asset('public/images/card.png') }}" alt="">
														</div>
													</div>
													<div class="exp_info">
														<div class="exp_text">
															<img src="{{ asset('public/images/exp.svg') }}" alt="">
															Expires on 10/2022
														</div>
													</div>
												</div>
											</div>
											<div class="def_btnopt2 frombtn frombtn2">
												<button type="button" class="btn2">Modify</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="frombtn_wrap">
								<div class="def_btnopt2 frombtn frombtn2">
									<a href="{{route('front.addPayment')}}" type="button" class="btn2" >Add a Payment Method</a>
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
