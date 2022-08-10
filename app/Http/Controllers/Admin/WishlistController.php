<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index(){
        $data = \DB::table( 'wishlist' )
        ->join( 'product', 'product.id', '=', 'wishlist.product_id' )
        ->leftjoin( 'users', 'users.id', '=', 'wishlist.user_id' )
        ->select(\DB::raw("product.id, count(product.id) as total, product.title, group_concat(distinct users.email) as email, group_concat(distinct users.phone) as phone"))
        ->orderBY('total','desc')
        ->groupBy('product.id')
        ->get();

        return view('admin.wishlist.index', compact('data'));
    }

    public function delete($id){
  
        $wishlist = Wishlist::where('product_id', $id);

        // delete wishlist
        $wishlist->delete();

        return redirect()->to('admin/wishlist')->with('success', 'Wishlist deleted successfully!');

    }
}
