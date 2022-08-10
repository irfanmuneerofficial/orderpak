<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\AddCart;
use App\Models\OrderBook;
use App\Models\OrderUserDetail;
use Auth;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // print_r(Auth::user()->id);die;
        $wishlist = Wishlist::where('user_id',Auth::user()->id)->get()->count();
        $addcart = OrderUserDetail::where('user_id',Auth::user()->id)->where('status','Cancel')->count();
        $complete = OrderUserDetail::where('user_id',Auth::user()->id)->where('status','Complete')->count();
        $process = OrderUserDetail::where('user_id',Auth::user()->id)->where('status','IN PROCESS')->count();
        $pending = OrderUserDetail::where('user_id',Auth::user()->id)->where('status','Pending')->count();
    	return view('user_panel.dashboard')
        ->with(compact('wishlist','addcart','complete','process','pending'));
    }

    public function wishlist()
    {
    	$wishlists = Wishlist::where('user_id',Auth::user()->id)->get();
    	$products = Product::get();
    	return view('/user_panel.wishlist')
    	->with(compact('wishlists','products'));
    }
}