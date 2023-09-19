<x-app-layout>
@section('title', $data['title'] . ' |')
@include('header')
<section class="maincontent_wrap inner_pageouter">
	<div class="inner_page_wrap">
		@include('layouts.sidebar')
		<div class="inner_page_des">
			<div class="content_block accountinfo">
				<div class="blocktitle">
					<h2 class="addpadding">Change Language</h2>
					<div class="fromdes_view ">
						<div class="fromdes_info">
							<div class="from_contentblock">
								<div class="inp_row gapadj singcol_opt">
									<div class="form-group langopt">
										<div class="selectoption2">
											<select id="demo-htmlselect" class="selectoption2_info">
												<!-- <option data-imagesrc=""  value="Select Language" selected >Select Language</option> -->
												<option data-imagesrc="{{ asset('public/images/flag/french.png') }}"  value="French" >French</option>
												<option data-imagesrc="{{ asset('public/images/flag/english.png') }}"  value="English"  >English</option>
											</select>
										</div>
									</div>
								</div>
								
								<div class="frombtn_wrap addmag_top">
									<div class="def_btnopt2 frombtn frombtn2">
										<button type="button" class="btn2">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('footer')
@push('scripts')
<script src="{{ asset('public/js/jquery.ddslick.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#demo-htmlselect").ddslick();
});
</script>
@endpush
</x-app-layout>