<div class="left_sidebar" style="background-color: {{$theme->value}}" >
    <div class="mob_user_icon">
        <span class="accountinfo" ><img src="{{ asset('admin/images/icon1.svg') }}" alt="" ></span>
        <span class="close_info" ><i class="fa fa-times"></i></span>
    </div>
    <div class="innersidebar_cont">
        <ul style="--hovers-bg:{{ $theme_color_hover->value }}">
            <li>
                <a href="{{ route('admin.settings') }}">
                    <span><img src="{{ asset('admin/images/adminsetup.svg') }}" alt="" ></span>
                    <em>{{ __('admin.Admin_Settings') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.configuration') }}">
                    <span><img src="{{ asset('admin/images/admin_configuration.svg') }}" alt="" ></span>
                    <em>{{ __('admin.Admin_Configuration') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.cmslistView') }}">
                    <span><img src="{{ asset('admin/images/admin_configuration.svg') }}" alt="" ></span>
                    <em>{{ __('admin.Content_Management') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>

        </ul>
    </div>
</div>