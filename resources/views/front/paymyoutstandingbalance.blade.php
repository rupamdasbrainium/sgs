<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')

            <div class="inner_page_des">
                <form action="{{ route('payMyOutstandingBalance.post') }}" method="post">
                    @csrf
                    <input type="hidden" name="client_id" value="{{ $data['client_id'] }}">
                    <div class="content_block paymentinfo">
                        <h2 class="head_opt"><span>{{ __('paymyoutstandingbalance.Total_outstanding_balance') }}:
                                ${{ $data['outstandingAmount'] }}</span>{{ __('paymyoutstandingbalance.Payment_Details') }}
                        </h2>
                        <div class="table_description_view oddoreven_opt">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="modify">{{ __('paymyoutstandingbalance.TYPE') }}</th>
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
                                                            @if(strtotime(Date('Y-m-d'))-strtotime(date('Y-m-d', strtotime($pt->paymentDate)))>0)
                                                            <div class="checkbox">
                                                                <input class="styled-checkbox checkBox"
                                                                    id="Option1{{ $key + 1 }}" data-id ="{{$pt->paymentId}}" type="checkbox"
                                                                    value="{{ $pt->amount }}" name="payment_checkbox">
                                                                <label for="Option1{{ $key + 1 }}" class=""
                                                                    data-value="{{ $pt->amount }}"
                                                                    onclick="">&nbsp;</label>
                                                            </div>
                                                            @endif
                                                            {{ __('paymyoutstandingbalance.Payments') }}
                                                        </div>

                                                    </td>
                                                    <td data-label="PAYMENT DATE">
                                                        {{ date('Y-m-d', strtotime($pt->paymentDate)) }}</td>
                                                    <td data-label="PAYMENT">${{ $pt->amount }}</td>
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
                                                    <td data-label="PAYMENT">${{ $pt->amount }}</td>
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
                                            checked>
                                        <label
                                            for="payment_opt1">{{ __('paymyoutstandingbalance.Credit_Card') }}</label>
                                    </div>

                                    <div class="memberships_nam radio bank">
                                        <input type="radio" id="payment_opt3" name="payment_type"
                                            value="bank_account">
                                        <label
                                            for="payment_opt3">{{ __('paymyoutstandingbalance.Bank_Account') }}</label>
                                    </div>

                                </div>

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
                                                                <option value="{{ $card->id }}">XXXX XXXX XXXX
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
                                                    <select class="select_opt" name="payment_method_id">
                                                        @if ($data['banks'] != null)
                                                            @foreach ($data['banks'] as $bank)
                                                                <option value="{{ $bank->id }}">XXXX XXXX XXXX
                                                                    {{ $bank->account_last_digits }} -
                                                                    {{ __('paymyoutstandingbalance.Bank') }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="" selected hidden>
                                                                {{ __('paymyoutstandingbalance.No_Bank_Account_Found') }}
                                                            </option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="def_btnopt2 frombtn frombtn2">
                                        <button type="button"
                                            style="background-color: {{ $button->value }}"class="btn2">{{ __('paymyoutstandingbalance.Add_Payment_Method') }}</button>
                                    </div>
                                </div>
                                <div class="aboundopt">
                                    <p id="totalAmount">{{ __('paymyoutstandingbalance.Amount_paid') }}: $0</p>
                                </div>
                                <div class="frombtn_wrap">
                                    <div class="def_btnopt2 frombtn frombtn2">
                                        <input type="hidden" name="payment_ids">
                                        <input type="hidden" name="totalAmount">
                                        <button type="submit" id="paynow"
                                            style="background-color: {{ $button->value }}" class="btn2"
                                            disabled>{{ __('paymyoutstandingbalance.Pay_Now') }}</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.select-banks').css({
                "display": "none",
                "visibility": "hidden"
            });
            $(document).on("click", ".bank", function() {
                $('.select-cards').css({
                    "display": "none",
                    "visibility": "hidden"
                });
                $('.select-banks').css({
                    "display": "grid",
                    "visibility": "visible"
                })
            });
            $(document).on("click", ".cards", function() {
                $('.select-banks').css({
                    "display": "none",
                    "visibility": "hidden"
                })
                $('.select-cards').css({
                    "display": "grid",
                    "visibility": "visible"
                });

            });

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
                $('.aboundopt').append(`<p id="totalAmount">Amount to be paid: $${amount}</p>`);
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
    </script>
</x-app-layout>
