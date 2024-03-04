<x-app-layout>
    @section('title', $data['title'] . ' |')
    @section('style', '--sub_btnhover-bg: '.$primary_button_color_hover->value .';--sub_btn-bg: '.$button->value. ';--theme-bg:' .$theme->value.';--secondary_theme:' .$theme->value)
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">
                <h2>{{__('newMembership.memberships') }}</h2>
                <div class="prod_item_wrap" id="home_prod_item">
                    <div class="from_cont_wrap" style="flex: 0 100%;">
                        <form
                            action="{{ route('newMembershipSteptwosave', ['id' => $data['subscription_plan']->data->id]) }}"
                            method="post">
                            @csrf
                            <div class="fromdes_info2">
                                <div class="content_block packge_des newsub_opt">
                                    <div class="packge_wrap_opt prod_view">
                                        <div class="optionwrap_block">
                                            @if (isset($data['subscription_plan']) &&
                                                    isset($data['subscription_plan']->data) &&
                                                    count($data['subscription_plan']->data->options))
                                                @foreach ($data['subscription_plan']->data->options as $item)
                                                    <div class="optionitem_add">
                                                        <h3>{{ __('newMembership.option') }} {{ $loop->iteration }}</h3>
                                                        <div class="optionitem_block">
                                                            <div class="opt_add">
                                                                @if($item->image == null)
																<img src="{{asset('public/images/prod_img1.png')}}" alt="">
																@else
																<img src="data:image/png;base64,{{$item->image}}" alt="">
																@endif
                                                            </div>
                                                            <div class="optionitem_des">
                                                                @if( $item->name )
                                                                <p>{{ $item->name }}</p>
                                                                @else
                                                                <p>&nbsp;</p>
                                                                @endif
                                                                <div class="price_opt_add">{{ number_format($item->price,2) }}$</div>
                                                                <div class="optionitem_prod">
                                                                    <span>{{ __('newMembership.quantity') }}:
                                                                        {{ $item->quantity }} X
                                                                        {{ $item->deliverable_quantity }}</span>
                                                                    <span>{{ __('newMembership.price') }}:
                                                                        {{ number_format($item->price,2) }}$</span>
                                                                </div>
                                                                <div class="optionitem_checkopt">
                                                                    <div class="form-group">
                                                                        <div class="checkbox">
                                                                            <input name="add_on[]"
                                                                                class="styled-checkbox2"
                                                                                id="Option{{ $loop->iteration }}"
                                                                                value="{{ $item->id }}|{{ $item->name }}"
                                                                                type="checkbox">
                                                                            <label for="Option{{ $loop->iteration }}">
                                                                                @if ($item->is_initial)
                                                                                    {{ __('newMembership.initial_fee') }}
                                                                                    <em>(
                                                                                        {{ __('newMembership.onetime') }})</em>
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
                                            <h4>{{ __('suscription.nop') }} *</h4>
                                            <div class="payment_contentblock">
                                                @if (isset($data['subscription_plan']) &&
                                                        isset($data['subscription_plan']->data) &&
                                                        count($data['subscription_plan']->data->prices_per_durations))
                                                    @foreach ($data['subscription_plan']->data->prices_per_durations as $item)
                                                        @if (count($item->installments))
                                                            @foreach ($item->installments as $val)
                                                                <div class="radio">
                                                                    <input type="radio" id="{{ $val->id }}"
                                                                        name="installments"
                                                                        value="{{ $item->duration_id }}|{{ $val->id }}"
                                                                        {{ $loop->index == 0 ? 'required' : '' }}>
                                                                    <label
                                                                        for="{{ $val->id }}">{{ $val->number_of_payments }}
                                                                        {{ __('suscription.payments') }}</label>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="frombtn_wrap">
                                            <div class="def_btnopt2 frombtn frombtn2">
                                                <button type="submit"
                                                    class="btn2">{{ __('newMembership.next') }}</button>
                                                    <button type="button" class="btn2 backbutton"
                                                    onclick="history.back()">{{ __('paymentForm.back') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('footer')
</x-app-layout>
