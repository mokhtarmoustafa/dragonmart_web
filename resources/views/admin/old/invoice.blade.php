<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        body {
            font-family: 'dejavu sans', sans-serif !important;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(4) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(4) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            /*font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;*/
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(4) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0" border="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>

                        <td class="title" colspan="2">
                            <img src="{{url('assets/apps/img/logo.png')}}" style="width:200px;">
                        </td>
                        <td></td>
                        <td>
                            Invoice #: {{$order->id}}<br>
                            Created: {{$order->actual_received_date}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            {{$order->merchant->username}}.<br>
                            {{$order->merchant->mobile}}.<br>
                            {{$order->merchant->address}}.<br>
                        </td>
                        <td>
                            {{$order->order_user->client->username}}.<br>
                            {{$order->order_user->client->mobile}}<br>
                            {{$order->order_user->client->email}}<br>
                            {{$order->order_user->client->address}}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <td>
                #
            </td>
            <td>
                Item
            </td>

            <td>
                Qty
            </td>
            <td>
                Price
            </td>
        </tr>

        @foreach($order->order_products as $order_product)

            <tr class="item">
                <td>
                    {{$loop->iteration}}
                </td>
                <td>
                    {{$order_product->product->name}}
                </td>
                <td>{{$order_product->quantity}}</td>
                <td>
                    {{$order_product->total_price}} SAR
                </td>
            </tr>
        @endforeach
        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td>
                Total: {{$order->products_price}} SAR
            </td>
        </tr>
        <tr>
            <td>
                Dragonmart Website
            </td>
            <td>
                <a href="{{url('/')}}">{{url('/')}}</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
