<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shopinfo;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Str;
use App\Models\AddCart;
use App\Models\OrderBook;
use App\Models\Vendor;
use App\Models\Categories;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function slug(Request $request , $id)
    {
        $vendors = Vendor::where('status', 'ACTIVE')->get();
    	$product = Product::with('productAttribute')->where('slug', $id)->first();
        //dd($product->id);
    	$totalp = Product::where('admin_status', 'APPROVED')->where('vendor_status','ACTIVE')->where('vendor_id',($product)? $product->vendor_id: '0')->count();
    	     
        if(!isset($product->category_id)){
            return abort(404);
        }
    	$category = Categories::find($product->category_id);
        if($totalp > 4){
    	   $products = Product::inRandomOrder()->where('category_id',$product->category_id)->where('admin_status','APPROVED')->paginate(4);
        }
        else
        {
           $products = Product::inRandomOrder()->where('category_id',$product->category_id)->where('admin_status','APPROVED')->limit(10)->get();
        }
    	$shop = Shopinfo::where('vendor_id',$product->vendor_id)->first();

        //Color and Size of Attribute
        // $result['product_attr'][$product->id]= DB::table("product_attributes")
        // ->select('product_id','color_id','title')
        // ->leftJoin('colors','colors.id','product_attributes.color_id')
        // ->where(['product_attributes.product_id'=>$product->id])
        // ->groupBy('product_attributes.color_id')
        // ->get();
            // dd(ProductAttribute::where('product_id',$product->id)->get());
            $attr_exist = count(ProductAttribute::where('product_id',$product->id)->get());
            if($attr_exist)
            {
                $result['product_attr'][$product->id]=
                DB::table('product_attributes')
                ->select('product_attributes.id as attr_id',
                'product_attributes.product_id',
                'product_attributes.sku',
                'product_attributes.price',
                'product_attributes.quantity',
                'product_attributes.size_id',
                'product_attributes.color_id',
                'product_attributes.attr_image',
                'product_attributes.attr_sale_price',
                'product_attributes.attr_sale_start',
                'product_attributes.attr_sale_end',
                'sizes.id',
                'sizes.option_name',
                'sizes.option_code',
                'colors.id',
                'colors.title',
                'colors.color_code',
                'colors.slug')
                ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
                ->leftJoin('colors','colors.id','=','product_attributes.color_id')
                ->where(['product_attributes.product_id'=>$product->id])
                ->where(['product_attributes.attr_status'=>1])
                ->get();
                // dd($result);
            }
            else{
                // $result['product_attr'][$product->id]=array(0=>array('size_id'=>0,'color_id'=>0,'id'=>0));
                $result['product_attr'][$product->id] = collect([
                    (object) [
                        'size_id' => '0',
                        'color_id' => '0',
                        'id' =>'0',
                        'price'=>'0',
                        'quantity'=>'0',
                        'sku'=>'0'
                    ]
                ]);
            }
            // dd(count($result['product_attr'][$product->id]));
    	// print_r($shop);die;
        $categories = Categories::where('parent_id', 0)->get();
        $pcategories = ParentCategory::get();
        $carts = AddCart::where('vendor_id',$product->vendor_id)->get();
        $booked = OrderBook::where('vendor_id',$product->vendor_id)->get();
        // $color_size = ProductAttribute::where('product_id',$id)->get();
            return view('product_detail')
            ->with(compact('product','shop','products','category','totalp', 'categories','pcategories','carts','booked', 'vendors','result'));
    }
	
    public function getprice(Request $request)
    {
        // echo "<pre>";
        //  print_r($request->all());
        // $result['product_price_qty']=
        //dd($request->all());

        if(($request->color!='')&&($request->size!=''))
        {
            $proAttr = DB::table('product_attributes')
            ->select('product_attributes.id','product_attributes.attr_systematic_sku','product_attributes.price','product_attributes.quantity','product_attributes.attr_sale_start'
            ,'product_attributes.attr_image','product_attributes.attr_sale_end','product_attributes.attr_sale_price')
            ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
            ->leftJoin('colors','colors.id','=','product_attributes.color_id')
            ->where(['colors.id'=>$request->color])
            ->where(['sizes.option_code'=>$request->size])
            ->where(['product_attributes.product_id'=>$request->pid])
            ->get();
        }
        elseif(($request->color=='')&&($request->size!=''))
        {
            $proAttr = DB::table('product_attributes')
            ->select('product_attributes.id','product_attributes.attr_systematic_sku','product_attributes.price','product_attributes.quantity','product_attributes.attr_sale_start'
            ,'product_attributes.attr_image','product_attributes.attr_sale_end','product_attributes.attr_sale_price')
            ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
            ->where(['sizes.option_code'=>$request->size])
            ->where(['product_attributes.product_id'=>$request->pid])
            ->get();
        }
        elseif(($request->color!='')&&($request->size==''))
        {
            $proAttr = DB::table('product_attributes')
            ->select('product_attributes.id','product_attributes.attr_systematic_sku','product_attributes.price','product_attributes.quantity','product_attributes.attr_sale_start'
            ,'product_attributes.attr_image','product_attributes.attr_sale_end','product_attributes.attr_sale_price')
            ->leftJoin('colors','colors.id','=','product_attributes.color_id')
            ->where(['colors.id'=>$request->color])
            ->where(['product_attributes.product_id'=>$request->pid])
            ->get();
    
        }
        // dump($proAttr);
        // dd($proAttr[0]->price);
        // print_r($proAttr[0]->price);
        unset($sdate);
        unset($edate);
        if($proAttr[0]->attr_sale_start !='' && $proAttr[0]->attr_sale_end !='')
        {
            $date1 = \Carbon\Carbon::now();
            $startDate = \Carbon\Carbon::parse($proAttr[0]->attr_sale_start.' 00:00:01');
            $sdate = $date1->gte($startDate);
    
            $date2 = \Carbon\Carbon::now();
            $endDate = \Carbon\Carbon::parse($proAttr[0]->attr_sale_end.' 23:59:58');
            $edate = $date2->lte($endDate);
            if(($sdate == true)&&($edate == true))
            {
               $sale ='true';
            }
            else{
                $sale ='false';
            }
        }
        else{
            $sale ='false';
            $sdate='false';
            $edate='false';
        }

        return response()->json([
             'status' => true,
             'attr_id' => $proAttr[0]->id,
             'price' => $proAttr[0]->price,
             'quantity' => $proAttr[0]->quantity,
             'attr_sku' => $proAttr[0]->attr_systematic_sku,   
             'sale' => $sale,   
             'sdate'=> $sdate,
             'edate'=> $edate,          
             'sale_price' => (int)$proAttr[0]->attr_sale_price,             
            // 'message' => 'Coupon code applied successfully.',
        ]);
    }
}