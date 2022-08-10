<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\AddCart;
use App\Models\Shipping;
use App\Models\OrderBook;
use App\Models\OrderUserDetail;
use App\Models\Vendor;
use App\Models\ProductAttribute;
use App\Models\Admin;
use Notification;
use App\Notifications\NewOrderNotification;

class GuestCheckoutController extends Controller
{
    public function checkoutg(Request $request,$id)
    {
        // $product = Product::where('slug', $id)->first();
        $product = Product::where('slug', $id)
        ->with('productAttribute', function ($query) use ($request) {
            $query->where('id',$request->aid);
        })->first();


        $shipping_parent = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->first();
        $pshipping = $shipping_parent->parent_price ?? '0';
        $attribute =array('color'=>$request->color,'size'=>$request->size);

        if(!empty($product->child_id)){
            $shipping_child = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->where('child_id', $product->child_id)->first();
            $cshipping = $shipping_child->child_price ?? '0';
        }

        if(!empty($product->child_id)){
            return view('guest_checkout')->with(compact('product', 'pshipping', 'cshipping','attribute'));
        }
        else{
            return view('guest_checkout')->with(compact('product', 'pshipping','attribute'));
        }

    }

    public function checkout($id)
    {
        // $product = Product::find($id);
        $product = Product::where('id', $id)
        ->with('productAttribute', function ($query) use ($request) {
            $query->where('id',$request->aid);
        })->first();

        $shipping_parent = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->first();
        $pshipping = $shipping_parent->parent_price ?? '0';

        if(!empty($product->child_id)){
            $shipping_child = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->where('child_id', $product->child_id)->first();
            $cshipping = $shipping_child->child_price ?? '0';
        }

        if(!empty($product->child_id)){
            return view('guest_checkout')->with(compact('product', 'pshipping', 'cshipping'));
        }
        else{
            return view('guest_checkout')->with(compact('product', 'pshipping'));
        }
    }

    public function guest_order_book(Request $request)
    {
        // print_r('sad');die;
        $productid = $request['product_id'];
        // $product = Product::find($productid);
        $product = Product::where('id', $productid)
        ->with('productAttribute', function ($query) use ($request) {
            $query->where('id',$request->aid);
        })->first();        
        
        if(count($product->productAttribute) > 0)
        {
            $qty =  $product->productAttribute[0]->quantity - $request['quantity'];
            ProductAttribute::where("id", $request->aid)->update(["quantity" => $qty]);
        }
        else{
            $qty = $product->quantity - $request['quantity'];
            $product->update([
                'quantity' => $qty
            ]);
        }

        
        $orderid = date('s') . rand();
        $orders[] = $order = new OrderBook;
        $order->cart_id = 'guest';
        $order->order_id = $orderid;
        $order->vendor_id = $request['vendor_id'];
        $order->user_id = 'guest';
        $order->product_id = $request['product_id'];
        $order->name = $request['name'];
        
        $order->product_name = $product->title;
        $order->category_id = $product->category_id;
        $order->parent_id = $product->parent_id;
        $order->child_id = $product->child_id;
        if(count($product->productAttribute) > 0)
        {
            $order->product_sku = $product->productAttribute[0]->sku;    
            $order->systematic_sku = (!empty($product->productAttribute[0]->attr_systematic_sku)) ? $product->productAttribute[0]->attr_systematic_sku : '';
            $order->product_price = $product->productAttribute[0]->price;
            $order->product_img = $product->productAttribute[0]->attr_image;
            $order->product_attr_id = $request->aid;
            //------------------------------
            if($product->productAttribute[0]->attr_sale_start !='' && $product->productAttribute[0]->attr_sale_end !='')
            {
                $date1 = \Carbon\Carbon::now();
                $startDate = \Carbon\Carbon::parse($product->productAttribute[0]->attr_sale_start.' 00:00:01');
                $sdate = $date1->gte($startDate);
        
                $date2 = \Carbon\Carbon::now();
                $endDate = \Carbon\Carbon::parse($product->productAttribute[0]->attr_sale_end.' 23:59:58');
                $edate = $date2->lte($endDate);
                if(($sdate == true)&&($edate == true))
                {
                   $sale ='true';
                   $sale_price =$product->productAttribute[0]->attr_sale_price;
                }
                else{
                    $sale ='false';
                    $sale_price =0;

                }
              }else{
                $sale ='false';
                $sale_price =0;
            }
          //------------------------------            
            $order->product_sale_price = $sale_price;
        }
        else{
            $order->product_sku = $product->product_sku;
            $order->systematic_sku = (!empty($product->systematic_sku)) ? $product->systematic_sku : '';
            //simple product sale price checking
            if($product->sale_status ==1)
            {
              $simple_sale_date = explode(" ",$product->sale_details);
              $data['start_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $simple_sale_date[0])->format('Y-m-d');
              $data['end_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $simple_sale_date[2])->format('Y-m-d');
              $date11 = \Carbon\Carbon::now();
              $startDate11 = \Carbon\Carbon::parse($data['start_date'].' 00:00:01');
              $sdate11 = $date11->gte($startDate11);
              $date22 = \Carbon\Carbon::now();
              $endDate22 = \Carbon\Carbon::parse($data['end_date'].' 23:59:58');
              $edate22 = $date22->lte($endDate22);
              if(($sdate11 == true)&&($edate22 == true))
              {
                $order->product_sale_price = $product->sale_price;
              }
              else{
                  $order->product_sale_price = 0;
              }
            } 
            // $order->product_sale_price = $product->sale_price;
            $order->product_price = $product->price;
            $order->product_img = $product->image_1;

        }

        $order->email = $request['email'];
        $order->phone = $request['phone'];
        $order->cash_delivery_no = $request['cash_delivery_no'];
        $order->city = $request['city'];
        $order->zipcode = $request['zipcode'];
        $order->address = $request['address'];
        $order->state = $request['state'];
        $order->amount = $request['amount'];
        $order->quantity = $request['quantity'];
        $order->size = $request['size'];
        $order->color = $request['color'];
        $order->shipping = $request['shipping'];
        $order->message = $request['message'];
        $order->product_attr_id = $request->aid;            
        $order->status = 'Pending';
        $order->save();

        $shipprice = $request['shipping'];
                
        $vendor = Vendor::find($request['vendor_id']);
        
        $order_user = OrderUserDetail::create([
            'order_id' => $orderid,
            'user_id' => 'guest',
            'vendor_id' => $request['vendor_id'],
            'name' => $request['name'],
            'email' => $request['email'],
            'phone_no' => $request['phone'],
            'city' => $request['city'],
            'zipcode' => $request['zipcode'],
            'state' => $request['state'],
            'address' => $request['address'],
            'message' => $request['message'],
            'amount' => $request['amount'],
            'status' => 'Pending',
        ]);
        
        //02April2022
        $user = Admin::where('id',1)->get();
        Notification::send($user, new NewOrderNotification($order_user));
        
        // $data = $orders;
        // print_r($data);die;
        $address = $request['address'];
        Mail::to($vendor->business_email)->send(new \App\Mail\VendorGuestBookOrder($orders,$product,str_replace(",", "", $request['shipping']),$orderid,$address));
        $username= $request['name'];
        Mail::to($request['email'])->send(new \App\Mail\GuestBookOrder($orders,$product,str_replace(",", "", $request['shipping']),$username,$orderid));
        Mail::to('admin@orderpak.com')->send(new \App\Mail\AdminBookOrder($orders,$product,$shipprice));
        // return redirect('/thankyou');
    }
}
