<div class="left_sidebar">
    <div class="mob_user_icon">
        <span class="accountinfo" ><img src="{{ asset('public/images/icon1.svg') }}" alt="" ></span>
        <span class="close_info" ><i class="far fa-times"></i></span>
    </div>
    <div class="innersidebar_cont">
        <ul>
            <li>
                <a href="{{ route('account') }}">
                    <span><img src="{{ asset('public/images/icon1.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.My_Account') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li >
                <a href="{{ route('myProfile') }}">
                    <span><img src="{{ asset('public/images/icon2.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.My_Profile') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li>
                <a href="{{ route('myContactInformation') }}">
                    <span><img src="{{ asset('public/images/icon3.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.My_Contact_Information') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li >
                <a href="{{ route('myBankCards') }}">
                    <span><img src="{{ asset('public/images/icon4.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.My_Credit_Card_Bank_Account') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li >
                <a href="{{ route('payMyOutstandingBalance') }}">
                    <span><img src="{{ asset('public/images/icon4.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.Pay_Balance') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li>
                <a href="{{ route('newMembership') }}">
                    <span><img src="{{ asset('public/images/icon5.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.New_Membership') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                    
                </a>
            </li>
            <li>
                <a href="{{ route('upgradeMembership') }}">
                    <span><img src="{{ asset('public/images/icon5.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.Upgrade_Membership') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li>
                <a href="{{ route('changePassword') }}">
                    <span><img src="{{ asset('public/images/icon6.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.Change_Password') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li>
                <a href="{{ route('changeLanguage') }}">
                    <span><img src="{{ asset('public/images/icon7.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.Change_Language') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
            <li >
                <a href="{{ route('referralCode') }}">
                    <span><img src="{{ asset('public/images/referral_code.svg') }}" alt="" ></span>
                    <em>{{ __('sidebar.My_Referral_Code') }}</em>
                    <strong class="arroright_opt"><i class="far fa-long-arrow-right"></i></strong>
                </a>
            </li>
        </ul>
    </div>
</div>