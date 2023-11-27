<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <section class="maincontent_wrap innermain_content payment_content">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="fromdes_info user_contentblock">

                            @include('layouts.sidebar')

                            <div class="from_cont_wrap">
                                <form method="POST" name="myform" action="{{route('modifyBanksUpdate')}}" onsubmit="return validfunc()">
                                    @csrf
                                    <input type="hidden" name="bank_id" value="{{$data["bank"][0]->id}}">
                                    <div class="fromdes_info">
                                        <div class="from_cont_wrap">
                                            <div class="content_block paymentinfo">
                                                <h2 class="head_opt">{{ __('paymentForm.payment_details') }}</h2>
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
                                                            <label>{{ __('paymentForm.Transit_Number') }} <em
                                                                    class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt" id="incdec">

                                                                <input type="text" name="transit_number"
                                                                    class="form-control" placeholder="" oninput="onlynumshow(event)" maxlength="5"
                                                                    value="{{ $data['bank'][0]->transit }}">
                                                            </div>
                                                        </div>
                                                        @error('transit_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>

                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Branch_Number') }} <em
                                                                    class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="institution" oninput="onlynumshow(event)" maxlength="3"
                                                                    class="form-control" placeholder=""  value="{{ $data['bank'][0]->institution }}">
                                                            </div>
                                                        </div>
                                                        @error('institution')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                    <div class="inp_row">
                                                        <div class="form-group">
                                                            <label>{{ __('paymentForm.Account_Number') }} <em
                                                                    class="req_text">*</em></label>
                                                            <div class="inp_cont_view noicon_opt">
                                                                <input type="text" name="account_number"
                                                                    class="form-control" placeholder="" oninput="onlynumshow(event)" maxlength="12" value="{{ $data['bank'][0]->account_last_digits }}">
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
                                                                    class="form-control" oninput="onlyletterhow(event)" placeholder="bank" value="{{ $data['bank'][0]->owner_name }}">
                                                            </div>
                                                        </div>
                                                        @error('owner_names')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="frombtn_wrap">
                                                <div class="def_btnopt2 frombtn">
                                                    <button type="submit" value="submit" class="btn2" style="background-color: {{$button->value}}"
                                                        id="myButton">{{ __('paymentForm.submit') }}</button>
                                                    <button type="button" style="background-color: {{$button->value}}"
                                                        class="btn2 backbutton" onclick="history.back()">{{ __('paymentForm.back') }}</button>
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
                    alert(trans('paymentForm.Transit_number_5_characters'));
                    return false;
                }
                if (institution.length != 6) {
                    alert(trans('paymentForm.Branchcode_mustbe_6_characters'));
                    return false;
                }
                if (account_number.length != 16) {
                    alert(trans('paymentForm.Account_number_mustbe_16_characterss'));
                    return false;
                }
                if (owner_names == "") {
                    alert(trans('paymentForm.Account_name_blank'));
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</x-app-layout>
