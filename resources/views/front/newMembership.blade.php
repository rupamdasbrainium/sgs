<x-guest-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap innermain_content user_information">
	<div class="welcomesection def_padding inner_content_block">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="welcomesec_info inner_heading">
						<!-- <div class="round_opt_btn3 modfround1">
							<img src="images/roundopt2.jpg" alt="">
						</div>						 -->
						<!-- <h2>User Information</h2>
						<p>Please provide your contact information</p> -->
					</div>
					<div class="fromdes_info user_contentblock">
						<div class="sidebar_content">
							<div class="sidebar_info">
								<p>
									Center: 
									<span>{{ $data['franchise']->name}}
								</p>
								<p>
									Address: 
									<span>{{ $data['franchise']->address_civic_number}} {{ $data['franchise']->address_street}} {{ $data['franchise']->address_city }} {{ $data['franchise']->address_postal_code }}</span>
								</p>
								<p>
									Package: 
									@if(isset($data['subscription_plan']) && isset($data['subscription_plan']->data))
										{{ $data['subscription_plan']->data->name }}
									@endif
								</p>
							</div>
						</div>
						<div class="from_cont_wrap">
							<form action="{{ route('suscriptionformSave',['id'=>$data['subscription_plan']->data->id]) }}" method="post">
								{{-- <form action="{{ route('suscriptionformSave',['id'=>18]) }}" method="post"> --}}
								@csrf
								<div class="fromdes_info2">
									<div class="content_block packge_des newsub_opt">
										<h2>Memberships</h2>
										<div class="packge_wrap_opt prod_view">
										
											
											<div class="optionwrap_block">
												@if(isset($data['subscription_plan']) && isset($data['subscription_plan']->data) && count($data['subscription_plan']->data->options))
													@foreach ($data['subscription_plan']->data->options as $item)
													<div class="optionitem_add">
														<h3>Option {{ $loop->iteration }}</h3>
														<div class="optionitem_block">
															<div class="opt_add">
																<img src="images/prod_img1.png" alt="">
															</div>
															<div class="optionitem_des">
																<p>{{ $item->name }}</p>
																<div class="price_opt_add">${{ $item->price }}</div>
																<div class="optionitem_prod">
																	<span>6 private training</span>
																	<span>Quantity: {{ $item->quantity }} X {{ $item->deliverable_quantity }}</span>
																	<span>Price: ${{ $item->price }}</span>
																</div>
																<div class="optionitem_checkopt">
																	<div class="form-group">
																		<div class="checkbox">
																			<input class="styled-checkbox2" id="Option5" value="{{ $item->id }}" type="checkbox" >
																			@if($item->is_initial)
																			<label for="Option5">Added to initial fee 
																				<em>( one time)</em></label>
																			@endif
																		</div>
																	</div>
																</div>
															</div>
														</div>
													
													</div>
													@endforeach
												@endif
												
											</div>
											<div class="frombtn_wrap">
												<div class="def_btnopt2 frombtn frombtn2">
													<button type="button" class="btn2" >Next</button>
												</div>
											</div>
										
						
										</div>
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
<div class="round_opt_btn rount_opt2">
	<img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
</div>
<div class="round_opt_btn rount_opt3">
	<img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
</div>
</section>
@include('footer')

</x-guest-layout>