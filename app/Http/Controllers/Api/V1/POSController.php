<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\Product\GetProductsRequest;
use App\Repositories\Eloquents\ProductEloquent;
use App\Product;
use App\ProductImage;
use App\ProductCategory;
use App\User;
use App\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Order;
use App\OrderUser;
use App\OrderProduct;
use App\PromotionCode;
use App\Repositories\Eloquents\NotificationSystemEloquent;
use Illuminate\Notifications\Action;

class POSController extends Controller
{

  private $MID;


  private $product, $category, $notificationSystem;

  public function __construct(ProductEloquent $product, ProductCategory $category, NotificationSystemEloquent $notificationSystem)
  {
    $this->product = $product;
    $this->category = $category;
    $this->notificationSystem = $notificationSystem;
  }

  public function CheckApiKey($Api_Key)
  {
    $check = User::where('api_key', $Api_Key)->get();
    if (count($check)) {
      $this->MID = $check->first()->id;
      return true;
    } else {
      return false;
    }
  }

  public function CategoryAction(Request $request, $action)
  {
    $validatedData = \Validator::make($request->all(), [
      'api_key' => 'required',
    ]);
    if ($validatedData->fails()) {
      return response_api(false, 4221, "The Api Key is required", []);
    }


    if (!$this->CheckApiKey($request->input('api_key'))) {
      return response_api(false, 4222, "The Api Key not corrcet", []);
    }


    switch ($action) {
      case 'new':
        return $this->CategoryNew($request);
        break;
      case 'update':
        return $this->CategoryUpdate($request);
        break;
      case 'delete':
        return $this->CategoryDelete($request);
        break;
      case 'get':
        return $this->GetCategory($request);
        break;
    }
  }

  public function CategoryNew($request)
  {


    $validator = \Validator::make($request->all(), [
      'name' => 'required',
      'name_ar' => 'required',
      'reference_id' => 'required',
    ]);

    if ($validator->fails()) {
      return response_api(false, 4223, "Some required data missing", $validator->errors()->all());
    }


    $category = new ProductCategory();
    $category->name = $request['name'];
    $category->name_ar = $request['name_ar'];
    $category->store_id = $this->MID;
    $category->order_by = $request['order_by'] ?? null;
    $category->reference_id = $request['reference_id'];

    if ($category->save()) {
      return response_api(true, 2001, "The Category added successfully", $category);
    }


    return response_api(false, 422);
  }

  public function CategoryUpdate($request)
  {

    $validator = \Validator::make($request->all(), [
      'name' => 'required',
      'name_ar' => 'required',
      'reference_id' => 'required',
    ]);

    if ($validator->fails()) {
      return response_api(false, 4223, "Some required data missing", $validator->errors()->all());
    }

    $category = ProductCategory::where('store_id', $this->MID)->where('reference_id', $request['reference_id'])->first();


    if (!$category) {
      return response_api(false, 4224, "Not found the category", []);
    }

    $category->name = $request['name'];
    $category->name_ar = $request['name_ar'];
    $category->order_by = $request['order_by'] ?? null;


    if ($category->save()) {

      return response_api(true, 2002, "The Category updated successfully", $category);
    }
    return response_api(false, 422);
  }

  public function CategoryDelete($request)
  {

    $validator = \Validator::make($request->all(), [
      'reference_id' => 'required',
    ]);

    if ($validator->fails()) {
      return response_api(false, 4223, "Some required data missing", $validator->errors()->all());
    }

    $category = ProductCategory::where('store_id', $this->MID)->where('reference_id', $request['reference_id'])->first();


    if (!$category) {
      return response_api(false, 4224, "Not found the category", []);
    }

    if (isset($category) && $category->delete()) {

      return response_api(true, 2003, "The Category deleted successfully", $category);
    }
    return response_api(false, 422);
  }

  public function GetCategory($request)
  {


    if (!isset($request['reference_id'])) {
      $category = ProductCategory::where('store_id', $this->MID)->get();
    } else {
      $category = ProductCategory::where('store_id', $this->MID)->where('reference_id', $request['reference_id'])->first();
      if (!$category) {
        return response_api(false, 4224, "Not found the category", []);
      }
    }


    return response_api(true, 2004, "Get categories successfully", $category);
  }

  public function ProductAction(Request $request, $action)
  {
    $validatedData = \Validator::make($request->all(), [
      'api_key' => 'required',
    ]);
    if ($validatedData->fails()) {
      return response_api(false, 4221, "The Api Key is required", []);
    }


    if (!$this->CheckApiKey($request->input('api_key'))) {
      return response_api(false, 4222, "The Api Key not corrcet", []);
    }


    switch ($action) {
      case 'new':
        return $this->ProductNew($request);
        break;
      case 'update':
        return $this->ProductUpdate($request);
        break;
      case 'delete':
        return $this->ProductDelete($request);
        break;
      case 'get':
        return $this->GetProduct($request);
      case 'images':
        return $this->ProductImages($request);
        break;
      case 'deleteImage':
        return $this->deleteProductImage($request);
        break;
    }
  }

  public function ProductNew(Request $request)
  {
    $validator = \Validator::make($request->all(), [
      'name' => 'required',
      'price' => 'required',
      'reference_id' => 'required',
      'original_quantity' => 'required',
      'category_id' => 'required',
    ]);

    if ($validator->fails()) {
      return response_api(false, 4223, "Some required data missing", $validator->errors()->all());
    }

    $store = Store::where('merchant_id', $this->MID)->first();
    $category = ProductCategory::where('store_id', $this->MID)->where('reference_id', $request['category_id'])->first();
    if (!$category) {
      return response_api(false, 4224, "Not found the category", []);
    }


    $product = new Product();
    $product->reference_id = $request['reference_id'];
    $product->name = $request['name'];
    $product->price = $request['price'];
    $product->original_quantity = $request['original_quantity'];
    $product->available_quantity = $request['original_quantity'];
    $product->is_offer = 0;
    $product->offer_percentage = null;
    $product->is_sponsor = 0;
    $product->category_id = $category->id;
    $product->merchant_id = $this->MID;
    $product->store_id = $store->id;

    if ($product->save()) {
      return response_api(true, 2005, "The Product added successfully", $product);
    }


    return response_api(false, 422);
  }

  public function ProductUpdate(Request $request)
  {


    $validator = \Validator::make($request->all(), [
      'name' => 'required',
      'price' => 'required',
      'reference_id' => 'required',
      'original_quantity' => 'required',
      'category_id' => 'required',
      'quantity_type' => 'required',
    ]);

    if ($validator->fails()) {
      return response_api(false, 4223, "Some required data missing", $validator->errors()->all());
    }

    $store = Store::where('merchant_id', $this->MID)->first();
    $category = ProductCategory::where('store_id', $this->MID)->where('reference_id', $request['category_id'])->first();
    if (!$category) {
      return response_api(false, 4224, "Not found the category", []);
    }


    $product = Product::where('merchant_id', $this->MID)->where('store_id', $store->id)->where('reference_id', $request['reference_id'])->first();

    if (!$product) {
      return response_api(false, 4225, "Not found the product", []);
    }



    $product->name = $request['name'];
    $product->price = $request['price'];
    $product->original_quantity =  $request['quantity_type'] == "update" ? $request['original_quantity']  : ($request['quantity_type'] == "add" ? $product->original_quantity + $request['original_quantity'] : $request['original_quantity']);
    $product->available_quantity = $request['quantity_type'] == "update" ? $request['original_quantity']  : ($request['quantity_type'] == "add" ? $product->available_quantity + $request['original_quantity'] : $request['original_quantity']);
    $product->category_id = $category->id;

    if ($product->save()) {
      return response_api(true, 2006, "The Product updated successfully", $product);
    }


    return response_api(false, 422);
  }

  public function ProductDelete(Request $request)
  {

    $validator = \Validator::make($request->all(), [
      'reference_id' => 'required',
    ]);

    if ($validator->fails()) {
      return response_api(false, 4223, "Some required data missing", $validator->errors()->all());
    }

    $store = Store::where('merchant_id', $this->MID)->first();
    $product = Product::where('merchant_id', $this->MID)->where('store_id', $store->id)->where('reference_id', $request['reference_id'])->first();

    if (!$product) {
      return response_api(false, 4225, "Not found the product", []);
    }


    if (isset($product) && $product->delete()) {
      return response_api(true, 2007, "The Product deleted successfully", []);
    }


    return response_api(false, 422);
  }

  public function ProductImages(Request $request)
  {

    $validator = \Validator::make($request->all(), [
      'files' => 'required',
      'reference_id' => 'required',
    ]);

    if ($validator->fails()) {
      return response_api(false, 4223, "Some required data missing", $validator->errors()->all());
    }

    if (!is_array($request['files'])) {


      return response_api(false, 4228, "Error", []);
    }

    $store = Store::where('merchant_id', $this->MID)->first();

    $product = Product::where('merchant_id', $this->MID)->where('store_id', $store->id)->where('reference_id', $request['reference_id'])->first();
    if ($this->product->productImages($request->all(), $product->id))
      return response_api(true, 2009, "The Product Image uploaded successfully", []);
  }

  public function deleteProductImage(Request $request)
  {

    $validator = \Validator::make($request->all(), [
      'image_id' => 'required',
    ]);

    if ($validator->fails()) {
      return response_api(false, 4223, "Some required data missing", $validator->errors()->all());
    }
    if ($this->product->deleteProductImage($request['image_id']))
      return response_api(true, 2010, "The Product Image deleted successfully", []);
  }

  public function GetProduct($request)
  {

    $store = Store::where('merchant_id', $this->MID)->first();
    if (!isset($request['reference_id'])) {
      $product = Product::where('merchant_id', $this->MID)->where('store_id', $store->id)->get();
    } else {
      $product = Product::where('merchant_id', $this->MID)->where('store_id', $store->id)->where('reference_id', $request['reference_id'])->first();
      if (!$product) {
        return response_api(false, 4224, "Not found the product", []);
      }
    }


    return response_api(true, 2008, "Get products successfully", $product);
  }

  public function docs()
  {
    return view('apiDocs.index');
  }

  // orderAction()
  // all of the action to the order from the app happens here
  public function orderAction(Request $request, $action)
  {
    switch ($action) {
      case 'get':
        return $this->getOrders($request);
      case 'Current':
        return $this->Current($request);
        break;
      case 'Available':
        return $this->getAvailableOrders($request);
        break;
      case 'Accept':
        return $this->OrderAccepted($request);
        break;
      case 'Reject':
        return  $this->OrderRejected($request);
        break;
      case 'Progress':
        return $this->OrderProgress($request);
        break;
      case 'Finish':
        return $this->OrderFinished($request);
        break;
      case 'DriverAccept':
        return $this->DriverAccepted($request);
        break;
      case 'Pickup':
        return $this->OrderPickupStore($request);
        break;
      case 'Receive':
        // driver
        return $this->OrderReceive($request);
        break;
      case 'StoreArrival':
        // driver
        return $this->StoreArrival($request);
        break;
      case 'ClientArrival':
        // driver
        return $this->ClientArrival($request);
        break;
      case 'Delivery':
        // driver
        return $this->OrderDelivery($request);
        break;
    }
  }

  public function getOrders($request)
  {

    $user = User::find($request['user_id']);
    if ($request['order_id']) {
      $orders = Order::where('id', $request['order_id'])->where('last_status', '!=', 'pending')->get();
      if ($user['type'] == 'driver' && $orders[0]['driver_id'] != null && $orders[0]['driver_id'] != $user['id']){
        return response_api(true, 422, "The order accpeted already");
      }
      

      
    } else {
      if ($user['type'] == 'client') {
        $user_order_ids = OrderUser::where('user_id', $user['id'])->pluck('id');
        $orders = Order::whereIn('user_order_id', $user_order_ids)->where('last_status', '!=', 'pending')->get();
      } elseif ($user['type'] == 'merchant')
        $orders = Order::where('merchant_id', $user['id'])->where('last_status', '!=', 'pending')->get();
      elseif ($user['type'] == 'driver')
        $orders = Order::where('driver_id', $user['id'])->where('last_status', '!=', 'pending')->get();
    }


    return response_api(true, 200, null, ['orders' => $orders]);
  }

  public function Current($request)
  {

    $user = User::find($request['user_id']);
    if ($user['type'] == 'client') {

      $user_order_ids = OrderUser::where('user_id', $user['id'])->pluck('id');
      $orders = Order::whereIn('user_order_id', $user_order_ids)->where('last_status', '!=', 'new')->where('last_status', '!=', 'pending')->where('last_status', '!=', '	
      rejected')->where('driver_status', '!=', 'delivered')->get();
    } elseif ($user['type'] == 'merchant')
      $orders = Order::where('merchant_id', $user['id'])->where('last_status', '!=', 'new')->where('last_status', '!=', 'pending')->where('last_status', '!=', '	
      rejected')->where('driver_status', '!=', 'delivered')->get();
    elseif ($user['type'] == 'driver')
      $orders = Order::where('driver_id', $user['id'])->where('last_status', '!=', 'new')->where('last_status', '!=', 'pending')->where('last_status', '!=', '	
      rejected')->where('driver_status', '!=', 'delivered')->get();

    return response_api(true, 200, null, ['orders' => $orders]);
  }

  public function getAvailableOrders($request)
  {

    $user = User::find($request['user_id']);

    if ($user['is_active'] == 1) {

      if ($user['type'] == 'driver')
        $orders = Order::where('last_status', '!=', 'new')->where('last_status', '!=', 'pending')->where('last_status', '!=', '	
      rejected')->where('driver_status', 'new')->get();
      elseif ($user['type'] == 'merchant')
        $orders = Order::where('merchant_id', $user['id'])->where('last_status', 'new')->get();
    } else {

      $orders = [];
    }



    return response_api(true, 200, null, ['orders' => $orders]);
  }

  public function DeliveryCost($id, Request $request)
  {

    $UserAddrerss  = DB::table('user_address')->where('id', $id)->first();
    $UserAddrerss = json_decode(json_encode($UserAddrerss), true);

    if ($UserAddrerss) {
      $UserInfo = User::where("id", $UserAddrerss['user_id'])->first();

      $Branches = Store::where('merchant_id', $UserInfo->id)->get();
      $near_Branches = [];
      foreach ($Branches as $Branche) {
        $distance = distance($request['lat'], $request['long'], $Branche->lat, $Branche->lng);
        if ($distance <= 35) {
          $Branche['distance'] = $distance;
          $Branche['cost'] = $distance;
          $near_Branches[] = $Branche;
        }
      }
    }
  }

  public function payment(Request $request)
  {
    $store = User::where("id", $request['merchant_id'])->first();
    $UserInfo  = User::where("id", $request['user_id'])->first();
    $UserAddrerss  = DB::table('user_address')->where('user_id', $UserInfo->id)->where('id', $request['address_id'])->first();
    $UserAddrerss = json_decode(json_encode($UserAddrerss), true);

    // inserting the user information to the order_users table
    $order_user = DB::table('order_users')->insertGetID([
      'user_id' => $request['user_id'],
      'procurement_method' => $request['receive_type'],
      'calculated_price' => $request['calculated_price'],
      'total_shipment_price' => $request['shipment_price'],
      'address' => $UserAddrerss['name'],
      'latitude' => $UserAddrerss['lat'],
      'longitude' => $UserAddrerss['lng'],
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')

    ]);


    // inserting the order information to the orders table
    $new_Order = DB::table('orders')->insertGetID([
      'user_order_id' => $order_user,
      'store_id' => $request['store_id'],
      'merchant_id' => $request['merchant_id'],
      'products_price' => $request['total_price'],
      'shipment_price' => $request['shipment_price'],
      'commission_rate' => $store['commission_rate'],
      'promotion_code' => $request['promotion_code'],
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')

    ]);

    $request['products'] = json_decode($request['products'], true);

    // inserting the products information to the order_products table
    for ($i = 0; $i < count($request['products']); $i++) {
      DB::table('order_products')->insert([
        'order_id' => $new_Order,
        'product_id' => $request['products'][$i]['id'],
        'price' => $request['products'][$i]['price'],
        'qty' => $request['products'][$i]['quan'],
        'custom' => json_encode($request['products'][$i]['selected_custom']),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ]);
    }




    $telrManager = new \TelrGateway\TelrManager();

    $billingParams = [
      'first_name' => $UserInfo->name,
      'sur_name' => $UserInfo->name,
      'address_1' => 'Hasa',
      'address_2' => 'Hasa',
      'city' => 'Hasa',
      'region' => 'San Stefano',
      'zip' => '11231',
      'country' => 'SA',
      'email' =>  $UserInfo->email,
    ];

    $telrManager->pay($new_Order, $request['total_price'], 'Order #' . $new_Order, $billingParams);

    $Payment_url = DB::table('transaction')->where('order_id', $new_Order)->first();
    $Payment_url = json_decode(json_encode($Payment_url), true);
    $Payment_id = $Payment_url['cart_id'];
    $Payment_url = "https://secure.telr.com/gateway/process.html?o=" . $Payment_url['trx_reference'];

    // https://secure.telr.com/gateway/process.html?o=429E9EFF1BE566D990F9DBCA914C331B7EA368696949B6C46EC8849C63B9DE39

    return response_api(true, 200, null, ['url' => $Payment_url, 'id' => $Payment_id, 'order_id' => $new_Order]);
  }

  public function payment_success(Request $request)
  {

    $Payment = DB::table('transaction')->where('cart_id', $request->cart_id)->update([
      'approved' => 1
    ]);

    $Payment = DB::table('transaction')->where('cart_id', $request->cart_id)->first();
    $Payment = json_decode(json_encode($Payment), true);

    $Order = Order::where('id', $Payment['order_id'])->first();

    $orderUser = OrderUser::where('id', $Order->user_order_id)->first();

    // last_status = new      
    $this->changeStatus([
      'id' => $Payment['order_id'],
      'user_id' => $orderUser['user_id'],
      'last_status' => 'new'
    ]);

    $this->notificationSystem->sendNotification($orderUser->user_id, $Order->store->merchant_id, $Order->id, 'new_order');

    return response_api(true, 200, null, ['order' => $Payment]);
  }

  public function payment_cancel(Request $request)
  {
    $Payment = DB::table('transaction')->where('cart_id', $request->cart_id)->update([
      'approved' => 0
    ]);

    if ($Payment) {
      $Payment = DB::table('transaction')->where('cart_id', $request->cart_id)->first();
      $Payment = json_decode(json_encode($Payment), true);
      $orderUser = OrderUser::where('order_id', $Payment['order_id'])->first();

      // last_status = new      
      $this->changeStatus([
        'id' => $Payment['order_id'],
        'user_id' => $orderUser['user_id'],
        'last_status' => 'cancel'
      ]);
    }

    return response_api(false, 422, null, []);
  }

  public function payment_declined(Request $request)
  {
    return response_api(false, 422, null, []);
  }

  public function OrderAccepted($request)
  {
    // last_status = accepted      
    // driver_status = new   
    $order = Order::where('id', $request['order_id'])->first();

    $this->changeStatus([
      'id' => $request['order_id'],
      'user_id' => $order['merchant_id'],
      'last_status' => 'accepted',
      'driver_status' => 'new'
    ]);
    // 'store_driver','app_driver','freelancer_driver'
    if (isset($request['delivery_method']) && $request['delivery_method'] == "store_driver")
      $this->assignDriver($request);

    $driver_ids = User::where('type', 'driver')->where('driver_type_id', 1)->orWhere('driver_type_id', 2)->where('is_active', 1)->where('is_driver_available', 1)->pluck('id');
    // $ss = new NotificationSystemEloquent();
    
    $this->notificationSystem->sendNotification($order->merchant_id, $order->order_user->user_id, $order->id, 'in_progress_order');

    foreach($driver_ids as $driver_id){
      $this->notificationSystem->sendNotification($order->merchant_id, $driver_id, $order->id, 'new_order');
    }
    
    return response_api(true, 200, null, ['order' => $order]);
  }

  public function assignDriver(array $attributes)
  {

    $order = Order::find($attributes['order_id'])->first();

    $order->driver_source = $attributes['delivery_method'];
    if (isset($attributes['driver_id']))
      $order->driver_id = $attributes['driver_id'];

    if ($order->save()) {

      if ($attributes['delivery_method'] == 'freelancer_driver') {
        $driver_free_lance = User::where('type', 'driver')->where('driver_type_id', 2)->where('is_active', 1)->where('is_driver_available', 1)->pluck('id');

        foreach ($driver_free_lance as $freelance)
        $this->notificationSystem->sendNotification(null, $freelance, $order->id, 'send_order');
      } else {

        $this->notificationSystem->sendNotification(null, $order->driver_id, $order->id, 'assign_driver');
        $this->notificationSystem->sendNotification(null, $order->merchant_id, $order->id, 'notify_merchant_assign_driver', $order->driver->username);
      }


      return response_api(true, 200, null, $order);
    }
    return response_api(false, 422, null, []);
  }

  public function OrderRejected($request)
  {
    // last_status = rejected      
    $order = Order::where('id', $request->order_id)->first();

    $this->changeStatus([
      'id' => $request->order_id,
      'user_id' => $order->merchant_id,
      'last_status' => 'rejected'
    ]);


    return response_api(true, 200, null, ['order' => $order]);
  }

  public function OrderProgress($request)
  {
    // last_status = progress      
    $order = Order::where('id', $request->order_id)->first();

    $this->changeStatus([
      'id' => $request->order_id,
      'user_id' => $order->merchant_id,
      'last_status' => 'progress'
    ]);

    return response_api(true, 200, null, ['order' => $order]);
  }

  public function OrderFinished($request)
  {
    // last_status = finished      
    $order = Order::where('id', $request->order_id)->first();

    $this->changeStatus([
      'id' => $request->order_id,
      'user_id' => $order->merchant_id,
      'last_status' => 'finished'
    ]);

    $this->notificationSystem->sendNotification($order->merchant_id, $order->driver_id, $order->id, 'finished_order');

    return response_api(true, 200, null, ['order' => $order]);
  }

  public function DriverAccepted($request)
  {
    // driver_status = accepted      
    $order = Order::where('id', $request->order_id)->first();
    $User = User::where('id', $request->user_id)->first();

    if ($User->type == "driver") {
      $this->changeStatus([
        'id' => $request->order_id,
        'user_id' => $request->user_id,
        'driver_status' => 'accepted'
      ]);

      $this->notificationSystem->sendNotification($User->id, $order->OrderUser->user_id, $order->id, 'accepted_driver');
      // $this->notificationSystem->sendNotification($User->id, $order->merchant_id, $order->id, 'accepted_driver');

      return response_api(true, 200, null, ['order' => $order]);
    } else {

      return response_api(false, 422, "You are not a driver", []);
    }
  }


  public function OrderPickupStore($request)
  {
    // last_status = pickup      
    $order = Order::where('id', $request->order_id)->first();
    if (!is_null($order->driver_id)) {
      $this->changeStatus([
        'id' => $request->order_id,
        'user_id' => $order->merchant_id,
        'last_status' => 'pickup'
      ]);
      return response_api(true, 200, null, ['order' => $order]);
    } else {
      return response_api(false, 422, "The not accepted by a driver yet", []);
    }
  }

  // OrderReceive()
  // change status to receive when the driver get the product from the store
  public function OrderReceive($request)
  {
    // driver_status = receive        
    $order = Order::where('id', $request->order_id)->first();

    $this->changeStatus([
      'id' => $request->order_id,
      'user_id' => $order->driver_id,
      'driver_status' => 'receive'
    ]);

    $this->notificationSystem->sendNotification($order->driver_id, $order->order_user->user_id, $order->id, 'start_navigation');

    return response_api(true, 200, null, ['order' => $order]);
  }

  // StoreArrival()
  // change status to store_arrival when the driver arrive to the store
  public function StoreArrival($request)
  {
    $order = Order::where('id', $request->order_id)->first();

    $this->changeStatus([
      'id' => $request->order_id,
      'user_id' => $order->driver_id,
      'driver_status' => 'store_arrival'
    ]);

    // $this->notificationSystem->sendNotification($order->driver_id, $order->OrderUser->user_id, $order->id, 'store_arrival_driver');

    return response_api(true, 200, null, ['order' => $order]);
  }

  // ClientArrival()
  // change status to client_arrival when the driver arrive to the client
  public function ClientArrival($request)
  {
    $order = Order::where('id', $request->order_id)->first();

    $this->changeStatus([
      'id' => $request->order_id,
      'user_id' => $order->driver_id,
      'driver_status' => 'client_arrival'
    ]);

    $this->notificationSystem->sendNotification($order->driver_id, $order->order_user->user_id, $order->id, 'client_arrival_driver');

    return response_api(true, 200, null, ['order' => $order]);
  }

  // OrderDelivery()
  // change status to delivered when the driver deliver the product to the client
  public function OrderDelivery($request)
  {
    // driver_status = 	delivered    
    $order = Order::where('id', $request->order_id)->first();

    $this->changeStatus([
      'id' => $request->order_id,
      'user_id' => $order->driver_id,
      'driver_status' => 'delivered'
    ]);

    $this->notificationSystem->sendNotification($order->driver_id, $order->order_user->user_id, $order->id, 'order_delivered');

    return response_api(true, 200, null, ['order' => $order]);
  }

  public function changeStatus(array $attributes)
  {
    $order = Order::find($attributes['id']);
    $User = User::where('id', $attributes['user_id'])->first();


    if ($User->type == "driver" && is_null($order->driver_id))
      $order->driver_id = $attributes['user_id'];

    $last_status = $attributes['last_status'] ?? null;
    $driver_status = $attributes['driver_status'] ?? null;

    if (!is_null($last_status))
      $order->last_status = $last_status;


    if (!is_null($driver_status))
      $order->driver_status = $driver_status;


    if ($order->save()) {

      if (!is_null($last_status))
        DB::table('order_statuses')->insert([
          'order_id' => $attributes['id'],
          'user_id' => $attributes['user_id'],
          'status' => $attributes['last_status'],
          'edit_at' => 'last_status',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')

        ]);


      if (!is_null($driver_status))
        DB::table('order_statuses')->insert([
          'order_id' => $attributes['id'],
          'user_id' => $attributes['user_id'],
          'status' => $attributes['driver_status'],
          'edit_at' => 'driver_status',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')

        ]);
    }
  }

  public function CheckPromotionCode(Request $request)
  {

    $PromotionCode = PromotionCode::where('code', $request['code'])->first();

    if ($PromotionCode) {

      $day = gmdate('Y-m-d h:i:s A');
      $diffStart = strtotime($PromotionCode->action->start_date) - strtotime($day);
      $diffEnd = strtotime($PromotionCode->action->end_date) - strtotime($day);

      if ($diffStart <= 0) {
        if ($diffEnd >= 0) {
          if (isset($PromotionCode->action->conditions) && $PromotionCode->action->conditions == "first_order") {
            $user_order_ids = OrderUser::where('user_id', $request['user_id'])->pluck('id');
            $orders = Order::whereIn('user_order_id', $user_order_ids)->where('last_status', '!=', 'pending')->count();
            if ($orders > 0) {
              return response_api(false, 42200, "Promotion Code for first order");
            } else {
              return response_api(true, 200, "Promotion Code OK", [$PromotionCode]);
            }
          }
          return response_api(true, 200, "Promotion Code OK", $PromotionCode);
        } else {
          return response_api(false, 42201, "Promotion Code Not Start");
        }
      } else {

        return response_api(false, 42202, "Promotion Code End");
      }
    } else {
      return response_api(false, 422, null);
    }
  }
}
