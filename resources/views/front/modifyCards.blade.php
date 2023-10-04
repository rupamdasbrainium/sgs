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
                                <form method="POST" name="myform" action="{{route('modifyCardsUpdate')}}" onsubmit="return validfunc()">
                                    @csrf
                                    <input type="hidden" name="credit_id" value="{{$data["card"][0]->id}}">
                                    <div class="fromdes_info">
                                        <div class="from_cont_wrap">
                                            <div class="content_block paymentinfo">
                                                <h2 class="head_opt">{{ __('paymentForm.payment_details') }}</h2>
                                            </div>
                                           
                                            <div id="credit_details">
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.Credit') }}</label>
                                                        <div class="card_add">
                                                            {{-- <input name="payCard" value="payCard"
                                                                type="hidden" /> --}}
                                                            <img src="images/voided.png" alt="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.Account_Name_Holder') }} <em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt">
                                                            <input type="text" name="owner_name" class="form-control"
                                                                placeholder=""value="{{ $data["card"][0]->owner_name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.PAN') }} <em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt">
                                                            <input type="text" name="pan"
                                                                class="form-control" placeholder=""value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.credit_card_number') }} <em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt" id="incdec">

                                                            <input type="text" name="token" class="form-control"
                                                                placeholder="" value="{{$data["card"][0]->four_digits_number}}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.Expiry_Month') }} <em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt">
                                                            <input type="text" name="expiry_month"
                                                                class="form-control" placeholder="" value="{{$data["card"][0]->expire_month}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.Expiry_Year') }} <em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt">
                                                            <input type="text" name="expiry_year"
                                                                class="form-control" placeholder="{{$data["card"][0]->expire_year}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.CVV') }}<em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt">
                                                            <input type="text" name="four_digits_number"
                                                                class="form-control" placeholder="{{$data["card"][0]->four_digits_number}}">
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
