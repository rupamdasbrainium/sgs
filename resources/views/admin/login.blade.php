@section('title', 'Admin Login |')
<x-admin-guest-layout>
<section class="maincontent_wrap innermain_content">
  <div class="welcomesection def_padding inner_content_block">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="welcomesec_info inner_heading">
            <div class="heading_info sublogo ">
              <img  src="{{ asset('public/admin/images/logo.svg') }}" alt="">
            </div>
          </div>
          <div class="fromdes_wrap_view">
            <div class="welcomesec_info inner_heading">
              <h2>Login</h2>
              <p>Input your details and password to get started</p>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('admin.adminlogin') }}">
              @csrf
              <div class="fromdes_info">
                <div class="from_cont_wrap">
                  <div class="inp_row">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <div class="inp_cont_view">
                        <div class="icon_opt">
                          <i class="fal fa-envelope"></i>
                        </div>
                        <input type="email" class="form-control" name="email" id="email" placeholder="jhon.deo@gmail.com" value="{{old('email')}}" required>
                        @if ($errors->has('email'))
                        <div class="text-danger mt-3">{{ $errors->first('email') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="inp_row">
                    <div class="form-group">
                      <label for="id_password">Password</label>
                      <div class="inp_cont_view">
                        <div class="icon_opt">
                          <i class="fal fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </div>
                        <input class="form-control" type="password" name="password" placeholder="**************" autocomplete="current-password" required id="id_password">
                        @if ($errors->has('password'))
                        <div class="text-danger mt-3">{{ $errors->first('password') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="inp_row capchacode_opt">
                    <div class="form-group">
                      <div class="inp_cont_view cap_inp_imf_add">
                        <div class="capcha_img">
                          <!-- <img src="{{ asset('public/admin/images/capcha_img1.png') }}" alt=""> -->
                          {!! captcha_img('flat') !!}
                        </div>
                        <div class="reset_capcha_opt">
                          <button type="button" class="reset_capcha" >
                          <img src="{{ asset('public/admin/images/cap_ref_btn.png') }}" alt="">
                          </button>
                        </div>
                      </div>
                      <div class="inp_cont_view cap_inp_block">
                        <input class="form-control inpopt2" type="text" name="captcha" placeholder="Enter the text in the image" id="captcha" required>   
                        @if ($errors->has('captcha'))
                        <div class="text-danger mt-3">Enter valid captcha</div>
                        @endif                     
                      </div>
                    </div>
                  </div>
                  
                  <div class="inp_row remember_opt">
                    <div class="form-group">
                      <div class="checkbox">
                        <!-- <label><input type="checkbox"> Remember me</label> -->
                        
                        <input class="styled-checkbox" id="styled-checkbox-2" name="remember" type="checkbox">
                        <label for="styled-checkbox-2">Remember me</label>
                      </div>
                      <div class="forgot_opt">
                        <a href="{{ route('admin.password.request') }}">Forgot Password?</a>
                      </div>
                    </div>
                  </div>
                  <div class="def_btnopt2 frombtn">
                    <button type="submit" class="btn2 fulldidthbtn" >Login</button>
                  </div>
                  
                </div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    
  </div>
  <div class="round_opt_btn">
    <img src="{{ asset('public/admin/images/roundopt2.jpg') }}" alt="">
  </div>
</section>
</x-admin-guest-layout>