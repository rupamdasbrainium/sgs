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
					</div>
					<div class="fromdes_info user_contentblock">
						<div class="from_cont_wrap">
							<div class="inp_row gapadj inp_colm2">
								<div class="form-group">
									<div class="inp_cont_view noicon_opt nobg">
										<input type="text" class="form-control" placeholder="Nancy" >
									</div>
								</div>
								<div class="form-group">
									<div class="inp_cont_view noicon_opt nobg">
										<input type="text" class="form-control" placeholder="Boudreault" >
									</div>
								</div>
								<div class="form-group">
									<div class="inp_cont_view noicon_opt nobg">
										<input type="email" class="form-control" placeholder="nancy@isma.ca" >
									</div>
								</div>
							</div>
							<div class="inp_row gapadj inp_colm3">
								<div class="form-group">
									<div class="inp_cont_view noicon_opt adbg">
										<input type="text" class="form-control" placeholder="App" >
									</div>
								</div>
								<div class="form-group">
									<div class="inp_cont_view noicon_opt adbg">
										<input type="text" class="form-control" placeholder="246" >
									</div>
								</div>
								<div class="form-group">
									<div class="inp_cont_view noicon_opt adbg">
										<input type="text" class="form-control" placeholder="st-jacques " >
									</div>
								</div>
							</div>
							<div class="inp_row gapadj inp_colm3">
								<div class="form-group">
									<div class="inp_cont_view noicon_opt adbg">
										<input type="text" class="form-control" placeholder="saint-jean" >
									</div>
								</div>
								<div class="form-group">
									<div class="inp_cont_view noicon_opt adbg">
										<input type="text" class="form-control" placeholder="1j2 j4j" >
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
												<select class="select_opt" >
													<option value="QC" selected >QC</option>
													<option value="QC" >QC</option>
													<option value="QC"  >QC</option>
													<option value="QC"  >QC</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="inp_row gapadj inp_colm2">
								<div class="form-group">
									<div class="inp_cont_view noicon_opt adbg">
										<input type="text" class="form-control" placeholder="Phone Number *" value="514 709-6517" >
										<p>Example: xxx xxx-xxxx</p>
									</div>
								</div>
								<div class="form-group">
									<div class="inp_cont_view noicon_opt adbg">
										<input type="text" class="form-control" placeholder="Cell *" value="514 709-6517" >
										<p>Example: xxx xxx-xxxx</p>
									</div>
								</div>
							</div>
							<div class="inp_row gapadj inp_colm2">
								<div class="form-group">
									<div class="inp_cont_view noicon_opt">
										<input type="text" class="form-control" placeholder="Emergency Phone Number *" >
										<p>Example: xxx xxx-xxxx</p>
									</div>
								</div>
								<div class="form-group">
									<div class="inp_cont_view noicon_opt">
										<input type="text" class="form-control" placeholder="26-11-1982" >
									</div>
								</div>
							</div>
							<div class="inp_row gapadj inp_colm2">
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
												<select class="select_opt" >
													<option value="Select Gender " selected >Select Gender </option>
													<option value="Select Gender " >Select Gender </option>
													<option value="Select Gender "  >Select Gender </option>
													<option value="Select Gender "  >Select Gender </option>
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
									<button type="button" class="btn2" >Save</button>
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
</x-app-layout>