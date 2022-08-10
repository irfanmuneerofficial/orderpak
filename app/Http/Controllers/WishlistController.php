<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;
class WishlistController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function add($productid)
    {
		$userid = Auth::user()->id;
    	$wishlist = new Wishlist;
    	$wishlist->product_id = $productid;
    	$wishlist->user_id = $userid;
    	$wishlist->save();
    }

    public function delete($productid)
    {
		$userid = Auth::user()->id;
    	$wishlist = Wishlist::where('product_id',$productid)->where('user_id',$userid)->first();
    	$wishlist->delete();
    }
}
