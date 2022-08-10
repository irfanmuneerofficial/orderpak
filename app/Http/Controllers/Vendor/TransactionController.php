<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transactions;
use App\Models\AdminTransferAmount;
use App\Models\PaymentTransfer;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\OrderBook;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }
    
    public function index()
    {
        //
    }

    public function wallet()
    {
        
        $vendorId = Auth::guard('vendor')->user()->id;
        $myamount = PaymentTransfer::where('vendor_id',$vendorId)->sum('amount');
        $myamountdetails = PaymentTransfer::where('vendor_id',$vendorId)->orderBy('id','desc')->get();
        $products = Product::where('vendor_id',$vendorId)->orderBy('id','desc')->get();
        $vendors = Vendor::get();
        
        // $myamount = PaymentTransfer::get();
        // $payments = PaymentTransfer::get();
        // $products = Product::get();
        // $vendors = Vendor::get();
        $payment_history = PaymentTransfer::where('vendor_id',Auth::guard('vendor')->user()->id)->sum('amount');
        $payment_pending = OrderBook::select('product_sale_price','product_price')->where('vendor_id',Auth::guard('vendor')->user()->id)->where('vpay_status','unpaid')->get();

        return view('vendor_panel.transaction_details.wallet')->with(compact('payment_history','payment_pending','myamount','myamountdetails','vendors','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
        //
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
