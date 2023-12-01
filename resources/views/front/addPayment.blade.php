<x-guest-layout>
    @section('title', $data['title'] . ' |')
    @section('style', ';--sub_btn-bg: '.$button->value. ';--sub_btnhover-bg:' .$primary_button_color_hover->value)

    @include('header')
    <section class="maincontent_wrap innermain_content payment_content">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container fullWidth">
                <div class="row">
                    @if(Session::has('message'))
                    <div class="alert alert-danger">
                        {{Session::get('message')}}
                    </div>
                        @endif
                    <div class="col-md-12">
                       
                        <div class="fromdes_info user_contentblock">

                                @include('layouts.sidebar')                          

                            <div class="from_cont_wrap">
                                <form method="POST" name="myform" action="{{ route('paymentaddSave') }}"
                                    onsubmit="return validfunc()">
                                    @csrf
                                    <div class="fromdes_info">
                                        <div class="from_cont_wrap">
                                            <div class="content_block paymentinfo">
                                                <h2 class="head_opt">{{ __('paymentForm.payment_details') }}</h2>
                                            </div>
                                            <div class="summary_content">



                                                <div class="content_block more_cont_view">
                                                    <h2>{{ __('paymentForm.method_of_payment') }}</h2>
                                                    <div class="checkout_optview payment_opt_details payment_opt2">
                                                        <div class="inp_row">
                                                            <div class="form-group">

                                                                <div class="memberships_nam radio">
                                                                    <input type="radio" id="payment_opt1"
                                                                        name="radio_group_pay" class="radio1"
                                                                        value="credit_acc" onclick="showA();" {{old('radio_group_pay') == 'credit_acc' ? 'checked' : '' }}>
                                                                    <label for="payment_opt1">{{ __('paymentForm.Credit_Card') }}</label>
                                                                </div>

                                                                
                                                                
                                                                <div class="memberships_nam radio">
                                                                    <input type="radio" id="payment_opt3"
                                                                        name="radio_group_pay" onclick="show();"
                                                                        value="bank_acc"  {{old('radio_group_pay') == 'credit_acc' ? '' : 'checked' }}>
                                                                    <label for="payment_opt3">{{ __('paymentForm.Bank_Account') }}</label>
                                                                </div>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="from_contentblock">

                                                <div id="bank_details">
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                           
                                                            <div class="card_add">
                                                                <img src="{{asset('public/images/voided.png')}}" alt="" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Transit_Number') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt" id="incdec">

                                                                <input type="text" name="transit_number" oninput="onlynumshow(event)" maxlength="5"
                                                                    class="form-control" placeholder=""
                                                                    value="{{ old('transit_number') }}">

                                                            </div>
                                                        </div>
                                                        @error('transit_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>

                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Branch_Number') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="institution" oninput="onlynumshow(event)" maxlength="3"
                                                                    class="form-control" placeholder="" value="{{ old('institution') }}">
                                                            </div>
                                                        </div>
                                                        @error('institution')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Account_Number') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="account_number" oninput="onlynumshow(event)" maxlength="12"
                                                                    class="form-control" placeholder="" value="{{ old('account_number') }}">
                                                            </div>
                                                        </div>
                                                        @error('account_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>

                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Account_Name_Holder') }} <em
                                                                    class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="owner_names"
                                                                    class="form-control" placeholder="" oninput="onlyletterhow(event)" value="{{ old('owner_names') }}">
                                                            </div>
                                                        </div>
                                                        @error('owner_names')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>

                                                <div id="credit_details">
                                                    <div class="selectcont ">

                                                        <div class="arrowdown2">
                                                            <i class="far fa-chevron-down"></i>
                                                        </div>
                                                        <select class="select_opt" name="type_id">
                                                            @foreach ($data['card_types'] as $cardtype)
                                                                <option value="{{ $cardtype->id }}">
                                                                    {{ $cardtype->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div><br>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Account_Name_Holder') }} <em
                                                                    class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="owner_name"
                                                                    class="form-control" oninput="onlyletterhow(event)" placeholder="" value="{{ old('owner_name') }}">
                                                            </div>
                                                        </div>
                                                        @error('owner_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.PAN') }} <em
                                                                    class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="pan" oninput="onlynumshow(event)" maxlength="16"
                                                                    class="form-control" placeholder="" value="{{ old('pan') }}">
                                                            </div>
                                                        </div>
                                                        @error('pan')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.CSV') }} <em
                                                                class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt" id="incdec">

                                                                <input type="text" name="four_digits_number" oninput="onlynumshow(event)" maxlength="4"
                                                                    class="form-control" placeholder=""
                                                                    value="{{ old('four_digits_number') }}">

                                                            </div>
                                                        </div>
                                                        @error('four_digits_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>

                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Expiry_Month') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="expiry_month" min="1" max="12" oninput="onlynumshow(event)" maxlength="2"
                                                                    class="form-control" placeholder=""  value="{{ old('expiry_month') }}">
                                                            </div>
                                                        </div>
                                                        @error('expiry_month')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Expiry_Year') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="expiry_year" max="9999" min="2023" oninput="onlynumshow(event)" maxlength="4"
                                                                    class="form-control" placeholder="" value="{{ old('expiry_year') }}">
                                                            </div>
                                                        </div>
                                                        @error('expiry_year')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>                                     

                                            <div class="frombtn_wrap">
                                                <div class="def_btnopt2 frombtn">
                                                    <button type="submit" value="submit" class="btn2"
                                                        id="myButton">{{ __('paymentForm.submit') }}</button>
                                                    <button type="button" class="btn2 backbutton" onclick="history.back()">{{ __('paymentForm.back') }}</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>


                    </div>
                </div>
            </div>

        </div>
        <div class="round_opt_btn rount_opt1">
            <img src="images/roundopt2.jpg" alt="">
        </div>
        <div class="round_opt_btn rount_opt2">
            <img src="images/roundopt2.jpg" alt="">
        </div>
        <div class="round_opt_btn rount_opt3">
            <img src="images/roundopt2.jpg" alt="">
        </div>
    </section>


    @include('footer')
    @push('scripts')
        <script>
            $("#credit_details").hide()
            var cred = "{{old('radio_group_pay')}}"
            if(cred == 'credit_acc'){
                showA();
            }
            else{
                show();
            }

            function show() {

                $("#credit_details").hide()
                $("#bank_details").show()
            }

            function showA() {

                $("#credit_details").show()
                $("#bank_details").hide()
            }
        </script>
    @endpush


    <script>
        function validfunc() {
            var valcheck = null;
            var ele = document.getElementsByName('radio_group_pay');
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked)
                    valcheck = ele[i].value;
            }
            if (valcheck == "bank_acc") {
                var transit_number = document.myform.transit_number.value;
                var institution = document.myform.institution.value;
                var account_number = document.myform.account_number.value;
                var owner_names = document.myform.owner_names.value;

                if (transit_number.length != 5) {
                    alert(trans('paymentForm.Transit_number_5_characters'));
                    return false;
                }
                if (institution.length != 6) {
                    alert(trans('paymentForm.Branchcode_mustbe_6_characters'));
                    return false;
                }
                // if (account_number.length < 13) {
                //     alert(trans('paymentForm.Account_number_mustbe_12_characters'));
                //     return false;
                // }
                if (owner_names == "") {
                    alert(trans('paymentForm.Account_name_blank'));
                    return false;
                }
            }

            if (valcheck == "credit_acc") {
                var owner_name = document.myform.owner_name.value;
                var token = document.myform.token.value;
                var expiry_month = document.myform.expiry_month.value;
                var expiry_year = document.myform.expiry_year.value;
                var four_digits_number = document.myform.four_digits_number.value;
                var pan = document.myform.pan.value;

                if (owner_name == "") {
                    alert(trans('paymentForm.Name_blank'));
                    return false;
                }

                if (four_digits_number.length != 16) {
                    alert(trans('paymentForm.Card_number_mustbe_16_characters'));
                    return false;
                }
                if (expiry_month.value <=12) {
                    alert(trans('paymentForm.Expiry_month'));
                    return false;
                }
                if (expiry_year.length != 4) {
                    alert(trans('paymentForm.Expiry_year'));
                    return false;
                }
            }
        }

function onlynumshow(event){

                let inputvalue = event.target.value;
                inputvalue = inputvalue.replace(/\D/g, ''); // Remove non-numeric characters

                event.target.value = inputvalue;
}
function onlyletterhow(event){

let inputvalue = event.target.value;
inputvalue = inputvalue.replace(/[^a-z A-Z\\.]+/g, ''); // Remove non-numeric characters

event.target.value = inputvalue;
}
    </script>


</x-guest-layout>
