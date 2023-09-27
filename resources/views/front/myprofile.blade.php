<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">
			<div class="content_block accountinfo">
				<div class="blocktitle">
					<h2>My Profile</h2>
					<h3 class="subtitle">{{ $client->firstname." ".$client->lastname }}</h3>
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
				<div class="memberships_content">

					<div class="memberships_opt">
						<div class="memberships_nam">Act1 Membership - davable $39.99 per Month</div>
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
							<div class="memberships_method_date">End date: 2023/02/04 </div>
							<div class="ren_opt"><a href="#">Renew</a> </div>
						</div>
					</div>
					<div class="memberships_opt">
						<div class="memberships_nam">Act1 Membership - davable $39.99 per Month</div>
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
							<div class="memberships_method_date">End date: 2023/02/04 </div>
							<div class="ren_opt"><a href="#">Renew</a> </div>
						</div>
					</div>
				</div>
			</div>
			<div class="content_block paymentinfo">
				<h2>Payment Details</h2>
				<div class="table_description_view">
					<table class="table">
						<thead>
							<tr>
								<th>TYPE</th>
								<th>PAYMENT DATE</th>
								<th>PAYMENT</th>
								<th>STATUS</th>
							</tr>
						</thead>
						<tbody>

                            @if($payments == "")
                            <tr>
                                <td colspan="5"> No payments available</td>
                            </tr>
                            @else
                            @foreach ($payments as $pt)

							<tr>
								<td data-label="TYPE">Payments</td>
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
</x-app-layout>
