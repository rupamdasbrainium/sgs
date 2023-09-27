<x-guest-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap innermain_content payment_content">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       
                        <div class="fromdes_info user_contentblock">
                            <div class="sidebar_content">
                           
                            </div>
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
                                                                        value="credit_acc" onclick="showA();">
                                                                    <label for="payment_opt1">{{ __('paymentForm.Credit_Card') }}</label>
                                                                </div>

                                                                <div class="memberships_nam radio">
                                                                    <input type="radio" id="payment_opt2"
                                                                        name="radio_group_pay" class="radio2"
                                                                        value="credit_acc" onclick="showA();">
                                                                    <label for="payment_opt2">{{ __('paymentForm.Debit_Card') }}</label>
                                                                </div>

                                                                <div class="memberships_nam radio">
                                                                    <input type="radio" id="payment_opt3"
                                                                        name="radio_group_pay" onclick="show();"
                                                                        value="bank_acc" checked>
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
                                                            <label>{{ __('paymentForm.Direct_Debit') }}</label>
                                                            <div class="card_add">
                                                                {{-- <input name="payCard" value="payCard"
                                                                    type="hidden" /> --}}
                                                                <img src="images/voided.png" alt="" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Transit_Number') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt" id="incdec">

                                                                <input type="text" name="transit_number"
                                                                    class="form-control" placeholder=""
                                                                    value="">
                                                                {{-- <i class="fas fa-sort-up" id="up"></i>
                                                                <i class="fas fa-sort-down" id="down"></i> --}}

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Branch_Number') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="institution"
                                                                    class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Account_Number') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="account_number"
                                                                    class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Account_Name_Holder') }} <em
                                                                    class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="owner_names"
                                                                    class="form-control" placeholder="bank">
                                                            </div>
                                                        </div>
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
                                                                    class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.credit_card_number') }} <em
                                                                    class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt" id="incdec">

                                                                <input type="text" name="token"
                                                                    class="form-control" placeholder=""
                                                                    value="">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Expiry_Month') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="expiry_month"
                                                                    class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Expiry_Year') }} <em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="expiry_year"
                                                                    class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.CVV') }}<em class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="four_digits_number"
                                                                    class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                      

                                            <div class="frombtn_wrap">
                                                <div class="def_btnopt2 frombtn">
                                                    <button type="submit" value="submit" class="btn2"
                                                        id="myButton">{{ __('paymentForm.submit') }}!</button>
                                                    <button type="button" class="btn2 backbutton">{{ __('paymentForm.back') }}</button>
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
                    alert("Transit number must be at least 5 characters long");
                    return false;
                }
                if (institution.length != 6) {
                    alert("Branchcode must be at least 6 characters long.");
                    return false;
                }
                if (account_number.length != 16) {
                    alert("Account number must be at least 16 characters long.");
                    return false;
                }
                if (owner_names == "") {
                    alert("Account name can't be blank.");
                    return false;
                }
            }

            if (valcheck == "credit_acc") {
                var owner_name = document.myform.owner_name.value;
                var token = document.myform.token.value;
                var expiry_month = document.myform.expiry_month.value;
                var expiry_year = document.myform.expiry_year.value;
                var four_digits_number = document.myform.four_digits_number.value;


                if (owner_name == "") {
                    alert("Name can't be blank");
                    return false;
                }
                if (token.length != 16) {
                    alert("Card number must be at least 16 characters long.");
                    return false;
                }
                if (expiry_month.length != 2) {
                    alert("Expiry month must be at least 2 characters long.");
                    return false;
                }
                if (expiry_year.length != 4) {
                    alert("Expiry year must be at least 4 characters long.");
                    return false;
                }
                if (four_digits_number.length != 3) {
                    alert("CVV must be at least 3 characters long.");
                    return false;
                }
            }
        }
    </script>


</x-guest-layout>
