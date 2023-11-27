<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <section class="maincontent_wrap innermain_content payment_content">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container fullWidth">
                <div class="row">
                    <div class="col-md-12">

                        <div class="fromdes_info user_contentblock">

                            @include('layouts.sidebar')

                            <div class="from_cont_wrap">
                                <form method="POST" name="myform" action="{{route('modifyCardsUpdate')}}" onsubmit="return validfunc()">
                                    @csrf                                  
                                    <div class="fromdes_info">
                                        <div class="from_cont_wrap">
                                            <div class="content_block paymentinfo">
                                                <h2 class="head_opt">{{ __('paymentForm.payment_details') }}</h2>
                                            </div>
                                          
                                            <div id="credit_details">
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.Credit_Card') }}</label>
                                                        <div class="card_add">
                                                            <img src="images/voided.png" alt="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="credit_id" value="{{$data["card"][0]->id}}">
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.Account_Name_Holder') }} <em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt">
                                                            <input type="text" name="owner_name" class="form-control"
                                                                placeholder="" oninput="onlyletterhow(event)" value="{{ $data["card"][0]->owner_name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.PAN') }} <em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt" id="incdec">
 
                                                            <input type="text" name="four_digits_number" class="form-control" oninput="onlynumshow(event)" maxlength="16"
                                                                placeholder="" value="{{$data["card"][0]->four_digits_number}}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.Expiry_Month') }} <em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt">
                                                            <input type="text" name="expiry_month" oninput="onlynumshow(event)" maxlength="2"
                                                                class="form-control" placeholder="" value="{{$data["card"][0]->expire_month}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inp_row">
                                                    <div class="form-group">
                                                        <label>{{ __('paymentForm.Expiry_Year') }} <em
                                                                class="req_text">*</em></label>
                                                        <div class="inp_cont_view noicon_opt">
                                                            <input type="text" name="expiry_year" oninput="onlynumshow(event)" maxlength="4"
                                                                class="form-control" placeholder="" value="{{$data["card"][0]->expire_year}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="frombtn_wrap">
                                                <div class="def_btnopt2 frombtn">
                                                    <button type="submit" value="submit" class="btn2" style="--hover-bg:{{ $primary_button_color_hover->value }}; background-color: {{$button->value}}"
                                                        id="myButton">{{ __('paymentForm.submit') }}</button>
                                                    <button type="button"
                                                        class="btn2 backbutton" style="--hover-bg:{{ $primary_button_color_hover->value }}" onclick="history.back()">{{ __('paymentForm.back') }}</button>
                                                </div>
                                            </div>

                                        </h2>
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
                    alert(trans('paymentForm.Name_blank'));
                    return false;
                }
                if (four_digits_number.length != 3) {
                    alert(trans('paymentForm.Card_numbe_least_4_characters'));
                    return false;
                }
                if (expiry_month.length <3) {
                    alert(trans('paymentForm.Expiry_month'));
                    return false;
                }
                if (expiry_year.length != 4) {
                    alert(trans('paymentForm.Expiry_year'));
                    return false;
                }
            }
        }
        function onlyletterhow(event){

let inputvalue = event.target.value;
inputvalue = inputvalue.replace(/[^a-z A-Z\\.]+/g, ''); // Remove non-numeric characters

event.target.value = inputvalue;
}
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</x-app-layout>
