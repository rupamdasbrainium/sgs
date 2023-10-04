<x-guest-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap innermain_content payment_content">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container">
                <div class="row">
                    @if(Session::has('message'))
                        <div class="alert alert-danger">
                            {{Session::get('message')}}
                        </div>
                            @endif

                        <div class="col-md-12">
                            <div class="welcomesec_info inner_heading">
                                <div class="round_opt_btn3 ">
                                    <img src="images/roundopt2.jpg" alt="">
                                </div>

                                <h2>{{ __('paymentForm.payment') }}</h2>
                            </div>
                            <div class="fromdes_info user_contentblock">
                                <div class="sidebar_content">
                                    <div class="sidebar_info">
                                        <p>{{ __('paymentForm.center') }}:
                                            {{-- @dd($data['membership_details']); --}}
                                            <span>{{ $data['membership_details']->data->franchise }}</span>
                                        </p>
                                        {{-- <p>Address: 
										<span>{{ $data['franchise']->address_civic_number}} {{ $data['franchise']->address_street}} {{ $data['franchise']->address_city }} {{ $data['franchise']->address_postal_code }}</span> --}}
                                        </p>
                                        <p>{{ __('paymentForm.package') }}: <span>
                                                {{-- @if (isset($data['subscription_plan']) && isset($data['subscription_plan']->data))
									{{ $data['subscription_plan']->data->name }}
									@endif --}}
                                                {{ $data['membership_details']->data->subscriptionPlan }}
                                            </span></p>
                                    </div>
                                </div>
                                <div class="from_cont_wrap">
                                    <form method="POST" name="myform" action="{{ route('paymentSave') }}"
                                        onsubmit="return validfunc()">
                                        @csrf
                                        <div class="fromdes_info">
                                            <div class="from_cont_wrap">
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label for="promocode">{{ __('paymentForm.promo') }} </label>
                                                        <div class="inp_cont_view noicon_opt">

                                                            <input type="text" class="form-control" name="code_promo"
                                                                id="promocode" placeholder="Promo/Reward Code ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="summary_content">
                                                    <h3>{{ __('paymentForm.summary') }}</h3>
                                                    <div class="summary_cont_wrap">
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.center') }}
                                                            </div>
                                                            <div class="sum_inp_right">

                                                                {{-- {{ $data['franchise']->name}} --}}
                                                                {{ $data['membership_details']->data->franchise }}
                                                            </div>
                                                        </div>
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.package_plan_Name') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{-- @if (isset($data['subscription_plan']) && isset($data['subscription_plan']->data))
														{{ $data['subscription_plan']->data->name }}
													@endif --}}
                                                                {{ $data['membership_details']->data->subscriptionPlan }}
                                                            </div>
                                                        </div>

                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.package') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ $data['membership_details']->data->initial_subtotal }}
                                                                $
                                                            </div>
                                                        </div>
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.number_of_payments') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ $data['membership_details']->data->number_of_payments }}
                                                                {{ __('paymentForm.payments') }}
                                                            </div>
                                                        </div>
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.begin_of_the_contract') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ date('Y-m-d', strtotime($data['membership_details']->data->begin)) }}
                                                            </div>
                                                        </div>
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.end_of_the_contract') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ date('Y-m-d', strtotime($data['membership_details']->data->end)) }}
                                                            </div>
                                                        </div>
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.duration') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ $data['membership_details']->data->duration_unit }}
                                                            </div>
                                                        </div>
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.membership') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ __('paymentForm.option') }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="summary_content">
                                                    <h3>{{ __('paymentForm.period_of_validity') }}</h3>
                                                    <div class="summary_cont_wrap">
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.package_name') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ $data['membership_details']->data->subscriptionPlan }}
                                                            </div>
                                                        </div>
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.membership_opt') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{-- @dd($data['subscription_plan']); --}}
                                                                @if (isset($data['subscription_plan']) && isset($data['subscription_plan']->data))
                                                                    @foreach ($data['subscription_plan']->data->options as $val)
                                                                        {{ $val->name }}
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.duration') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ $data['membership_details']->data->duration_unit }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="summary_content">
                                                    <h3>{{ __('paymentForm.1st_pay') }}</h3>
                                                    <div class="summary_cont_wrap">
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.fee') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                39.99$
                                                            </div>
                                                        </div>
                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.subtotal') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ $data['membership_details']->data->initial_subtotal }}
                                                            </div>
                                                        </div>
                                                        @php
                                                            $total = $data['membership_details']->data->initial_subtotal;
                                                        @endphp
                                                        @foreach ($data['membership_details']->data->initial_taxes as $item)
                                                            @php
                                                                $total += $item->amount;
                                                            @endphp
                                                            <div class="sum_inp_cont">
                                                                <div class="sum_inp_left">
                                                                    {{ $item->legal_name }}
                                                                </div>
                                                                <div class="sum_inp_right">
                                                                    {{ $item->amount }}$
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        @foreach ($data['membership_details']->data->recurant_taxes as $item2)
                                                            @php
                                                                $total += $item2->amount;
                                                            @endphp
                                                            <div class="sum_inp_cont">
                                                                <div class="sum_inp_left">
                                                                    {{ $item2->legal_name }}
                                                                </div>
                                                                <div class="sum_inp_right">
                                                                    {{ $item2->amount }}$
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="sum_inp_cont">
                                                            <div class="sum_inp_left">
                                                                {{ __('paymentForm.total') }}
                                                            </div>
                                                            <div class="sum_inp_right">
                                                                {{ $total }}$
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="summary_content">

                                                    <div class="content_block paymentinfo">
                                                        <h2 class="head_opt">{{ __('paymentForm.payment_details') }}
                                                        </h2>
                                                        <div
                                                            class="table_description_view oddoreven_opt oddoreven_opt2">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{ __('paymentForm.type') }}</th>
                                                                        <th>{{ __('paymentForm.pay_date') }}</th>
                                                                        <th>{{ __('paymentForm.pay') }}</th>
                                                                        <th>{{ __('paymentForm.status') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <tr class="activeitem">
                                                                        <td data-label="TYPE">
                                                                            <div class="pay_view_opt">
                                                                                {{ __('paymentForm.payments') }}
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="PAYMENT DATE">2023-7-18</td>
                                                                        <td data-label="PAYMENT">$45.32</td>
                                                                        <td data-label="STATUS">
                                                                            {{ __('paymentForm.paid') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td data-label="TYPE">
                                                                            <div class="pay_view_opt">
                                                                                {{ __('paymentForm.payments') }}
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="PAYMENT DATE">2023-7-18</td>
                                                                        <td data-label="PAYMENT">$45.32</td>
                                                                        <td data-label="STATUS">
                                                                            {{ __('paymentForm.paid') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td data-label="TYPE">
                                                                            <div class="pay_view_opt">
                                                                                {{ __('paymentForm.payments') }}
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="PAYMENT DATE">2023-7-18</td>
                                                                        <td data-label="PAYMENT">$45.32</td>
                                                                        <td data-label="STATUS">
                                                                            {{ __('paymentForm.paid') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td data-label="TYPE">
                                                                            <div class="pay_view_opt">

                                                                                {{ __('paymentForm.payments') }}
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="PAYMENT DATE">2023-7-18</td>
                                                                        <td data-label="PAYMENT">$45.32</td>
                                                                        <td data-label="STATUS">
                                                                            {{ __('paymentForm.paid') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td data-label="TYPE">
                                                                            <div class="pay_view_opt">
                                                                                {{ __('paymentForm.payments') }}
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="PAYMENT DATE">2023-7-18</td>
                                                                        <td data-label="PAYMENT">$45.32</td>
                                                                        <td data-label="STATUS">
                                                                            {{ __('paymentForm.paid') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td data-label="TYPE">
                                                                            <div class="pay_view_opt">
                                                                                {{ __('paymentForm.payments') }}
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="PAYMENT DATE">2023-7-18</td>
                                                                        <td data-label="PAYMENT">$45.32</td>
                                                                        <td data-label="STATUS">
                                                                            {{ __('paymentForm.paid') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td data-label="TYPE">
                                                                            <div class="pay_view_opt">
                                                                                {{ __('paymentForm.payments') }}
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="PAYMENT DATE">2023-7-18</td>
                                                                        <td data-label="PAYMENT">$45.32</td>
                                                                        <td data-label="STATUS">
                                                                            {{ __('paymentForm.paid') }}</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="content_block more_cont_view">
                                                        <h2>{{ __('paymentForm.method_of_payment') }}</h2>
                                                        <div class="checkout_optview payment_opt_details payment_opt2">
                                                            <div class="inp_row">
                                                                <div class="form-group">

                                                                    <div class="memberships_nam radio">
                                                                        <input type="radio" id="payment_opt1"
                                                                            name="radio_group_pay" class="radio1"
                                                                            value="credit_acc" onclick="showA();">
                                                                        <label
                                                                            for="payment_opt1">{{ __('paymentForm.Credit_Card') }}</label>
                                                                    </div>

                                                                    <div class="memberships_nam radio">
                                                                        <input type="radio" id="payment_opt2"
                                                                            name="radio_group_pay" class="radio2"
                                                                            value="credit_acc" onclick="showA();">
                                                                        <label
                                                                            for="payment_opt2">{{ __('paymentForm.Debit_Card') }}</label>
                                                                    </div>

                                                                    <div class="memberships_nam radio">
                                                                        <input type="radio" id="payment_opt3"
                                                                            name="radio_group_pay" onclick="show();"
                                                                            value="bank_acc" checked>
                                                                        <label
                                                                            for="payment_opt3">{{ __('paymentForm.Bank_Account') }}</label>
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
                                                                <label>{{ __('paymentForm.Transit_Number') }} <em
                                                                        class="req_text">*</em></label>
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
                                                                <label>{{ __('paymentForm.Branch_Number') }} <em
                                                                        class="req_text">*</em></label>
                                                                <div class="inp_cont_view noicon_opt">
                                                                    <input type="text" name="institution"
                                                                        class="form-control" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="inp_row">
                                                            <div class="form-group">
                                                                <label>{{ __('paymentForm.Account_Number') }} <em
                                                                        class="req_text">*</em></label>
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

                                                                    <input type="text" name="four_digits_number"
                                                                        class="form-control" placeholder=""
                                                                        value="">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="inp_row">
                                                            <div class="form-group">
                                                                <label>{{ __('paymentForm.Expiry_Month') }} <em
                                                                        class="req_text">*</em></label>
                                                                <div class="inp_cont_view noicon_opt">
                                                                    <input type="text" name="expiry_month"
                                                                        class="form-control" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="inp_row">
                                                            <div class="form-group">
                                                                <label>{{ __('paymentForm.Expiry_Year') }} <em
                                                                        class="req_text">*</em></label>
                                                                <div class="inp_cont_view noicon_opt">
                                                                    <input type="text" name="expiry_year"
                                                                        class="form-control" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="inp_row">
                                                            <div class="form-group">
                                                                <label>{{ __('paymentForm.CVV') }}<em
                                                                        class="req_text">*</em></label>
                                                                <div class="inp_cont_view noicon_opt">
                                                                    <input type="text" name="token"
                                                                        class="form-control" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <input type="hidden" name="subscription_plan_id"
                                                    value="{{ $data['membership_details']->data->subscriptionPlan_id }}">
                                                <input type="hidden" name="duration_id"
                                                    value="{{ Session::get('duration_id') }}">
                                                <input type="hidden" name="date_begin"
                                                    value="{{ $data['membership_details']->data->begin }}">
                                                <input type="hidden" name="processed_amount"
                                                    value="{{ $total }}">

                                                <div class="checkbox_block">
                                                    <div class="inp_row remember_opt">
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <!-- <label><input type="checkbox"> Remember me</label> -->

                                                            <input class="styled-checkbox" type="checkbox"
                                                                name="check1" id="checkbox1" value="value1"
                                                                onclick="checksignup()">
                                                            <label for="checkbox1">{{ __('paymentForm.accept') }} <a target="_blank"
                                                                    href="{{ route('front.terms') }}">{{ __('paymentForm.terms') }}</a></label>
                                                        </div>

                                                        </div>

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <!-- <label><input type="checkbox"> Remember me</label> -->

                                                            <input class="styled-checkbox" type="checkbox"
                                                                name="check2" id="checkbox2" value="value2"
                                                                onclick="checksignup()">
                                                            <label for="checkbox2">{{ __('paymentForm.accept') }} <a target="_blank"
                                                                    href="{{ route('front.privacy') }}">{{ __('paymentForm.suitability') }}</a></label>
                                                        </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="frombtn_wrap">
                                                    <div class="def_btnopt2 frombtn">
                                                        <button type="submit" value="submit" class="btn2"
                                                            id="myButton"
                                                            disabled>{{ __('paymentForm.sign_up') }}!</button>
                                                        <button type="button"
                                                            class="btn2 backbutton">{{ __('paymentForm.back') }}</button>
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
                if (four_digits_number.length != 16) {
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
                if (token.length != 3) {
                    alert("CVV must be at least 3 characters long.");
                    return false;
                }
            }
        }
    </script>
    <script>
        function checksignup() {
            var checkbox1 = document.getElementById("checkbox1").checked;
            var checkbox2 = document.getElementById("checkbox2").checked;
            if (checkbox1 && checkbox2) {
                document.getElementById("myButton").disabled = false;
            } else {
                document.getElementById("myButton").disabled = true;
            }
        }
    </script>

</x-guest-layout>
