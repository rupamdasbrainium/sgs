<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">
			<div class="content_block accountinfo">
				<div class="blocktitle">
					@if(Session::has('message'))
						<div class="alert alert-danger">
							{{Session::get('message')}}
						</div>
						@endif
					@if(Session::has('message'))
						<div class="alert alert-success">
							{{Session::get('message')}}
						</div>
						@endif
					<h2 class="addpadding">Change Password</h2>
					<div class="fromdes_view ">
						<div class="fromdes_info">
							<div class="from_contentblock">
								<form action="{{route('changePasswordUser')}}" method="post">
									@csrf
								<div class="inp_row gapadj singcol_opt">
									<div class="form-group">
										<label> <em class="req_text">*</em> Enter Old Password </label>
										<div class="inp_cont_view">
											<div class="icon_opt">
												<i class="fal fa-eye" id="togglePassword" style="cursor: pointer;"></i>
											</div>
											<input class="form-control" type="password" name="old_password" placeholder="**************" autocomplete="current-password" required="" id="id_password">
										</div>
									</div>
									
									<div class="form-group">
										<label ><em class="req_text">*</em> Enter New Password  </label>
										<div class="inp_cont_view">
											<div class="icon_opt">
												<i class="fal fa-eye" id="togglePassword2" style="cursor: pointer;"></i>
											</div>
											<input class="form-control" type="password" name="new_password" placeholder="**************" autocomplete="current-password" required="" id="id_password2">
										</div>
									</div>
									<div class="form-group">
										<label ><em class="req_text">*</em> Enter Confirm Password</label>
										<div class="inp_cont_view">
											<div class="icon_opt">
												<i class="fal fa-eye" id="togglePassword3" style="cursor: pointer;"></i>
											</div>
											<input class="form-control" type="password" name="con_password" placeholder="**************" autocomplete="current-password" required="" id="id_password3">
										</div>
									</div>
								</div>
								
								<div class="frombtn_wrap singcol_btn">
									<div class="def_btnopt2 frombtn frombtn2">
										<button type="submit" class="btn2">Change Password</button>
									</div>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('footer')
</x-app-layout>