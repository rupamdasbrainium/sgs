<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
       
            @include('layouts.sidebar')

            <div class="inner_page_des">
                {{-- @if(Session::has('errors'))
                <div class="alert alert-danger">
                    {{Session::get('errors')}}
                </div>
                    @endif --}}
                <form action="{{ route('payMyOutstandingBalance.post') }}" method="post">
                    @csrf
                    <input type="hidden" name="client_id" value="{{ $data['client_id'] }}">
                    <div class="content_block paymentinfo">
                        <h2 class="head_opt"><span>{{ __('paymyoutstandingbalance.Total_outstanding_balance') }}:
                                {{ $data['outstandingAmount'] }}$</span>{{ __('paymyoutstandingbalance.Payment_Details') }}
                        </h2>
                        <div class="table_description_view oddoreven_opt">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="modify"></th>
                                        <th>{{ __('paymyoutstandingbalance.PAYMENT_DATE') }}</th>
                                        <th>{{ __('paymyoutstandingbalance.PAYMENT') }}</th>
                                        <th>{{ __('paymyoutstandingbalance.STATUS') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data['payments'] == null)
                                        <tr>
                                            <td colspan="4">
                                                {{ __('paymyoutstandingbalance.No_Payments_Data_Availble') }}</td>
                                        </tr>
                                    @else
                                        @foreach ($data['payments'] as $key => $pt)
                                            @if (!$pt->is_paid)
                                                <tr class="evenitem">
                                                    <td data-label="TYPE">
                                                        <div class="pay_view_opt">
                                                            @if (strtotime(Date('Y-m-d')) - strtotime(date('Y-m-d', strtotime($pt->paymentDate))) > 0)
                                                                <div class="checkbox">
                                                                    <input class="styled-checkbox checkBox"
                                                                        id="Option1{{ $key + 1 }}"
                                                                        data-id ="{{ $pt->paymentId }}" type="checkbox"
                                                                        value="{{ $pt->remainingAmount }}"
                                                                        name="payment_checkbox">
                                                                    <label for="Option1{{ $key + 1 }}"
                                                                        class="" data-value="{{ $pt->remainingAmount }}"
                                                                        onclick="">&nbsp;</label>
                                                                </div>
                                                            @endif
                                                            {{ __('paymyoutstandingbalance.Payments') }}
                                                        </div>

                                                    </td>
                                                    <td data-label="PAYMENT DATE">
                                                        {{ date('Y-m-d', strtotime($pt->paymentDate)) }}</td>
                                                    <td data-label="PAYMENT">{{ $pt->remainingAmount }}$</td>
                                                    <td data-label="STATUS">{{ __('paymyoutstandingbalance.Unpaid') }}
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td data-label="TYPE">
                                                        <div class="pay_view_opt">
                                                            {{ __('paymyoutstandingbalance.Payments') }}
                                                        </div>
                                                    </td>
                                                    <td data-label="PAYMENT DATE">
                                                        {{ date('Y-m-d', strtotime($pt->paymentDate)) }}</td>
                                                    <td data-label="PAYMENT">{{ $pt->amount }}$</td>
                                                    <td data-label="STATUS">{{ __('paymyoutstandingbalance.Paid') }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="content_block more_cont_view">
                        <h2>{{ __('paymyoutstandingbalance.Method_of_Payment') }}</h2>
                        <div class="checkout_optview payment_opt_details">
                            <div class="inp_row">
                                <div class="form-group">
                                    <div class="memberships_nam radio cards">
                                        <input type="radio" id="payment_opt1" name="payment_type" value="credit_card"
                                            @if(request()->type!= "bank" || request()->type != "new_bank")checked @endif>
                                        <label
                                            for="payment_opt1">{{ __('paymyoutstandingbalance.Credit_Card') }}</label>
                                    </div>

                                    {{-- <div class="memberships_nam radio bank">
                                        <input type="radio" id="payment_opt3" name="payment_type"
                                            value="bank_account"  @if(request()->type == "bank" || request()->type == "new_bank")checked @endif>
                                        <label
                                            for="payment_opt3">{{ __('paymyoutstandingbalance.Bank_Account') }}</label>
                                    </div> --}}

                                </div>
                                <input type="hidden" name="new_key" id="new_key" value="0">
                                <div class="frombtn_wrap select_optblock">
                                    <div class="select_card_opt">

                                        <div class="form-group">
                                            <div class="inp_cont_view noicon_opt accountBox">
                                                <div class="selectcont select-cards">
                                                    <div class="arrowdown2">
                                                        <i class="fal fa-chevron-down"></i>
                                                    </div>
                                                    <select class="select_opt" name="payment_method_card">
                                                        @if ($data['cards'] != null)
                                                            @foreach ($data['cards'] as $card)
                                                                <option value="{{ $card->id }}" {{ (request()->type == 'card' && request()->acc_id == $card->id) ? 'selected':'' }}>XXXX XXXX XXXX
                                                                    {{ $card->four_digits_number }} -
                                                                    {{ __('paymyoutstandingbalance.Card') }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="" selected hidden>
                                                                {{ __('paymyoutstandingbalance.No_Card_Found') }}
                                                            </option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="selectcont select-banks">
                                                    <div class="arrowdown2">
                                                        <i class="fal fa-chevron-down"></i>
                                                    </div>
                                                    {{-- <select class="select_opt" name="payment_method_id">
                                                        @if ($data['banks'] != null)
                                                            @foreach ($data['banks'] as $bank)
                                                                <option value="{{ $bank->id }}" {{ (request()->type == 'bank' && request()->acc_id == $bank->id) ? 'selected':'' }}>XXXX XXXX XXXX
                                                                    {{ $bank->account_last_digits }} -
                                                                    {{ __('paymyoutstandingbalance.Bank') }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="" selected hidden>
                                                                {{ __('paymyoutstandingbalance.No_Bank_Account_Found') }}
                                                            </option>
                                                        @endif
                                                    </select> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="def_btnopt2 frombtn frombtn2">
                                        <button type="button"
                                            style="--hover-bg:{{ $primary_button_color_hover->value }}; background-color: {{ $button->value }}"class="btn2"
                                            id="add_pay_method">{{ __('paymyoutstandingbalance.Add_Payment_Method') }}</button>
                                    </div>
                                </div>

                                {{-- <div id="bank_details">
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
                                                <input type="number" name="transit_number" class="form-control"
                                                    placeholder="" value="{{ old('transit_number') }}">
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
                                                <input type="text" name="institution" class="form-control"
                                                    placeholder="" value="{{ old('institution') }}">
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
                                                <input type="text" name="account_number" class="form-control"
                                                    placeholder=""  value="{{ old('account_number') }}">
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
                                                <input type="text" name="owner_names" class="form-control"
                                                    placeholder="" oninput="onlyletterhow(event)" value="{{ old('owner_names') }}">
                                            </div>
                                        </div>
                                        @error('owner_names')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

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
                                                <input type="text" name="owner_name" class="form-control"
                                                    placeholder="" oninput="onlyletterhow(event)" value="{{ old('owner_names') }}">
                                            </div>
                                        </div>
                                        @error('owner_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="inp_row">
                                        <div class="form-group">
                                            <label>{{ __('paymentForm.PAN') }} <em class="req_text">*</em></label>
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="pan" class="form-control" maxlength="16" oninput="onlynumshow(event)"
                                                    placeholder="" value="{{ old('pan') }}">
                                            </div>
                                        </div>
                                        @error('pan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="inp_row">
                                        <div class="form-group">
                                            <label>{{ __('paymentForm.CSV') }} <em class="req_text">*</em></label>
                                            <div class="inp_cont_view noicon_opt" id="incdec">

                                                <input type="text" name="four_digits_number" class="form-control" oninput="onlynumshow(event)" maxlength="4"
                                                    placeholder="" value="{{ old('four_digits_number') }}">

                                            </div>
                                        </div>
                                        @error('four_digits_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="inp_row">
                                        <div class="form-group">
                                            <label>{{ __('paymentForm.Expiry_Month') }} <em
                                                    class="req_text">*</em></label>
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" name="expiry_month" class="form-control" oninput="onlynumshow(event)" maxlength="2"
                                                    placeholder=""  value="{{ old('expiry_month') }}">
                                            </div>
                                        </div>
                                        @error('expiry_month')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="inp_row">
                                        <div class="form-group">
                                            <label>{{ __('paymentForm.Expiry_Year') }} <em
                                                    class="req_text">*</em></label>
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="number" name="expiry_year" class="form-control" oninput="onlynumshow(event)" maxlength="4"
                                                    placeholder="" value="{{ old('expiry_year') }}">
                                            </div>
                                        </div>
                                    </div>
                                    @error('expiry_year')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="aboundopt">
                                    <p id="totalAmount">{{ __('paymyoutstandingbalance.Amount_paid') }}: 0$</p>
                                </div>
                                <div class="frombtn_wrap">
                                    <div class="def_btnopt2 frombtn frombtn2">
                                        <input type="hidden" name="payment_ids">
                                        <input type="hidden" name="totalAmount">
                                        <button type="submit" id="paynow"
                                            style="--hover-bg:{{ $primary_button_color_hover->value }}; background-color: {{ $button->value }}" class="btn2"
                                            disabled>{{ __('paymyoutstandingbalance.Pay_Now') }}</button>
                                        <button type="submit" class="btn2" id="btnaccsave"
                                            style="--hover-bg:{{ $primary_button_color_hover->value }}; background-color: {{ $button->value }}">{{ __('newMembership.Saveapaymentmethod') }}</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
    @include('footer')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#bank_details').hide();
            $('#credit_details').hide();
            $('#card_acc_sec').show();
            $('#btnaccsave').hide();
            var type = "{{ request()->type }}"
            if (type == "bank") {
            // $('input[name="payment_type"]:checked').val('bank_account'); 

                $('.select-cards').hide();
                $('.select-banks').show();
                $('#bank_details').hide();
            $('#credit_details').hide();
            $('#card_acc_sec').hide();
            $('#btnaccsave').hide();
            }
            else if (type == "new_card") {
                $('#card_acc_sec').hide();
                $('#btnaccsave').show();
                $('#paynow').hide();
                $("#new_key").val(1);
                // $('#bank_details').hide();
                $('#credit_details').show();
                $('.select-cards').hide();
                $('.select-banks').hide();
            }
            else if (type == "new_bank") {
                $('#card_acc_sec').hide();
                $('#btnaccsave').show();
                $('#paynow').hide();
                $("#new_key").val(1);
                $('#bank_details').show();
                    // $('#credit_details').hide();
                    $('.select-cards').hide();
                    $('.select-banks').hide();
                    // $('input[name="payment_type"]:checked').val('bank_account');
            }

            else {

                $('.select-cards').show();
                $('.select-banks').hide();
            }
            $('#add_pay_method').click(function() {
                $('#card_acc_sec').hide();
                $('#btnaccsave').show();
                $('#paynow').hide();
                $("#new_key").val(1);
                let radio_group_pay = $('input[name="payment_type"]:checked').val();
                console.log(radio_group_pay);
                if (radio_group_pay == 'bank_account') {
                    $('#bank_details').show();
                    $('#credit_details').hide();
                    $('.select-cards').hide();
                    $('.select-banks').hide();

                } else if (radio_group_pay == 'credit_card') {
                    $('#bank_details').hide();
                    $('#credit_details').show();
                    $('.select-cards').hide();
                    $('.select-banks').hide();
                } else {
                    console.log('not selected radio' + radio_group_pay);
                }
            });


            $('input[type=radio][name=payment_type]').change(function() {
                $('#card_acc_sec').show();
                $('#btnaccsave').hide();
                $('#paynow').show();
                $("#new_key").val(0);
                if (this.value == 'bank_account') {
                    $('#bank_details').hide();
                    $('#credit_details').hide();
                    $('.select-cards').hide();
                    $('.select-banks').show();
                } else {
                    $('#bank_details').hide();
                    $('#credit_details').hide();
                    $('.select-cards').show();
                    $('.select-banks').hide();
                }
            });


            // $('.select-banks').css({
            //     "display": "none",
            //     "visibility": "hidden"
            // });
            // $(document).on("click", ".bank", function() {
            //     $('.select-cards').css({
            //         "display": "none",
            //         "visibility": "hidden"
            //     });
            //     $('.select-banks').css({
            //         "display": "grid",
            //         "visibility": "visible"
            //     })
            // });
            // $(document).on("click", ".cards", function() {
            //     $('.select-banks').css({
            //         "display": "none",
            //         "visibility": "hidden"
            //     })
            //     $('.select-cards').css({
            //         "display": "grid",
            //         "visibility": "visible"
            //     });

            // });

            $(document).on("click", ".checkBox", function() {

                var boxed = $('input[name="payment_checkbox"]:checked');
                var amount = 0;
                var payemntIds = [];
                if (boxed.length > 0) {
                    boxed.each(function() {
                        amount += parseFloat($(this).val());
                        payemntIds.push($(this).attr('data-id'));
                    });
                    document.getElementById("paynow").disabled = false;
                } else {
                    amount = 0;
                    document.getElementById("paynow").disabled = true;
                }
                console.log(payemntIds);
                amount = parseFloat(amount).toFixed(2);
                $('.aboundopt').empty()
                $('.aboundopt').append(`<p id="totalAmount">Amount to be paid: ${amount}$</p>`);
                $('input[name="totalAmount"]').val(amount);
                $('input[name="payment_ids"]').val(payemntIds);
            });

            toastr.options.timeOut = 3000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @endif

            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif

        });


        function onlyletterhow(event){

let inputvalue = event.target.value;
inputvalue = inputvalue.replace(/[^a-z A-Z\\.]+/g, ''); // Remove non-numeric characters

event.target.value = inputvalue;
}
function onlynumshow(event){

let inputvalue = event.target.value;
inputvalue = inputvalue.replace(/\D/g, ''); // Remove non-numeric characters

event.target.value = inputvalue;
}
    </script>
</x-app-layout>
