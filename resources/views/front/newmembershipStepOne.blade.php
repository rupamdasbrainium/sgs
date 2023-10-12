<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">

			<h2>{{ $data['title'] }}</h2>
			<div class="prod_item_wrap" id="home_prod_item">

				@foreach ($data['all_plan']->data as $key => $item)
				@php
				$values = $data['all_plan_details'][$key];
				
				@endphp
					<div class="prod_item">
						<div class="action_opt action_opt_title" style="background-color: {{$theme->value}}">

							<div class="action_text">

								<div class="selectcont ">
									
									<div class="arrowdown2">
										{{-- <i class="far fa-chevron-down"></i> --}}
									</div>
									<select class="select_opt">
										<option value="{{$values->data->id}}">

											{{ $values->data->name }}

										</option>
									</select>
								</div>
							</div>
						</div>
						<div class="action_opt">
							<div class="price_text">

								@if (isset($values->data))
									@if (count($values->data->prices_per_durations))
										@foreach ($values->data->prices_per_durations as $val)
											${{ $val->price_recurent }}<span>/
												{{ $val->duration_unit_display }}</span>
											@php
												break;
											@endphp
										@endforeach
									@else
										$0
									@endif
								@endif
							</div>
							{{-- <p>{{ __('global.price') }}</p> --}}
						</div>
						<div class="individual_opt">
							<div class="individual_head" style="background-color: {{$theme->value}}">
								{{ __('global.individual_head') }}
							</div>
							<div class="individual_des">
								{{-- <ul>
									@if (isset($values->data))
										@if (isset($values->data->options))
											@foreach ($values->data->options as $val)
												<li><span><i
															class="fal fa-times"></i></span>{{ $val->name }}
												</li>
											@endforeach
										@endif
									@endif
								</ul> --}}
								<ul>
									<li>{{ $lang_id == 2 ? $item->descr_english : $item->descr_french }}</li>
								</ul>
								<div class="subscribe_btn" >
									
									<a href="{{ route('newMembershipSteptwo', [$values->data->id]) }}"
										class="sub_btn"  style="background-color: {{$button->value}}">{{ __('global.subscribe') }}</a>
								</div>
							</div>
						</div>
					</div>
				@endforeach
				{{-- <div class="prod_item">
					<div class="action_opt action_opt_title">
						
						<div class="action_text">
							<!-- Action 2
							<div class="arrowdown">
									<i class="far fa-chevron-down"></i>
							</div> -->
							<div class="selectcont ">
								<div class="arrowdown2">
									<i class="far fa-chevron-down"></i>
								</div>
								<select class="select_opt" >
									<option value="Action1">Action 1</option>
									<option value="Action2" selected>Action 2</option>
									<option value="Action3" >Action 3</option>
									<option value="Action4" >Action 4</option>
								</select>
							</div>
						</div>
					</div>
					<div class="action_opt">
						<div class="price_text">
							$3.99 <span>/ month</span>
						</div>
						<p>per user/month,billed annually</p>
					</div>
					<div class="individual_opt">
						<div class="individual_head">
							For individual entrepreneurs
						</div>
						<div class="individual_des">
							<ul>
								<li><span><i class="far fa-check"></i></span>Monthly limit of 500 users</li>
								<li><span><i class="far fa-check"></i></span>Monthly limit of 1500 orders</li>
								<li><span><i class="far fa-check"></i></span>Basic Financial Tools</li>
								<li><span><i class="fal fa-times"></i></span>Email Support</li>
								<li><span><i class="fal fa-times"></i></span>Email Support</li>
								<li><span><i class="fal fa-times"></i></span>Email Support</li>
							</ul>
							<div class="subscribe_btn">
								<a href="#" class="sub_btn">Subscribe</a>
							</div>
						</div>
					</div>
				</div>
				<div class="prod_item">
					<div class="action_opt action_opt_title">
						
						<div class="action_text">
							<!-- Action 3
							<div class="arrowdown">
									<i class="far fa-chevron-down"></i>
							</div> -->
							<div class="selectcont ">
								<div class="arrowdown2">
									<i class="far fa-chevron-down"></i>
								</div>
								<select class="select_opt" >
									<option value="Action1">Action 1</option>
									<option value="Action2">Action 2</option>
									<option value="Action3" selected >Action 3</option>
									<option value="Action4" >Action 4</option>
								</select>
							</div>
						</div>
					</div>
					<div class="action_opt">
						<div class="price_text">
							$3.99 <span>/ month</span>
						</div>
						<p>per user/month,billed annually</p>
					</div>
					<div class="individual_opt">
						<div class="individual_head">
							For individual entrepreneurs
						</div>
						<div class="individual_des">
							<ul>
								<li><span><i class="far fa-check"></i></span>Monthly limit of 500 users</li>
								<li><span><i class="far fa-check"></i></span>Monthly limit of 1500 orders</li>
								<li><span><i class="far fa-check"></i></span>Basic Financial Tools</li>
								<li><span><i class="fal fa-times"></i></span>Email Support</li>
								<li><span><i class="fal fa-times"></i></span>Email Support</li>
								<li><span><i class="fal fa-times"></i></span>Email Support</li>
							</ul>
							<div class="subscribe_btn">
								<a href="#" class="sub_btn">Subscribe</a>
							</div>
						</div>
					</div>
				</div>
				<div class="prod_item">
					<div class="action_opt action_opt_title">
						<div class="action_text">
							<!-- Action 2
							<div class="arrowdown">
									<i class="far fa-chevron-down"></i>
							</div> -->
							<div class="selectcont ">
								<div class="arrowdown2">
									<i class="far fa-chevron-down"></i>
								</div>
								<select class="select_opt" name="4" >
									<option value="action1">Action 1</option>
									<option value="action2">Action 2</option>
									<option value="action3" >Action 3</option>
									<option selected value="action4" >Action 4</option>
								</select>
							</div>
						</div>
					</div>
					<div class="action_opt">
						<div class="price_text">
							$3.99 <span>/ month</span>
						</div>
						<p>per user/month,billed annually</p>
					</div>
					<div class="individual_opt">
						<div class="individual_head">
							For individual entrepreneurs
						</div>
						<div class="individual_des">
							<ul>
								<li><span><i class="far fa-check"></i></span>Monthly limit of 500 users</li>
								<li><span><i class="far fa-check"></i></span>Monthly limit of 1500 orders</li>
								<li><span><i class="far fa-check"></i></span>Basic Financial Tools</li>
								<li><span><i class="fal fa-times"></i></span>Email Support</li>
								<li><span><i class="fal fa-times"></i></span>Email Support</li>
								<li><span><i class="fal fa-times"></i></span>Email Support</li>
							</ul>
							<div class="subscribe_btn">
								<a href="#" class="sub_btn">Subscribe</a>
							</div>
						</div>
					</div>
				</div>  --}}
			</div>
		</div>
	</div>
</section>
@include('footer')
</x-app-layout>