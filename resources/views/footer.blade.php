<footer class="footer_outer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="footer_des">
					<div class="footer_link continfo">
						<h3>{{ __('footer.contact') }}</h3>
						<ul>
							<li><a href="tel:+978 4569877"><span> <i class="far fa-phone-alt"></i></span>000-5824-879258</a></li>
							<li><span><i class="far fa-map-marker-alt"></i></span>EN 60, 5th Floor,700091</li>
							<li><a href="mailto: contact@beutics.com"><span><i class="far fa-envelope"></i></span>info@domain.com</a></li>
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
							<li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
							<li><a href="javascript:void(0)"><i class="fab fa-linkedin-in"></i></a></li>
							<li><a href="javascript:void(0)"><i class="fab fa-youtube"></i></a></li>
						</ul>
					</div>
					<div class="copy_rightinfo ">
						<div class="footer_logo">
							<a href="{{ route('homepage',['short_code'=>'CentreDemo']) }}"><img src="{{ asset('public/upload/banner/' . $logo->value) }}" style="width: 100px; height:23.11px;" alt=""></a>
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