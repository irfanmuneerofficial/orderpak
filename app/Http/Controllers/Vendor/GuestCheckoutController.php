<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\OrderBook;

class GuestCheckoutController extends Controller
{
    public function edit($id)
    {
        $order = OrderBook::find(request('order_id'))->pluck('email');

        if(request('status') =='In Process'){
            Mail::to($order)->send(new \App\Mail\OrderProcess('Your order is '.request('status') .'!'));
        }
        elseif(request('status') =='Ship'){
            Mail::to($order)->send(new \App\Mail\OrderShip('Your order is '.request('status') .'!'));
        }
        elseif(request('status') =='Complete'){
            Mail::to($order)->send(new \App\Mail\OrderComplete('Your order is '.request('status') .'!'));
        }
        elseif(request('status') =='Cancel'){
            Mail::to($order)->send(new \App\Mail\OrderCancel('Your order is '.request('status') .'!'));
        }

        $data = OrderBook::find($id);
        // print_r(request('status'));die;
        $data->status = request('status');
        $data->save();
        return back()->with('success', 'Status updated successfully!');
    }
}
