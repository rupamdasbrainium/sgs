<div class="left_sidebar">
    <div class="mob_user_icon">
        <span class="accountinfo" ><img src="{{ asset('admin/images/icon1.svg') }}" alt="" ></span>
        <span class="close_info" ><i class="far fa-times"></i></span>
    </div>
    <div class="innersidebar_cont">
        <ul>
            <li>
                <a href="{{ route('admin.settings') }}">
                    <span><img src="{{ asset('admin/images/adminsetup.svg') }}" alt="" ></span>
                    <em>Admin Settings</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.configuration') }}">
                    <span><img src="{{ asset('admin/images/admin_configuration.svg') }}" alt="" ></span>
                    <em>Admin Configuration</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
        </ul>
    </div>
</div>