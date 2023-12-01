<x-guest-layout>
@section('title', $data['title'] . ' |')
@section('style', ';--sub_btn-bg: '.$button->value. ';--sub_btnhover-bg:' .$primary_button_color_hover->value)

@include('header')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<div class="banner_outer inner_banner">
	<div class="banner_slider">
		<div class="banner_panel">
			<div class="banner_img">
				<img src="{{ asset('public/images/loginbanner.png') }}" alt="">
			</div>
			<div class="banner_cont">
				<div class="container">
					<div class="row">
						{{-- @if(Session::has('message'))
						<div class="alert alert-danger">
							{{Session::get('message')}}
						</div>
							@endif --}}
						<div class="col-md-12">
							<!-- <div class="banner_info">
													<h1>Elevate Your <span>Fitness,</span></h1>
													<h2>Ignite Your Potential!</h2>
							</div> -->
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
						<h2>{{ __('login.Login') }}</h2>
						<p>{{ __('login.Input_your_details') }}</p>
					</div>
					<div class="fromdes_info">
						<form method="POST" action="{{ route('userLogin') }}">
							@csrf
							<div class="from_cont_wrap">
								<div class="inp_row">
									<div class="form-group">
										<label for="email">{{ __('login.Username') }}</label>
										<div class="inp_cont_view">
											<div class="icon_opt">
												<i class="fal fa-envelope"></i>
											</div>
											<input type="text" class="form-control" name="user" id="email" placeholder="jhon.deo@gmail.com" required>
											@if ($errors->has('user'))
					                        <div class="text-danger mt-3">{{ $errors->first('user') }}</div>
					                        @endif
										</div>
									</div>
								</div>
								<div class="inp_row">
									<div class="form-group">
										<label for="id_password">{{ __('login.Password') }}</label>
										<div class="inp_cont_view">
											<div class="icon_opt">
												<i class="fal fa-eye" id="togglePassword" style="cursor: pointer;"></i>
											</div>
											<input class="form-control" type="password" name="password" placeholder="**************" autocomplete="current-password" required id="id_password">
											@if ($errors->has('password'))
					                        <div class="text-danger mt-3">{{ $errors->first('password') }}</div>
					                        @endif
										</div>
									</div>
								</div>
								<div class="inp_row capchacode_opt">
									<div class="form-group">
										<div class="inp_cont_view cap_inp_imf_add">
											<div class="capcha_img">
												<!-- <img src="{{ asset('public/images/capcha_img1.png') }}" alt=""> -->
												{!! captcha_img('flat') !!}
											</div>
											<div class="reset_capcha_opt">
												<button type="button" class="reset_capcha btn2">
												<img src="{{ asset('public/images/cap_ref_btn.png') }}" alt="">
												</button>
											</div>

										</div>
										<div class="inp_cont_view cap_inp_block">
											<input class="form-control inpopt2" type="text" name="captcha" placeholder="{{ __('login.captcha') }}" id="capcha_codeview" required>
											@if ($errors->has('captcha'))
					                        <div class="text-danger mt-3">{{ __('login.validcaptcha') }}</div>
					                        @endif
										</div>
									</div>
								</div>
								<div class="inp_row remember_opt">
									<div class="form-group">
										<div class="checkbox">
											<!-- <label><input type="checkbox"> Remember me</label> -->
											<input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="value2">
											<label for="styled-checkbox-2">{{ __('login.Remember_me') }}</label>
										</div>
										<div class="forgot_opt">
											<a href="{{ route('forgotpassword') }}">{{ __('login.Forgot_Password') }}</a>
										</div>
									</div>
								</div>
								<div class="def_btnopt2 frombtn">
									<button type="submit" class="btn2 fulldidthbtn">{{ __('login.Login') }}</button>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</x-guest-layout>
