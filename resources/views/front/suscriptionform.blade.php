<x-guest-layout>
    @php
        $lang_id = getLocale();
    @endphp
    @section('title', $data['title'] . ' |')
    @section('style', ';--sub_btn-bg: ' . $button->value . ';--theme-bg:' . $theme->value . ';--sub_btnhover-bg:' .
        $primary_button_color_hover->value)
        @include('header')
        <section class="maincontent_wrap innermain_content user_information">
            <div class="welcomesection def_padding inner_content_block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
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
                                        @csrf
                                        <input type="hidden" name="franchise_id" value="{{ $data['franchise']->id }}">
                                        <div class="inp_row gapadj inp_colm2">
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" name="firstname" id="firstname"
                                                        value="{{ old('firstname') }}" class="form-control"
                                                        placeholder="{{ __('suscription.fn') }} *" maxlength="50">
                                                        @error('firstname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                               
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" name="lastname" value="{{ old('lastname') }}"
                                                        class="form-control" placeholder="{{ __('suscription.ln') }} *"
                                                        maxlength="100">
                                                        @error('lastname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="inp_row gapadj inp_colm3">
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" name="address_civic_number"
                                                        id="address_civic_number" autocomplete="address_civic_number"
                                                        value="{{ old('address_civic_number') }}" class="form-control"
                                                        placeholder="{{ __('suscription.sn') }} *">
                                                        @error('address_civic_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                              
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" name="address_street" id="latitude"
                                                        autocomplete="address_street" value="{{ old('address_street') }}"
                                                        class="form-control" placeholder="{{ __('suscription.street') }} *"
                                                        maxlength="50">
                                                        @error('address_street')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                               
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" name="address_appartment" id="longitude"
                                                        autocomplete="address_appartment"
                                                        value="{{ old('address_appartment') }}" class="form-control"
                                                        placeholder="{{ __('suscription.app') }} ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inp_row gapadj inp_colm3">
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" name="address_city"
                                                        value="{{ old('address_city') }}" class="form-control"
                                                        autocomplete="address_city"
                                                        placeholder="{{ __('suscription.city') }} *" maxlength="50">
                                                        @error('address_city')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                               
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" name="address_postal_code" min="6"
                                                        id="address_postal_code" value="{{ old('address_postal_code') }}"
                                                        class="form-control" placeholder="{{ __('suscription.pin') }} *">
                                                    <p>{{ __('suscription.example') }}: j3B 8k7</p>
                                                    @error('address_postal_code')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                               
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <div class="selectcont ">
                                                        <div class="arrowdown2">
                                                            <i class="fal fa-chevron-down"></i>
                                                        </div>
                                                        <select class="select_opt" name="address_province_id">
                                                            @if (isset($data['provinces']))
                                                                @foreach ($data['provinces'] as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == old('address_province_id') ? 'selected' : '' }}>
                                                                        {{ $lang_id == 2 ? mb_strtoupper($item->display_english, 'UTF-8') : mb_strtoupper($item->display_french, 'UTF-8') }}

                                                                    </option>
                                                                @endforeach
                                                            @endif
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
                                                        placeholder="{{ __('suscription.ph') }} *">
                                                    <p>{{ __('suscription.example') }}: xxx xxx-xxxx</p>
                                                    @error('phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                               
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" name="cellphone" id="cellphone"
                                                        value="{{ old('cellphone') }}" class="form-control"
                                                        placeholder="{{ __('suscription.cell') }} *">
                                                    <p>{{ __('suscription.example') }}: xxx xxx-xxxx</p>
                                                    @error('cellphone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                              
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" name="emergency_contact"
                                                        value="{{ old('emergency_contact') }}" class="form-control"
                                                        placeholder="{{ __('suscription.emergency_contact_name') }}*"
                                                        maxlength="50">
                                                        @error('emergency_contact')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                             
                                            </div>
                                        </div>
                                        <div class="inp_row gapadj inp_colm3">
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="text" value="{{ old('emergency_phone') }}"
                                                        name="emergency_phone" id="emergency_phone" class="form-control"
                                                        placeholder="{{ __('suscription.emergency_ph') }} *">
                                                    <p>{{ __('suscription.example') }}: xxx xxx-xxxx</p>
                                                    @error('emergency_phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                              
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="date" name="date_of_birth"
                                                        value="{{ old('date_of_birth') }}" id="datepicker"
                                                        max="" class="form-control"
                                                        placeholder="{{ __('suscription.dob') }} *">
                                                        <p>{{ __('suscription.Birthday') }}</p>
                                                        @error('date_of_birth')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                              
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <div class="selectcont ">
                                                        <div class="arrowdown2">
                                                            <i class="fal fa-chevron-down"></i>
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
                                                        placeholder="{{ __('suscription.email') }} *" maxlength="260">
                                                        @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                               
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input type="email" class="form-control" name="email_confirmation" value="{{ old('email_confirmation') }}"
                                                        placeholder="{{ __('suscription.email_con') }} *">
                                                        @error('email_confirmation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                               
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
                                                        autocomplete="current-password" id="id_password" minlength="9"
                                                        maxlength="75">
                                                        @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                              
                                            </div>
                                            <div class="form-group">
                                                <div class="inp_cont_view  noicon_opt noicon_opt2">
                                                    <div class="icon_opt">
                                                        <i class="fal fa-eye" id="togglePassword2"
                                                            style="cursor: pointer;"></i>
                                                    </div>
                                                    <input class="form-control" type="password" name="confirm_password" value="{{ old('confirm_password') }}"
                                                        placeholder="{{ __('suscription.password_con') }} *"
                                                        autocomplete="current-password" id="id_password2">
                                                        @error('confirm_password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="inp_row  ">
                                            <div class="form-group">
                                                <div class="inp_cont_view noicon_opt">
                                                    <input class="form-control" name="user_name"
                                                        value="{{ old('user_name') }}" type="text"
                                                        placeholder="{{ __('suscription.user_name') }} *" maxlength="35">
                                                        @error('user_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
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
                                            <div class="payment_opt_view">
                                                <div class="payment_block">
                                                    <h4>{{ __('suscription.nop') }} *</h4>
                                                    <div class="payment_contentblock">
                                                        @if (isset($data['subscription_plan']) &&
                                                                isset($data['subscription_plan']->data) &&
                                                                count($data['subscription_plan']->data->prices_per_durations))
                                                            @foreach ($data['subscription_plan']->data->prices_per_durations as $item)
                                                                @if (count($item->installments))
                                                                    @foreach ($item->installments as $val)
                                                                        <div class="radio">
                                                                            <input type="radio"
                                                                                id="{{ $val->id }}"
                                                                                name="installments" 
                                                                                value="{{ $item->duration_id }}|{{ $val->id }}" checked
                                                                                {{ $loop->index == 0 ? '' : '' }}>
                                                                            <label
                                                                                for="{{ $val->id }}">{{ $val->number_of_payments }}
                                                                                {{ __('suscription.payments') }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @error('installments')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inp_row">
                                            <div class="form-group">
                                                <label>{{ __('suscription.hear_about_us') }}? *</label>
                                                <div class="inp_cont_view noicon_opt">
                                                    <div class="selectcont ">
                                                        <div class="arrowdown2">
                                                            <i class="fal fa-chevron-down"></i>
                                                        </div>
                                                        <select class="select_opt" name="reference_id">
                                                            <option value="" selected>
                                                                {{ __('suscription.please_choose') }}...</option>
                                                            @if (isset($data['opts_references']) && isset($data['opts_references']->data))
                                                                @foreach ($data['opts_references']->data as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == old('reference_id') ? 'selected' : '' }}>
                                                                        {{ ucfirst($item->display) }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    @error('reference_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="frombtn_wrap">
                                            <div class="def_btnopt2 frombtn frombtn2">
                                                <button type="submit"
                                                    class="btn2">{{ __('suscription.save') }}</button>
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
                const address_civic_numberInput = document.getElementById('address_civic_number');
                address_civic_numberInput.addEventListener('input', function(event) {
                    let inputvalue = event.target.value;
                    inputvalue = inputvalue.replace(/\D/g, ''); // Remove non-numeric characters
                    event.target.value = inputvalue;
                });
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
                const cellphoneInput = document.getElementById('cellphone');
                cellphoneInput.addEventListener('input', function(event) {
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
                    inputValue = inputValue.replace(/[^a-zA-Z0-9]/g, ''); // Remove non-alphanumeric characters
                    console.log(inputValue);
                    inputValue = inputValue.slice(0, 6); // Limit input to maximum 6 characters
                    inputValue = inputValue.replace(/(\w{3})(?=\w)/g,
                        '$1 '); // Add space after every 3 non-alphanumeric characters
                    event.target.value = inputValue;
                });
                var today = new Date().toISOString().split('T')[0];
                document.getElementById("datepicker").setAttribute("max", today);

                function validateNumericInput(input) {
                    input.value = input.value.replace(/[^a-zA-Z\\.]+/g, '');
                }
            </script>
        @endpush
    </x-guest-layout>
