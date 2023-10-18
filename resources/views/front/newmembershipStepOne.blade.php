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
				// @dd($data['all_plan_details'])
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
										<div class="selectcont ">
											<div class="arrowdown2">
												<i class="far fa-chevron-down"></i>
											</div>
											<select class="select_opt">
												@foreach ($values->data->prices_per_durations as $val)
													{{-- ${{ $val->price_recurant }}<span>/
														{{ $val->duration_unit_display }}</span> --}}
														<option>${{ $val->price_recurant }}<span>/
															{{ $val->duration_unit_display }}</span> For {{ $val->frequency }} {{ $val->duration_unit_display }}
														</option>
												@endforeach
											</select>
										</div>
									@else
										$0
									@endif
								@endif
							</div>
							{{-- <p>{{ __('global.price') }}</p> --}}
							<p>{{ $lang_id == 2 ? $item->descr_english : $item->descr_french }}</p>
						</div>
						<div class="individual_opt">
							<div class="individual_head" style="background-color: {{$theme->value}}">
								{{ __('global.age') }} : {{ $lang_id == 2 ? $item->ageLimit_english : $item->ageLimit_french }}
							</div>
							<div class="individual_des">
								<ul>
									@if (isset($values->data))
										@if (isset($values->data->options))
											@foreach ($values->data->options as $val)
												<li><span><i
															class="fal fa-times"></i></span>{{ $val->name }}
												</li>
											@endforeach
										@endif
									@endif
								</ul>
								{{-- <ul>
									<li>{{ $lang_id == 2 ? $item->descr_english : $item->descr_french }}</li>
								</ul> --}}
								<div class="subscribe_btn" >
									
									<a href="{{ route('newMembershipSteptwo', [$values->data->id]) }}"
										class="sub_btn"  style="background-color: {{$button->value}}">{{ __('global.subscribe') }}</a>
								</div>
							</div>
						</div>
					</div>
				@endforeach
				
			</div>
		</div>
	</div>
</section>
@include('footer')
</x-app-layout>