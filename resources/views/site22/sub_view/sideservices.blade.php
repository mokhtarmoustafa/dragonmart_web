<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 sidebar">
    <form>
        @php

            $parameters = \Request::query();
            $merchants =merchants();

        @endphp

        @if(request()->segment(2)  != 'merchant-page')
            <div class="widget widget-categories">
                <h5 class="widgettitle">{{trans(lang_app_site().'.services.categories')}}</h5>
                <ul class="list-categories scrollable-area" style="max-height: 200px;">

                    @php
                        $Services =Services();
                    @endphp
                    @foreach($Services as $m)
                        <li><input type="checkbox" name="services_filter[]" id="serv{{$m->id}}"
                                   value="{{$m->id}}" {{ (isset($parameters['services_filter']) && in_array(  $m->id , $parameters['services_filter']) ) ? 'checked' : '' }}><label
                                    for="serv{{$m->id}}" class="label-text">{{$m->name}}</label>
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
                    <option value="all">{{trans(lang_app_site().'.filter.all_cities')}}</option>
                @foreach($cities as $city)
                        <option value="{{$city->id}}" {{ (isset($parameters['city']) &&  $city->id  ==  $parameters['city'] ) ? 'selected' : '' }} >{{$city->name_en}}</option>
                    @endforeach
                </select>
            </ul>
        </div>

        <div class="widget widget_filter_price box-has-content mner">
            <h3 class="widgettitle">{{trans(lang_app_site().'.filter.near_by')}}</h3>
            <div class="near-by-filter">
                <div data-label-reasult="{{trans(lang_app_site().'.filter.near_by')}}:" data-min="0" data-max="30"
                     data-unit="K" data-distance="{{trans(lang_app_site().'.filter.distance')}}"
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

            <button class="button btn btn-success"
                    style="width:100%;text-align:center;">{{trans(lang_app_site().'.filter.apply_filter')}}</button>
    </form>
</div>
</div>


<?php


?>





