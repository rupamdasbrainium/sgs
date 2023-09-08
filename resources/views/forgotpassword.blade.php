<x-guest-layout>
@section('title', $data['title'] . ' |')
@include('header')
<div class="banner_outer inner_banner">
	<div class="banner_slider">
		<div class="banner_panel">
			<div class="banner_img">
				<img src="{{ asset('images/passwordadd.png') }}" style=" filter: grayscale(100%);" alt="">
			</div>
			<div class="banner_cont">
				<div class="container">
					<div class="row">
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
							<img src="{{ asset('images/roundopt2.jpg') }}" alt="">
						</div>
						
						<div class="heading_info sublogo ">
							<img  src="{{ asset('images/logo.svg') }}" alt="">
						</div>
						<h2>Forgot Your Password</h2>
						<p>Fear not. We'll email you instructions to reset your password. If you don't have access to you: email anymore. you can try <a href="#">account recovery.</a> </p>
					</div>
					<div class="fromdes_info">
						<div class="from_cont_wrap">
							<div class="inp_row rowopt2">
								<div class="form-group">
									<label for="email">Email</label>
									<div class="rowopt2_wrap1">
										<div class="inp_cont_view">
											<div class="icon_opt">
												<i class="fal fa-envelope"></i>
											</div>
											<input type="email" class="form-control" id="email" placeholder="jhon.deo@gmail.com" >
										</div>
										<div class="inp_row capchacode_opt">
											<div class="form-group">
												<div class="inp_cont_view cap_inp_imf_add">
													<div class="capcha_img">
														<img src="{{ asset('images/capcha_img1.png') }}" alt="">
													</div>
													<div class="reset_capcha_opt">
														<button type="reset" class="reset_capcha" >
														<img src="{{ asset('images/cap_ref_btn.png') }}" alt="">
														</button>
													</div>
												</div>
												<div class="inp_cont_view cap_inp_block">
													<input class="form-control inpopt2" type="text" name="capcha_codeview" placeholder="Enter the text in the image" id="capcha_codeview">
													
												</div>
											</div>
										</div>
										
										<div class="def_btnopt2 frombtn">
											<button type="button" class="btn2" >Reset Password</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="round_opt_btn">
		<img src="{{ asset('images/roundopt2.jpg') }}" alt="">
	</div>
</section>
@include('footer')
</x-guest-layout>