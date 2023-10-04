<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">

                <div class="content_block paymentinfo">
                    <h2 class="head_opt"><span>Total outstanding balance: ${{ $data['outstandingAmount'] }}</span>Payment
                        Details</h2>
                    <div class="table_description_view oddoreven_opt">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>TYPE</th>
                                    <th>PAYMENT DATE</th>
                                    <th>PAYMENT</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data['payments'] == null)
                                    <tr>
                                        <td colspan="4">No Payments Data Availble</td>
                                    </tr>
                                @else
                                    @foreach ($data['payments'] as $key=>$pt)
                                        @if (!$pt->is_paid)
                                            <tr class="evenitem">
                                                <td data-label="TYPE">
                                                    <div class="pay_view_opt">
                                                        <div class="checkbox">
                                                            <input class="styled-checkbox" id="Option1{{$key+1}}"
                                                                type="checkbox" value="{{$pt->amount}}" name="payment_checkbox">
                                                            <label for="Option1{{$key+1}}" class="checkBox" data-value="{{$pt->amount}}" onclick="">&nbsp;</label>
                                                        </div>
                                                        Payments
                                                    </div>

                                                </td>
                                                <td data-label="PAYMENT DATE">
                                                    {{ date('Y-m-d', strtotime($pt->paymentDate)) }}</td>
                                                <td data-label="PAYMENT">${{ $pt->amount }}</td>
                                                <td data-label="STATUS">Unpaid</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td data-label="TYPE">
                                                    <div class="pay_view_opt">
                                                        <!-- <div class="checkbox">
                                                <input class="styled-checkbox" id="Option1" type="checkbox" value="value1">
                                                <label for="Option1">&nbsp;</label>
                                            </div>  -->
                                                        Payments
                                                    </div>
                                                </td>
                                                <td data-label="PAYMENT DATE">
                                                    {{ date('Y-m-d', strtotime($pt->paymentDate)) }}</td>
                                                <td data-label="PAYMENT">${{ $pt->amount }}</td>
                                                <td data-label="STATUS">Paid</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="content_block more_cont_view">
                    <h2>Method of Payment</h2>
                    <div class="checkout_optview payment_opt_details">
                        <div class="inp_row">
                            <div class="form-group">
                                <div class="memberships_nam radio cards">
                                    <input type="radio" id="payment_opt1" name="radio-group_pay" value="credit_card" checked>
                                    <label for="payment_opt1">Credit Card</label>
                                </div>

                                <div class="memberships_nam radio bank">
                                    <input type="radio" id="payment_opt3" name="radio-group_pay" value="bank_account">
                                    <label for="payment_opt3">Bank Account</label>
                                </div>

                            </div>

                            <div class="frombtn_wrap select_optblock">
                                <div class="select_card_opt">

                                    <div class="form-group">
                                        <div class="inp_cont_view noicon_opt accountBox">
                                            <div class="selectcont select-cards">
                                                <div class="arrowdown2">
                                                    <i class="far fa-chevron-down"></i>
                                                </div>
                                                <select class="select_opt">
                                                    @if ($data['cards'] != null)
                                                        @foreach ($data['cards'] as $card)
                                                            <option value="{{ $card->id }}">XXXX XXXX XXXX
                                                                {{ $card->four_digits_number }} - Card</option>
                                                        @endforeach
                                                    @else
                                                        <option value="" selected hidden>No Card Found</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="selectcont select-banks">
                                                <div class="arrowdown2">
                                                    <i class="far fa-chevron-down"></i>
                                                </div>
                                                <select class="select_opt">
                                                    @if ($data['banks'] != null)
                                                        @foreach ($data['banks'] as $bank)
                                                            <option value="{{ $bank->id }}">XXXX XXXX XXXX
                                                                {{ $bank->account_last_digits }} - Bank</option>
                                                        @endforeach
                                                    @else
                                                        <option value="" selected hidden> No Bank Account Found</option>
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="def_btnopt2 frombtn frombtn2">
                                    <button type="button" class="btn2">Add a Payment Method</button>
                                </div>
                            </div>
                            <div class="aboundopt">
                                <p>Amount to be paid: $90.64</p>
                            </div>
                            <div class="frombtn_wrap">
                                <div class="def_btnopt2 frombtn frombtn2">
                                    <button type="button" class="btn2">Pay Now</button>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-banks').css({
                "display":"none",
                "visibility":"hidden"
            });
            $(document).on("click", ".bank", function(){
                $('.select-cards').css({
                    "display":"none",
                    "visibility":"hidden"
                });
                $('.select-banks').css({
                    "display":"grid",
                    "visibility":"visible"
                })
            });
            $(document).on("click", ".cards", function(){
                $('.select-banks').css({
                    "display":"none",
                    "visibility":"hidden"
                })
                $('.select-cards').css({
                    "display":"grid",
                    "visibility":"visible"
                });

            })

            $(document).on("click",".checkBox", function(){
                var boxed = $('input[name="payment_checkbox"]:checked');
                console.log(boxed);
            })
        });
    </script>
</x-app-layout>
