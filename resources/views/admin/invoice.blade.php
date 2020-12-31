<!doctype html>
<html dir="rtl" lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        @page {
            margin: 0;
        }

        .inv {
            width: 7.9cm;


        }

        .center {
            margin: auto;
        }


        body {
            font-family: 'dejavu sans', sans-serif !important;
        }

        /* start::header */
        .header {
            /* background-image: url("{{url('assets/site/images/Login_side_phone.png')}}"); */
            padding: 10px;
            /* margin-bottom: 50px; */
        }

        .header .title {
            color: #000;
            /* float: right;
            width: 80%; */
        }

        .header .logo img {
            width: 50%;
            margin-right: 25%;
            margin-bottom: 10px;
            /* float: left; */
        }

        /* end::header */

        /* start::content */
        .content {
            padding: 10px;
        }

        /* end::content */

        /* start::footer */
        .footer {
            /* background-image: url("{{url('assets/site/images/Login_side_phone.png')}}"); */
            bottom: 0;
            right: 0;
            width: 100%;
            height: 2.5rem;
            color: #000;
            padding: 10px;
        }

        /* end::footer */

        table {
            width: 100%;
        }

        table tr.heading td {
            background: #000;
            border-bottom: 1px solid #000;
            font-weight: bold;
        }

        table tr.item td {
            border-bottom: 1px solid #000;
        }

        table tr.item.last td {
            border-bottom: none;
        }

        table tr.total td:nth-child(4) {
            border-top: 2px solid #000;
            font-weight: bold;
        }

        table tr.heading td {
            background: #000;
            border-bottom: 1px solid #000;
            font-weight: bold;
        }

        table tr.item td {
            border-bottom: 1px solid #000;
        }

        table tr.item.last td {
            border-bottom: none;
        }

        table tr.total td:nth-child(4) {
            border-top: 2px solid #000;
            font-weight: bold;
        }

        .invoice_title {
            overflow: hidden;
            border-bottom: 1px solid #000;
            width: 100%;
            margin-bottom: 10px;
        }

        .invoice_content {
            overflow: hidden;
            width: 100%;
            margin-bottom: 40px;
        }

        .from {
            float: right;
            width: 75%;
        }

        .title_text {
            font-weight: bold;
            font-size: 1rem;
            color: #000;
        }

        .to {
            overflow: hidden;
        }

        .table {
            width: 100%;
            clear: both;
        }

        .table .row {
            overflow: hidden;
            border-bottom: 1px solid #000;
            width: 100%;
            margin-bottom: 15px;
        }

        .table .row .col-1 {
            float: right;
            width: 5%;
        }

        .table .row .col-2 {
            float: right;
            width: 50%;


        }

        .table .row .col-3 {
            float: right;
            width: 20%;
        }

        .table .row .col-4 {
            overflow: hidden;
            width: 23%;
        }

        .order_totle {
            overflow: hidden;
            /* background: lightgray; */
            width: 100%;
            margin-bottom: 15px;
            padding: 5px;
        }

        .order_totle .title {
            float: right;
            width: 45%;
        }

        .order_totle .totle {
            overflow: hidden;
            float: left;
        }

        .w-100 {

            width: 100%;

        }

        .title_text {

            margin: 5px;
        }
    </style>
</head>

<body>

    <div class="inv center">

        <div class="header">
            <div>
                <div class="logo center">
                    <img src="{{url('assets/img/black_logo.png')}}" alt="">
                </div>
                <div class="title">
                    <span>
                        رقم الفاتورة: {{$order->id}}
                    </span>
                    <br>
                    <span>
                        تاريخ الفاتورة: {{$order->created_at}}
                    </span>
                </div>
            </div>

        </div>
        <div class="content">




            <div class="invoice_title">
                <div class="from w-100">
                    <h6 class="title_text w-100">الفاتورة من</h6>
                    <div class="from">
                        <div>{{$order->merchant->username}}</div>
                        <div>{{$order->store->name}}</div>
                        <div>{{$order->merchant->mobile}}</div>
                        <div>{{$order->merchant->address}}</div>
                    </div>

                </div>
                <div class="to w-100">
                    <h6 class="title_text w-100">الفاتورة إلى</h6>
                    <div class="to">
                        <div>{{$order->order_user->client->mobile}}</div>
                    </div>

                </div>
                <br>
            </div>
            <br>

            <br>

            <div class="table">
                <div class="row">
                    <div class="col col-1">#</div>
                    <div class="col col-2">المنتج</div>
                    <div class="col col-3">العدد</div>
                    <div class="col col-4">السعر</div>
                </div>
                @foreach($order->order_products as $order_product)
                <div class="row">
                    <div class="col col-1">{{$loop->iteration}}</div>
                    <div class="col col-2">{{$order_product->product->name}}</div>
                    <div class="col col-3">{{$order_product->qty}}</div>
                    <div class="col col-4">{{$order_product->total_price}} SAR</div>
                </div>
                @endforeach
            </div>
            <div class="order_totle">
                <div class="title">التوصيل:</div>
                <div class="totle">{{$order->shipment_price}} SAR</div>
            </div>
            <div class="order_totle">
                <div class="title">المجموع:</div>
                <div class="totle">{{$order->products_price}} SAR</div>
            </div>
        </div>
        <div class="footer">
            <span>Dragon Mart</span>
            <br>
            <span>القيمة شاملة الضريبة</span>
        </div>



    </div>

</body>

</html>