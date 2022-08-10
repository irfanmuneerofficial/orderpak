<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\AddCart;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\OrderBook;
use App\Models\OrderUserDetail;
use App\Models\Shipping;
use App\Models\ProductAttribute;
use Auth;
use DB;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Admin;
use Notification;
use App\Notifications\NewOrderNotification;

class AddCartController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        
    }
    
    public function index()
    {
        if(Auth::guard('vendor')->check()){
            return redirect('/vendor/login');
        }

        $session = new Session();

        $data = new AddCart;
        $products = new Product;

        if(Auth::check()){
            // dd('Auth');
            $userid = Auth::user()->id;
            // $data = AddCart::where('user_id',$userid)->get();
            $data = AddCart::select('vendor_id',
            'user_id',
            'product_id',
            'product_name',
            'product_img',
            'product_sku',
            'systematic_sku',
            'product_sale_price',
            'product_price',
            'quantity',
            'size',
            'color',
            'shipping',
            'status',
            'product_attr_id')->where('user_id',$userid)->get();            
            //gettind cart product for simple product and attribute one
            $productsInCart = AddCart::where('user_id',$userid)->pluck('product_id')->toArray();
            $AttproductsInCart = AddCart::where('user_id',$userid)->pluck('product_attr_id')->toArray();

            // $products = Product::get();
            // $products = Product::select('id','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','vendor_status','admin_status','category_id','parent_id','child_id','size_qty','product.image_1','title','systematic_sku')->get();            
            $products = Product::select('id','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','vendor_status','admin_status','category_id','parent_id','child_id','size_qty','product.image_1','title','systematic_sku')->whereIn('id',$productsInCart)
            ->with('productAttribute', function ($query) use ($AttproductsInCart) {
                $query->whereIn('id',$AttproductsInCart);
            })->get();
        }
        else{
            if($session->get('guest_chk')){
                // dd('Guest');                
                $userid = $session->get('guest_chk');
                // $data = AddCart::where('user_id',$userid)->get();
                $data  = AddCart::select('vendor_id',
                'user_id',
                'product_id',
                'product_name',
                'product_img',
                'product_sku',
                'systematic_sku',
                'product_sale_price',
                'product_price',
                'quantity',
                'size',
                'color',
                'shipping',
                'status',
                'product_attr_id')->where('user_id',$userid)->get();

                $product_cart = $data->toArray();
                $productsInCart = AddCart::where('user_id',$userid)->pluck('product_id')->toArray();
                $AttproductsInCart = AddCart::where('user_id',$userid)->pluck('product_attr_id')->toArray();                                
                // dd($data);
                // dd($data->items[0]->product_id);
                // $products = Product::select('id','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','vendor_status','admin_status','category_id','parent_id','child_id','size_qty','product.image_1','title','systematic_sku')->get();
                $products = Product::with('productAttribute')->select('id','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','vendor_status','admin_status','category_id','parent_id','child_id','size_qty','product.image_1','title','systematic_sku')->get();
                // dd($products);
            }
        }
        
        return view('cart')
        ->with(compact('data','products'));
    }
    
    public function addtocart(Request $request, $slug)
    {
        if(Auth::guard('vendor')->check()){
            return redirect('/vendor/login');
        }
        // dd($request->all());
        $userid = Auth::user()->id;
        // print_r($userid);die;
        $product = Product::select('id','title','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','category_id','parent_id','child_id','size_qty','product.image_1','systematic_sku')->where('slug', $slug)->first();


        if($product->productAttribute)
        {
            $attr_product = ProductAttribute::where([
                ['product_id', '=', $product->id],
                ['id', '=', $request->aid]
                ])->get();
        }
        else{
            $attr_product=0;
        }
        // dd(sizeof($attr_product));
        $carts = AddCart::where('product_id',$product->id)->where('user_id',$userid)->first();
        $shipping_parent = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->first();
        $pshipping = $shipping_parent->parent_price ?? '';

        if(!empty($product->child_id)){
            $shipping_child = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->where('child_id', $product->child_id)->first();
            $cshipping = $shipping_child->child_price ?? '';
        }

        
        if($carts){
            $carts->delete();
        }
        $quantity = $request['quantity'];
        $color = $request['color'];
        // $size = $request['size'];
        $size = str_replace('dot','.',$request['size']);

        $cart = new AddCart;
        $cart->user_id = $userid;
        $cart->vendor_id = $product->vendor_id;
        $cart->product_id = $product->id;
        $cart->product_name = $product->title;
        $cart->category_id = $product->category_id;
        $cart->parent_id = $product->parent_id;
        $cart->child_id = $product->child_id;
        if(sizeof($attr_product)==0)
        {
            $cart->product_price = $product->price;
            $cart->product_img = $product->image_1;
            $cart->product_sku = $product->product_sku;
            $cart->systematic_sku = (!empty($product->systematic_sku)) ? $product->systematic_sku : '';
            $cart->product_sale_price = $product->sale_price;
        }
        else{
            // $cart->product_price = $proAttr[0]->price;
            $cart->product_price = $attr_product[0]->price;
            $cart->product_attr_id = $attr_product[0]->id;            
            $cart->product_img = $attr_product[0]->attr_image;
            $cart->product_sku = $attr_product[0]->sku;
            $cart->systematic_sku = $attr_product[0]->attr_systematic_sku;
//----------sale price-----------------
            // unset($sdate);
            // unset($edate);
            // if($attr_product[0]->attr_sale_start !='' && $attr_product[0]->attr_sale_end !='')
            // {
            //     $date1 = \Carbon\Carbon::now();
            //     $startDate = \Carbon\Carbon::parse($attr_product[0]->attr_sale_start.' 00:00:01');
            //     $sdate = $date1->gte($startDate);

            //     $date2 = \Carbon\Carbon::now();
            //     $endDate = \Carbon\Carbon::parse($attr_product[0]->attr_sale_end.' 23:59:58');
            //     $edate = $date2->lte($endDate);
            //     if(($sdate == true)&&($edate == true))
            //     {
            //        $sale ='true';
            //        $cart->product_sale_price = $$attr_product[0]->attr_sale_price;
            //     }
            //     else{
            //         $sale ='false';
            //         $cart->product_sale_price = 0;
            //     }
            // }
          // }      
//----------sale price-----------------
            $cart->product_sale_price = $attr_product[0]->attr_sale_price;
            // echo $cart->product_price = $AttrPrice;
            // $cart->product_img = $AttrImage;
            // $cart->product_sku = $product->product_sku;

        }
        $cart->quantity = $quantity;
        $cart->size = $size;

        if(!empty($product->child_id))
            $cart->shipping = $cshipping;
        else
            $cart->shipping = $pshipping;

        if(sizeof($attr_product)!=0)
        {
            $cart->product_attr_id = $attr_product[0]->id;            
        }
        $cart->color = $color;
        $cart->save();
        return redirect('/cart');
    }

    public function addtocart_guest_new(Request $request, $slug)
    {
        // dump('addtocart_guest_new');
        // dd($request->all());
        if(Auth::guard('vendor')->check()){
            return redirect('/vendor/login');
        }
        $session = new Session();
        $userid = '';

        $userid =  $session->get('guest_chk');
        if (empty($userid) && !isset($userid)){
            $session->set('guest_chk', 'g_'.time());
            $userid =  $session->get('guest_chk');
        }
     
        $product = Product::select('id','title','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','sale_details','quantity','category_id','parent_id','child_id','size_qty','product.image_1','systematic_sku')->where('slug', $slug)->first();
        // dd($product);
        $attr_product = $product->productAttribute->where('id',$request->aid)->first();  
        // dd($attr_product);
        $carts = AddCart::where('product_id',$product->id)->first();
        $shipping_parent = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->first();
        $pshipping = $shipping_parent->parent_price ?? '';

        if(!empty($product->child_id)){
            $shipping_child = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->where('child_id', $product->child_id)->first();
            $cshipping = $shipping_child->child_price ?? '';
        }
        
        // dd($cshipping);

        
        if($carts){
            $carts->delete();
        }

        $quantity = $request['quantity'];
        $color = $request['color'];
        // $size = $request['size'];
        $size = str_replace('dot','.',$request['size']);


        $cart = new AddCart;
        $cart->user_id = $userid;
        $cart->vendor_id = $product->vendor_id;
        $cart->product_id = $product->id;
        $cart->product_name = $product->title;
        $cart->category_id = $product->category_id;
        $cart->parent_id = $product->parent_id;
        $cart->child_id = $product->child_id;
        if(!isset($attr_product))
        {
            // dump('product attribute not set');
            $cart->product_price = $product->price;
            $cart->product_img = $product->image_1;
            $cart->product_sku = $product->product_sku;
            $cart->systematic_sku = (!empty($product->systematic_sku)) ? $product->systematic_sku : '';
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
                $cart->product_sale_price = $product->sale_price;
              }
              else{
                $cart->product_sale_price = 0;
              }
            }             
            // $cart->product_sale_price = $product->sale_price;
        }
        else{
            // $cart->product_price = $proAttr[0]->price;
            // dd('product attributeset'.$attr_product->price);
            $cart->product_price = $attr_product->price;
            $cart->product_attr_id = $attr_product->id;            
            $cart->product_img = $attr_product->attr_image;
            $cart->product_sku = $attr_product->sku;
            $cart->systematic_sku = (!empty($attr_product->attr_systematic_sku)) ? $attr_product->attr_systematic_sku : '';
            //------------------------------
            if($attr_product->attr_sale_start !='' && $attr_product->attr_sale_end !='')
            {
                $date1 = \Carbon\Carbon::now();
                $startDate = \Carbon\Carbon::parse($attr_product->attr_sale_start.' 00:00:01');
                $sdate = $date1->gte($startDate);
        
                $date2 = \Carbon\Carbon::now();
                $endDate = \Carbon\Carbon::parse($attr_product->attr_sale_end.' 23:59:58');
                $edate = $date2->lte($endDate);
                if(($sdate == true)&&($edate == true))
                {
                   $sale ='true';
                   $sale_price =$attr_product->attr_sale_price;
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
            $cart->product_sale_price = $sale_price;
        }
        $cart->quantity = $quantity;
        $cart->size = $size;
    
        if(!empty($product->child_id))
        $cart->shipping = $cshipping;
        else
        $cart->shipping = $pshipping;

        $cart->color = $color;
        $cart->save();
        return redirect('/cart');
    }
    
    public function add(Request $request)
    {
        $userid = Auth::user()->id;
        // print_r($userid);die;
        $productid = $request['product_id'];
        $vendor_id = $request['vendor_id'];
        $carts = AddCart::where('product_id',$productid)->where('user_id',$userid)->first();
        $product = Product::find($productid);
        
        $shipping_parent = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->first();
        $pshipping = $shipping_parent->parent_price ?? '';

        if(!empty($product->child_id)){
            $shipping_child = Shipping::where('main_id', $product->category_id)->where('parent_id', $product->parent_id)->where('child_id', $product->child_id)->first();
            $cshipping = $shipping_child->child_price ?? '';
        }
        // dd($cshipping);

        
        if($carts){
            $carts->delete();
        }

        $quantity = $request['quantity'];
        $color = $request['color'];
        // $size = $request['size'];
        $size = str_replace('dot','.',$request['size']);

        $cart = new AddCart;
        $cart->user_id = $userid;
        $cart->vendor_id = $vendor_id;
        $cart->product_id = $productid;
        $cart->product_name = $product->title;
        $cart->product_img = $product->image_1;
        $cart->category_id = $product->category_id;
        $cart->parent_id = $product->parent_id;
        $cart->child_id = $product->child_id;
        $cart->product_sku = $product->product_sku;
        $cart->product_sale_price = $product->sale_price;
        $cart->product_price = $product->price;
        $cart->quantity = $quantity;
        $cart->size = $size;
    
        if(!empty($product->child_id))
        $cart->shipping = $cshipping;
        else
        $cart->shipping = $pshipping;

        $cart->color = $color;
        $cart->save();
        return redirect('/cart');
    }

    public function checkout()
    {
        // dump('checkout');
        if(Auth::guard('vendor')->check()){
            return redirect('/vendor/login');
        }
        $session = new Session();
        if(Auth::user()){
            
            $userid = Auth::user()->id;
        }
        else{
            if($session->get('guest_chk')){
                $userid = $session->get('guest_chk');
            }
        }
        // $userid = Auth::user()->id;
        $data = AddCart::where('user_id',$userid)->get();
        // print_r($data); die;
        // $product = Product::find($data->);

        $ship_price = AddCart::where('user_id',$userid)->max('shipping');
        // print_r($ship_price);die;
        // $adjustid = AddCart::where('shipping',$ship_price)->pluck('id')->first();
        
        // $adjustid =  AddCart::where('shipping',$ship_price)->pluck('id')->first();
        // print_r($adjustid);die;
        
            // print_r($ship_price); die;
        // $ship_price = DB::table("add_cart as cart")->where('user_id',$userid)->select(DB::raw('MAX(cart.shipping) AS price_max'))->max('cart.shipping');

        // $products = Product::select('id','title','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','category_id','parent_id','child_id','size_qty','product.image_1','systematic_sku')->get();
        $productsInCart = AddCart::where('user_id',$userid)->pluck('product_id')->toArray();
        $AttproductsInCart = AddCart::where('user_id',$userid)->pluck('product_attr_id')->toArray();

        $products = Product::select('id','vendor_id','product_sku','color_check','colors','condition','price','sale_status','sale_price','quantity','vendor_status','admin_status','category_id','parent_id','child_id','size_qty','product.image_1','title','systematic_sku')->whereIn('id',$productsInCart)
        ->with('productAttribute', function ($query) use ($AttproductsInCart) {
            $query->whereIn('id',$AttproductsInCart);
        })->get();

        //comments 13112021 $products = Product::get();
        // $shippings = Shipping::get();
        return view('checkout')
        ->with(compact('data','products', 'ship_price'));
    }

    public function orderbooked(Request $request)
    {
        // dd('Add to cart order booked');
        if(Auth::guard('vendor')->check()){
            return redirect('/vendor/login');
        }
        $session = new Session();
        if(Auth::user()){
            
            $userid = Auth::user()->id;
        }
        else{
            if($session->get('guest_chk')){
                $userid = $session->get('guest_chk');
            }
        }
        
        $cartid = json_encode($request['cart_id']);
        
        $orderid = date('s') . rand();
        foreach (json_decode($cartid) as $key => $value) {
            $cart = AddCart::find($value);
            $cart->status = 'Pending';
            $cart->save();
        }
        $orders =[];
        foreach (json_decode($cartid) as $key => $value) 
        {
            // print_r($request->adjustid);die;
            $cart = AddCart::find($value);
            
            // $product = Product::find($cart->product_id);
            // print_r($product);die;
            // dd($cart['quantity']);
            $product = Product::find($cart['product_id']);
            if($cart['product_attr_id']!='')
            {
                $product_attr = ProductAttribute::where([["id",'=',$cart['product_attr_id']], ["product_id",'=', $cart['product_id']]])->get();
            }
            $orders[] =  $order = new OrderBook;
            $order->cart_id = $value;
            $order->order_id = $orderid;
            $order->vendor_id = $cart['vendor_id'];
            $order->user_id = $request['user_id'];
            
            $order->product_name = $cart['product_name'];
            $order->product_img = $cart['product_img'];
            $order->category_id = $cart['category_id'];
            $order->parent_id = $cart['parent_id'];
            $order->child_id = $cart['child_id'];
            $order->product_sku = $cart['product_sku'];
            $order->systematic_sku = (!empty($cart['systematic_sku'])) ? $cart['systematic_sku'] : '';
            $order->product_sale_price = $cart['product_sale_price'];
            $order->product_price = $cart['product_price'];
            
            $order->product_id = $cart['product_id'];
            $order->name = $request['name'];
            $order->email = $request['email'];
            $order->phone = $request['phone'];
            $order->cash_delivery_no = $request['cash_delivery_no'];
            $order->city = $request['city'];
            $order->zipcode = $request['zipcode'];
            $order->address = $request['address'];
            $order->state = $request['state'];
            $order->amount = $request['amount'];
            $order->address = $request['address'];
            $order->message = $request['message'];
            $order->quantity = $cart['quantity'];
            $order->size = $cart['size'];
            $order->color = $cart['color'];
            $order->product_attr_id = $cart['product_attr_id'];
            $order->shipping = str_replace(",", "", $request['shipping']);
            
            $order->status = 'Pending';
            $order->save();
            
            
            // print_r($product);die;
            if($cart['product_attr_id']!='')
            {
                $qty = $product_attr[0]->quantity - $cart->quantity;
                $order->product_attr_id = $cart['product_attr_id'];
                ProductAttribute::where("id", $cart['product_attr_id'])->update(["quantity" => $qty]);
            }
            else{
                $qty = $product->quantity - $cart->quantity;
                $product->update([
                    'quantity' => $qty
                ]);                
            }
            
            $data = OrderUserDetail::where('order_id',$orderid)->where('vendor_id',$cart['vendor_id'])->first();
            if(empty(json_decode($data))){
                $new_data = OrderUserDetail::create([
                    'order_id' => $orderid,
                    'user_id' => $userid,
                    'vendor_id' => $cart['vendor_id'],
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
            }
            
            $vendor = Vendor::find($cart['vendor_id']);
            $data = AddCart::find($value);
            $order_id = $orderid;
            $address = $request['address'];
            Mail::to($vendor->business_email)->send(new \App\Mail\VendorBookOrder($data,$product,str_replace(",", "", $request['shipping']),$order_id,$address));
            
            $username= $request['name'];
            // Mail::to($request['email'])->send(new \App\Mail\BookOrder($data,$product,str_replace(",", "", $request['shipping']),$username,$orderid));
            
            $cart->delete();
        }
        
        //02April2022
        $user = Admin::where('id',1)->get();
        Notification::send($user, new NewOrderNotification($new_data));        

        $shipprice = str_replace(",", "", $request['shipping']);
        Mail::to($request['email'])->send(new \App\Mail\BookOrder($orders,$product,str_replace(",", "", $request['shipping']),$username,$orderid));
        Mail::to('admin@orderpak.com')->send(new \App\Mail\AdminBookOrder($orders,$product,$shipprice));
        
        return redirect('/thankyou');

    }

    public function delete($id)
    {
        // print_r($id);
        $data = AddCart::find($id);
        $data->delete();
    }
    
    public function remove($id)
    {
        // print_r($id);
        $data = AddCart::find($id);
        $data->delete();
        return redirect()->back();
    }
    
    public function add_cart_quantity($id)
    {
        $data =  AddCart::find($id);
        $data->update([
            'quantity'  => $data->quantity + 1,

        ]);
        return response()->json(['data'=>$data->quantity]);
    }

    public function min_cart_quantity($id)
    {
        $data =  AddCart::find($id);
        $data->update([
            'quantity'  => $data->quantity - 1,

        ]);
        return response()->json(['data'=>$data->quantity]);
    }
}