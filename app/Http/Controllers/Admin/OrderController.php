<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderBook;
use App\Models\Vendor;
use App\Models\AddCart;
use App\Models\Commission;
use App\Models\OrderUserDetail;
use App\Models\PaymentTransfer;
use Illuminate\Support\Facades\Response;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\ShipmentInfo;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderTrackingNotification;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $mp_username;
    private $mp_password;
    private $mp_location_id;
    private $mp_account;

    public function __construct()
    {
        $this->middleware('auth:admin');

        if(config('app.env') == 'local'){
            $this->mp_username = 'Test_User';
            $this->mp_password = '12345';
            $this->mp_location_id = '';
            $this->mp_account = '4T154';
        }
        else{
            $this->mp_username = 'waseem_4o133';
            $this->mp_password = 'Orderpak12!';
            $this->mp_location_id = '11345';
            $this->mp_account = '4o118';
        }
    }
    
    public function index()
    {
        $products = Product::where('admin_status','APPROVED')->orderBy('id', 'desc')->paginate(10);
        // $orders = OrderBook::paginate(10);
        $users = OrderUserDetail::get();
            
        $userss = OrderUserDetail::get();
        $orders = $userss->unique('order_id');
        // $orders = $userss->diff($usersUnique);
        
        // dd($users, $usersUnique, $usersDupes);

        // print_r(json_decode($usersUnique));die;
        $carts = AddCart::get();
        $vendors = Vendor::get();
        $commissions = Commission::get();

        return view('admin.order.index')
        ->with(compact('orders','users','products','vendors','carts','commissions'));
    }
    
    public function show($id)
    {
        $products = Product::where('admin_status','APPROVED')->orderBy('id', 'desc')->paginate(10);
        // $orders = OrderBook::paginate(10);
        $order = OrderUserDetail::where('order_id',$id)->first();
        $porder = OrderBook::where('order_id',$id)->where('status','Pending')->count();
        // print_r($porder);die;
        $orders = OrderBook::with('shipment_info')->where('order_id',$id)->get();

        // echo '<pre>';
        // print_r($orders);die;
        $carts = AddCart::get();
        $vendors = Vendor::get();
        $commissions = Commission::get();

        return view('admin.order.show')
        ->with(compact('order','orders','products','vendors','carts','commissions','porder'));
    }

    // book a shipment
    public function generateShipmentMP(Request $request){
        // $this->tracking_by_consignmentMP();die;
        // $this->get_locationMP();die;

        $weight = ($request->weight) ? $request->weight : 1;
        
        // url
        $url = 'http://mnpcourier.com/mycodapi/api/Booking/InsertBookingData';

        // Make Post Fields Array
        $data = [
            "username" => $this->mp_username,
            "password" => $this->mp_password,
            "locationID" => $this->mp_location_id,
            "AccountNo" => $this->mp_account,
            "consigneeName" => $request->name,
            "consigneeAddress" => $request->address,
            "consigneeMobNo" => $request->phone,
            "consigneeEmail" =>  $request->email,
            "destinationCityName" =>  $request->city,
            "pieces" =>  $request->items,
            "weight" => $weight,
            "codAmount" => $request->amount,
            "custRefNo" => $request->order_id,
            "productDetails" => "Products",
            "fragile" => "Yes",
            "service" => $request->service_type,
            "remarks" => "Please call before delivery",
            "insuranceValue" => "0"
        ];

        $response = $this->process_curl_post($url, $data);
      
        if($response[0]->isSuccess  == 'true'){
            
            $response[0]->name  = $request->name;
            $response[0]->order_id = $request->order_id;
            $response[0]->tracking_url = url("/order/gettrackinginfo/".$response[0]->orderReferenceId);

            $this->sendNotification($request->email, $response[0]);

            $shipmentObj = new ShipmentInfo;
            $data = [
                'order_id' => $request->order_id,
                'user_id' => Auth::user()->id,
                'is_success' => $response[0]->isSuccess,
                'message' => $response[0]->message,
                'consignment_number' => $response[0]->orderReferenceId,
                'courier_type' => 'M&P',
                'label' => '',
                'status' => 1,

            ];
    
            $shipmentObj->save_shipment($data);

            if($response[0]->orderReferenceId){
                return redirect('/admin/order/show/'.$request->order_id)->with('success', 'Shipment generated successfully');
            }

            return redirect('/admin/order/show/'.$request->order_id)->with('error', $response[0]->message);
        }
        else  if($response[0]->isSuccess  == 'false'){
            $shipmentObj = new ShipmentInfo;
            $data = [
                'order_id' => $request->order_id,
                'user_id' => Auth::user()->id,
                'is_success' => $response[0]->isSuccess,
                'message' => $response[0]->message,
                'consignment_number' => $response[0]->orderReferenceId,
                'courier_type' => 'M&P',
                'label' => '',
                'status' => 0,

            ];
    
            $shipmentObj->save_shipment($data);
           
            return redirect('/admin/order/show/'.$request->order_id)->with('error', $response[0]->message);
        }
        else{
            return redirect('/admin/order/show/'.$request->order_id)->with('error', 'Something went wrong!');
        }
    }

    // get location if we have multiple pickup point
    public function get_locationMP(){
        $url = 'http://mnpcourier.com/mycodapi/api/Locations/Get_locations?username='.$this->mp_username.'&password='.$this->mp_password.'&AccountNo='.$this->mp_account;
        $response =  $this->process_curl_get($url);
        echo '<pre>';
        print_r($response);die;
    }

    //  track shipment by consignment number
    public function tracking_by_consignmentMP($consignment_number){
        $url = 'http://mnpcourier.com/mycodapi/api/Tracking/Consignment_Tracking?username='.$this->mp_username.'&password='.$this->mp_password.'&consignment='.$consignment_number;
        $response = $this->process_curl_get($url);
        
        if($response){
            return view('admin.order.tracking')
            ->with(array('tracking' => $response)); 
        } 
        else{
            return response()->json(['response' => 'Something went wrong']);
        }
    }

    public function process_curl_post($url, $data){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here required headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
           
            return json_decode($response);
        }
    }

    public function process_curl_get($url){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }

    public function sendNotification($email, $tracking) {
        
        Notification::route('mail', $email)->notify(new OrderTrackingNotification($tracking));
    }

    public function process()
    {
        $cancel_all_orders = OrderUserDetail::where('status',request()->get('status'))->orderBy('id', 'desc')->get();
        $orders = $cancel_all_orders->unique('order_id');
        // print_r($orders);die;

        $commissions = Commission::get();
        $status = request()->get('status');
        return view('admin.order.process')
        ->with(compact('orders', 'commissions','status'));
    }
    public function print(Request $request , $id)
    {
        // print_r($id);die;
        $orders = OrderBook::where('order_id',$id)->get();
        return view('admin.order.print')
        ->with(compact('orders'));
    }
    
/*    public function payment_transfer_form(Request $request)
    {
        $vendors = Vendor::get();
        // print_r($request['product_id']);die;
        // $vendor = Vendor::get();
        // $product = Product::find($request['product_id']);

        // $order = OrderBook::where('order_id',$id)->get();
        // print_r($order);die;
        return view('admin.order.payment_form')->with(compact('vendors'));
    }

    public function payment_transfer(Request $request)
    {
        try {
            // validate incoming request
            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'end_date' => 'required',
                'shop_name' => 'required',
                'amount' => 'required',
                'file' => 'required',
                'status' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $fileName = null;
            if ($request->hasFile('file')) {
                $files = $request->file('file');
                $destinationPath = 'uploads/admin/payment_transfer/'; // upload path
                $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $fileName);
            }
            PaymentTransfer::create([
                'sdate' => $request['start_date'],
                'edate' => $request['end_date'],
                'vendor_id' => $request['shop_name'],
                'amount' => $request['amount'],
                'file' => $fileName,
                'status' => $request['status']
            ]);
            return redirect('/admin/order/payment')->with('success', 'Payment Transfer added successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
    */
    public function payment_transfer_form(Request $request)
    {
        $vendors = Vendor::get();
        $orders = OrderUserDetail::where([
            ['status','Complete'],
            ['vpay_status','unpaid']
            ])
            ->groupBy('order_id')
            ->get();
        return view('admin.order.payment_form')->with(compact('vendors','orders'));
    }

    public function payment_transfer(Request $request)
    {
        try 
        {
            // validate incoming request
            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'end_date' => 'required',
                'shop_name' => 'required',
                'amount' => 'required',
                'file' => 'required',
                'status' => 'required',
                'order_id'=>'required'                
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $orders = OrderBook::where([
            ['status', '=', 'Complete'],
            ['vpay_status', '=', 'unpaid'],
            ['vendor_id', '=', $request['shop_name']],
            ['order_id', '=', $request['order_id']]
            ])->get();

            if($orders->count()>0)
            {
                $fileName = null;
                if ($request->hasFile('file')) {
                    $files = $request->file('file');
                    $destinationPath = 'uploads/admin/payment_transfer/'; // upload path
                    $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $fileName);
                }

                PaymentTransfer::create([
                    'sdate' => $request['start_date'],
                    'edate' => $request['end_date'],
                    'vendor_id' => $request['shop_name'],
                    'order_id' => $orders[0]->order_id,
                    'amount' => $request['amount'],
                    'file' => $fileName,
                    'status' => $request['status']
                ]);

                //update the order product status
                OrderBook::where([
                ['vendor_id', '=',$orders[0]->vendor_id],
                ['order_id', '=', $orders[0]->order_id]
                ])->update(['vpay_status'=>'paid']);

                $paid_status =  DB::table("orderbook")
                ->select(DB::raw("COUNT(vpay_status) as total_count"),
                DB::raw("COUNT(CASE WHEN vpay_status='unpaid' THEN 1 END) AS unpaid_count"),
                DB::raw("COUNT(CASE WHEN vpay_status='paid' THEN 1 END) AS paid_count"))
                ->where("order_id", "=",  $orders[0]->order_id)
                ->get();
                // dd($paid_status);
                if($paid_status[0]->total_count == $paid_status[0]->paid_count)
                {
                    OrderUserDetail::where('order_id', '=', $orders[0]->order_id)->update(array('vpay_status' =>'paid'));
                }
                return redirect('/admin/order/payment')->with('success', 'Payment Transfer added successfully!');
            }
            else{
                return redirect()->back()->withErrors('Record not found');
            }
        } catch (\Exception $ex) {
        return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function order_vendor_list(Request $request)
    {
        // dd($request->all());
        $vendors_list['data'] = DB::table('vendors')
        ->join('orderbook','vendors.id','=','orderbook.vendor_id')
        ->where('orderbook.order_id',$request->order_id)
        ->where('orderbook.vpay_status','unpaid')
        ->select('vendors.business_name','vendors.id')
        // ->select('users.*', 'contacts.phone', 'orders.price')
        ->distinct()
        ->get();

        return response()->json($vendors_list);
    }    

    public function unpaid_paymets(Request $request)
    {
        // $payments = PaymentTransfer::orderBy('id', 'desc')->get();
        // $payments = OrderUserDetail::where('status','Complete')->where('vpay_status','unpaid')->get();
       // dd($request->status);
        $payments = OrderUserDetail::where([
            ['status','Complete'],
            ['vpay_status',$request->status]
            ])
            ->groupBy('order_id')
            ->get();        
        $products = Product::get();
        $vendors = Vendor::get();

        return view('/admin/order/order_payment_list')
        ->with(compact('payments','products','vendors'));
    }
    
    public function paymets(Request $request)
    {
        $payments = PaymentTransfer::orderBy('id', 'desc')->get();
        $products = Product::get();
        $vendors = Vendor::get();

        return view('/admin/order/paymenttransfer')
        ->with(compact('payments','products','vendors'));
    }

    public function payment_delete(Request $request,$id)
    {
        $payments = PaymentTransfer::find($id);
        $payments->delete();
        return redirect()->back();
        
    }
    
    public function edit($id)
    {
        $orderr = OrderUserDetail::where('order_id',$id)->get();
        $order = OrderUserDetail::where('order_id',$id)->first();
        $orderss = OrderBook::where('order_id',$id)->get()->pluck('vendor_id');
        $vendorid = OrderBook::where('order_id',$id)->pluck('vendor_id')->first();
        $vendor = Vendor::find($vendorid);
        
        
        $username = $order->name;
        
        
        $dataaa = OrderBook::where('order_id',$id)->get();
        foreach ($dataaa as $key => $value) {
            $value->status = request('status');
            if(request('status') =='Complete'){
                $value->vpay_status = 'unpaid';
            }            
            $value->save();
            # code...
        }
        
        foreach ($orderr as $value) {
            $value->status = request('status');
            if(request('status') =='Complete'){
                $value->vpay_status = 'unpaid';
            }            
            $value->save();
        }
            
            if(request('status') =='Complete'){
                $orders = OrderBook::where('order_id',$id)->get();
                Mail::to($order->email)->send(new \App\Mail\OrderComplete($orders,$username));
                Mail::to('admin@orderpak.com')->send(new \App\Mail\AdminOrderComplete($orders));
                foreach($orderss as $vid){
                    $orders = OrderBook::where('order_id',$id)->where('vendor_id',$vid)->get();
                    $vendorr = Vendor::find($vid);
                    Mail::to($vendorr->business_email)->send(new \App\Mail\VendorOrderComplete($orders));
                    
                }
            }
            elseif(request('status') =='Ship'){
                $orders = OrderBook::where('order_id',$id)->get();
                Mail::to($order->email)->send(new \App\Mail\OrderShip($orders,$username));
                Mail::to('admin@orderpak.com')->send(new \App\Mail\AdminOrderShip($orders));
                
                foreach($orderss as $vid){
                    $orders = OrderBook::where('order_id',$id)->where('vendor_id',$vid)->get();
                    $vendorr = Vendor::find($vid);
                    Mail::to($vendor->business_email)->send(new \App\Mail\VendorOrderShip($orders));
                }
                
            }
            elseif(request('status') =='Cancel'){
                $orders = OrderBook::where('order_id',$id)->get();
                Mail::to($order->email)->send(new \App\Mail\OrderCancel($orders,$username));
                Mail::to('admin@orderpak.com')->send(new \App\Mail\AdminOrderCancel($orders));
                foreach($orderss as $vid){
                    $orders = OrderBook::where('order_id',$id)->where('vendor_id',$vid)->get();
                    $vendorr = Vendor::find($vid);
                    Mail::to($vendor->business_email)->send(new \App\Mail\VendorOrderCancel($orders));
                }
            }
        // }

        // $data->status = request('status');
        // $data->save();
        
        // $order = OrderBook::find(request('order_id'));
        // $orders = OrderBook::where('id', $id)->get();
        
        
        // // print_r($order->vendor_id);die;
        // $username = $order->name;
        
        // if(request('status') =='Complete'){
        //     Mail::to($order->email)->send(new \App\Mail\OrderComplete($orders,$username));
        //     Mail::to($vendor->business_email)->send(new \App\Mail\VendorOrderComplete($orders));
        //     Mail::to('admin@orderpak.com')->send(new \App\Mail\AdminOrderComplete($orders));
        // }
        // elseif(request('status') =='Ship'){
        //     Mail::to($order->email)->send(new \App\Mail\OrderShip($orders,$username));
        //     Mail::to($vendor->business_email)->send(new \App\Mail\VendorOrderShip($orders));
        //     Mail::to('admin@orderpak.com')->send(new \App\Mail\AdminOrderShip($orders));
        // }
        // elseif(request('status') =='Cancel'){
        //     Mail::to($order->email)->send(new \App\Mail\OrderCancel($orders,$username));
        //     Mail::to($vendor->business_email)->send(new \App\Mail\VendorOrderCancel($orders));
        //     Mail::to('admin@orderpak.com')->send(new \App\Mail\AdminOrderCancel($orders));
        // }
        return redirect()->back();
    }

    public function edit_order($id){
        $order = OrderUserDetail::where('order_id',$id)->first();
        $orders = OrderBook::with('shipment_info')->where('order_id',$id)->get();

        return view('admin.order.edit')
        ->with(compact('order','orders'));
    }

    public function update_order(Request $request, $id){
        
        $orderBook = OrderBook::where('order_id', $id)->first();
        $orderUserDetail = OrderUserDetail::where('order_id', $id)->first();
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]*$/|size:10',
        ]);

        $orderBook->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'address' => $request->address,
            'amount' => $request->amount,
            // 'shipping' => $request->shipping,
        ]);

        OrderBook::where('order_id', '=', $id)->orderBy('shipping', 'desc')->update(array('shipping' => $request->shipping));

        $orderUserDetail->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone_no' => $request['phone'],
            'city' => $request['city'],
            'zipcode' => $request['zipcode'],
            'state' => $request['state'],
            'address' => $request['address'],
            'amount' => $request['amount'],
        ]);

        return redirect()->to('admin/orders')->with('success', 'Order updated successfully!');
    }

    public function add_cart_quantity($product_id, $order_id)
    {
        $product =  Product::find($product_id);

        $product_sale_price = 0;
        $product_price = 0;
        $total_cost = 0;

        $order =  OrderBook::find($order_id);
        $order_user_detail = OrderUserDetail::where('order_id', $order->order_id)->orderBy('amount', 'desc')->first();
    
        if($order->product_sale_price) {
            $product_sale_price = $product->sale_price * ($order->quantity + 1);
        }
        else{
            $product_price = $product->price * ($order->quantity + 1);
        }
 
        $price = ($product->sale_price) ? $product->sale_price : $product->price;
        $total_cost = $order_user_detail->amount + $price;

        $order->update([
            'quantity'  => $order->quantity + 1,
            'product_sale_price' => $product_sale_price,
            'product_price' => $product_price,
            'amount' => $total_cost

        ]);

        OrderUserDetail::where('order_id', '=', $order->order_id)->update(array('amount' => $total_cost));

        $product->update([
            'quantity'  => $product->quantity - 1,
        ]);

        return response()->json(['response' => ['quantity' => $product->quantity, 'product_price' => $price, 'total_cost' => $total_cost]]);
    }
    
    public function get_quantity($id)
    {
        $data =  Product::select('quantity')->where('id', $id)->first();

        return response()->json(['quantity' => $data->quantity]);
    }

    public function subtract_quantity($product_id, $order_id)
    {
        $product =  Product::find($product_id);

        $product_sale_price = 0;
        $product_price = 0;
        $total_cost = 0;

        $order =  OrderBook::find($order_id);
        $order_user_detail = OrderUserDetail::where('order_id', $order->order_id)->orderBy('amount', 'desc')->first();

        if($order->product_sale_price) {
            $product_sale_price = $product->sale_price * ($order->quantity - 1);
        }
        else{
            $product_price = $product->price * ($order->quantity - 1);
        }
 
        $price = ($product->sale_price) ? $product->sale_price : $product->price;
        $total_cost = $order_user_detail->amount - $price;

        $order->update([
            'quantity'  => $order->quantity - 1,
            'product_sale_price' => $product_sale_price,
            'product_price' => $product_price,
            'amount' => $total_cost

        ]);

        OrderUserDetail::where('order_id', '=', $order->order_id)->update(array('amount' => $total_cost));

        $product->update([
            'quantity'  => $product->quantity + 1,
        ]);

        return response()->json(['response' => ['quantity' => $product->quantity, 'product_price' => $price, 'total_cost' => $total_cost]]);
    }
}