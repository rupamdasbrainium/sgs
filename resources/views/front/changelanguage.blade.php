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
						<div class="alert alert-success">
							{{Session::get('message')}}
						</div>
						@endif
					<h2 class="addpadding">{{ __('changelanguage.Change_Language') }}</h2>
					<div class="fromdes_view ">
						<div class="fromdes_info">
							<form method="POST" name="myforms" action="{{ route('mylanguagechange') }}">
							@csrf
							 <div class="from_contentblock">
								<div class="inp_row gapadj singcol_opt">
									<div class="form-group langopt">
										<div class="selectoption2">
											<select id="demo-htmlselect" class="selectoption2_info" name="display">
												@foreach($data['language'] as $lang)
												<!-- <option data-imagesrc=""  value="Select Language" selected >Select Language</option> -->
												<option data-imagesrc="{{ $lang->id == 2?asset('public/images/flag/english.png') : asset('public/images/flag/french.png') }}"  value="{{$lang->id}}" >{{$lang->display}}</option>
												{{-- <option data-imagesrc="{{  }}"  value="English"  >English</option> --}}
												@endforeach
											</select>
										</div>
									</div>
								</div>
								
								<div class="frombtn_wrap addmag_top">
									<div class="def_btnopt2 frombtn frombtn2">
										<button type="submit" class="btn2">{{ __('changelanguage.Save') }}</button>
									</div>
								</div>
							</div>
							</form>
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