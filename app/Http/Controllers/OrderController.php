<?php

namespace App\Http\Controllers;

use App\DriverType;
use App\Expense;
use App\Http\Requests\Api\Order\PayOrderRequest;
use App\Http\Requests\Order\AcceptOrderRequest;
use App\Http\Requests\Order\ReadyOrderRequest;
use App\Http\Requests\Order\AssignDriverRequest;
use App\Order;
use App\OrderProduct;
use App\Repositories\Eloquents\OrderEloquent;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    //
    private $order;

    public function __construct(OrderEloquent $orderEloquent)
    {
        parent::__construct();
        $this->order = $orderEloquent;
    }

    public function orderList()
    {
        $new = Order::where('last_status', 'new')->count();
        $current = Order::where('last_status', 'accepted')->orWhere('last_status', 'progress')->count();
        $completed = Order::where('last_status', 'finished')->count();
        $driver_types = DriverType::all();
        $data = [
            'main_title' => 'Orders',
            'icon' => 'fa fa-shopping-cart',
            'driver_types' => $driver_types,
            'new' => $new,
            'current' => $current,
            'completed' => $completed,
        ];
        return view(admin_order_vw() . '.index', $data);
    }

    public function orderFollowingUp()
    {
        $orders = Order::where('driver_status', '!=', 'delivered')->where('last_status', '!=', 'canceled')->where('last_status', '!=', 'rejected')->where('last_status', '!=', 'pending')->orderByDesc('created_at')->get();
        
        $data = [
            'main_title' => 'Orders Following Up',
            'orders' => $orders,
        ];

        return view('admin.orders_followup', $data);
    }

    public function orderFollowingUpData()
    {
        $orders = Order::where('driver_status', '!=', 'delivered')->where('last_status', '!=', 'canceled')->where('last_status', '!=', 'rejected')->where('last_status', '!=', 'pending')->orderByDesc('created_at')->get();

        return $orders;
    }

    public function clientOrdersData($client_id)
    {
        return $this->order->clientOrdersData($client_id);
    }

    public function merchantOrdersData($merchant_id)
    {
        return $this->order->merchantOrdersData($merchant_id);
    }

    public function ordersData($status) // new, current, completed, late, rejacted
    {
        return $this->order->anyData($status);
    }

    public function revenueOrdersData() // new, current, completed
    {
        return $this->order->revenueOrdersData();
    }

    public function reportOrdersData($status) // new, current, completed
    {
        return $this->order->reportOrdersData($status);
    }

    public function getAssignDriver($order_id) //
    {
        $driver_dragonmart = User::where('type', 'driver')->where('driver_type_id', 1)->where('is_active', 1)->get();

        $data = [
            'order_id' => $order_id,
            'delivery_method' => DriverType::where('id', '<>', 3)->get(),
            'driver_dragonmart' => $driver_dragonmart
        ];
        return view()->make('admin.modals.assigned-driver', $data);
    }

    public function assignDriver(AssignDriverRequest $request) //
    {
        return $this->order->assignDriver($request->all());
    }

    public function orderDet($id)
    {
        $order = Order::find($id);
        $data = [
            'main_title' => 'Order details',
            'icon' => 'fa fa-shopping-cart',
            'order' => $order,
        ];

        // return $order->order_products[0];

        return view(admin_order_vw() . '.order_det', $data);
    }

    public function ordersByType($status)
    {
        if ($status == 'current') {
            $orders = Order::where(function ($query) {
                $query->where('last_status', 'accepted')->orWhere('last_status', 'progress');
            })->orderByDesc('created_at');
        } else
            $orders = Order::where('last_status', $status)->orderByDesc('created_at');

        $data = [
            'main_title' => $status . ' Orders',
            'icon' => 'fa fa-shopping-cart',
            'orders' => $orders->get(),
        ];

        return view(admin_order_vw() . '.order_lists', $data);
    }

    public function revenues()
    {
        $driver_types = DriverType::all();
        $total_revenue = Order::all()->values()->sum('revenue') - Expense::sum('amount');
        $data = [
            'main_title' => 'Revenues',
            'icon' => 'fa fa-money',
            'driver_types' => $driver_types,
            'total_revenue' => $total_revenue,

        ];
        return view(admin_revenue_vw() . '.index', $data);
    }


    // merchant can reject new request , admin can cancel new or current request
    public function canceledOrder($order_id)
    {
        return $this->order->canceledOrder($order_id);
    }

    // merchant can accept new request
    public function acceptOrder(AcceptOrderRequest $request, $order_id)
    {
        return $this->order->acceptOrder($request->all(), $order_id);
    }

    public function readyOrder(ReadyOrderRequest $request, $order_id)
    {
        return $this->order->readyOrder($request->all(), $order_id);
    }

    public function handOverOrder(ReadyOrderRequest $request, $order_id)
    {
        return $this->order->handOverOrder($request->all(), $order_id);
    }

    public function cancelProduct(Request $request, $product_id)
    {
        return $this->order->cancelProduct($request->all(), $product_id);
    }

    //---------merchant
    public function orderListMerchant()
    {
        $driver_types = DriverType::all();
        $new = Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where('last_status', 'new')->count();
        $current = Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where(function ($query) {
            $query->where('last_status', 'accepted')->orWhere('last_status', 'progress');
        })->count();
        $completed = Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where('last_status', 'finished')->count();

        $rejected = Order::where('merchant_id', auth()->guard('admin')->user()->user_id)->where('last_status', 'rejected')->count();

        $data = [
            'main_title' => 'Orders',
            'icon' => 'fa fa-shopping-cart',
            'driver_types' => $driver_types,
            'new' => $new,
            'current' => $current,
            'completed' => $completed,
            'rejected' => $rejected,
        ];
        return view(merchant_order_vw() . '.index', $data);
    }

    public function orderDetMerchant($id)
    {
        $order = Order::find($id);
        $data = [
            'main_title' => 'Order details',
            'icon' => 'fa fa-shopping-cart',
            'order' => $order,
        ];
        return view(merchant_order_vw() . '.order_det', $data);
    }

    public function ordersByTypeMerchant()
    {
        $orders = Order::all();
        $data = [
            'main_title' => 'Orders',
            'icon' => 'fa fa-shopping-cart',
            'orders' => $orders,
        ];
        return view(merchant_order_vw() . '.order_lists', $data);
    }

    public function revenuesMerchant()
    {
        $driver_types = DriverType::all();
        $data = [
            'main_title' => 'Revenues',
            'icon' => 'fa fa-money',
            'driver_types' => $driver_types,
        ];
        return view(merchant_revenue_vw() . '.index', $data);
    }

    public function expensesMerchant()
    {
        $driver_types = DriverType::all();
        $data = [
            'main_title' => 'Expenses',
            'icon' => 'fa fa-money',
            'driver_types' => $driver_types,
        ];
        return view(merchant_expense_vw() . '.index', $data);
    }

    public function viewInvoice($orderId)
    {
        $order = Order::find($orderId);

        if (!isset($order))
            return redirect()->back();

        $data = [
            'main_title' => 'Order details',
            'order' => $order,
        ];


        return view('admin.invoice', $data);

        $pdf = PDF::loadView('admin.invoice', $data);
        return $pdf->stream('invoice(' . $orderId . ').pdf');
    }

    public function viewOrderAcceptMdl($id)
    {
        $order = Order::find($id);
        $html = 'This Order does not exist';
        if (isset($order)) {

            $view = view()->make(merchant_order_vw() . '.accept_order_mdl', [
                'order' => $order,
                'modal_id' => 'accept-order',
                'modal_title' => 'Accept Order (<a href="' . url(merchant_url() . '/order/' . $order->id) . '" target="_blank"><span class="badge badge-success">' . $id . '</span></a>)',
            ]);

            $html = $view->render();
        }
        return $html;
    }

    public function viewOrderReadyMdl($id)
    {
        $order = Order::find($id);
        $html = 'This Order does not exist';
        if (isset($order)) {

            $view = view()->make(merchant_order_vw() . '.ready_order_mdl', [
                'order' => $order,
                'modal_id' => 'ready-order',
                'modal_title' => 'Ready Order (<a href="' . url(merchant_url() . '/order/' . $order->id) . '" target="_blank">' . $id . '</a>)',
            ]);

            $html = $view->render();
        }

        return $html;
    }

    public function viewOrderHandOverMdl($id)
    {
        $order = Order::find($id);
        $html = 'This Order does not exist';
        if (isset($order)) {

            $view = view()->make(merchant_order_vw() . '.handover_order_mdl', [
                'order' => $order,
                'modal_id' => 'handover-order',
                'modal_title' => 'Hand Over Order (<a href="' . url(merchant_url() . '/order/' . $order->id) . '" target="_blank">' . $id . '</a>)',
            ]);

            $html = $view->render();
        }

        return $html;
    }

    public function viewProductCustomsMdl($id)
    {
        $product = OrderProduct::find($id);
        $customs = $product->custom;
        $html = 'This Order has no customaizations';
        if (isset($customs)) {

            if (getAuth()->type == 'merchant') {
                $view = view()->make(merchant_order_vw() . '.product_custom_mdl', [
                    'customs' => $customs,
                    'modal_id' => 'product_custom-order',
                    'modal_title' => $product->product->name,
                ]);
            }
            else{
                $view = view()->make(admin_order_vw() . '.product_custom_mdl', [
                    'customs' => $customs,
                    'modal_id' => 'product_custom-order',
                    'modal_title' => $product->product->name,
                ]);
            }


            $html = $view->render();
        }

        return $html;
    }

    public function viewCancelProductMdl($id)
    {
        $product = OrderProduct::find($id);
        $html = 'This product is not exist';
        if (isset($product)) {

            if (getAuth()->type == 'merchant') {
                $view = view()->make(merchant_order_vw() . '.cancel_product_mdl', [
                    'product' => $product,
                    'modal_id' => 'cancel_product-order',
                    'modal_title' => $product->product->name,
                ]);
            }
            else{
                $view = view()->make(admin_order_vw() . '.cancel_product_mdl', [
                    'product' => $product,
                    'modal_id' => 'cancel_product-order',
                    'modal_title' => $product->product->name,
                ]);
            }


            $html = $view->render();
        }

        return $html;
    }
}
