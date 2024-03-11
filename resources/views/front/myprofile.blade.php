<x-app-layout>
    @section('title', $data['title'] . ' |')
    @section('style', ';--sub_btn-bg: ' . $button->value . ';--sub_btnhover-bg:' . $primary_button_color_hover->value)
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">
                <div class="content_block accountinfo">
                    <div class="blocktitle">
                        <h2>{{ __('myProfile.My_Profile') }}</h2>
                        <h3 class="subtitle">{{ $client->firstname . ' ' . $client->lastname }}</h3>
                        <div class="account_des">
                            <span class="acc_des_title">{{ __('myProfile.My_Address') }}: </span>
                            <span class="acc_des_info">{{ getAddress($client->adress) }} </span>
                            <span class="accountedit"><a
                                    href="{{ route('myContactInformation') }}">{{ __('myProfile.Edit') }}</a>
                            </span><br>
                            <span class="acc_des_status">{{ __('myProfile.Status') }}: {{ $client->status }} </span><br>
                            <span class="acc_des_status">{{ __('myProfile.Message') }}:
                                {{ $client->communication_ToClient }} </span><br>
                        </div>
                        <div class="account_leng">
                            <div class="account_leng_title">{{ __('myProfile.communication_language') }}</div>
                            <form action="{{ route('userLanguageUpdate') }}" method="POST">
                                @csrf
                                <div class="account_leng_opt">
                                    <div class="account_select_opt">
                                        <div class="selectcont ">
                                            <div class="arrowdown2">
                                                <i class="fal fa-chevron-down"></i>
                                            </div>
                                            <select class="select_opt" name="language_id">
                                                @foreach ($languages as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $client->language_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->display }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="account_leng_opt_btn">
                                        <div class="def_btnopt2 frombtn">
                                            <button type="submit" class="btn2">{{ __('myProfile.Submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="content_block memberships">
                    <h2>{{ __('myProfile.Memberships') }}</h2>

                    @if ($membership->data == null)

                        <div class="memberships_content memberFlexbox">
                            {{ __('myProfile.No_Membership') }}
                        </div>
                    @else
                        <div class="memberships_content memberFlexbox">
                            @foreach ($membership->data as $item)
                                <div class="memberships_opt mb-2 menbershipNewblock">
                                    <div class="memberships_nam">{{ $item->type }} {{ number_format($item->recurantCharge,2) }}$
                                        {{ __('myProfile.per_Month') }}</div>
                                        @if($item->options)  
                                        <div class="memberships_nam">{{ __('newMembership.memberships') }}: {{ $item->options }}  </div> 
                                        @else
                                        <div class="memberships_nam">{{ __('newMembership.memberships') }}:   {{ __('paymentForm.none') }} </div>   
                                        @endif                                                                  
                                    <div class="memberships_method_view">
                                        <div class="memberships_method">{{ __('myProfile.Method_of_payment') }}:</div>
                                        <div class="memberships_method_opt">
                                            <div class="selectcont ">
                                                <div class="arrowdown2">
                                                    <i class="fal fa-chevron-down"></i>
                                                </div>
                                                <select class="select_opt paymethod" id="paymethods">
                                                    @if ($data['cards'] != null)
                                                        @foreach ($data['cards'] as $card)
                                                            <option value="{{ $card->id }}" data-type="card"
                                                                data-membershipsid="{{ $item->membershipsId }}"
                                                                {{ $item->creditCardId && $item->creditCardId == $card->id ? 'selected' : '' }}>
                                                                xxx xxx xxxx {{ $card->four_digits_number }}
                                                                {{ __('myProfile.Card') }}</option>
                                                        @endforeach
                                                    @endif
                                                    @if ($data['banks'] != null)
                                                        @foreach ($data['banks'] as $bank)
                                                            <option value="{{ $bank->id }}" data-type="bank"
                                                                data-membershipsid="{{ $item->membershipsId }}"
                                                                {{ $item->bancAccountId && $item->bancAccountId == $bank->id ? 'selected' : '' }}>
                                                                xxx xxx xxxx {{ $bank->account_last_digits }}
                                                                {{ __('myProfile.Bank') }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="ranew_opt_block">
                                        <div class="memberships_method_date">{{ __('myProfile.begin_date') }}:
                                            {{ date('Y/m/d', strtotime($item->begin)) }} </div>
                                        <div class="memberships_method_date">{{ __('myProfile.End_date') }}:
                                            {{ date('Y/m/d', strtotime($item->end)) }} </div>

                                        <div class="ren_opt" id="renew">
                                            @if ($item->isRenewable)
                                                @if ($item->creditCardId)
                                                    <a id="link_{{ $item->membershipsId }}"
                                                        href="{{ route('renewMembership', [$item->membershipsId, 'card' => $item->creditCardId]) }}">{{ __('myProfile.Renew') }}</a>
                                                @elseif ($item->bancAccountId)
                                                    <a id="link_{{ $item->membershipsId }}"
                                                        href="{{ route('renewMembership', [$item->membershipsId, 'bank' => $item->bancAccountId]) }}">{{ __('myProfile.Renew') }}</a>
                                                @else
                                                    <a id="link_{{ $item->membershipsId }}"
                                                        href="{{ route('renewMembership', $item->membershipsId) }}">{{ __('myProfile.Renew') }}</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="content_block paymentinfo">
                    <h2>{{ __('myProfile.Payment_Details') }}</h2>
                    <div class="table_description_view">
                        <table class="table tbspace">
                            <thead>
                                <tr>
                                    <th>{{ __('myProfile.TYPE') }}</th>
                                    <th>{{ __('myProfile.PAYMENT_DATE') }}</th>
                                    <th>{{ __('myProfile.PAYMENT') }}</th>
                                    <th>{{ __('myProfile.STATUS') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($payments == '')
                                    <tr>
                                        <td colspan="5"> {{ __('myProfile.No_payments_available') }}</td>
                                    </tr>
                                @else
                                    @foreach ($payments as $pt)
                                        <tr>
                                            <td data-label={{ __('myProfile.TYPE') }}>{{ __('myProfile.Payments') }}</td>
                                            <td data-label={{ __('myProfile.PAYMENT_DATE') }}>
                                                {{ date('Y-m-d', strtotime($pt->paymentDate)) }}</td>
                                            <td data-label={{ __('myProfile.PAYMENT') }}>{{ number_format($pt->amount,2) }}$</td>
                                            <td data-label={{ __('myProfile.STATUS') }}>
                                                {{ $pt->is_paid ? __('myProfile.Paid') : __('myProfile.Unpaid') }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('footer')
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(this).on('change', '.paymethod', function() {
                    var type = $(this).find(':selected').data('type')
                    var membershipsid = $(this).find(':selected').data('membershipsid')
                    if (type == 'bank') {
                        var uri = "bank=" + $(this).val()
                    } else {
                        var uri = "card=" + $(this).val()
                    }
                    $('#link_' + membershipsid).attr('href', "{{ url('renewMembership') }}/" + membershipsid +
                        "?" + uri)
                    console.log(type, membershipsid, uri)

                    $.ajax({
                        url: "{{ url('onchangecardbank') }}",
                        type: 'GET',
                        data: {
                            type: type,
                            membershipsid: membershipsid,
                            value: $(this).val(),
                        },
                        success: function(result) {
                            console.log(result);
                            toastr.success("Changed successfully");
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
