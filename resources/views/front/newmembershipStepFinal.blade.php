<x-app-layout>
    @section('title', $data['title'] . ' |')
    @section('style', ';--sub_btn-bg: ' . $button->value . ';--sub_btnhover-bg:' . $primary_button_color_hover->value)
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">
                @if (Session::has('message'))
                    <div class="alert alert-danger">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if (Session::has('messages'))
                    <div class="alert alert-success">
                        {{ Session::get('messages') }}
                    </div>
                @endif
                <h2>{{ __('paymentForm.payment') }}</h2>
                <div class="prod_item_wrap" id="home_prod_item">
                    <form method="POST" name="myform" action="{{ route('newMembershipFinalsave') }}" id="mainform"
                        onsubmit="return validfunc()">
                        @csrf
                        <div class="fromdes_info">
                            <div class="from_cont_wrap">
                                <p>{{ __('paymentForm.center') }}:
                                    <span>{{ $data['membership_details']->data->franchise }}</span>
                                </p>
                                <p>{{ __('paymentForm.package') }}: <span>
                                    {{ $data['membership_details']->data->subscriptionPlan }}
                                </span></p>
                                <div class="inp_row">
                                    <div class="form-group">
                                        <label for="promocode">{{ __('paymentForm.promo') }} </label>
                                        <div class="inp_cont_view noicon_opt">

                                            <input type="text" class="form-control" name="code_promo" id="promocode"
                                                placeholder="{{ __('paymentForm.promo') }} ">
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
                                                {{ $data['membership_details']->data->franchise }}
                                            </div>
                                        </div>
                                        <div class="sum_inp_cont">
                                            <div class="sum_inp_left">
                                                {{ __('paymentForm.package_plan_Name') }}
                                            </div>
                                            <div class="sum_inp_right">
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
                                        @php
                                            $total = $data['membership_details']->data->initial_subtotal;
                                        @endphp
                                        @foreach ($data['membership_details']->data->initial_taxes as $initial_tax)
                                            <div class="sum_inp_cont">
                                                <div class="sum_inp_left">
                                                    {{ $initial_tax->legal_name }}
                                                </div>
                                                <div class="sum_inp_right">
                                                    {{ $initial_tax->amount }}$

                                                </div>
                                            </div>
                                            @php
                                                $total += $initial_tax->amount;
                                            @endphp
                                        @endforeach
                                        <div class="sum_inp_cont">
                                            <div class="sum_inp_left">
                                                {{ __('paymentForm.First_Payment') }}
                                            </div>
                                            <div class="sum_inp_right">
                                                {{ $total }}$
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
                                            @if (Session::get('addonname') == null)
                                                <div class="sum_inp_right">
                                                    {{ __('paymentForm.none') }}
                                                </div>
                                            @else
                                                @php
                                                    Session::get('addonname');
                                                    $addonname = Session::get('addonname');
                                                @endphp
                                                <div class="sum_inp_right">
                                                    @foreach ($addonname as $addonName)
                                                        {{ $addonName }}
                                                        {{ $loop->last ? '' : ',' }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="summary_content">
                                   
                                    <div class="summary_content">
                                        <h3>{{ __('paymentForm.1st_pay') }}</h3>
                                        <div class="summary_cont_wrap">
                                            <div class="sum_inp_cont">
                                                <div class="sum_inp_left">
                                                    {{ __('paymentForm.subtotal') }}
                                                </div>
                                                <div class="sum_inp_right">
                                                    {{ $data['membership_details']->data->initial_subtotal }}$
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
                                    <div class="content_block paymentinfo">
                                        <h2 class="head_opt">{{ __('paymentForm.payment_details') }}
                                        </h2>
                                        <div class="table_description_view oddoreven_opt oddoreven_opt2">
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
                                                    @foreach ($data['membership_details']->data->payment_details as $payment_detail)
                                                        <tr class="activeitem">
                                                            <td data-label="TYPE">
                                                                <div class="pay_view_opt">
                                                                    {{ $payment_detail->type }}
                                                                </div>
                                                            </td>
                                                            <td data-label="PAYMENT DATE">
                                                                {{ date('Y-m-d', strtotime($payment_detail->date)) }}
                                                            </td>
                                                            <td data-label="PAYMENT">
                                                                {{ $payment_detail->amount }}$</td>
                                                            <td data-label="STATUS">
                                                                {{ $payment_detail->isPaid ? trans('paymentForm.paid') : trans('paymentForm.unpaid') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="content_block more_cont_view">
                                        <h2>{{ __('paymentForm.method_of_payment') }}</h2>
                                        <div class="checkout_optview payment_opt_details">
                                            <div class="inp_row">
                                                <div class="form-group">
                                                    <div class="memberships_nam radio">
                                                        <input type="radio" id="payment_opt1" name="radio_group_pay"
                                                            value="credit"
                                                            {{ request()->type != 'bank' ? 'checked' : '' }}>
                                                        <label
                                                            for="payment_opt1">{{ __('paymentForm.Credit_Card') }}</label>
                                                    </div>
                                                    <div class="memberships_nam radio">
                                                        <input type="radio" id="payment_opt3" name="radio_group_pay"
                                                            value="bank"{{ request()->type == 'bank' ? 'checked' : '' }}>
                                                        <label for="payment_opt3">
                                                            {{ __('paymentForm.Bank_Account') }}</label>
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
                                                <input type="hidden" name="new_key" id="new_key" value="0">
                                                <div class="frombtn_wrap select_optblock">
                                                    <div class="select_card_opt" id="card_acc_sec">
                                                        <div class="form-group">
                                                            <div class="inp_cont_view noicon_opt">
                                                                <div class="selectcont ">
                                                                    <div class="arrowdown2">
                                                                        <i class="far fa-chevron-down"></i>
                                                                    </div>
                                                                    <div id="old_card">
                                                                        <select class="select_opt" name="old_card">
                                                                            @foreach ($data['pay_methods_card']->data as $card)
                                                                                <option value="{{ $card->id }}"
                                                                                    {{ request()->type == 'card' && request()->acc_id == $card->id ? 'selected' : '' }}>
                                                                                    XXX XXX XXXX
                                                                                    {{ $card->four_digits_number }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div id="old_acc">
                                                                        <select class="select_opt" name="old_acc">
                                                                            @foreach ($data['pay_methods_acc']->data as $acc)
                                                                                <option value="{{ $acc->id }}"
                                                                                    {{ request()->type == 'bank' && request()->acc_id == $acc->id ? 'selected' : '' }}>
                                                                                    XXX XXX XXXX
                                                                                    {{ $acc->account_last_digits }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="def_btnopt2 frombtn frombtn2">
                                                        <button type="button" class="btn2"
                                                            id="add_pay_method">{{ __('paymentForm.Add_Payment_Method') }}</button>
                                                    </div>
                                                </div>
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
                                                                    oninput="onlynumshow(event)" maxlength="5"
                                                                    value="{{ old('transit_number') }}">
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
                                                                <input type="text" name="institution"
                                                                    class="form-control" placeholder=""
                                                                    oninput="onlynumshow(event)" maxlength="3"
                                                                    value="{{ old('institution') }}">
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
                                                                    class="form-control" placeholder=""
                                                                    oninput="onlynumshow(event)" maxlength="12"
                                                                    value="{{ old('account_number') }}">
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
                                                                    class="form-control" placeholder=""
                                                                    oninput="onlyletterhow(event)"
                                                                    value="{{ old('owner_names') }}">
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
                                                                    class="form-control" placeholder=""
                                                                    oninput="onlyletterhow(event)"
                                                                    value="{{ old('owner_name') }}">
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
                                                                <input type="text" name="pan"
                                                                    class="form-control" placeholder=""
                                                                    oninput="onlynumshow(event)" maxlength="16"
                                                                    value="{{ old('pan') }}">
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
                                                                <input type="text" name="four_digits_number"
                                                                    class="form-control" placeholder=""
                                                                    oninput="onlynumshow(event)" maxlength="4"
                                                                    value="{{ old('four_digits_number') }}">
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
                                                                <input type="text" name="expiry_month"
                                                                    class="form-control" placeholder=""
                                                                    oninput="onlynumshow(event)" maxlength="2"
                                                                    value="{{ old('expiry_month') }}">
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
                                                                <input type="text" name="expiry_year"
                                                                    class="form-control" placeholder=""
                                                                    oninput="onlynumshow(event)" maxlength="4"
                                                                    value="{{ old('expiry_year') }}">
                                                            </div>
                                                        </div>
                                                        @error('expiry_year')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="aboundopt">
                                                    <p>{{ __('paymentForm.Amount_to_be_paid') }}:
                                                        {{ $total }}$</p>
                                                </div>
                                                <div class="form-group" id="checkboxtermssuitablity">
                                                    <div class="checkbox_block">
                                                        <div class="inp_row remember_opt">
                                                            <div class="form-group">
                                                                <div class="checkbox">
                                                                    <input class="styled-checkbox" type="checkbox"
                                                                        name="check1" id="checkbox1" value="value1"
                                                                        onclick="checksignup()">
                                                                    <label
                                                                        for="checkbox1">{{ __('paymentForm.accept') }}
                                                                        <a target="_blank"
                                                                            href="{{ route('front.terms') }}">{{ __('paymentForm.terms') }}</a></label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="checkbox">
                                                                    <input class="styled-checkbox" type="checkbox"
                                                                        name="check2" id="checkbox2" value="value2"
                                                                        onclick="checksignup()">
                                                                    <label
                                                                        for="checkbox2">{{ __('paymentForm.accept') }}
                                                                        <a target="_blank"
                                                                            href="{{ route('front.privacy') }}">{{ __('paymentForm.suitability') }}</a></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="frombtn_wrap">
                                                    <div class="def_btnopt2 frombtn frombtn2">
                                                        <button type="submit" class="btn2" id="btnformsave"
                                                            disabled>{{ __('newMembership.Save') }}</button>
                                                        <button type="submit" class="btn2"
                                                            id="btnaccsave">{{ __('newMembership.Saveapaymentmethod') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('footer')
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#bank_details').hide();
                $('#credit_details').hide();
                $('#card_acc_sec').show();
                $('#btnaccsave').hide();
                var type = "{{ request()->type }}"
                if (type == "bank") {
                    $('#old_card').hide();
                    $('#old_acc').show();

                } else {
                    $('#old_card').show();
                    $('#old_acc').hide();
                }
                $('#add_pay_method').click(function() {
                    $('#card_acc_sec').hide();
                    $('#btnaccsave').show();
                    $('#btnformsave').hide();
                    $('#checkboxtermssuitablity').hide();
                    $("#new_key").val(1);
                    let radio_group_pay = $('input[name="radio_group_pay"]:checked').val();
                    if (radio_group_pay == 'bank') {
                        $('#bank_details').show();
                        $('#credit_details').hide();
                        $('#old_card').hide();
                        $('#old_acc').hide();
                    } else if (radio_group_pay == 'credit') {
                        $('#bank_details').hide();
                        $('#credit_details').show();
                        $('#old_card').hide();
                        $('#old_acc').hide();
                    } else {
                        console.log('not selected radio' + radio_group_pay);
                    }
                });
                $('input[type=radio][name=radio_group_pay]').change(function() {
                    $('#checkboxtermssuitablity').show();
                    $('#card_acc_sec').show();
                    $('#btnaccsave').hide();
                    $('#btnformsave').show();
                    $("#new_key").val(0);
                    if (this.value == 'bank') {
                        $('#bank_details').hide();
                        $('#credit_details').hide();
                        $('#old_card').hide();
                        $('#old_acc').show();
                    } else {
                        $('#bank_details').hide();
                        $('#credit_details').hide();
                        $('#old_card').show();
                        $('#old_acc').hide();
                    }
                });
            });

            function checksignup() {
                var checkbox1 = document.getElementById("checkbox1").checked;
                var checkbox2 = document.getElementById("checkbox2").checked;
                if (checkbox1 && checkbox2) {
                    document.getElementById("btnformsave").disabled = false;
                } else {
                    document.getElementById("btnformsave").disabled = true;
                }
            }

            function onlyletterhow(event) {
                let inputvalue = event.target.value;
                inputvalue = inputvalue.replace(/[^a-z A-Z\\.]+/g, ''); // Remove non-numeric characters
                event.target.value = inputvalue;
            }

            function onlynumshow(event) {
                let inputvalue = event.target.value;
                inputvalue = inputvalue.replace(/\D/g, ''); // Remove non-numeric characters
                event.target.value = inputvalue;
            }
        </script>
    @endpush
</x-app-layout>
