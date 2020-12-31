<!doctype html>
<html dir="rtl" lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        @page  {
            margin: 0;
        }

        body {
            font-family: 'dejavu sans', sans-serif !important;
        }

        /* start::header */
        .header {
            background-image: url("<?php echo e(url('assets/site/images/Login_side_phone.png')); ?>");
            padding: 10px;
            margin-bottom: 50px;
        }

        .header .title {
            color: #ffffff;
            float: right;
            width: 80%;
        }

        .header .logo {
            width: 100px;
            float: left;
        }

        /* end::header */

        /* start::content */
        .content {
            padding: 10px;
        }

        /* end::content */

        /* start::footer */
        .footer {
            background-image: url("<?php echo e(url('assets/site/images/Login_side_phone.png')); ?>");
            bottom: 0;
            right: 0;
            position: fixed;
            width: 100%;
            height: 2.5rem;
            color: #ffffff;
            padding: 10px;
        }

        /* end::footer */

        table {
            width: 100%;
        }

        table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        table tr.item td {
            border-bottom: 1px solid #eee;
        }

        table tr.item.last td {
            border-bottom: none;
        }

        table tr.total td:nth-child(4) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        table tr.item td {
            border-bottom: 1px solid #eee;
        }

        table tr.item.last td {
            border-bottom: none;
        }

        table tr.total td:nth-child(4) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .invoice_title {
            overflow: hidden;
            border-bottom: 1px solid #ebedf3;
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
            width: 50%;
        }

        .title_text {
            font-weight: bold;
            font-size: 1rem;
            color: #b5b5c3;
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
            border-bottom: 1px solid #ebedf3;
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

        .order_totle{
            overflow: hidden;
            background: lightgray;
            width: 100%;
            margin-bottom: 15px;
            margin-right: 54%;
            padding: 5px;
        }

        .order_totle .title{
            float: right;
            width: 45%;
        }

        .order_totle .totle{
            overflow: hidden;
            width: 23%;
            color: red;
        }

    </style>
</head>

<body>

    <div class="header">
        <div>
            <div class="title">
                <span>
                    رقم الفاتورة: <?php echo e($order->id); ?>

                </span>
                |
                <span>
                    تاريخ الفاتورة: <?php echo e($order->actual_received_date); ?>

                </span>
            </div>
            <div class="logo">
                <img src="<?php echo e(url('assets/site/images/white_DragonMart.png')); ?>" alt="">
            </div>
        </div>

    </div>
    <div class="content">
        <div class="invoice_title">
            <div class="from">
                <span class="title_text">الفاتورة من</span>
            </div>
            <div class="to">
                <span class="title_text">الفاتورة إلى</span>
            </div>
        </div>
        <div class="invoice_content">
            <div class="from">
                <div><?php echo e($order->merchant->username); ?></div>
                <div><?php echo e($order->merchant->mobile); ?></div>
                <div><?php echo e($order->merchant->address); ?></div>
            </div>
            <div class="to">
                <div><?php echo e($order->order_user->client->username); ?></div>
                <div><?php echo e($order->order_user->client->mobile); ?></div>
                <div><?php echo e($order->order_user->client->email); ?></div>
                <div><?php echo e($order->order_user->client->address); ?></div>
            </div>
        </div>
        <div class="table">
            <div class="row">
                <div class="col col-1">#</div>
                <div class="col col-2">المنتج</div>
                <div class="col col-3">العدد</div>
                <div class="col col-4">السعر</div>
            </div>
            <?php $__currentLoopData = $order->order_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col col-1"><?php echo e($loop->iteration); ?></div>
                <div class="col col-2"><?php echo e($order_product->product->name); ?></div>
                <div class="col col-3"><?php echo e($order_product->qty); ?></div>
                <div class="col col-4"><?php echo e($order_product->total_price); ?> SAR</div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="order_totle">
            <div class="title">المجموع:</div>
            <div class="totle"><?php echo e($order->products_price); ?> SAR</div>
        </div>
    </div>
    <div class="footer">
        <span>Dragon Mart <a href="<?php echo e(url('/')); ?>"><?php echo e(url('/')); ?></a></span>
    </div>

</body>

</html><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/invoice.blade.php ENDPATH**/ ?>