@extends('layouts.app')

@section('content')
    <div class="main-content shop-page page-404">
        <div class="container">
            <h4 class="main-title">404</h4>
            <h3 class="title">Sorry ! Page not found </h3>
            <h5 class="sub-title">We’re sorry but the page you are looking for does nor exist. You could return to <a
                        href="index.html">homepage</a></h5>
            <div class="widget widget-search">
                <div class="search-block">
                    <div class="search-inner">
                        <input type="text" class="search-info" placeholder="Enter Keywords...">
                        <a href="#" class="search-button"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop