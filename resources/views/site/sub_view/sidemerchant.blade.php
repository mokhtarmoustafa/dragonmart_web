<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 sidebar">
    <form>
        @php

            $parameters = \Request::query();
            $merchants =merchants();

        @endphp

        @if(request()->segment(2)  != 'merchant-page')
            <div class="widget widget-categories">
                <h5 class="widgettitle">{{trans(lang_app_site().'.home.merchants')}}</h5>
                <ul class="list-categories scrollable-area" style="max-height: 200px;">


                    @foreach($merchants as $m)
                        <li><input type="checkbox" name="merchan_filter[]" id="nc{{$m->id}}"
                                   value="{{$m->id}}" {{ (isset($parameters['merchan_filter']) && in_array(  $m->id , $parameters['merchan_filter']) ) ? 'checked' : '' }}><label
                                    for="nc{{$m->id}}" class="label-text">{{$m->username}}</label>
                        </li>

                    @endforeach


                </ul>
            </div>
        @endif


        @if(request()->segment(2)  != 'category')
            <div class="widget widget-brand">
                <h5 class="widgettitle">{{trans(lang_app_site().'.home.categories')}}</h5>
                <ul class="list-categories">
                    @php
                        $cats =Categories();
                    @endphp
                    @foreach($cats as $cat)
                        <li>
                            <input type="checkbox" name="categories_filter[]" id="catf{{$cat->id}}"
                                   value="{{$cat->id}}" {{ (isset($parameters['categories_filter']) && in_array(  $cat->id , $parameters['categories_filter']) ) ? 'checked' : '' }}>
                            <label for="catf{{$cat->id}}" class="label-text">{{$cat->name}}</label>
                        </li>

                    @endforeach
                </ul>
            </div>
        @endif
        <div class="widget widget-brand">
            <h5 class="widgettitle">{{trans(lang_app_site().'.filter.cities')}}</h5>
            <ul class="list-categories">
                <select class="input-info chosen-select" name="city">
                    @php
                        $cities=cities();
                    @endphp
                    @foreach($cities as $city)
                        <option value="all">{{trans(lang_app_site().'.filter.all_cities')}}</option>
                        <option value="{{$city->id}}" {{ (isset($parameters['city']) &&  $city->id  ==  $parameters['city'] ) ? 'selected' : '' }} >{{$city->name_en}}</option>
                    @endforeach
                </select>
            </ul>
        </div>
        <div class="widget widget_filter_price box-has-content">
            <h3 class="widgettitle">{{trans(lang_app_site().'.filter.price')}}</h3>
            <div class="price-filter">
                <div data-label-reasult="{{trans(lang_app_site().'.filter.price')}}:" data-min="1" data-max="9000"
                     data-unit="{{trans(lang_app_site().'.home.sar')}}"
                     class="slider-range-price "
                     data-value-min="{{ (isset($parameters['min_price_filter'])  ) ? $parameters['min_price_filter'] : '1' }} "
                     data-value-max="{{ (isset($parameters['max_price_filter'])  ) ? $parameters['max_price_filter'] : '9000' }}"></div>
                <div class="amount-range-price">{{trans(lang_app_site().'.filter.price')}}: <span
                            class="from">{{ (isset($parameters['min_price_filter'])  ) ? $parameters['min_price_filter'] : '1' }}  {{trans(lang_app_site().'.home.sar')}}</span>
                    -
                    <span class="to">{{ (isset($parameters['max_price_filter'])  ) ? $parameters['max_price_filter'] : '9000' }} {{trans(lang_app_site().'.home.sar')}}</span>
                </div>
            </div>
        </div>
        <div class="widget widget_filter_price box-has-content mner">
            <h3 class="widgettitle">{{trans(lang_app_site().'.filter.near_by')}}</h3>
            <div class="near-by-filter">
                <div data-label-reasult="{{trans(lang_app_site().'.filter.near_by')}}:" data-min="0" data-max="30"
                     data-unit="K"
                     data-distance="{{trans(lang_app_site().'.filter.distance')}}"
                     class="slider-near-by"
                     data-value-min="{{ (isset($parameters['min_near_filter'])  ) ? $parameters['min_near_filter'] : '0' }} "
                     data-value-max="{{ (isset($parameters['max_near_filter'])  ) ? $parameters['max_near_filter'] : '30' }} "></div>


            </div>
            <div class="amount-range-nearby" style="margin-top: 10px;">{{trans(lang_app_site().'.filter.distance')}}:
                <span class="from">{{ (isset($parameters['min_near_filter'])  ) ? $parameters['min_near_filter'] : '0' }}  K</span>
                - <span class="to">{{ (isset($parameters['max_near_filter'])  ) ? $parameters['max_near_filter'] : '30' }} K</span>
            </div>
        </div>

        <div class="group-button">

            <input type="hidden" name="min_price_filter" id="min_price_filter" value="0">
            <input type="hidden" name="max_price_filter" id="max_price_filter" value="9000">
            <input type="hidden" name="min_near_filter" id="min_near_filter" value="0">
            <input type="hidden" name="max_near_filter" id="max_near_filter" value="30">
            <input type="hidden" name="url_filter" value="{{request()->segment(2)}}">

            <button class="button btn-success btn"
                    style="width:100%;text-align:center;">{{trans(lang_app_site().'.filter.apply_filter')}}</button>
    </form>
</div>
</div>


<?php


?>


