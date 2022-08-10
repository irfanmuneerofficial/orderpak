<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

class ZoneController extends Controller
{
    public function getProvinces(Type $var = null)
    {
        $provinces = Province::select('id','name')->get();
        if (count($provinces) > 0) {
            return response()->json($provinces);
        }    
    }

    public function getCities(Request $request)
    {
        $cities = DB::table('cities')
            ->select('name','city_slug')
            ->where('province_id', $request->province_id)
            ->get();
        
        if (count($cities) > 0) {
            return response()->json($cities);
        }
    }
}
