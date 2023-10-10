<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
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
							<h4>{{ __('referalcode.You_receive') }} $25</h4>
							<p>{{ __('referalcode.friend_signup') }} $25</p>
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
									<button type="button" onclick="myFunction()" class="btn2" style="background-color: {{$button->value}}">{{ __('referalcode.COPY') }}</button>
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
										<li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
										<li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
										<li><a href="javascript:void(0)"><i class="fab fa-linkedin-in"></i></a></li>
										<li><a href="javascript:void(0)"><i class="fab fa-youtube"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="tab-pane fade" id="nav-email" >
								<div class="emailopt">
									<i class="fal fa-envelope"></i>
									{{$data['referral']->data->email}}"
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

@include('footer')
</x-app-layout>