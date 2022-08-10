<?php

namespace App\Http\Controllers\Api\V1\Dashboard\Repository;

use App\Http\Controllers\Api\V1\Dashboard\Interfaces\DashboardInterface;
use App\Models\Commission;
use App\Models\OrderBook;
use App\Models\OrderUserDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

use App\Models\Sliders;

class DashboardRepository implements DashboardInterface{
    public function dashboardNumbers(){
        $usr=auth('apivendor')->user();
        $response=[];
        $response['Approved Products']= Product::where('admin_status','APPROVED')->where('vendor_id',$usr->id)->get()->count();
        $response['Pending Products']= Product::where('admin_status','PENDING')->where('vendor_id',$usr->id)->get()->count();
        $response['Rejected Products']= Product::where('admin_status','REJECTED')->where('vendor_id',$usr->id)->get()->count();
        $response['All Products'] = Product::where('vendor_id',$usr->id)->get()->count();
        $response['All Orders']=OrderUserDetail::where('vendor_id',$usr->id)->get()->count();
        $response['Complete']=OrderUserDetail::where('vendor_id',$usr->id)->where('status','Complete')->get()->count();
        $response['In Process']=OrderUserDetail::where('vendor_id',$usr->id)->where('status','In Process')->get()->count();
        $response['Pending']=OrderUserDetail::where('vendor_id',$usr->id)->where('status','Pending')->get()->count();
        $response['Ship']=OrderUserDetail::where('vendor_id',$usr->id)->where('status','Ship')->get()->count();
        $response['Cancel']=OrderUserDetail::where('vendor_id',$usr->id)->where('status','Cancel')->get()->count();
        $response['total_sale']=OrderBook::where('vendor_id',$usr->id)->where('status','Complete')->get()->sum('amount');
        $response['daily_sale']=OrderBook::where('vendor_id',$usr->id)->where('status','Complete')->get()->avg('amount');
        $response['slider']=Sliders::all();
        $response['updated_date']=date('Y-m-d');

        return $response;
    }
}
