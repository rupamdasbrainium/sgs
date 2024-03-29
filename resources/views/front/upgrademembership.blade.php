<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">
                <div class="content_block memberships">
                    <h2>{{ __('upgrademembership.Memberships') }}</h2>
                    @if ($data['membership']->data == null)
                        <div class="memberships_content">
                            <center> {{ __('upgrademembership.no_data_available') }}</center>
                        </div>
                    @else
                        <div class="memberships_content memberships2">
                            @foreach ($data['membership']->data as $itemmain)
                                <div class="memberships_item_block @if ($loop->index == 0) activecheckopt @endif">
                                    <div class="memberships_opt ">
                                        <div class="memberships_nam radio">
                                            <input type="hidden" name="typeId" value="{{ $itemmain->typeId }}">
                                            <input type="hidden" name="date_begin" value="{{ $itemmain->begin }}">
                                            <input type="hidden" name="membershipid" value="{{ $itemmain->membershipsId }}">
                                            <input type="radio" id="testnum{{ $loop->iteration }}" name="radio-group">
                                            <label
                                                for="testnum{{ $loop->iteration }}">{{ $itemmain->type }}
                                                {{  number_format($itemmain->recurantCharge,2) }}$ {{ __('upgrademembership.per_Month') }}
                                            </label>
                                        </div>
                                        <div class="memberships_method_view">
                                            <div class="memberships_method">
                                                {{ __('upgrademembership.Method_of_payment') }}:</div>
                                            <div class="memberships_method_opt">
                                                <div class="selectcont ">
                                                    <div class="arrowdown2">
                                                        <i class="fal fa-chevron-down"></i>
                                                    </div>
                                                    <select class="select_opt pid" name="card_id">
                                                        @foreach ($data['pay_methods_card']->data as $card)
                                                            <option
                                                                value="{{ $itemmain->membershipsId }}|card|{{ $card->id }}">
                                                                XXX XXX XXXX
                                                                {{ $card->four_digits_number }}{{ __('myProfile.Card') }}</option>
                                                        @endforeach
                                                        @foreach ($data['pay_methods_bank']->data as $bank)
                                                            <option
                                                                value="{{ $itemmain->membershipsId }}|account|{{ $bank->id }}">
                                                                XXX XXX XXXX
                                                                {{ $bank->account_last_digits }}{{ __('myProfile.Bank') }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ranew_opt_block">
                                            <div class="memberships_method_date">
                                                {{ __('upgrademembership.End_date') }}:
                                                {{ date('Y-m-d', strtotime($itemmain->end)) }}</div>
                                        </div>
                                    </div>
                                    <div class="more_content_block ">
                                        <div class="content_block more_cont_view">
                                            <h2>{{ __('upgrademembership.Membership_Options_Add-ons') }}</h2>
                                            <div class="optionwrap_block">
                                                @php
                                                    $subscription_plan = json_decode(APICall('SubscriptionPlans/type/' . $itemmain->typeId . '?language_id=' . $itemmain->languageId, 'get', '{}', 'client_app'));
                                                @endphp
                                                @if (isset($subscription_plan) && isset($subscription_plan->data) && count($subscription_plan->data->options))
                                                    @foreach ($subscription_plan->data->options as $item)
                                                        <div class="optionitem_add">
                                                            <h3 style="background-color: {{ $theme->value }}">
                                                                {{ __('upgrademembership.Option') }}
                                                                {{ $loop->iteration }} </h3>
                                                            <div class="optionitem_block">
                                                                <div class="opt_add">
                                                                    <img src="{{ asset('public/images/prod_img1.png') }}" alt="">
                                                                </div>
                                                                <div class="optionitem_des">
                                                                    <p>{{ $item->name }}</p>
                                                                    <div class="price_opt_add">{{  number_format($item->price,2) }}$
                                                                    </div>
                                                                    <div class="optionitem_prod">
                                                                        <span>{{ __('upgrademembership.Quantity') }}:
                                                                            {{ $item->quantity }} X
                                                                            {{ $item->deliverable_quantity }}</span>
                                                                        <span>{{ __('upgrademembership.Price') }}:{{  number_format($item->price,2) }}$
                                                                        </span>
                                                                    </div>
                                                                    <div class="optionitem_checkopt">
                                                                        <div class="form-group">
                                                                            <div class="checkbox">
                                                                                <input name="add_on[]"
                                                                                    class="styled-checkbox2"
                                                                                    id="Option{{ $itemmain->membershipsId }}{{ $loop->iteration }}"
                                                                                    value="{{ $item->id }}"
                                                                                    type="checkbox">
                                                                                <label
                                                                                    for="Option{{ $itemmain->membershipsId }}{{ $loop->iteration }}">
                                                                                    @if ($item->is_initial)
                                                                                        {{ __('newMembership.initial_fee') }}
                                                                                        <em>({{ __('newMembership.onetime') }})</em>
                                                                                    @endif
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="payment_block">
                                                <div class="payment_contentblock">
                                                    @if (isset($subscription_plan) &&
                                                            isset($subscription_plan->data) &&
                                                            count($subscription_plan->data->prices_per_durations))
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="frombtn_wrap">
                                                <div class="def_btnopt2 frombtn frombtn2">
                                                    @if (count($data['pay_methods_card']->data))
                                                        <a href="{{ route('upgragemembershipsubmit', [$itemmain->membershipsId, $data['pay_methods_card']->data[0]->id]) }}"
                                                            class="sub_btn" id="submit_{{ $itemmain->membershipsId }}"
                                                            style="--sub_btnhover-bg:{{ $primary_button_color_hover->value }}; background-color: {{ $button->value }}">{{ __('upgrademembership.Pay_Now') }}
                                                        </a>
                                                    @else
                                                        <a href="{{ route('upgragemembershipsubmitbank', [$itemmain->membershipsId, $data['pay_methods_bank']->data[0]->id]) }}"
                                                            class="sub_btn" id="submit_{{ $itemmain->membershipsId }}"
                                                            style="--sub_btnhover-bg:{{ $primary_button_color_hover->value }}; background-color: {{ $button->value }}">{{ __('upgrademembership.Pay_Now') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('footer')
    @push('scripts')
        <script>
            document.getElementById('testnum1').checked = true;
        </script>
        <script>
            $(document).ready(function() {
                $(this).on('change', '.pid', function() {
                    var pay_id = $(this).val();
                    var data_arr = pay_id.split("|");
                    var url = "{{ route('dashboard') }}";
                    var ret = url.replace('dashboard', '');
                    if (data_arr[1] == "card") {
                        $('#submit_' + data_arr[0]).attr('href', ret + 'upgragemembershipsubmit/card/' +
                            data_arr[0] + '/' + data_arr[2]);
                    } else {
                        $('#submit_' + data_arr[0]).attr('href', ret + 'upgragemembershipsubmit/account/' +
                            data_arr[0] + '/' + data_arr[2]);
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>

{{-- {{ $itemmain->type }} --}}