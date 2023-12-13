<footer class="footer_outer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="footer_des">
					<div class="footer_link continfo">
						<h3>{{ __('footer.contact') }}</h3>
						<ul>
							<li><a href="tel:+978 4569877"><span> <i class="fa fa-phone-alt"></i></span>{{$admin_phone->value}}</a></li>
							<li><span><i class="fa fa-map-marker-alt"></i></span>{{$admin_address->value}}</li>
							<li><a href="mailto: contact@beutics.com"><span><i class="fa fa-envelope"></i></span>info@domain.com</a></li>
						</ul>
					</div>
					<div class="footer_link">
						<h3>{{ __('footer.links') }}</h3>
						<ul>
							<li><a href="{{ route('front.terms') }}">{{ __('footer.terms') }}</a></li>
							<li><a href="{{ route('front.privacy') }}">{{ __('footer.policy') }}</a></li>
							<li><a href="{{ route('front.law25') }}">{{ __('footer.law') }} 25</a></li>
						</ul>
					</div>
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
					<div class="copy_rightinfo ">
						<div class="footer_logo">
							<a href="{{ route('homepage',['short_code'=>$short_code]) }}">
								@if(isset($logo))
                                <img src=" {{ asset('public/upload/banner/' . $logo->value) }}" alt="">
                                @else
                                <img src=" {{ asset('public/images/logo.svg') }}"  alt="">
                                @endif
							</a>
						</div>
						<p>
							© 2023 sgs. {{ __('footer.all_right') }}.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
@if (Auth::user())
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
  var cur_url = location.href;
  var qpos = cur_url.lastIndexOf('?');
  if (qpos > 0) {
    cur_url = cur_url.substr(0, qpos);
  }
  $('.left_sidebar .innersidebar_cont ul li a[href="' + cur_url + '"]').parent().addClass('activepage');
});
</script>

@endpush
@endif