<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\OrderBook;
use App\Models\OrderUserDetail;
use App\Models\AddCart;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Categories;
use App\Traits\SitemapTrait;

class DashboardController extends Controller
{
    use SitemapTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $date = date('Y-m-d');
        $latest = Product::whereDate('created_at',$date)->where('admin_status','PENDING')->count();
        $avendor = Vendor::where('status','ACTIVE')->count();
        $dvendor = Vendor::where('status','DEACTIVE')->count();
        
        $suspendvendors = Vendor::where('status','SUSPEND')->count();
        $product = Product::get()->count();
        $aproduct = Product::where('admin_status','APPROVED')->count();
        $pproduct = Product::where('admin_status','PENDING')->count();

        $products = Product::paginate(10);
        // $orders = OrderUserDetail::get();
        
        $users = OrderUserDetail::get();
        $usersUnique = $users->unique('order_id');
        $orders = $users->diff($usersUnique);
        $torders =   count($usersUnique) ;
        
        
        // Pending Orders
        
        $pending__all_orders = OrderUserDetail::where('status','Pending')->get();
        $pending__all_ordersUnique = $pending__all_orders->unique('order_id');
        $porders =  count($pending__all_ordersUnique);
        
        
        // In Process Orders
        
        $inprocess__all_orders = OrderUserDetail::where('status','In Process')->get();
        $inprocess__all_ordersUnique = $inprocess__all_orders->unique('order_id');
        // $inprocessorders = $inprocess__all_orders->diff($inprocess__all_ordersUnique);
        $iporders =  count($inprocess__all_ordersUnique) ;
        
        
        // Ship Orders
        
        $ship__all_orders = OrderUserDetail::where('status','Ship')->get();
        $ship__all_ordersUnique = $ship__all_orders->unique('order_id');
        // $shiporders = $ship__all_orders->diff($ship__all_ordersUnique);
        
        $sorders =  count($ship__all_ordersUnique) ;
        
        // Complete Orders
        
        $complate_all_orders = OrderUserDetail::where('status','Complete')->get();
        $complate_all_ordersUnique = $complate_all_orders->unique('order_id');
        // $complateorders = $complate_all_orders->diff($complate_all_ordersUnique);
        
        $corders =  count($complate_all_ordersUnique) ;
        
        // Cancel Orders
        
        $cancel_all_orders = OrderUserDetail::where('status','Cancel')->get();
        $cancel_all_ordersUnique = $cancel_all_orders->unique('order_id');
        // $cancelorders = $cancel_all_orders->diff($cancel_all_ordersUnique);
        $cancelorders =  count($cancel_all_ordersUnique) ;
        
        // Complete Orders amount
        $complete_pay_orders = OrderUserDetail::where('status','Complete')->where('vpay_status','paid')->sum('amount');
        $corderspayment =  $complete_pay_orders ;
        // Complete Orders payment pending 
        $complete_unpay_orders = OrderUserDetail::where('status','Complete')->where('vpay_status','unpaid')->sum('amount');
        $cordersunpaid =  $complete_unpay_orders ;        
        
        $carts = AddCart::get();
        $vendors = Vendor::get();

        return view('admin.dashboard.index')
        ->with(compact('cordersunpaid','corderspayment','avendor','dvendor','torders','users','porders','iporders','sorders','corders','cancelorders','product','aproduct','pproduct','latest','products','orders','carts','vendors','suspendvendors'));
    }
    
    public function showNotification()
    {
        $new_vendor_notifications = auth()->user()->unreadnotifications->where('type', 'App\Notifications\VendorRegisterNotification')->all();
        $new_order_notifications = auth()->user()->unreadnotifications->where('type', 'App\Notifications\NewOrderNotification')->all();
        return view('admin.dashboard.notification')
        ->with(compact('new_order_notifications','new_vendor_notifications'));
    }

    public function notify_count(Request $request)
    {
        $new_vendor_notifications = auth()->user()->unreadnotifications->where('type', 'App\Notifications\VendorRegisterNotification')->all();
        $new_order_notifications = auth()->user()->unreadnotifications->where('type', 'App\Notifications\NewOrderNotification')->all();
        return response()->json(['vendor_count' =>count($new_vendor_notifications), 'order_count' => count($new_order_notifications)]);
    }

    public function markNotification($id)
    {
        // dd($id);
        if($id)
        {
            auth()->user()->notifications->where('id',$id)->markasRead();
        }
        return back();
    }


    public function products()
    {
        $products = Product::paginate(10);
        $categories = Categories::get();
        $pcategories = ParentCategory::get();
        $ccategories = ChildCategory::get();

        return view('admin.product.index')
        ->with(compact('products','categories','pcategories','ccategories'));
    }
    
    public function latest()
    {
        $date = date('Y-m-d');
        $products = Product::whereDate('created_at',$date)->where('admin_status','PENDING')->paginate(10);
        $categories = Category::get();
        $pcategories = ParentCategory::get();
        $ccategories = ChildCategory::get();
        return view('admin.product.latest')
        ->with(compact('products','categories','pcategories','ccategories'));
    }
    
    public function pending()
    {
        $products = Product::where('admin_status','PENDING')->paginate(10);
        $categories = Category::get();
        $pcategories = ParentCategory::get();
        $ccategories = ChildCategory::get();
        return view('admin.product.pending')
        ->with(compact('products','categories','pcategories','ccategories'));
    }
    
    public function approved()
    {
        $products = Product::where('admin_status','APPROVED')->paginate(10);
        $categories = Category::get();
        $pcategories = ParentCategory::get();
        $ccategories = ChildCategory::get();
        return view('admin.product.approved')
        ->with(compact('products','categories','pcategories','ccategories'));
    }
    
    public function subscribe()
    {
        $subscribers = Subscribe::get();
        return view('admin.subscribe.index')
        ->with(compact('subscribers'));
    }
    
    public function Users()
    {
        $users = User::all()->sortByDesc("id");
        return view('admin.users.index')
        ->with(compact('users'));
    }

    public function edit($id)
    {
    
        $user = User::find($id);
        return view('admin.users.edit')
        ->with(compact('user'));
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
        
        $user = User::find($id);

        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|regex:/^[0-9]*$/|size:10|unique:users,phone,'.$user->id,
        ]);

        $user->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->to('admin/users')->with('success', 'User edit successfully!');
    }

    public function changepassword(Request $request, $id){

        $user = User::find($id);

        $request->validate([
            'password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->to('admin/users')->with('success', 'Password changed successfully!');

    }

    public function user_delete($id){
  
        $user = User::find($id);

        // delete carts
        $carts = AddCart::where('user_id',explode(",",$id))->get();

        foreach ($carts as $cart) {
            $cart->delete();
        }

        // delete orders
        $orders = OrderBook::where('user_id',explode(",",$id))->get();

        foreach ($orders as $order){
            $order->delete();
        }

        // delete vendor
        $user->delete();

        return redirect()->to('admin/users')->with('success', 'User deleted successfully!');

    }

    public function product_url_change(Request $request, $id){
        
        $vname = Vendor::select('slug')->where('id',$request->vendor_id)->first();

        $slug = str_slug($request['product_title_keyword'],'-').'-'.$vname->slug.'-'.$id;
        $request['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        $request->validate([
            'product_title_keyword' => 'required|string',
            'slug'    =>  'unique:product,slug,'.$id
        ]);
      
        $proObj = Product::find($id);
        $request->request->add(['old_slug' =>  $proObj->slug]);
        
        $proObj->update([
            'slug' => $request['slug'],
            'product_title_keyword' => $request['product_title_keyword']
        ]);

// 		//Update Sitemap
        if(($proObj->vendor_status =='ACTIVE')&&($proObj->admin_status =='APPROVED'))
        {        
            $this->SitemapProduct($request,$proObj,'product','product','slug_update');
        }
//         //Sitemap
        
        return redirect()->to('admin/products')->with('success', 'Product updated successfully!');
    }
    
}