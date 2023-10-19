<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">
			<div class="content_block accountinfo">
				<div class="blocktitle">
					<h2>{{ __('myProfile.My_Profile') }}</h2>
					<h3 class="subtitle">{{ $client->firstname." ".$client->lastname }}</h3>
					<p><span>{{ __('myProfile.My_Gym') }}</span></p>
					<div class="account_des">
						<span class="acc_des_title">{{ __('myProfile.My_Address') }}: </span>
						<span class="acc_des_info">{{ getAddress($client->adress) }} </span>
						<span class="accountedit"><a href="{{ route('myContactInformation') }}">{{ __('myProfile.Edit') }}</a> </span><br>
						@if(!empty($client->communication_ToClient))
							<span class="acc_des_status">{{ __('myProfile.Message') }}:{{ $client->communication_ToClient}} </span><br>
						@endif
						<span class="acc_des_status">{{ __('myProfile.Status') }}:{{ $client->status}} </span>
						
					</div>
					<div class="account_leng">
						<div class="account_leng_title">{{ __('myProfile.communication_language') }}</div>
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
                                        <button type="submit" class="btn2" style="background-color: {{$button->value}}" >{{ __('myProfile.Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>

			</div>

			<div class="content_block memberships">
				<h2>{{ __('myProfile.Memberships') }}</h2>

                @if($membership == "")
                    <div class="memberships_content">
                        {{ __('myProfile.No_Membership') }}
                    </div>
                @else
				<div class="memberships_content">
                    @foreach ($membership->data as $item)

					<div class="memberships_opt mb-2">
						<div class="memberships_nam">{{ $item->type }} - {{ __('myProfile.davable') }} ${{ $item->recurantCharge }} {{ __('myProfile.per_Month') }}</div>
						<div class="memberships_method_view">
							<div class="memberships_method">{{ __('myProfile.Method_of_payment') }}:</div>
							<div class="memberships_method_opt">
								<div class="selectcont ">
									<div class="arrowdown2">
										<i class="fal fa-chevron-down"></i>
									</div>
									<select class="select_opt" >
                                        @if($data["cards"] != null)
                                            @foreach ($data["cards"] as $card)

                                            <option value="{{ $card->id }}" {{ ($item->creditCardId && $item->creditCardId == $card->id) ? "selected" : "" }} >xxx xxx xxxx {{ $card->four_digits_number}} {{ __('myProfile.Card') }}</option>
                                            @endforeach
                                        @endif
                                        @if($data['banks'] != null)
                                            @foreach ($data["banks"] as $bank)
                                            <option value="{{ $bank->id }}" {{ ($item->bancAccountId && $item->bancAccountId == $bank->id) ? "selected" : "" }} >xxx xxx xxxx {{ $bank->account_last_digits}} {{ __('myProfile.Bank') }}</option>
                                            @endforeach
                                        @endif


									</select>
								</div>
							</div>
						</div>
						<div class="ranew_opt_block">
							<div class="memberships_method_date">{{ __('myProfile.End_date') }}: {{ date('Y/m/d',strtotime($item->end)) }} </div>
							<div class="ren_opt"><a href="#">{{ __('myProfile.Renew') }}</a> </div>
						</div>
					</div>
                    @endforeach

				</div>
                @endif
			</div>
			<div class="content_block paymentinfo">
				<h2>{{ __('myProfile.Payment_Details') }}</h2>
				<div class="table_description_view">
					<table class="table">
						<thead>
							<tr>
								<th>{{ __('myProfile.TYPE') }}</th>
								<th>{{ __('myProfile.PAYMENT_DATE') }}</th>
								<th>{{ __('myProfile.PAYMENT') }}</th>
								<th>{{ __('myProfile.STATUS') }}</th>
							</tr>
						</thead>
						<tbody>

                            @if($payments == "")
                            <tr>
                                <td colspan="5"> {{ __('myProfile.No_payments_available') }}</td>
                            </tr>
                            @else
                            @foreach ($payments as $pt)

							<tr>
								<td data-label="TYPE">{{ __('myProfile.Payments') }}</td>
								<td data-label="PAYMENT DATE">{{ date('Y-m-d',strtotime($pt->paymentDate)) }}</td>
								<td data-label="PAYMENT">{{ $pt->amount }}</td>
								<td data-label="STATUS">{{ $pt->is_paid ? "Paid" :"Unpaid" }}</td>
							</tr>
                            @endforeach
                            @endif

						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</section>
@include('footer')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</x-app-layout>
