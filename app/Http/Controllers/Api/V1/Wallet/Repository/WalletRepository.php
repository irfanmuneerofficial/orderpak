<?php

namespace App\Http\Controllers\Api\V1\Wallet\Repository;

use App\Http\Controllers\Api\V1\Wallet\Interfaces\WalletInterface;
use App\Models\PaymentTransfer;
use App\Models\OrderBook;
use Illuminate\Http\Request;
use Validator;

class WalletRepository implements WalletInterface{

    public function WalletList(Request $request){
        $sort_type='asc';
        $sort_column='paymenttransfer.id';
        $paginate='';
        $search='';
        if($request->has('paginate'))
        $paginate=(int)$request->paginate;
        if($request->has('sort'))
        $sort_type=$request->sort;
        if($request->has('sort_column'))
        $sort_column=$request->sort_column;
        if($request->has('search'))
        $search=$request->search;;

        $usr=auth('apivendor')->user();
        // $usr_id = 277;
        // return $usr->id;
        $respone['paid_list']=PaymentTransfer::select('paymenttransfer.id as id', 'file as Slip Image','amount','sdate as start date','edate as end dates','business_name as Vendor Name')
        ->where('vendor_id',$usr->id)
        ->join('vendors', 'paymenttransfer.vendor_id', '=', 'vendors.id')
        ->where(function($query)use($search){
            $query->where('business_name', 'like', '%' . $search . '%')
            ->orWhere('amount', 'like', '%' . $search . '%')
            ->orWhere('sdate', 'like', '%' . $search . '%')
            ->orWhere('edate', 'like', '%' . $search . '%');
        })
        ->orderBy($sort_column,$sort_type)
        ->paginate($paginate);

        $respone['total_paid']=PaymentTransfer::where('vendor_id',$usr->id)->sum('amount');

        $payment_pending = OrderBook::select('product_sale_price','product_price')->where('vendor_id',$usr->id)->where('vpay_status','unpaid')->get();        
        $unpaid_amount = 0;
        if($payment_pending)
        {
            foreach($payment_pending as $unpaid)
            {
                if($unpaid->product_sale_price == 0){
                    $unpaid_amount += $unpaid->product_price;
                }
              else
              {
                $unpaid_amount += $unpaid->product_sale_price;
              }
            }
        }

      $respone['unpaid_amount']= $unpaid_amount;
        /*   if(count($respone)>0)
        {
            $respone['image_url']='/uploads/admin/payment_transfer/';
            $respone['Wallet']=PaymentTransfer::where('vendor_id',$usr->id)->sum('amount');
        }  */

        return $respone;

    }
}

