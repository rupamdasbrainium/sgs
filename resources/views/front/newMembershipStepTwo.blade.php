<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">

                <h2>{{ $data['title'] }}</h2>
                <div class="prod_item_wrap" id="home_prod_item">

                    <div class="from_cont_wrap" style="flex: 0 100%;">
                        <form
                            action="{{ route('newMembershipSteptwosave', ['id' => $data['subscription_plan']->data->id]) }}"
                            method="post">
                            {{-- <form action="{{ route('suscriptionformSave',['id'=>18]) }}" method="post"> --}}
                            @csrf
                            <div class="fromdes_info2">
                                <div class="content_block packge_des newsub_opt">

                                    <div class="packge_wrap_opt prod_view">


                                        <div class="optionwrap_block">
                                            @if (isset($data['subscription_plan']) &&
                                                    isset($data['subscription_plan']->data) &&
                                                    count($data['subscription_plan']->data->options))
                                                @foreach ($data['subscription_plan']->data->options as $item)
                                                    <div class="optionitem_add">
                                                        <h3 style="background-color: {{$theme->value}}">{{ __('newMembership.option') }} {{ $loop->iteration }}</h3>
                                                        {{-- <h3>{{ __('newMembership.option') }} 1</h3> --}}
                                                        <div class="optionitem_block">
                                                            <div class="opt_add">
                                                                {{-- <img src="images/prod_img1.png" alt=""> --}}
                                                                {{$item->image}}
                                                            </div>
                                                            <div class="optionitem_des">
                                                                <p>{{ $item->name }}</p>
                                                                {{-- <p>name </p> --}}
                                                                <div class="price_opt_add">${{ $item->price }}</div>
                                                                {{-- <div class="price_opt_add">$3</div> --}}
                                                                <div class="optionitem_prod">
                                                                    {{-- <span>{{ __('newMembership.training') }}</span> --}}
                                                                    {{-- <span>{{ __('newMembership.quantity') }}: asd</span> --}}
                                                                    <span>{{ __('newMembership.quantity') }}:
                                                                        {{ $item->quantity }} X
                                                                        {{ $item->deliverable_quantity }}</span>
                                                                    {{-- <span>{{ __('newMembership.price') }}: $5</span> --}}
                                                                    <span>{{ __('newMembership.price') }}:
                                                                        ${{ $item->price }}</span>
                                                                </div>
                                                                <div class="optionitem_checkopt">
                                                                    <div class="form-group">
                                                                        <div class="checkbox">
                                                                            <input name="add_on[]"
                                                                                class="styled-checkbox2"
                                                                                id="Option{{ $loop->iteration }}"
                                                                                value="{{ $item->id }}"
                                                                                type="checkbox">
                                                                            <label for="Option{{ $loop->iteration }}">
                                                                                @if ($item->is_initial)
                                                                                    {{ __('newMembership.initial_fee') }}
                                                                                    <em>(
                                                                                        {{ __('newMembership.onetime') }})</em>
                                                                                @endif
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
                                                @if (isset($data['subscription_plan']) &&
                                                        isset($data['subscription_plan']->data) &&
                                                        count($data['subscription_plan']->data->prices_per_durations))
                                                    @foreach ($data['subscription_plan']->data->prices_per_durations as $item)
                                                        @if (count($item->installments))
                                                            @foreach ($item->installments as $val)
                                                                <div class="radio">
                                                                    <input type="radio" id="{{ $val->id }}"
                                                                        name="installments"
                                                                        value="{{ $item->duration_id }}|{{ $val->id }}"
                                                                        {{ $loop->index == 0 ? 'required' : '' }}>
                                                                    <label
                                                                        for="{{ $val->id }}">{{ $val->number_of_payments }}
                                                                        {{ __('suscription.payments') }}</label>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif

                                                {{-- <div class="radio">
													<input type="radio" id="testnum2" name="radio-group">
													<label for="testnum2">26 Payments</label>
												</div>
												<div class="radio">
													<input type="radio" id="testnum2" name="radio-group">
													<label for="testnum2">26 Payments</label>
												</div> --}}
                                            </div>
                                        </div>
                                        <div class="frombtn_wrap">
                                            <div class="def_btnopt2 frombtn frombtn2">
                                                <button type="submit"
                                                    class="btn2" style="background-color: {{$button->value}}">{{ __('newMembership.next') }}</button>
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
    </section>
    @include('footer')
</x-app-layout>
{{-- <x-guest-layout>
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

</x-guest-layout> --}}
