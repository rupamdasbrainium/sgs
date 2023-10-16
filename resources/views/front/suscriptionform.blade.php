<x-guest-layout>
    @php
        $lang_id = getLocale();
    @endphp
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap innermain_content user_information">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container">
                <div class="row">
                    {{-- @dump(Session::get('message')); --}}
                    <div class="col-md-12">
                        @if (Session::has('message'))
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    {{ Session::get('message') }}
                                    {{-- <ul> --}}
                                    {{-- @foreach ($error as $error) --}}
                                    {{-- <li>{{ $error->message }}</li> --}}
                                    {{-- @endforeach --}}
                                    {{-- </ul> --}}
                                </div>
                            </div>
                        @endif
                        <div class="welcomesec_info inner_heading">
                            <div class="round_opt_btn3 modfround1">
                                <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
                            </div>
                            <h2>{{ __('suscription.info') }}</h2>
                            <p>{{ __('suscription.contact_info') }}</p>
                        </div>
                        <div class="fromdes_info user_contentblock">
                            <div class="sidebar_content">
                                <div class="sidebar_info">
                                    <p>{{ __('suscription.center') }}: <span>{{ $data['franchise']->name }}</span></p>
                                    <p>{{ __('suscription.address') }}:
                                        <span>{{ $data['franchise']->address_civic_number }}
                                            {{ $data['franchise']->address_street }}
                                            {{ $data['franchise']->address_city }}
                                            {{ $data['franchise']->address_postal_code }}</span>
                                    </p>
                                    <p>{{ __('suscription.package') }}: <span>
                                            @if (isset($data['subscription_plan']) && isset($data['subscription_plan']->data))
                                                {{ $data['subscription_plan']->data->name }}
                                            @endif
                                        </span></p>
                                </div>
                            </div>
                            <div class="from_cont_wrap">
                                <form method="post"
                                    action="{{ route('suscriptionformSave', ['id' => $data['subscription_plan']->data->id]) }}">
                                    {{-- <form method="post" action="{{ route('suscriptionformSave',['id'=>18]) }}" > --}}
                                    @csrf
                                    <input type="hidden" name="franchise_id" value="{{ $data['franchise']->id }}">
                                    <div class="inp_row gapadj inp_colm2">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="firstname" value="{{ old('firstname') }}"
                                                    class="form-control" placeholder="{{ __('suscription.fn') }} *"
                                                    required>
                                            </div>
                                            @error('firstname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="lastname" value="{{ old('lastname') }}"
                                                    class="form-control" placeholder="{{ __('suscription.ln') }} *"
                                                    required>
                                            </div>
                                            @error('lastname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm3">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="number" name="address_civic_number" id="autocomplete" autocomplete="address_civic_number"
                                                    value="{{ old('address_civic_number') }}" class="form-control"
                                                    placeholder="{{ __('suscription.sn') }} *" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="address_street" id="latitude" autocomplete="address_street"
                                                    value="{{ old('address_street') }}" class="form-control"
                                                    placeholder="{{ __('suscription.street') }} *" required>
                                            </div>
                                            @error('address_street')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="address_appartment" id="longitude" autocomplete="address_appartment"
                                                    value="{{ old('address_appartment') }}" class="form-control"
                                                    placeholder="{{ __('suscription.app') }} ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm3">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="address_city"
                                                    value="{{ old('address_city') }}" class="form-control" autocomplete="address_city"
                                                    placeholder="{{ __('suscription.city') }} *" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="address_postal_code" id="address_postal_code"
                                                    value="{{ old('address_postal_code') }}" class="form-control"
                                                    placeholder="{{ __('suscription.pin') }} *" required>
                                                <p>{{ __('suscription.example') }}: j3B 8k7</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <!-- <input type="text" class="form-control" placeholder="AB  " > -->
                                                <div class="selectcont ">
                                                    <div class="arrowdown2">
                                                        <i class="far fa-chevron-down"></i>
                                                    </div>
                                                    <select class="select_opt" name="address_province_id">
                                                        @if (isset($data['provinces']))
                                                            @foreach ($data['provinces'] as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->id == old('address_province_id') ? 'selected' : '' }}>
                                                                    {{ $lang_id == 2 ? $item->display_english : $item->display_french }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                        {{-- <option value="AB" >AB</option>
												<option value="AB"  >AB</option>
												<option value="AB"  >AB</option> --}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm2">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" value="{{ old('phone') }}" name="phone"
                                                    id="phone" class="form-control"
                                                    placeholder="{{ __('suscription.ph') }} *" required>
                                                <p>{{ __('suscription.example') }}: xxx xxx-xxxx</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="cellphone" value="{{ old('cellphone') }}"
                                                    class="form-control" placeholder="{{ __('suscription.cell') }} *"
                                                    required>
                                                <p>{{ __('suscription.example') }}: xxx xxx-xxxx</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="emergency_contact"
                                                    value="{{ old('emergency_contact') }}" class="form-control"
                                                    placeholder="{{ __('suscription.emergency_contact_name') }}*"
                                                    required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm3">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" value="{{ old('emergency_phone') }}"
                                                    name="emergency_phone" id="emergency_phone" class="form-control"
                                                    placeholder="{{ __('suscription.emergency_ph') }} *" required>
                                                <p>{{ __('suscription.example') }}: xxx xxx-xxxx</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="date" name="date_of_birth"
                                                    value="{{ old('date_of_birth') }}" id="datepicker"
                                                    class="form-control" placeholder="{{ __('suscription.dob') }} *"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <!-- <input type="text" class="form-control" placeholder="Man " > -->
                                                <div class="selectcont ">
                                                    <div class="arrowdown2">
                                                        <i class="far fa-chevron-down"></i>
                                                    </div>
                                                    <select class="select_opt" name="is_male">
                                                        <option value="1"
                                                            {{ $item->id = old('is_male') == 1 ? 'selected' : '' }}>
                                                            {{ __('suscription.male') }}</option>
                                                        <option value="0"
                                                            {{ $item->id = old('is_male') == 0 ? 'selected' : '' }}>
                                                            {{ __('suscription.female') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm2">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                    class="form-control"
                                                    placeholder="{{ __('suscription.email') }} *" required>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="email" class="form-control" name="email_confirmation"
                                                    placeholder="{{ __('suscription.email_con') }} *" required>
                                            </div>
                                            @error('email_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm2">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt noicon_opt2">
                                                <div class="icon_opt">
                                                    <i class="fal fa-eye" id="togglePassword"
                                                        style="cursor: pointer;"></i>
                                                </div>
                                                <input class="form-control" type="password" name="password"
                                                    value="{{ old('password') }}"
                                                    placeholder="{{ __('suscription.password') }} *"
                                                    autocomplete="current-password" required="" id="id_password"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view  noicon_opt noicon_opt2">
                                                <div class="icon_opt">
                                                    <i class="fal fa-eye" id="togglePassword2"
                                                        style="cursor: pointer;"></i>
                                                </div>
                                                <input class="form-control" type="password" name="confirm-password"
                                                    placeholder="{{ __('suscription.password_con') }} *"
                                                    autocomplete="current-password" required="" id="id_password2"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inp_row  ">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input class="form-control" name="user_name"
                                                    value="{{ old('user_name') }}" type="text"
                                                    placeholder="{{ __('suscription.user_name') }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="inp_row  ">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input class="form-control" name="reference_Code"
                                                    value="{{ old('reference_Code') }}" type="text"
                                                    placeholder="{{ __('suscription.rc') }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="more_cont_view">
                                        <!-- <h4>Membership Options/ Add-ons</h4>
        <div class="checkout_optview">
          <div class="inp_row checkoutmore_info">
            <div class="form-group">
              <div class="checkbox">
                <input class="styled-checkbox" id="Option1" type="checkbox" value="value1">
                <label for="Option1">Option1</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <input class="styled-checkbox" id="Option2" type="checkbox" value="value2">
                <label for="Option2">Option2</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <input class="styled-checkbox" id="Option3" type="checkbox" value="value3">
                <label for="Option3">Option3</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <input class="styled-checkbox" id="Option4" type="checkbox" value="value4">
                <label for="Option4">Option4</label>
              </div>
            </div>
            
          </div>
        </div> -->
                                        <div class="payment_opt_view">
                                            <!-- <div class="payment_block">
           <h4>Method of Payment</h4>
           <div class="payment_contentblock">
             <div class="radio">
               <input type="radio" id="test1" name="radio-group">
               <label for="test1">Credit Card</label>
             </div>
             
             <div class="radio">
               <input type="radio" id="test2" name="radio-group">
               <label for="test2">Direct Debit</label>
             </div>
             <div class="radio">
               <input type="radio" id="test3" name="radio-group">
               <label for="test3">Prepaid Account</label>
             </div>
           </div>
         </div> -->
                                            <div class="payment_block">
                                                <h4>{{ __('suscription.nop') }} *</h4>
                                                <div class="payment_contentblock">
                                                    {{-- @dump($data['subscription_plan']); --}}
                                                    @if (isset($data['subscription_plan']) &&
                                                            isset($data['subscription_plan']->data) &&
                                                            count($data['subscription_plan']->data->prices_per_durations))
                                                        @foreach ($data['subscription_plan']->data->prices_per_durations as $item)
                                                            @if (count($item->installments))
                                                                @foreach ($item->installments as $val)
                                                                    {{-- @dump( $item->duration_id,$val->id); --}}
                                                                    <div class="radio">
                                                                        <input type="radio"
                                                                            id="{{ $val->id }}"
                                                                            name="installments"
                                                                            value="{{ $item->duration_id }}|{{ $val->id }}"
                                                                            {{ $loop->index == 0 ? 'required' : '' }}>
                                                                        <label
                                                                            for="{{ $val->id }}">{{ $val->number_of_payments }}
                                                                            {{ __('suscription.payments') }}</label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    {{-- <div class="radio">
												<input type="radio" id="testnum2" name="radio-group">
												<label for="testnum2">26 Payments</label>
											</div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="inp_row">
                                        <div class="form-group">
                                            <label>{{ __('suscription.hear_about_us') }}? *</label>
                                            <div class="inp_cont_view noicon_opt">
                                                <!-- <input type="email" class="form-control" placeholder="Please choose..." > -->
                                                <div class="selectcont ">
                                                    <div class="arrowdown2">
                                                        <i class="far fa-chevron-down"></i>
                                                    </div>
                                                    <select class="select_opt" name="reference_id">
                                                        <option value="" selected>
                                                            {{ __('suscription.please_choose') }}...</option>
                                                        @if (isset($data['opts_references']) && isset($data['opts_references']->data))
                                                            @foreach ($data['opts_references']->data as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->id == old('reference_id') ? 'selected' : '' }}>
                                                                    {{ $item->display }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frombtn_wrap">
                                        <div class="def_btnopt2 frombtn frombtn2">
                                            <button type="submit" class="btn2"
                                                style="background-color: {{ $button->value }}">{{ __('suscription.save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="round_opt_btn rount_opt2">
            <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
        </div>
        <div class="round_opt_btn rount_opt3">
            <img src="{{ asset('public/images/roundopt2.jpg') }}" alt="">
        </div>
    </section>
    @include('footer')
    @push('scripts')
        <script>
            $(function() {
                $('#datepicker').datepicker();
            });
        </script>
        <script>
            var string = ;
            var phone = [string.slice(0, 3), " ", string.slice(3, 7), " ", string.slice(7)].join('');
        </script>
        <script>
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function(event) {
                let inputValue = event.target.value;
                inputValue = inputValue.replace(/\D/g, ''); // Remove non-numeric characters
                if (inputValue.length > 0) {
                    inputValue = inputValue.match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                    inputValue = !inputValue[2] ? inputValue[1] : inputValue[1] + '-' + inputValue[2] + (inputValue[3] ?
                        '-' + inputValue[3] : '');
                }
                event.target.value = inputValue;
            });

			const emergency_phoneInput = document.getElementById('emergency_phone');
            emergency_phoneInput.addEventListener('input', function(event) {
                let inputValue = event.target.value;
                inputValue = inputValue.replace(/\D/g, ''); // Remove non-numeric characters
                if (inputValue.length > 0) {
                    inputValue = inputValue.match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                    inputValue = !inputValue[2] ? inputValue[1] : inputValue[1] + '-' + inputValue[2] + (inputValue[3] ?
                        '-' + inputValue[3] : '');
                }
                event.target.value = inputValue;
            });

			const address_postal_codeInput = document.getElementById('address_postal_code');
            address_postal_codeInput.addEventListener('input', function(event) {
                let inputValue = event.target.value;
                inputValue = inputValue.replace(/\D/g, ''); // Remove non-numeric characters
                if (inputValue.length > 0) {
                    inputValue = inputValue.match(/(\d{0,3})(\d{0,3})/);
                    inputValue = !inputValue[2] ? inputValue[1] : inputValue[1] + ' ' + inputValue[2] + (inputValue[3] ?
                        '-' + inputValue[3] : '');
                }
                event.target.value = inputValue;
            });
        </script>

        {{-- googleaddress --}}
          {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
          <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&libraries=places"></script>
          <script>
              $(document).ready(function () {
                  $("#latitudeArea").addClass("d-none");
                  $("#longtitudeArea").addClass("d-none");
              });
          </script>
          <script>
              google.maps.event.addDomListener(window, 'load', initialize);
        
              function initialize() {
                  var input = document.getElementById('autocomplete');
                  var autocomplete = new google.maps.places.Autocomplete(input);
        
                  autocomplete.addListener('place_changed', function () {
                      var place = autocomplete.getPlace();
                      $('#latitude').val(place.geometry['location'].lat());
                      $('#longitude').val(place.geometry['location'].lng());
        
                      $("#latitudeArea").removeClass("d-none");
                      $("#longtitudeArea").removeClass("d-none");
                  });
              }
          </script> --}}
    @endpush
</x-guest-layout>
