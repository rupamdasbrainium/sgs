<x-app-layout>
    @php
        $lang_id = getLocale();
    @endphp
    @section('title', $data['title'] . ' |')
    @section('style', ';--sub_btn-bg: ' . $button->value . ';--sub_btnhover-bg:' . $primary_button_color_hover->value)
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">
                <div class="content_block accountinfo">
                    <div class="d-flex d-inline justify-content-between">
                        <h2>{{ __('mycontactinformatiion.My_Contact_Information') }}</h2>
                        <div>
                            <a href="{{ route('changemail_view') }}" class="btn2">{{ __('mycontactinformatiion.email_change') }}</a>
                        </div>
                    </div>
                    <div class="fromdes_view">
                        <div class="titleopt2">
                            <h3>{{ __('mycontactinformatiion.Change_Of_Informations') }}</h3>
                        </div>
                        <form action="{{ route('user.update') }}" method="POST">
                            @csrf
                            <div class="fromdes_info user_contentblock">
                                <div class="from_cont_wrap">
                                    <div class="inp_row gapadj inp_colm2">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt nobg">
                                                <input type="text" class="form-control" name="firstname" readonly
                                                    placeholder="Nancy" value="{{ $client->firstname }}" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt nobg">
                                                <input type="text" class="form-control" readonly name="lastname"
                                                    placeholder="Boudreault" value="{{ $client->lastname }}"
                                                    maxlength="100">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt nobg">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="nancy@isma.ca *" value="{{ $client->email }}"
                                                    maxlength="260">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm3">

                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt adbg">
                                                <input type="text" class="form-control" name="civic_number"
                                                    placeholder="{{ __('suscription.sn') }} *"
                                                    value="{{ $client->adress->civic_number }}"
                                                    oninput="onlynumshow(event)">
                                                    @if ($errors->has('civic_number'))
                                                    <div class="text-danger">{{ $errors->first('civic_number') }}
                                                    </div>
                                                @endif
                                            </div>
                                           
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt adbg">
                                                <input type="text" class="form-control" name="street"
                                                    placeholder="{{ __('suscription.street') }} *"
                                                    value="{{ $client->adress->street }}" maxlength="50">
                                                    @if ($errors->has('street'))
                                                    <div class="text-danger">{{ $errors->first('street') }}</div>
                                                @endif
                                            </div>
                                          
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt adbg">
                                                <input type="text" class="form-control" name="appartment"
                                                    placeholder="{{ __('suscription.app') }}"
                                                    value="{{ $client->adress->appartment }}">
                                                    @if ($errors->has('appartment'))
                                                    <div class="text-danger">{{ $errors->first('appartment') }}</div>
                                                @endif
                                            </div>
                                          
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm3">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt adbg">
                                                <input type="text" class="form-control" name="city"
                                                    placeholder="{{ __('suscription.city') }} *"
                                                    value="{{ $client->adress->city }}" maxlength="50">
                                                    @if ($errors->has('city'))
                                                    <div class="text-danger">{{ $errors->first('city') }}</div>
                                                @endif
                                            </div>
                                          
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt adbg">
                                                <input type="text" class="form-control" name="postal_code"
                                                    id="postal_code" placeholder="{{ __('suscription.pin') }} *"
                                                    value="{{ $client->adress->postal_code }}">
                                                <p>{{ __('mycontactinformatiion.Example') }}: j3B 8k7</p>
                                                @if ($errors->has('postal_code'))
                                                <div class="text-danger">{{ $errors->first('postal_code') }}</div>
                                            @endif
                                            </div>
                                           
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <div class="inp_cont_view noicon_opt adbg def-select2">
                                                    <div class="selectcont ">
                                                        <div class="arrowdown2">
                                                            <i class="fal fa-chevron-down"></i>
                                                        </div>
                                                        <select class="select_opt" name="province_id">
                                                            @foreach ($province as $pr)
                                                                <option value="{{ $pr->id }}"
                                                                    {{ $pr->id == $client->adress->province_id ? 'selected' : '' }}>
                                                                    {{ $lang_id == 2 ? $pr->display_english : $pr->display_french }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($errors->has('province_id'))
                                                <div class="text-danger mt-3">{{ $errors->first('province_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm2">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt adbg">
                                                <input type="text" class="form-control" name="phone"
                                                    id="phone" placeholder="{{ __('suscription.ph') }} *"
                                                    value="{{ $client->phone }}">
                                                <p>{{ __('mycontactinformatiion.Example') }}: xxx xxx-xxxx</p>
                                                @if ($errors->has('phone'))
                                                <div class="text-danger">{{ $errors->first('phone') }}</div>
                                            @endif
                                            </div>
                                          
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt adbg">
                                                <input type="text" class="form-control" name="cellphone"
                                                    id="cellphone"
                                                    placeholder="{{ __('suscription.secondary_phone_number') }} *"
                                                    value="{{ $client->cellphone }}">
                                                <p>{{ __('mycontactinformatiion.Example') }}: xxx xxx-xxxx</p>
                                                @if ($errors->has('cellphone'))
                                                    <div class="text-danger">{{ $errors->first('cellphone') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm2">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" class="form-control" name="emergency_phone"
                                                    id="emergency_phone"
                                                    placeholder="{{ __('suscription.emergency_ph') }} *"
                                                    value="{{ $client->emergency_phone }}">
                                                <p>{{ __('mycontactinformatiion.Example') }}: xxx xxx-xxxx</p>
                                                @if ($errors->has('emergency_phone'))
                                                <div class="text-danger">{{ $errors->first('emergency_phone') }}
                                                </div>
                                            @endif
                                            </div>
                                          
                                        </div>
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">

                                                <input type="text" readonly name="date_of_birth"
                                                    value="{{ date('d/m/Y', strtotime($client->date_of_birth)) }}"
                                                    id="" class="form-control" placeholder="Date of birth *"
                                                    required>
                                                    <p>{{ __('suscription.Birthday') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inp_row gapadj inp_colm2">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <div class="inp_cont_view noicon_opt adbg def-select2">
                                                    <div class="selectcont ">
                                                        <div class="arrowdown2">
                                                            <i class="far fa-chevron-down"></i>
                                                        </div>
                                                        <select class="select_opt" name="is_male">
                                                            <option value="1"
                                                                {{ $client->is_male ? 'selected' : '' }}>
                                                                {{ __('mycontactinformatiion.Male') }}</option>
                                                            <option value="0"
                                                                {{ $client->is_male ? '' : 'selected' }}>
                                                                {{ __('mycontactinformatiion.Female') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="franchise_name"
                                                value="{{ $client->franchise_name }}">
                                        </div>
                                    </div>
                                    <div class="titleopt2">
                                        <h3>{{ __('suscription.emergency_contact') }}</h3>
                                    </div>
                                    <div class="inp_row gapadj inp_colm2">
                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" class="form-control" name="emergency_contact"
                                                    placeholder="{{ __('suscription.emergency_contact') }}"
                                                    value="{{ $client->emergency_contact }}" maxlength="50">
                                                    @if ($errors->has('emergency_contact'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('emergency_contact') }}
                                                    </div>
                                                @endif
                                            </div>
                                          
                                        </div>
                                    </div>
                                    <div class="frombtn_wrap">
                                        <div class="def_btnopt2 frombtn frombtn2">
                                            <button type="submit"
                                                class="btn2">{{ __('mycontactinformatiion.Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
        const postal_codeInput = document.getElementById('postal_code');
        postal_codeInput.addEventListener('input', function(event) {
            let inputValue = event.target.value;
            inputValue = inputValue.replace(/[^a-zA-Z0-9]/g, ''); // Remove non-alphanumeric characters
            console.log(inputValue);
            inputValue = inputValue.slice(0, 6); // Limit input to maximum 6 characters
            inputValue = inputValue.replace(/(\w{3})(?=\w)/g,
                '$1 '); // Add space after every 3 non-alphanumeric characters
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

        function onlynumshow(event) {
            let inputvalue = event.target.value;
            inputvalue = inputvalue.replace(/\D/g, ''); // Remove non-numeric characters
            event.target.value = inputvalue;
        }
    </script>
    @include('footer')
</x-app-layout>
