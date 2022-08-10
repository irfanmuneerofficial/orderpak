<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderBook;
use App\Models\OrderUserDetail;
use App\Models\AddCart;
use App\Models\Vendor;
use App\Models\Commission;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $mp_username;
    private $mp_password;
    private $mp_location_id;
    private $mp_account;


    public function __construct()
    {
        $this->middleware('auth:vendor');

        if(config('app.env') == 'local'){
            $this->mp_username = 'Test_User';
            $this->mp_password = '12345';
            $this->mp_location_id = '';
            $this->mp_account = '4T154';
        }
        else{
            $this->mp_username = 'waseem_4o118';
            $this->mp_password = 'Orderpak12!';
            $this->mp_location_id = '11345';
            $this->mp_account = '4o118';
        }
    }

    public function index()
    {
        $userid = Auth::guard('vendor')->user()->id;
        $carts = AddCart::get();
        $booked = OrderUserDetail::where('vendor_id',$userid)->get();
        // foreach($bookedd as $book){
        //     foreach(json_decode($book->vendor_id ,true) as $key => $vendorid){
        //         if($vendorid == $userid){
        //             $booked = $book;
        //             print_r($vendorid);die;
        //         }

        //     }
        // }

        $commissions = Commission::get();

        $products = Product::where('vendor_id',$userid)->get();

        return view('vendor_panel.order.index')
        ->with(compact('carts','booked','products','commissions'));
    }

    public function process()
    {
        $vendorid = Auth::guard('vendor')->user()->id;
        $orders = OrderUserDetail::where('status',request()->get('status'))->where('vendor_id',$vendorid)->get();
        // print_r(request()->get('status'));die;

        $commissions = Commission::get();
        return view('vendor_panel.order.process')
        ->with(compact('orders', 'commissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataaa = OrderBook::where('order_id',$id)->where('vendor_id',Auth::guard('vendor')->user()->id)->get();
        foreach ($dataaa as $key => $value) {
            $value->status = request('status');
            $value->save();
            # code...
        }

        $dataa = OrderUserDetail::where('order_id',$id)->where('vendor_id',Auth::guard('vendor')->user()->id)->get();
        foreach ($dataa as $key => $value) {
            $value->status = request('status');
            $value->save();
            # code...
        }
        $data = OrderUserDetail::where('order_id',$id)->first();
        // print_r(request('status'));die;
        $username = $data->name;
        // $order = OrderBook::find($id);
        $orders = OrderBook::where('order_id', $id)->where('vendor_id',$data->vendor_id)->get();

        $vendor = Vendor::find(request('vendor_id'));

        // $username = $order->name;
        if(request('status') =='In Process'){
            // Mail::to($data->email)->send(new \App\Mail\OrderProcess($orders,$username));
            Mail::to($vendor->business_email)->send(new \App\Mail\VendorOrderProcess($orders));
            Mail::to('admin@orderpak.com')->send(new \App\Mail\AdminOrderProcess($orders));
        }
        return redirect()->back();
    }

    public function show_detail($id)
    {
        $products = Product::where('admin_status','APPROVED')->orderBy('id', 'desc')->paginate(10);
        // $orders = OrderBook::paginate(10);
        $order = OrderUserDetail::with('shipment_info')->where('order_id',$id)->first();
        $orderrs = OrderBook::where('order_id',$id)->where('vendor_id',Auth::guard('vendor')->user()->id)->get();

        // echo  '<pre>';
        // print_r($orderrs);die;
        $carts = AddCart::get();
        $vendors = Vendor::get();
        $commissions = Commission::get();

        return view('vendor_panel.order.show')
        ->with(compact('order','orderrs','products','vendors','carts','commissions'));
    }

     //  track shipment by consignment number
     public function tracking_by_consignmentMP($consignment_number){
        $url = 'http://mnpcourier.com/mycodapi/api/Tracking/Consignment_Tracking?username='.$this->mp_username.'&password='.$this->mp_password.'&consignment='.$consignment_number;
        $response = $this->process_curl_get($url);

        if($response){
            return view('vendor_panel.order.tracking')
            ->with(array('tracking' => $response));
        }
        else{
            return response()->json(['response' => 'Something went wrong']);
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

    public function print(Request $request , $id)
    {

        $orders = OrderBook::where('order_id',$id)->where('vendor_id',Auth::guard('vendor')->user()->id)->get();
        $carts = AddCart::get();
        $product = Product::find($request->product_id);
        return view('vendor_panel.order.print')
        ->with(compact('orders','carts','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
