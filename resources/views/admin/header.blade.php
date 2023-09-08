<header class="header_outer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header_info">
                    <div class="logoinfo ">
                        <a href="index.html" class="def_logo">
                            <img src="{{ asset('admin/images/logo.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="header_right_info">
                        <div class="mob_user_icon">
                            <span class="accountinfo" ><img src="{{ asset('admin/images/icon1.svg') }}" alt="" ></span>
                            <!-- <span class="accountinfo" ><i class="far fa-ellipsis-v"></i></span> -->
                            
                            <span class="close_info" ><i class="far fa-times"></i></span>
                        </div>
                        <div class="logout_info">
                            <div class="def_btnopt2 frombtn">
                                <a href="{{ route('admin.logout') }}" class="btn btn2 fulldidthbtn" >Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>