<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">
			<div class="content_block accountinfo">
				<div class="blocktitle2">
					<h2>My Contact Information</h2>
				</div>
				<div class="fromdes_view">
					<div class="titleopt2">
						<h3>Change Of Informations</h3>
                        @if (Session::has('error'))

                        @endif
					</div>
					<form action="{{ route('user.name') }}" method="POST">
						@csrf
						<div class="fromdes_info user_contentblock">
							<div class="from_cont_wrap">
								<div class="inp_row gapadj inp_colm2">
									<div class="form-group">
										<div class="inp_cont_view noicon_opt nobg">
											<input type="text" class="form-control" name="firstname" readonly placeholder="Nancy" value="{{ $client->firstname }}">
										</div>
									</div>
									<div class="form-group">
										<div class="inp_cont_view noicon_opt nobg">
											<input type="text" class="form-control"  readonly name="lastname" placeholder="Boudreault"  value="{{ $client->lastname }}">
										</div>
									</div>
									<div class="form-group">
										<div class="inp_cont_view noicon_opt nobg">
											<input type="email" class="form-control" name="email"  readonly placeholder="nancy@isma.ca"  value="{{ $client->email }}">
										</div>
									</div>
								</div>
								<div class="inp_row gapadj inp_colm3">

									<div class="form-group">
										<div class="inp_cont_view noicon_opt adbg">
											<input type="text" class="form-control" name="civic_number" placeholder="246" value="{{ $client->adress->civic_number }}" >
										</div>
									</div>
									<div class="form-group">
										<div class="inp_cont_view noicon_opt adbg">
											<input type="text" class="form-control" name="street" placeholder="st-jacques "  value="{{ $client->adress->street }}">
										</div>
									</div>
									<div class="form-group">
										<div class="inp_cont_view noicon_opt adbg">
											<input type="text" class="form-control" name="appartment" placeholder="App" value="{{ $client->adress->appartment }}" >
										</div>
									</div>
								</div>
								<div class="inp_row gapadj inp_colm3">
									<div class="form-group">
										<div class="inp_cont_view noicon_opt adbg">
											<input type="text" class="form-control" name="city" placeholder="saint-jean" value="{{ $client->adress->city }}" >
										</div>
									</div>
									<div class="form-group">
										<div class="inp_cont_view noicon_opt adbg">
											<input type="text" class="form-control" name="postal_code"	 placeholder="1j2 j4j"  value="{{ $client->adress->postal_code }}">
											<p>Example: j3B 8k7</p>
										</div>
									</div>
									<div class="form-group">
										<div class="inp_cont_view noicon_opt">
											<div class="inp_cont_view noicon_opt adbg def-select2">
												<div class="selectcont ">
													<div class="arrowdown2">
														<i class="far fa-chevron-down"></i>
													</div>
													<select class="select_opt" name="province_id">
														@foreach ($province as $pr )
														<option value="{{ $pr->id }}" {{ $pr->id == $client->adress->province_id ? "selected" : '' }} >{{ $pr->display_english }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="inp_row gapadj inp_colm2">
									<div class="form-group">
										<div class="inp_cont_view noicon_opt adbg">
											<input type="text" class="form-control" name="phone" placeholder="Phone Number *" value="{{ $client->phone }}">
											<p>Example: xxx xxx-xxxx</p>
										</div>
									</div>
									<div class="form-group">
										<div class="inp_cont_view noicon_opt adbg">
											<input type="text" class="form-control" name="cellphone" placeholder="Cell *" value="{{ $client->cellphone }}" >
											<p>Example: xxx xxx-xxxx</p>
										</div>
									</div>
								</div>
								<div class="inp_row gapadj inp_colm2">
									<div class="form-group">
										<div class="inp_cont_view noicon_opt">
											<input type="text" class="form-control" name="emergency_phone" placeholder="Emergency Phone Number *"  value="{{ $client->emergency_phone }}">
											<p>Example: xxx xxx-xxxx</p>
										</div>
									</div>
									<div class="form-group">
										<div class="inp_cont_view noicon_opt">

											<input type="text" readonly name="date_of_birth" value="{{date('d/m/Y',strtotime($client->date_of_birth))}}" id="" class="form-control" placeholder="Date of birth *" required>
										</div>
									</div>
								</div>
								<div class="inp_row gapadj inp_colm2">
                                    <div class="form-group">
										<div class="inp_cont_view noicon_opt">
											<input type="text" class="form-control" name="emergency_contact" placeholder="Emergency contact"  value="{{ $client->emergency_contact }}">

										</div>
									</div>
									<div class="form-group">
										<!-- <div class="inp_cont_view noicon_opt">
												<input type="text" class="form-control" placeholder="Select Gender " >
										</div> -->
										<div class="inp_cont_view noicon_opt">
											<div class="inp_cont_view noicon_opt adbg def-select2">
												<div class="selectcont ">
													<div class="arrowdown2">
														<i class="far fa-chevron-down"></i>
													</div>
                                                    <input type="hidden" value="{{ $client->is_male }}" name="is_male">
													<select class="select_opt"  disabled>
														<option value="1" disabled {{ $client->is_male ? "selected":'' }}>Male</option>
														<option value="0"  disabled {{ !$client->is_male ? "selected":'' }}>Female</option>
														<option value="" disabled >Select Gender </option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">

									</div>
								</div>

								<div class="frombtn_wrap">
									<div class="def_btnopt2 frombtn frombtn2">
										<button type="submit" class="btn2" >Save</button>
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
