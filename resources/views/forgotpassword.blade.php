<x-guest-layout>
@section('title', $data['title'] . ' |')
@section('style', ';--sub_btn-bg: '.$button->value. ';--sub_btnhover-bg:' .$primary_button_color_hover->value)
@include('header')
<div class="banner_outer inner_banner">
	<div class="banner_slider">
		<div class="banner_panel">
			<div class="banner_img">
				<img src="{{ asset('public/images/passwordadd.png') }}" style=" filter: grayscale(100%);" alt="">
			</div>
			<div class="banner_cont">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="banner_outer_shape">
	</div>
</div>
<section class="maincontent_wrap innermain_content">
	<div class="welcomesection def_padding inner_content_block">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="welcomesec_info inner_heading">
						<div class="round_opt_btn3">
							<img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
						</div>
						
						<div class="heading_info sublogo ">
							<img  src="{{ asset('public/images/logo.svg') }}" alt="">
						</div>
						<h2>{{ __('forgetpassword.Forgot_Your_Password') }}</h2>
						<p>{{ __('forgetpassword.Fear_not_msg') }}</p>
						{{-- <p>{{ __('forgetpassword.Fear_not') }}<a href="#">{{ __('forgetpassword.account_recovery') }}</a> </p> --}}
					</div>
					<div class="fromdes_info">
						<form method="POST" action="{{ route('forgotPasswordsendmail') }}">
							@csrf
							<div class="from_cont_wrap">
								<div class="inp_row rowopt2">
									<div class="form-group">
										<label for="user_name">{{ __('forgetpassword.Email') }}</label>
										<div class="rowopt2_wrap1">
											<div class="inp_cont_view">
												<div class="icon_opt">
													<i class="fal fa-user"></i>
												</div>
												<input type="text" class="form-control" name="user_name" id="user_name" placeholder="" required>
												@if ($errors->has('user_name'))
												<div class="text-danger mt-3">{{ $errors->first('user_name') }}</div>
												@endif
											</div>
											<div class="inp_row capchacode_opt">
												<div class="form-group">
													<div class="inp_cont_view cap_inp_imf_add">
														<div class="capcha_img">
															{!! captcha_img('flat') !!}
														</div>
														<div class="reset_capcha_opt">
															<button type="button" class="reset_capcha">
															<img src="{{ asset('public/images/cap_ref_btn.png') }}" alt="">
															</button>
														</div>
													</div>
													<div class="inp_cont_view cap_inp_block">
														<input class="form-control inpopt2" type="text" name="captcha" placeholder="{{ __('forgetpassword.Enter_the_text') }}" id="capcha_codeview" required>
														@if ($errors->has('captcha'))
														<div class="text-danger mt-3">{{ __('forgetpassword.captcha') }}</div>
														@endif
													</div>
												</div>
											</div>
											
											<div class="def_btnopt2 frombtn">
												<button type="submit" class="btn2" >{{ __('forgetpassword.Reset_Password') }}</button>
											</div>
											<div class="forgot_opt text-center mt-3">
												<a href="{{ route('login') }}">{{ __('forgetpassword.Login') }}</a>
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
		<img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
	</div>
</section>
@include('footer')
</x-guest-layout>