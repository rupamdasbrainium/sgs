<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="welcomesection def_padding inner_content_block">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="welcomesec_info inner_heading">
					</div>
					<div class="fromdes_info user_contentblock">
						<div class="sidebar_content">
							<div class="sidebar_info">
								<p>
									Center: <span>Gym Proacif</span>
								</p>
								<p>
									Address: <span>246st-iccauses, saint-iean.9.1j2 j4j</span>
								</p>
								<p>
									Package: <span>Acti 1</span>
								</p>
							</div>
						</div>
						<div class="from_cont_wrap">
							<div class="fromdes_info2">
								<div class="content_block packge_des newsub_opt">
									<h2>Memberships</h2>
									<div class="packge_wrap_opt prod_view">
										
										
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
												<button type="button" class="btn2" >Next</button>
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
	</div>
</section>
@include('footer')
</x-app-layout>