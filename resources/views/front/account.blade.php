<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">
			<div class="content_block accountinfo">
				<div class="blocktitle">
					<h2>{{ __('account.My_Account') }}</h2>
					<h3 class="subtitle">{{ $client->firstname ." ". $client->lastname }}</h3>
					<p><span>{{ __('account.My_Gym') }}</span></p>

					<div class="account_des">
						<span class="acc_des_title">{{ __('account.My_Address') }}: </span>
						<span class="acc_des_info">{{ getAddress($client->adress) }} </span>
						<span class="accountedit"><a href="{{ route('myContactInformation') }}">{{ __('account.Edit') }}</a> </span><br>
						@if(!empty($client->communication_ToClient))
							<span class="acc_des_status">{{ __('myProfile.Message') }}:{{ $client->communication_ToClient}} </span><br>
						@endif
						<span class="acc_des_status">{{ __('myProfile.Status') }}:{{ $client->status}} </span>
					</div>
					<div class="account_leng">
						<div class="account_leng_title">{{ __('account.communication_language') }}</div>
                        <form action="{{ route('userLanguageUpdate') }}" method="POST">
                            @csrf
                            <div class="account_leng_opt">
                                <div class="account_select_opt">
                                    <div class="selectcont ">
                                        <div class="arrowdown2">
                                            <i class="fal fa-chevron-down"></i>
                                        </div>
                                        <select class="select_opt" name="language_id">
                                            @foreach ($languages as $item)
                                            <option value="{{ $item->id }}" {{ $client->language_id == $item->id ? "selected" : "" }}>{{ $item->display }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="account_leng_opt_btn">
                                    <div class="def_btnopt2 frombtn">
                                        <button type="submit" class="btn2" style="background-color: {{$button->value}}">{{ __('account.Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>

			</div>

			<div class="content_block memberships">
				<h2>{{ __('account.Memberships') }}</h2>
              
                @if($membership == "")
                    <div class="memberships_content">
						{{ __('account.No_Membership') }}
                    </div>
                @else
				<div class="memberships_content">
                    @foreach ($membership->data as $item)

					<div class="memberships_opt">
						<div class="memberships_nam">{{ $item->type }} - {{ __('account.davable') }} ${{ $item->recurantCharge }} {{ __('account.per_Month') }}</div>
						<div class="memberships_method_view">
							<div class="memberships_method">{{ __('account.Method_of_payment') }}:</div>
							<div class="memberships_method_opt">
								<div class="selectcont ">
									<div class="arrowdown2">
										<i class="fal fa-chevron-down"></i>
									</div>
									<select class="select_opt" >
                                        @if($data["cards"] != null)
                                            @foreach ($data["cards"] as $card)

                                            <option value="{{ $card->id }}" {{ ($item->creditCardId && $item->creditCardId == $card->id) ? "selected" : "" }} >xxx xxx xxxx {{ $card->four_digits_number}} {{ __('account.Card') }}</option>
                                            @endforeach
                                        @endif
                                        @if($data['banks'] != null)
                                            @foreach ($data["banks"] as $bank)
                                            <option value="{{ $bank->id }}" {{ ($item->bancAccountId && $item->bancAccountId == $bank->id) ? "selected" : "" }} >xxx xxx xxxx {{ $bank->account_last_digits}} {{ __('account.Bank') }}</option>
                                            @endforeach
                                        @endif


									</select>
								</div>
							</div>
						</div>
						<div class="ranew_opt_block">
							<div class="memberships_method_date">{{ __('account.End_date') }}: {{ date('Y/m/d',strtotime($item->end)) }} </div>
							<div class="ren_opt"><a href="{{route('renewMembership',$item->membershipsId)}}">{{ __('account.Renew') }}</a> </div>
						</div>
					</div>
                    @endforeach

				</div>
                @endif
			</div>

		</div>


	</div>

</section>
@include('footer')
</x-app-layout>
