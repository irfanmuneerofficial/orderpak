<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\AddCart;
use App\Models\OrderBook;
use App\Models\OrderUserDetail;
use App\Models\Shopinfo;
use App\Models\PaymentTransfer;
use App\Models\Vendor;
use Auth;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function index()
    {
        $aproduct = Product::where('admin_status','APPROVED')->where('vendor_id',Auth::guard('vendor')->user()->id)->get()->count();
        $dproduct = Product::where('admin_status','PENDING')->where('vendor_id',Auth::guard('vendor')->user()->id)->get()->count();
        $rproduct = Product::where('admin_status','REJECTED')->where('vendor_id',Auth::guard('vendor')->user()->id)->get()->count();
        $product = Product::where('vendor_id',Auth::guard('vendor')->user()->id)->get()->count();

        $userid = Auth::guard('vendor')->user()->id;
        $carts = AddCart::get();
        $booked = OrderUserDetail::where('vendor_id',$userid)->get();
        $shop =Shopinfo::where('vendor_id',Auth::guard('vendor')->user()->id)->first();
        $payment_history = PaymentTransfer::where('vendor_id',Auth::guard('vendor')->user()->id)->sum('amount');
        $payment_pending = OrderBook::select('product_sale_price','product_price')->where('vendor_id',Auth::guard('vendor')->user()->id)->where('vpay_status','unpaid')->get();
        $unpaid_amount =0;
        if($payment_pending)
        {
            foreach($payment_pending as $unpaid)
            {
                if($unpaid->product_sale_price == 0)
                {
                    $unpaid_amount += $unpaid->product_price;
                }
              else{
                $unpaid_amount += $unpaid->product_sale_price;
              }
            }
        }
        Vendor::where('id',Auth::guard('vendor')->user()->id)->update(['pending_payment'=>$unpaid_amount]);
        // $products = Product::where('vendor_id',$userid)->get();

        return view('vendor_panel.dashboard.index')
        ->with(compact('aproduct','dproduct','product','rproduct' ,'carts','booked', 'shop','payment_history','payment_pending'));
    }
}