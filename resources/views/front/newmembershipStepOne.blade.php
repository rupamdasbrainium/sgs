<x-app-layout>
    @section('title', $data['title'] . ' |')
    @include('header')
    <section class="maincontent_wrap inner_pageouter">
        <div class="inner_page_wrap">
            @include('layouts.sidebar')
            <div class="inner_page_des">
                <h2>{{ $data['title'] }}</h2>
                <div class="prod_item_wrap" id="home_prod_item">
                    @foreach ($data['all_plan']->data as $key => $item)
                        @php
                            $values = $data['all_plan_details'][$key];
                        @endphp
                        <div class="prod_item" style="--hover_bg: {{ $theme_color_hover->value }}">
                            <div class="action_opt action_opt_title"
                                style="--sushover-bg:{{ $secondary_theme_color_hover->value }}; background-color: {{ $theme->value }}">
                                <div class="action_text">
                                    <div class="selectcont ">
                                        <div class="arrowdown2">
                                        </div>
                                        <select class="select_opt" title=" {{ $values->name }}">
                                            <option value="{{ $values->id }}">
                                                {{ substr($values->name, 0, 13) }}...
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="action_opt">
                                <div class="price_text">
                                    @if (isset($values))
                                        @if (count($values->priceBydurations))
                                            <div class="selectcont ">
                                                <div class="arrowdown2">
                                                    <i class="fal fa-chevron-down"></i>
                                                </div>
                                                <select class="select_opt optionclass"
                                                    style="--secondary_theme: {{ $theme->value }}">
                                                    @foreach ($values->priceBydurations as $val)
                                                        <option>{{ $val->price }}$<span>/
                                                                {{ $val->typeDuration }}</span> For
                                                            {{ $val->frequency }} {{ $val->typeDuration }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            0$
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="individual_opt">
                                <div class="individual_head" style="background-color: {{ $theme->value }}">
                                    {{ __('global.age') }} : {{ $values->ageLimit }}
                                </div>
                                <div class="individual_des">
                                    <ul>
                                        @if (isset($values))
                                            @if (isset($values->marketingBools))
                                                @foreach ($values->marketingBools as $val)
                                                    <li><span><i
                                                                class="fal fa-times"></i></span>{{ $val->description }}
                                                    </li>
                                                @endforeach
                                            @endif
                                        @endif
                                    </ul>
                                    <div class="subscribe_btn">
                                        <a href="{{ route('newMembershipSteptwo', [$values->id]) }}" class="sub_btn"
                                            style="--sub_btnhover-bg:{{ $primary_button_color_hover->value }}; background-color: {{ $button->value }}">{{ __('global.subscribe') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @include('footer')
</x-app-layout>
