<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">
			
			<div class="content_block packge_des">
				<h2>{{ __('referalcode.Referral_Code') }}</h2>
				<div class="referral_code_des referral_code_des2">
					<div class="referral_code_info">
						<div class="referral_code_view">
							<div class="referral_img">
								<img src="{{ asset('public/images/referral.png') }}" alt="" />
							</div>
							<h4>{{ __('referalcode.Invite_Friends') }}</h4>
						</div>
						<div class="referral_code_view">
							<div class="referral_img referral_img2">
								<img src="{{ asset('public/images/referral2.png') }}" alt="" />
							</div>
							<h4>{{ __('referalcode.You_receive') }} 25$</h4>
							<p>{{ __('referalcode.friend_signup') }} 25$</p>
						</div>
					</div>
					
					
					
				</div>
			</div>
			<div class="content_block packge_des">
				<h2>{{ __('referalcode.My_Referral_Code') }}</h2>
				<div class="referral_code_des">
					<div class="referral_code_from">
						<div class="form-group">
							
							<div class="inp_cont_view noicon_opt">
								<input type="text" class="form-control" placeholder="JBAF6" value="{{$data['referral']->data->reference_code}}" id="myInput">
								<div class="def_btnopt2 frombtn" >
									<button type="button" onclick="myFunction()" class="btn2" style="--hover-bg:{{ $primary_button_color_hover->value }}; background-color: {{$button->value}}">{{ __('referalcode.COPY') }}</button>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="content_block packge_des">
				<h2>{{ __('referalcode.Invite_Friends') }}</h2>
				<div class="referral_code_des">
					<p>{{ __('referalcode.no_limit') }}.</p>
					<p>{{ __('referalcode.send_invites') }}</p>
					<!--  -->
					<div class="tab_contentblock" >
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<button class="nav-link active" id="nav-social-tab" data-bs-toggle="tab" data-bs-target="#nav-social" aria-selected="true">{{ __('referalcode.Social') }}</button>
								<button class="nav-link" id="nav-email-tab" data-bs-toggle="tab" data-bs-target="#nav-email" aria-selected="false">{{ __('referalcode.Email') }}</button>
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade active show" id="nav-social">
								<div class="social_media ">
									<ul>
										@php
							$short_code =  'CentreDemo';
							if(Cookie::has('driver_route_id')){

								$short_code = Cookie::get('driver_route_id');
							}
							@endphp
							<li><a href="https://www.facebook.com/sharer/sharer.php?u={{route('homepage',  $short_code)}}"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="https://twitter.com/intent/tweet?text=Default+share+text&url={{route('homepage',  $short_code)}}"><i class="fab fa-twitter"></i></a></li>
							<li><a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url={{route('homepage', $short_code)}}"><i class="fab fa-linkedin-in"></i></a></li>
							<li><a href="https://telegram.me/share/url?url={{route('homepage',  $short_code)}}"><i class="fab fa-telegram"></i></a></li>
							
									</ul>
								</div>
							</div>
							<div class="tab-pane fade" id="nav-email" >
								<div class="emailopt">
									<i class="far fa-envelope"></i>
									{{$data['referral']->data->email}}
								</div>
							</div>
							
						</div>
					</div>
					<!--  -->
				</div>
				
			</div>
		</div>
	</div>
</section>
<script>
	function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999);

  navigator.clipboard.writeText(copyText.value);
  alert("Copied the text: " + copyText.value);
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="js/bootstrap.bundle.min.js"></script> -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/select_optiones.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>
@include('footer')
</x-app-layout>