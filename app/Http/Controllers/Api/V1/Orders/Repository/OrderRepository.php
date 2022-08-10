<?php

namespace App\Http\Controllers\Api\V1\Orders\Repository;

use App\Http\Controllers\Api\V1\Orders\Interfaces\OrderInterface;
use App\Models\OrderBook;
use App\Models\OrderUserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class OrderRepository implements OrderInterface{

    public function allOrders(Request $request){
        $sort_type='asc';
        $sort_column='order_id';
        $paginate='';
        $search='';
        $filter_status='';

        if($request->has('paginate'))
            $paginate=(int)$request->paginate;
        if($request->has('sort'))
            $sort_type=$request->sort;
        if($request->has('sort_column'))
            $sort_column=$request->sort_column;
        if($request->has('search'))
            $search=$request->search;
        if($request->has('filter_status'))
        {
            $filter_status=$request->filter_status;
            if($filter_status=='All')
                $filter_status='';
        }



        $usr=auth('apivendor')->user();
        return OrderUserDetail::select('order_id', 'name as Customer Name','created_at as date','status')
        ->where('vendor_id',$usr->id)
        ->where('status','like', '%' . $filter_status . '%')
        ->where(function($query)use($search){
            $query->where('order_id', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('created_at', 'like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%');
        })
        ->distinct('order_id')
        ->orderBy($sort_column,$sort_type)
        ->paginate($paginate);

    }

    public function findOrder($id){
        $usr=auth('apivendor')->user();
        $order=OrderUserDetail::where('order_id',$id)->where('vendor_id',$usr->id)->first();
        if(empty($order))
        {
            return null;
        }
        $order_detail=OrderBook::with('vendor:id,business_name')->where('order_id',$id)->where('vendor_id',$usr->id)->get();

        $response=[];
        $response['Order Details']=array();
        $response['Order Details']['OrderId']=$id;
        $response['Order Details']['Total Product']=count($order_detail);
        $response['Order Details']['Total Cost']=(int)$order->amount;
        $response['Order Details']['Ordered Date']=$order->created_at;
        $response['Order Details']['Payment Method']="Cash On Delivery";
        $response['Order Details']['Status']=$order->status;
        $response['Products Ordered']=$order_detail;

        return $response;
    }

    public function genereateInvoice($id){
        $usr=auth('apivendor')->user();
        $orders = OrderBook::where('order_id',$id)->where('vendor_id',$usr->id)->get();
        $total=0;
        $response=[];
        $response['Item']=array();
        $data = [];
        foreach($orders as $item){
            $response['Item']['Order id']=$item->order_id;
            $response['Item']['Product Name']=$item->product_name;
            $response['Item']['SKU']=$item->vendor_id."-".$item->category_id."-".$item->product_sku;
            $response['Item']['color']=$item->color;
            $response['Item']['size']=$item->size;
            $response['Item']['quantity']=$item->quantity;
            $response['Item']['Product image']='/uploads/product_images/'.$item->product_img;
            $response['Item']['price']=$item->product_price;
            $total+=$item->product_price*$item->quantity;
            array_push($data, $response);
        }
        $data['sub total']=$total;
        $data['total']=$total;
        return $data;
    }

    public function changestatus($id){
        $usr=auth('apivendor')->user();
        $order=OrderUserDetail::where('order_id',$id)->where('vendor_id',$usr->id)->first();
        if(empty($order))
        {
            return 422;
        }
        if($order->status!="Complete" && $order->status!="Cancel"){
            OrderUserDetail::where('order_id',$id)->update(['status'=>'In Process']);
            OrderBook::where('order_id',$id)->update(['status'=>'In Process']);
            return 200;
        }
        else{
            return 400;
        }
    }
}
