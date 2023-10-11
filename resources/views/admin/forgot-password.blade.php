@section('title', 'Admin Forgot Password |')
<x-admin-guest-layout>
	@include('admin.header')
<section class="maincontent_wrap innermain_content">
	<div class="welcomesection def_padding inner_content_block">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="welcomesec_info inner_heading">
						<div class="heading_info sublogo ">
							<img  src="{{ asset('public/admin/images/logo.svg') }}" alt="">
						</div>
					</div>
					<div class="fromdes_wrap_view">
						<div class="welcomesec_info inner_heading">
							<h2>{{ __('admin.Forgot_Your_Password') }}</h2>
							<!-- <p>Input your details and password to get started</p> -->
						</div>
						<form method="POST" action="{{ route('admin.password.email') }}">
							@csrf
							<div class="fromdes_info">
								<div class="from_cont_wrap">
									<div class="inp_row rowopt2">
										<div class="form-group">
											<label for="email">{{ __('admin.Email') }}</label>
											<div class="rowopt2_wrap1">
												
												<div class="inp_cont_view">
													<div class="icon_opt">
														<i class="fal fa-envelope"></i>
													</div>
													<input type="email" class="form-control" name="email" id="email" placeholder="jhon.deo@gmail.com" value="{{old('email')}}" >
													@if ($errors->has('email'))
													<div class="text-danger mt-3">{{ $errors->first('email') }}</div>
													@endif
												</div>
												
												<div class="inp_row capchacode_opt">
													<div class="form-group">
														<div class="inp_cont_view cap_inp_imf_add">
															<div class="capcha_img">
																<!-- <img src="{{ asset('public/admin/images/capcha_img1.png') }}" alt=""> -->
																{!! captcha_img('flat') !!}
															</div>
															<div class="reset_capcha_opt">
																<button type="button" class="reset_capcha" >
																<img src="{{ asset('public/admin/images/cap_ref_btn.png') }}" alt="">
																</button>
															</div>
														</div>
														<div class="inp_cont_view cap_inp_block">
															<input class="form-control inpopt2" type="text" name="captcha" placeholder="{{ __('admin.Enter_the_text') }}" id="captcha" required>
															@if ($errors->has('captcha'))
															<div class="text-danger mt-3">{{ __('admin.captcha') }}</div>
															@endif
														</div>
													</div>
												</div>
												<div class="def_btnopt2 frombtn">
													<button type="submit" class="btn2 fulldidthbtn" >{{ __('admin.Forgot_Password') }}</button>
												</div>
												<div class="forgot_opt text-center mt-3">
													<a href="{{ route('admin.login') }}">{{ __('admin.Login') }}</a>
												</div>
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
	<div class="round_opt_btn">
		<img src="{{ asset('public/admin/images/roundopt2.jpg') }}" alt="">
	</div>
</section>
</x-admin-guest-layout>