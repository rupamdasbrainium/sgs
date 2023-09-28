<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">
			<div class="content_block accountinfo">
				<div class="blocktitle">
					<h2>My Account</h2>
					<h3 class="subtitle">{{ $client->firstname ." ". $client->lastname }}</h3>
					<p><span>My Gym: Gym Prafick</span></p>

					<div class="account_des">
						<span class="acc_des_title">My Address: </span>
						<span class="acc_des_info">{{ getAddress($client->adress) }} </span>
						<span class="accountedit"><a href="{{ route('myContactInformation') }}">Edit</a> </span>
					</div>
					<div class="account_leng">
						<div class="account_leng_title">Preferred communication language</div>
                        <form action="{{ route('userLanguageUpdate') }}" method="POST">
                            @csrf
                            <div class="account_leng_opt">
                                <div class="account_select_opt">
                                    <div class="selectcont ">
                                        <div class="arrowdown2">
                                            <i class="far fa-chevron-down"></i>
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
                                        <button type="submit" class="btn2" >Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>

			</div>

			<div class="content_block memberships">
				<h2>Memberships</h2>
                @if($membership == "")
                    <div class="memberships_content">
                        No Membership Found
                    </div>
                @else
				<div class="memberships_content">
                    @foreach ($membership->data as $item)

					<div class="memberships_opt">
						<div class="memberships_nam">{{ $item->type }}- davable ${{ $item->recurantCharge }} per Month</div>
						<div class="memberships_method_view">
							<div class="memberships_method">Method of  payment:</div>
							<div class="memberships_method_opt">
								<div class="selectcont ">
									<div class="arrowdown2">
										<i class="far fa-chevron-down"></i>
									</div>
									<select class="select_opt" >
										<option value="visa" selected >xxx xxx xxxx 4242 visa</option>
										<option value="visa" >xxx xxx xxxx 4242 visa</option>
										<option value="visa"  >xxx xxx xxxx 4242 visa</option>
										<option value="visa"  >xxx xxx xxxx 4242 visa</option>
									</select>
								</div>
							</div>
						</div>
						<div class="ranew_opt_block">
							<div class="memberships_method_date">End date: {{ date('Y/m/d',strtotime($item->end)) }} </div>
							<div class="ren_opt"><a href="#">Renew</a> </div>
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
