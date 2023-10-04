<x-guest-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap innermain_content payment_content">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="fromdes_info user_contentblock">

                            @include('layouts.sidebar')

                            <div class="from_cont_wrap">
                                <form method="POST" name="myform" action="" onsubmit="return validfunc()">
                                    @csrf
                                    <div class="fromdes_info">
                                        <div class="from_cont_wrap">
                                            <div class="content_block paymentinfo">
                                                <h2 class="head_opt">{{ __('paymentForm.payment_details') }}</h2>
                                            </div>
                                            @dd($data['bank'])
                                            <div class="from_contentblock">

                                                <div id="bank_details">
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Direct_Debit') }}</label>
                                                            <div class="card_add">
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
                                                                    value="{{ $data['bank']->transit }}">
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
                                            </div>

                                            <div class="frombtn_wrap">
                                                <div class="def_btnopt2 frombtn">
                                                    <button type="submit" value="submit" class="btn2"
                                                        id="myButton">{{ __('paymentForm.submit') }}!</button>
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

        }
    </script>


</x-guest-layout>
