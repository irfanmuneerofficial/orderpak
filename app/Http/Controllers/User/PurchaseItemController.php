<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderBook;
use App\Models\OrderUserDetail;
use App\Models\AddCart;
use App\Models\Product;
use Auth;

class PurchaseItemController extends Controller
{

    private $mp_username;
    private $mp_password;
    private $mp_location_id;
    private $mp_account;

	public function __construct()
    {
        $this->middleware('auth');

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
    	$userid = Auth::user()->id;
        $carts = AddCart::where('user_id',$userid)->get();
		$booked = OrderUserDetail::where('user_id',$userid)->where('status',request('status'))->get();
		$products = Product::get();

    	return view('user_panel.purchase_item')
    	->with(compact('carts','booked','products'));
    }
    
    public function detail($id)
    {
        $order = OrderBook::with('shipment_info')->where('order_id',$id)->first();
        $orders = OrderUserDetail::where('order_id',$id)->get();
        $orderrs = OrderBook::where('order_id',$id)->get();
        // echo '<pre>';
        // print_r($order->shipment_info['consignment_number']);die;
        return view('user_panel.test')
        ->with(compact('order','orders','orderrs'));
    }

     //  track shipment by consignment number
     public function tracking_by_consignmentMP($consignment_number){
        $url = 'http://mnpcourier.com/mycodapi/api/Tracking/Consignment_Tracking?username='.$this->mp_username.'&password='.$this->mp_password.'&consignment='.$consignment_number;
        $response = $this->process_curl_get($url);
        
        if($response){
            return view('user_panel.tracking')
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

    
    public function pending()
    {
    	$userid = Auth::user()->id;
        // print_r($userid);die;
        $carts = AddCart::where('user_id',$userid)->get();
		$booked = OrderUserDetail::where('user_id',$userid)->where('status','Pending')->get();
		$products = Product::get();

    	return view('user_panel.purchase_item')
    	->with(compact('carts','booked','products'));
    }
    
    public function process()
    {
    	$userid = Auth::user()->id;
        $carts = AddCart::where('user_id',$userid)->get();
		$booked = OrderUserDetail::where('user_id',$userid)->where('status','In Process')->get();
		$products = Product::get();

    	return view('user_panel.purchase_item')
    	->with(compact('carts','booked','products'));
    }
    
    public function ship()
    {
    	$userid = Auth::user()->id;
        $carts = AddCart::where('user_id',$userid)->get();
		$booked = OrderUserDetail::where('user_id',$userid)->where('status','Ship')->get();
		$products = Product::get();

    	return view('user_panel.purchase_item')
    	->with(compact('carts','booked','products'));
    }
    
    public function cancel()
    {
    	$userid = Auth::user()->id;
        $carts = AddCart::where('user_id',$userid)->get();
		$booked = OrderUserDetail::where('user_id',$userid)->where('status','Cancel')->get();
		$products = Product::get();

    	return view('user_panel.purchase_item')
    	->with(compact('carts','booked','products'));
    }
    
    public function complete()
    {
    	$userid = Auth::user()->id;
        $carts = AddCart::where('user_id',$userid)->get();
		$booked = OrderUserDetail::where('user_id',$userid)->where('status','Complete')->get();
		$products = Product::get();

    	return view('user_panel.purchase_item')
    	->with(compact('carts','booked','products'));
    }

    public function cart($value='')
    {
        $userid = Auth::user()->id;

        $carts = AddCart::where('user_id',$userid)->get();
        $booked = OrderBook::where('user_id',$userid)->pluck('cart_id');
        // print_r($booked);die;
        $products = Product::get();

        return view('user_panel.cart')
        ->with(compact('carts','products','booked'));
    }


}