<?php

namespace App\Http\Controllers\Api\V1\Product\Repository;

use App\Models\Color;
use App\Http\Controllers\Api\V1\Product\Interfaces\ProductInterface;
use App\Models\Categories;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\ParentCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\File;

class ProductRepository implements ProductInterface{

    public function allProduct(Request $request){
       /*  $usr=auth('apivendor')->user();
        return Product::where('vendor_id',$usr->id)->get(); */

        $sort_type='asc';
        $sort_column='id';
        $paginate='';
        $search='';
        $filter_status='';

        if($request->has('paginate'))
            $paginate=(int)$request->paginate;
        if($request->has('sort'))
            $sort_type=$request->sort;
        if($request->has('sort_column'))
            $sort_column=$request->sort_column;
        if($request->has('search'))
            $search=$request->search;
        if($request->has('filter_status'))
        {
            $filter_status=$request->filter_status;
            if($filter_status=='All')
                $filter_status='';
        }



        $usr=auth('apivendor')->user();
        return Product::where('vendor_id',$usr->id)
        ->where('admin_status','like', '%' . $filter_status . '%')
        ->where(function($query)use($search){
            $query->where('id', 'like', '%' . $search . '%')
            ->orWhere('title', 'like', '%' . $search . '%')
            ->orWhere('product_sku', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')
            ->orWhere('admin_status', 'like', '%' . $search . '%')
            ->orWhere('vendor_status', 'like', '%' . $search . '%');
        })
        ->orderBy($sort_column,$sort_type)
        ->paginate($paginate);
    }

    public function findProduct($id){
        $usr=auth('apivendor')->user();
        $respone=Product::where('id',$id)->where('vendor_id',$usr->id)->first();
        if(!empty($respone))
        {
            $respone['image_url']='/uploads/product_images/';
        }
        return $respone;
    }

    public function deleteProduct($id){
        Product::where('id',$id)->delete();
    }

    public function validateaddProduct(Request $request){

        $validator = Validator::make($request->all(), [
            'product_sku'=>'required',
            'search_sku'=>'required',
            'category_id'=>'required',
            'parent_id'=>'required',
            'brand_id'=>'required',
            'title'=>'required',
            'slug'=>'required',
            'short_description'=>'required',
            'product_description'=>'required',
            'price'=>'required',
            'quantity'=>'required',

        ]);

        $error = null;

        if ($validator->fails()) {
            return $error=$validator->messages();
        }
        else
        {
            return null;
        }
    }

    public function addProduct(Request $request){

        $files = $request->file('images');
        // $color_image = $request->file(['pro_variation']);
        $i = 0;
        $data = [];
        $json_data = null;

        if(isset($request->pro_variation) && count($request->pro_variation) > 0){
            foreach($request->pro_variation as $val){
                $data['color'][$i]['name'] = $val[$i]['name'] ?? '';
                $data['color'][$i]['size'] = $val[$i]['size'] ?? '';
                if(isset($val[$i]['color_image'])){
                    if($val[$i]['color_image'] == null){
                        $data['color'][$i]['color_image'] = null;
                    }
                    else{
                        $nmwithex = $val[$i]['color_image']->getClientOriginalName();
                        $filename = pathinfo($nmwithex, PATHINFO_FILENAME);
                        $ext = $val[$i]['color_image']->getClientOriginalExtension();
                        $fl_store = $filename . time() . '.' . $ext;
                        $val[$i]['color_image']->move('./uploads/product_images/', $fl_store);
                        //$path = $file->storeAs('images', $fl_store);
                        $data['color'][$i]['color_image']=$fl_store;
                    }
                }
                else{
                    $data['color'][$i]['color_image'] = null;
                }

                $i++;
            }

            $json_data = $data;
        }

        for($i=0;$i<6;$i++)
        {
            $img_array[$i]=null;
        }
        $i=0;
        foreach($files as $file){
            $nmwithex = $file->getClientOriginalName();
            $filename = pathinfo($nmwithex, PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $fl_store = $filename . time() . '.' . $ext;
            $file->move('./uploads/product_images/', $fl_store);
            //$path = $file->storeAs('images', $fl_store);
            $img_array[$i]=$fl_store;
            $i++;
        }
        if($request->hasFile('sizechart'))
        {
            $file = $request->file('sizechart');
            $nmwithex = $file->getClientOriginalName();
            $filename = pathinfo($nmwithex, PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $fl_store = $filename . time() . '.' . $ext;
            $file->move('./uploads/product_images/', $fl_store);
            $request->request->add(['size_chart' =>$fl_store]);
        }
        $usr=auth('apivendor')->user();

        $request->request->add(['vendor_id'=>$usr->id,'vendor_status' => 'ACTIVE','admin_status' => 'PENDING','image_1' => $img_array[0],'image_2' => $img_array[1],'image_3' => $img_array[2],'image_4' => $img_array[3],'image_5' => $img_array[4],'image_6' => $img_array[5], 'variation' => $json_data]);
        $request=$request->except(['sizechart','images','pro_variation']);
        $product=Product::create($request);
        //return response()->json($request->all());

    }

    public function editProduct(Request $request,$id){
        $i = 0;
        $data = [];
        $json_data = null;

        if(isset($request->pro_variation) && count($request->pro_variation) > 0){

            foreach($request->pro_variation['color'] as $val){
                $data['color'][$i]['name'] = $val['name'] ?? '';
                $data['color'][$i]['size'] = $val['size'] ?? '';
                if(isset($val['color_image'])){
                    if($val['color_image'] == null){
                        $data['color'][$i]['color_image'] = null;
                    }
                    else{
                        $nmwithex = $val['color_image']->getClientOriginalName();
                        $filename = pathinfo($nmwithex, PATHINFO_FILENAME);
                        $ext = $val['color_image']->getClientOriginalExtension();
                        $fl_store = $filename . time() . '.' . $ext;
                        $val['color_image']->move('./uploads/product_images/', $fl_store);
                        //$path = $file->storeAs('images', $fl_store);
                        $data['color'][$i]['color_image']=$fl_store;
                    }
                }
                else{
                    $data['color'][$i]['color_image'] = null;
                }

                $i++;
            }

            $json_data = $data;
        }

        if($request->hasFile('images'))
        {
            $files = $request->file('images');
            for($i=0;$i<6;$i++)
            {
                $img_array[$i]=null;
            }
            $i=0;
            foreach($files as $file){
                $nmwithex = $file->getClientOriginalName();
                $filename = pathinfo($nmwithex, PATHINFO_FILENAME);
                $ext = $file->getClientOriginalExtension();
                $fl_store = $filename . time() . '.' . $ext;
                $file->move('./uploads/product_images/', $fl_store);
                //$path = $file->storeAs('images', $fl_store);
                $img_array[$i]=$fl_store;
                $i++;
            }

            $request->request->add(['image_1' => $img_array[0],'image_2' => $img_array[1],'image_3' => $img_array[2],'image_4' => $img_array[3],'image_5' => $img_array[4],'image_6' => $img_array[5], 'variation' => $json_data]);
        }

        if($request->hasFile('sizechart'))
        {
            $file = $request->file('sizechart');
            $nmwithex = $file->getClientOriginalName();
            $filename = pathinfo($nmwithex, PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $fl_store = $filename . time() . '.' . $ext;
            $file->move('./uploads/product_images/', $fl_store);
            $request->request->add(['size_chart' =>$fl_store]);
        }
        $request=$request->except(['sizechart','images', 'pro_variation']);

        Product::where('id',$id)->update($request);
    }

    public function allCategory(){
        return Categories::select('id','title')->where('parent_id',0)->get();
    }

    public function SubCategory($parent_id){
        return Categories::select('id','title')->where('parent_id',$parent_id)->get();
    }

    public function ChildCategory($parent_id){
        return Categories::select('id','title')->where('parent_id',$parent_id)->get();
    }

    public function colors(){
        return Color::select('title')->get();
    }


    public function addProductImage(Request $request){
        if($request->hasFile('editor_image'))
        {
            $file = $request->file('editor_image');
            $nmwithex = $file->getClientOriginalName();
            $filename = pathinfo($nmwithex, PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $fl_store = $filename . time() . '.' . $ext;
            $file->move('./uploads/product_images/', $fl_store);
        }
        return '/uploads/product_images/'.$fl_store;
    }
    public function removeProductImage($name){
        File::delete('./uploads/product_images/'.$name);
    }

    public function bestSellingProducts(Request $request){

        $sort_type='desc';
        $sort_column='quantity_sold';
        $paginate='';
        $search='';
        // $filter_status='';

        if($request->has('paginate'))
            $paginate=(int)$request->paginate;
        if($request->has('sort'))
            $sort_type=$request->sort;
        if($request->has('sort_column'))
            $sort_column=$request->sort_column;
        if($request->has('search'))
            $search=$request->search;

        $usr=auth('apivendor')->user();
        $products = Product::query()
        ->join('orderbook', 'orderbook.product_id', '=', 'product.id')
        ->selectRaw('product.*, SUM(orderbook.quantity) AS quantity_sold')
        ->where('product.vendor_id', $usr->id)
        ->where(function($query)use($search){
            $query->where('product.id', 'like', '%' . $search . '%')
            ->orWhere('product.title', 'like', '%' . $search . '%')
            ->orWhere('product.product_sku', 'like', '%' . $search . '%')
            ->orWhere('product.price', 'like', '%' . $search . '%');
        })
        ->groupBy(['product.id']) // should group by primary key
        ->orderBy($sort_column,$sort_type)
        ->paginate($paginate);

        return $products;
    }


}
