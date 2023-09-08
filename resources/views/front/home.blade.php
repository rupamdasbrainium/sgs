<x-guest-layout>
@section('title', $data['title'] . ' |')
@include('header')
<div class="banner_outer">
	<div class="banner_slider">
		<div class="banner_panel">
			<div class="banner_img">
				<img src="{{ asset('images/yoav_banner_img.png') }}" alt="">
			</div>
			<div class="banner_cont">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="banner_info">
								<h1>Elevate Your <span>Fitness,</span></h1>
								<h2>Ignite Your Potential!</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="banner_outer_shape">
	</div>
</div>
<section class="maincontent_wrap">
	<div class="welcomesection def_padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="welcomesec_info">
						<div class="round_opt_btn3">
							<img src="{{ asset('images/roundopt2.jpg') }}" alt="">
						</div>
						
						<div class="heading_info "><h3>Welcome To SGS</h3></div>
						<h2>Select Your Magic Plan</h2>
						<p>Transform Your Body, Transform Your Life at Fitness Gym</p>
					</div>
					
				</div>
			</div>
		</div>
		<div class="prod_viewsection_outer">
			<div class="round_opt1">
				<img src="{{ asset('images/roundopt2.jpg') }}" alt="">
			</div>
			
			<div class="prod_viewsection">
				
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="select_opr_block">
								<div class="selectcont_wrap">
									<div class="selectcont ">
										<div class="arrowdown2">
											<i class="far fa-chevron-down"></i>
										</div>
										<select class="select_opt" >
											<option value="Proactive Gym" selected >Proactive Gym</option>
											<option value="Proactive Gym" >Proactive Gym</option>
											<option value="Proactive Gym"  >Proactive Gym</option>
											<option value="Proactive Gym"  >Proactive Gym</option>
										</select>
									</div>
									<div class="selectcont ">
										<div class="arrowdown2">
											<i class="far fa-chevron-down"></i>
										</div>
										<select class="select_opt" >
											<option value="1030 Boulevard rene le" >1030 Boulevard rene le</option>
											<option value="1030 Boulevard rene le" >1030 Boulevard rene le</option>
											<option value="1030 Boulevard rene le" >1030 Boulevard rene le</option>
											<option value="1030 Boulevard rene le" >1030 Boulevard rene le</option>
										</select>
									</div>
									<div class="selectcont ">
										<div class="arrowdown2">
											<i class="far fa-chevron-down"></i>
										</div>
										<select class="select_opt" >
											<option value="Actil" >Actil</option>
											<option value="Actil" >Actil</option>
											
											<option value="Actil" >Actil</option>
											
											<option value="Actil" >Actil</option>
											
										</select>
									</div>
								</div>
								<div class="def_btnopt2">
									<button type="button" class="btn2" >Continue</button>
								</div>
								
							</div>
							<div class="prod_item_wrap">
								<div class="prod_item">
									<div class="action_opt action_opt_title">
										
										<div class="action_text">
											
											<!-- Action 1
											<div class="arrowdown">
													<i class="far fa-chevron-down"></i>
											</div> -->
											<div class="selectcont ">
												<div class="arrowdown2">
													<i class="far fa-chevron-down"></i>
												</div>
												<select class="select_opt" >
													<option value="Action1" selected>Action 1</option>
													<option value="Action2" >Action 2</option>
													<option value="Action3" >Action 3</option>
													<option value="Action4" >Action 4</option>
												</select>
											</div>
										</div>
									</div>
									<div class="action_opt">
										<div class="price_text">
											$3.99 <span>/ month</span>
										</div>
										<p>per user/month,billed annually</p>
									</div>
									<div class="individual_opt">
										<div class="individual_head">
											For individual entrepreneurs
										</div>
										<div class="individual_des">
											<ul>
												<li><span><i class="far fa-check"></i></span>Monthly limit of 500 users</li>
												<li><span><i class="far fa-check"></i></span>Monthly limit of 1500 orders</li>
												<li><span><i class="far fa-check"></i></span>Basic Financial Tools</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
											</ul>
											<div class="subscribe_btn">
												<a href="#" class="sub_btn">Subscribe</a>
											</div>
										</div>
									</div>
								</div>
								<div class="prod_item">
									<div class="action_opt action_opt_title">
										
										<div class="action_text">
											<!-- Action 2
											<div class="arrowdown">
													<i class="far fa-chevron-down"></i>
											</div> -->
											<div class="selectcont ">
												<div class="arrowdown2">
													<i class="far fa-chevron-down"></i>
												</div>
												<select class="select_opt" >
													<option value="Action1">Action 1</option>
													<option value="Action2" selected>Action 2</option>
													<option value="Action3" >Action 3</option>
													<option value="Action4" >Action 4</option>
												</select>
											</div>
										</div>
									</div>
									<div class="action_opt">
										<div class="price_text">
											$3.99 <span>/ month</span>
										</div>
										<p>per user/month,billed annually</p>
									</div>
									<div class="individual_opt">
										<div class="individual_head">
											For individual entrepreneurs
										</div>
										<div class="individual_des">
											<ul>
												<li><span><i class="far fa-check"></i></span>Monthly limit of 500 users</li>
												<li><span><i class="far fa-check"></i></span>Monthly limit of 1500 orders</li>
												<li><span><i class="far fa-check"></i></span>Basic Financial Tools</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
											</ul>
											<div class="subscribe_btn">
												<a href="#" class="sub_btn">Subscribe</a>
											</div>
										</div>
									</div>
								</div>
								<div class="prod_item">
									<div class="action_opt action_opt_title">
										
										<div class="action_text">
											<!-- Action 3
											<div class="arrowdown">
													<i class="far fa-chevron-down"></i>
											</div> -->
											<div class="selectcont ">
												<div class="arrowdown2">
													<i class="far fa-chevron-down"></i>
												</div>
												<select class="select_opt" >
													<option value="Action1">Action 1</option>
													<option value="Action2">Action 2</option>
													<option value="Action3" selected >Action 3</option>
													<option value="Action4" >Action 4</option>
												</select>
											</div>
										</div>
									</div>
									<div class="action_opt">
										<div class="price_text">
											$3.99 <span>/ month</span>
										</div>
										<p>per user/month,billed annually</p>
									</div>
									<div class="individual_opt">
										<div class="individual_head">
											For individual entrepreneurs
										</div>
										<div class="individual_des">
											<ul>
												<li><span><i class="far fa-check"></i></span>Monthly limit of 500 users</li>
												<li><span><i class="far fa-check"></i></span>Monthly limit of 1500 orders</li>
												<li><span><i class="far fa-check"></i></span>Basic Financial Tools</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
											</ul>
											<div class="subscribe_btn">
												<a href="#" class="sub_btn">Subscribe</a>
											</div>
										</div>
									</div>
								</div>
								<div class="prod_item">
									<div class="action_opt action_opt_title">
										<div class="action_text">
											<!-- Action 2
											<div class="arrowdown">
													<i class="far fa-chevron-down"></i>
											</div> -->
											<div class="selectcont ">
												<div class="arrowdown2">
													<i class="far fa-chevron-down"></i>
												</div>
												<select class="select_opt" name="4" >
													<option value="action1">Action 1</option>
													<option value="action2">Action 2</option>
													<option value="action3" >Action 3</option>
													<option selected value="action4" >Action 4</option>
												</select>
											</div>
										</div>
									</div>
									<div class="action_opt">
										<div class="price_text">
											$3.99 <span>/ month</span>
										</div>
										<p>per user/month,billed annually</p>
									</div>
									<div class="individual_opt">
										<div class="individual_head">
											For individual entrepreneurs
										</div>
										<div class="individual_des">
											<ul>
												<li><span><i class="far fa-check"></i></span>Monthly limit of 500 users</li>
												<li><span><i class="far fa-check"></i></span>Monthly limit of 1500 orders</li>
												<li><span><i class="far fa-check"></i></span>Basic Financial Tools</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
												<li><span><i class="fal fa-times"></i></span>Email Support</li>
											</ul>
											<div class="subscribe_btn">
												<a href="#" class="sub_btn">Subscribe</a>
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
	</div>
	
	<div class="subscribe_content">
		<div class="outer_shape1">
		</div>
		<div class="subscribe_info">
			<div class="sub_text_info">
				<h2>Find a GYM Near you</h2>
				<p>To find a Club, use the search bar, navigate using the map, or turn on location services.
				</p>
				<div class="sub_from">
					<div class="form-group">
						<input type="email" class="form-control" id="email" placeholder="hjgbhjg bvjhvjhg"  >
						<button type="button" class="searchicon_opt">
						<i class="far fa-search"></i>
						</button>
					</div>
				</div>
			</div>
			<div class="subscribe_map">
				<!-- <img src="{{ asset('images/map.png') }}" alt=""> -->
				<div class="mapopt">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.1220591551264!2d88.43105637416711!3d22.574537732901522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275af0f72e607%3A0x7b8571e4cca5cae4!2s60%2C%20Street%20Number%2018%2C%20EN%20Block%2C%20Sector%20V%2C%20Bidhannagar%2C%20Kolkata%2C%20West%20Bengal%20700091!5e0!3m2!1sen!2sin!4v1690264798361!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<div class="round_opt_btn">
					<img src="{{ asset('images/roundopt2.jpg') }}" alt="">
				</div>
				
				<div class="round_opt_btn2">
					<img src="{{ asset('images/roundopt2.jpg') }}" alt="">
				</div>
			</div>
		</div>
	</div>
</section>
@include('footer')
</x-guest-layout>