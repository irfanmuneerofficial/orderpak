<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\VendorPayout;
use App\Models\Shopinfo;
use App\Models\AddCart;
use App\Models\OrderBook;
use File;
use Illuminate\Support\Facades\Hash;
use App\Models\BlockedIp;
use App\Traits\SitemapTrait;

class VendorController extends Controller
{
    use SitemapTrait;
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
    	$vendors = Vendor::orderBy('id', 'desc')->get();
    	return view('admin.vendor.index')
    	->with(compact('vendors'));
    }
    
    public function vendor_active(Request $request)
    {
        $vendors = Vendor::where('status','ACTIVE')->orderBy('id', 'desc')->paginate(10);
    	return view('admin.vendor.active_vendors')
    	->with(compact('vendors'));
    }
    
    public function vendor_deactive(Request $request)
    {
        $vendors = Vendor::where('status','DEACTIVE')->orderBy('id', 'desc')->paginate(10);
    	return view('admin.vendor.deactive_vendors')
    	->with(compact('vendors'));
    }
    
    public function vendor_suspend(Request $request)
    {
        $vendors = Vendor::where('status','SUSPEND')->orderBy('id', 'desc')->paginate(10);
    	return view('admin.vendor.suspend_vendors')
    	->with(compact('vendors'));
    }

    public function showproduct()
    {
        //print_r('dsa');die;
        $categories = Category::get();
        $pcategories = ParentCategory::get();
    	$ccategories = ChildCategory::get();
    	$products = Product::where('vendor_id',request()->get('vendor_id'))->orderBy('id', 'desc')->paginate(10);
    	return view('admin.vendor.product')
    	->with(compact('products','categories','pcategories','ccategories'));
    }

    public function product_status(Request $request,$id)
    {
        $data = Product::find($id);
        $status = $_GET['status'];
        // print_r($status);die;
        $data->admin_status = $status;
        // $data->admin_status = $data->admin_status =='PENDING' ? 'APPROVED' : ($data->admin_status =='APPROVED' ? 'REJECTED' : 'APPROVED');

        $data->save();
        
        //ADD Product Sitemap
        $this->SitemapProduct($request,$data,'product','product','add');
        
        return back()->with('success', 'Product status updated successfully!');
    }

    public function vendor_status(Request $request)
    {
        $data = Vendor::find($request->id);
        $data->status = request('status');
        
        if($data->status =='ACTIVE'){
        Mail::to($data->business_email)->send(new \App\Mail\VendorActive());
        } 
        elseif($data->status =='DEACTIVE'){
        Mail::to($data->business_email)->send(new \App\Mail\VendorDeactive());
        }
        elseif($data->status =='SUSPEND'){
        Mail::to($data->business_email)->send(new \App\Mail\VendorSuspend());
        }
        elseif($data->status =='PENDING'){
        Mail::to($data->business_email)->send(new \App\Mail\VendorPending());
        }
        // print_r(request('status'));die;
        $data->save();
        //Vendor ADD Sitemap
        $this->SitemapCUD($request,$data,'shop','vendor','add');
        
        return back()->with('success', 'Status updated successfully!');
    }

    public function venodrspayout()
    {
        $payouts = VendorPayout::orderBy('id', 'desc')->get();
        $vendors = Vendor::orderBy('id', 'desc')->get();
        return view('admin.vendor.payouts')->with(compact('vendors','payouts'));
    }

    public function venodrspayout_detail($id)
    {
        $payout = VendorPayout::find($id);
        return view('admin.vendor.payouts_detail')->with(compact('payout'));
    }

    public function vendor_delete($id)
    {
        $vendor = Vendor::find($id);

        // delete carts
        $carts = AddCart::where('vendor_id',explode(",",$id))->get();

        foreach ($carts as $cart) {
            $cart->delete();
        }

        // delete orders
        $orders = OrderBook::where('vendor_id',explode(",",$id))->get();

        foreach ($orders as $order){
            $order->delete();
        }

        //Vendor Delete Sitemap 
        $this->SitemapCUD(NULL,$vendor,'shop','vendor','delete');
        
        // delete vendors
        $products = Product::where('vendor_id',explode(",",$id))->get();
        $product_path = 'uploads/product_images/';

        foreach($products as $product) {
            $productImage1 = $product->image_1;
            $productImage2 = $product->image_2;
            $productImage3 = $product->image_3;
            $productImage4 = $product->image_4;
            $productImage5 = $product->image_5;
            $productImage6 = $product->image_6;
            $product->delete();

            File::delete($product_path. $productImage1);
            File::delete($product_path. $productImage2);
            File::delete($product_path. $productImage3);
            File::delete($product_path. $productImage4);
            File::delete($product_path. $productImage5);
            File::delete($product_path. $productImage6);
        }

        // delete shop
        $shop = Shopinfo::where('vendor_id', $id)->first();
        $shop_path = 'uploads/vendor/shop/';
        
        if($shop){
        $shop->delete();
        File::delete($shop_path. $shop->shop_img);
        }

        // delete vendor
        $vendor->delete();


        return back()->with('success', 'Your vendor has been deleted!');
    }

    public function edit($id)
    {
    
        $vendor = Vendor::find($id);
        return view('admin.vendor.edit')
        ->with(compact('vendor'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_vendor(Request $request, $id)
    {
        
        $vendor = Vendor::find($id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'alternate_phone_no' => 'required|regex:/^[0-9]*$/|size:10',
            'business_name' => 'required|unique:vendors,business_name,'.$vendor->id,
            'business_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'cnic' => 'required|regex:/^[0-9]{5}-[0-9]{7}-[0-9]$/|unique:vendors,cnic,'.$vendor->id,
            'business_email' => 'required|email|unique:vendors,business_email,'.$vendor->id,
            'phone_no' => 'required|regex:/^[0-9]*$/|size:10|unique:vendors,phone_no,'.$vendor->id,
        ]);

        $vendor->update([
            'first_name'=> $request['first_name'],
        	'last_name'=> $request['last_name'],
            'phone_no'=> $request['phone_no'],
        	'alternate_phone_no'=> $request['alternate_phone_no'],
            'business_name'=> $request['business_name'],
            'slug' => str_slug($request['business_name'],'-'),
        	'business_email'=> $request['business_email'],
        	'business_address'=> $request['business_address'],
            'city'=> $request['city'],
        	'state'=> $request['state'],        	
        	'cnic'=> $request['cnic'],
        ]);
        
        //SITEMAP
        $this->SitemapCUD($request,$vendor,'shop','vendor','update');        
       //Vendor Update Sitemap
       if($request['business_name'] != $vendor->business_name)
       {
            $products = Product::where('vendor_id',$vendor->id)->first();
            $products->brand_id = $vendor->business_name;
            $products->save();
       }
        
        return redirect()->to('admin/vendors')->with('success', 'Vendor updated successfully!');
    }

    public function change_password(Request $request, $id){

        $vendor = Vendor::find($id);
        
        $request->validate([
            'password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $vendor->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->to('admin/vendors')->with('success', 'Password changed successfully!');

    }

    public function vendor_blocked(Request $request)
    {
        $data = $request->all();
        $data['color_code']  = '#800080';
        BlockedIp::create([
            'user_id' => $data['vendor_id'],
            'ip' => $data['ip_address'],
            'color_code' => $data['color_code']
        ]);

        return response()->json(['success'=>'Ajax request submitted successfully']);
    }

    public function vendor_unblock_ip($id)
    {
        $blocked_ip = BlockedIp::find($id);
        
        $blocked_ip->delete();

        return back()->with('success', 'Your vendor has been unblocked!');
    }
    
}