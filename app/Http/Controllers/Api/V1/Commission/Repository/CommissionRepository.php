<?php

namespace App\Http\Controllers\Api\V1\Commission\Repository;

use App\Http\Controllers\Api\V1\Commission\Interfaces\CommissionInterface;
use App\Models\Commission;
use Illuminate\Http\Request;
use Validator;

class CommissionRepository implements CommissionInterface{

    public function commissionList(Request $request){
        $sort_type='asc';
        $sort_column='commission.id';
        $paginate='';
        $search='';
        if($request->has('paginate'))
        $paginate=(int)$request->paginate;
        if($request->has('sort'))
        $sort_type=$request->sort;
        if($request->has('sort_column'))
        $sort_column=$request->sort_column;
        if($request->has('search'))
        $search=$request->search;


        $array_Convertint=['main_rate','parent_rate','child_rate'];
        

        /* if(in_array($sort_column,$array_Convertint)){
            return Commission::select('category.title as Main Category','main_rate','parent_category.title as Parent Category','parent_rate','child_category.title as Child Category','child_rate' )
            ->join('category', 'commission.category_id', '=', 'category.id')
            ->join('child_category', 'commission.child_id', '=', 'child_category.id')
            ->join('parent_category', 'commission.parent_id', '=', 'parent_category.id')
            ->where(function($query)use($search){
                $query->where('main_rate', 'like', '%' . $search . '%')
                ->orWhere('parent_rate', 'like', '%' . $search . '%')
                ->orWhere('child_rate', 'like', '%' . $search . '%')
                ->orWhere('category.title', 'like', '%' . $search . '%')
                ->orWhere('parent_category.title', 'like', '%' . $search . '%')
                ->orWhere('child_category.title', 'like', '%' . $search . '%');
            })
            ->orderByRaw('CONVERT('.$sort_column.',int ) '.$sort_type.'')
            ->paginate($paginate);
        }
        else{ */
            return Commission::select('category.title as Main Category','main_rate','parent_category.title as Parent Category','parent_rate','child_category.title as Child Category','child_rate' )
            ->join('category', 'commission.category_id', '=', 'category.id')
            ->join('child_category', 'commission.child_id', '=', 'child_category.id')
            ->join('parent_category', 'commission.parent_id', '=', 'parent_category.id')
            ->where(function($query)use($search){
                $query->where('main_rate', 'like', '%' . $search . '%')
                ->orWhere('parent_rate', 'like', '%' . $search . '%')
                ->orWhere('child_rate', 'like', '%' . $search . '%')
                ->orWhere('category.title', 'like', '%' . $search . '%')
                ->orWhere('parent_category.title', 'like', '%' . $search . '%')
                ->orWhere('child_category.title', 'like', '%' . $search . '%');
            })
            ->orderBy($sort_column,$sort_type)
            ->paginate($paginate);
        /* } */
            
    }
}