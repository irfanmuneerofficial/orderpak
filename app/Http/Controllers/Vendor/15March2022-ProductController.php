<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductImages;
use Auth;
use File;
use Validator;
use App\Models\Categories;
use App\Models\OptionsValue;
use App\Traits\SitemapTrait;
use Illuminate\Support\Facades\DB;
use App\Models\ProductAttribute;

class ProductController extends Controller
{
    use SitemapTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }
    
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->where('vendor_id',Auth::guard('vendor')->user()->id)->get();
        return view('vendor_panel.product.index')
        ->with(compact('products'));
    }

    public function approved()
    {
        $products = Product::where('vendor_id',Auth::guard('vendor')->user()->id)->where('admin_status','APPROVED')->get();
        return view('vendor_panel.product.approved')
        ->with(compact('products'));
    }

    public function pending()
    {
        $products = Product::where('vendor_id',Auth::guard('vendor')->user()->id)->where('admin_status','PENDING')->get();
        return view('vendor_panel.product.pending')
        ->with(compact('products'));
    }

    public function rejected()
    {
        $products = Product::where('vendor_id',Auth::guard('vendor')->user()->id)->where('admin_status','REJECTED')->get();
        return view('vendor_panel.product.rejected')
        ->with(compact('products'));
    }

    public function checksku(Request $request)
    {
        
        $data = Product::where('vendor_id',Auth::guard('vendor')->user()->id)->where('product_sku',str_slug($request->title))->first();
        if(!empty($data)){
            $slug = str_slug($request->title);
            return response()->json(['error' => 'Sku Is Already Taken','slug' => $slug]);
        }
        else{
            $slug = str_slug($request->title);
            return response()->json(['slug' => $slug]);
        }
        // return response($request->title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categories::where('parent_id', 0)->get();
        $parentcategory = ParentCategory::get();
        $childcategory = ChildCategory::get();
        $brands = Brand::get();
        $colors = Color::get();
        // $colors = OptionsValue::where('option_id',1)->get();
        // $sizes = OptionsValue::where('option_id',2)->get();
        $sizes = Size::get();


        return view('vendor_panel.product.create')
        ->with(compact('category','brands','sizes','colors','parentcategory','childcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $path = 'uploads/product_images/';
        // $product_id = 4958;
        $file1 = null;

        if($request->hasFile('image_1'))
        {
            $fileGet = request()->file('image_1');
            $file1 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file1);
        }

        $file2 = null;

        if($request->hasFile('image_2'))
        {
            $fileGet = request()->file('image_2');
            $file2 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file2);
        }

        $file3 = null;

        if($request->hasFile('image_3'))
        {
            $fileGet = request()->file('image_3');
            $file3 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file3);
        }

        $file4 = null;

        if($request->hasFile('image_4'))
        {
            $fileGet = request()->file('image_4');
            $file4 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file4);
        }

        $file5 = null;

        if($request->hasFile('image_5'))
        {
            $fileGet = request()->file('image_5');
            $file5 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file5);
        }

        $file6 = null;

        if($request->hasFile('image_6'))
        {
            $fileGet = request()->file('image_6');
            $file6 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file6);
        }

        $size_chart = null;

        if($request->hasFile('size_chart'))
        {
            $fileGet = request()->file('size_chart');
            $size_chart = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $size_chart);
        }   

        $tags = explode(",", $request->tags);
        // echo json_encode($tags) ;die;
        do {
            $systematic_sku = mt_rand( 1000000000, 9999999999 ).'_PK'.time();
        } while ( \DB::table( 'product' )->where( 'systematic_sku', $systematic_sku )->exists() );

        $this->validate($request, [
            'parent_id' => 'required',
            'category_id' => 'required',
            // 'quantity' => 'required|numeric|digits:6',
        ]);

        $productStore = Product::create([
            'vendor_id' => Auth::guard('vendor')->user()->id,
            'category_id' => $request['category_id'],
            'parent_id' => $request['parent_id'],
            'child_id' => $request['child_id'],
            'brand_id' => $request['brand_id'],
            'title' => $request['title'],
            'slug' => str_slug($request['title'],'-').'-'.strtolower(str_random(10)),
            'product_sku' => $request['product_sku'],
            'systematic_sku'  =>  $systematic_sku,
            'search_sku' => $request['vendor_id'] ."-". $request['category_id'] ."-". $request['product_sku'],
            'model' => $request['model'],
            'short_description' => $request['short_description'],
            'product_description' => $request['product_description'],
            'image_1' => $file1,
            'image_2' => $file2,
            'image_3' => $file3,
            'image_4' => $file4,
            'image_5' => $file5,
            'image_6' => $file6,
            'color_check' => (empty($request->color_check )) ? 0 :  $request['color_check'],
            'colors' => (empty($request->color_check )) ? null :  json_encode($request->colors),
            'condition' => $request->condition,
            'size_check' => (empty($request->size_check)) ? 0 : $request['size_check'], 
            'size_name' => (empty($request->size_check)) ? null : json_encode($request->size_name),
            'size_qty' => (empty($request->size_check)) ? null : json_encode($request->size_qty),
            'size_chart' => $size_chart,
            // 'colors' => json_encode($request['colors']),
            // 'sizes' => $request['sizes'],
            'tagss' => json_encode($tags),
            'sale_status' => (empty($request->sale_status)) ? 0 :  $request['sale_status'],
            'sale_price' => (empty($request->sale_status)) ? 0 : $request['sale_price'],
            'sale_details' => (empty($request->sale_status)) ? 0 : $request['sale_details'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
            'condition' => $request['condition'],
            'additional_details' => $request['additional_details'],
            'warrenty_type' => $request['warrenty_type'],
            'warrenty_period' => $request['warrenty_period'],
            'warrenty_policy' => $request['warrenty_policy'],
            'vendor_status' => 'ACTIVE',
            'admin_status' => 'PENDING',
            'video_url' => $request->video_1,
        ]);

        $productStore->update([
            'slug' => str_slug($request['title'],'-').'-'.$productStore->id
        ]);

        /* Product Attribute Start */ 
        $skuArr=$request->post('sku'); 
        $mrpArrImg=$request->post('attr_image'); 
        $priceArr=$request->post('attr_price'); 
        $qtyArr=$request->post('qty'); 
        $size_idArr=$request->post('size_id'); 
        $color_idArr=$request->post('color_id'); 
        $attr_sale_dateArr=$request->post('attr_sale_date'); 
        $attr_sale_priceArr=$request->post('attr_sale_price'); 
        $attr_status = $request->post('attr_status');                        

        if(isset($request->size_id))
        {
            foreach($request->size_id as $size_key => $size_val)
            {
                $repeat_key = 0;
                foreach($size_val as $size_val2)
                {

                    $productAttrArr['product_id']=$productStore->id;
                    $productAttrArr['sku']=$skuArr[$size_key];
                    $productAttrArr['price']=$priceArr[$size_key];
                    $productAttrArr['quantity']=$qtyArr[$size_key];
                    do {
                        $attr_systematic_sku = mt_rand( 1000000000, 9999999999 ).'_PK'.time();
                    } while ( \DB::table( 'product_attributes' )->where( 'attr_systematic_sku', $attr_systematic_sku )->exists() );
                    $productAttrArr['attr_systematic_sku'] = $attr_systematic_sku;
            
                    if(isset($attr_sale_priceArr[$size_key]))
                    {
                        $productAttrArr['attr_sale_price']=$attr_sale_priceArr[$size_key];   
                    }
                    $productAttrArr['attr_sale_date']=$attr_sale_dateArr[$size_key];

                    if(($color_idArr[$size_key]=='')||($color_idArr[$size_key]=='null')){
                    $productAttrArr['color_id']=0;
                    }else{
                    $productAttrArr['color_id']=$color_idArr[$size_key];
                    }
            
                    if($attr_sale_priceArr[$size_key]==''){
                        $productAttrArr['attr_sale_price']=0;
                    }else{
                    $productAttrArr['attr_sale_price']=$attr_sale_priceArr[$size_key];
                    //$attr_sale_dateArr[$size_key]==''?'':$attr_sale_dateArr[$size_key];
                        if(isset($attr_sale_dateArr[$size_key]))
                        {
                            $attr_sale_dateArr1 =explode('-',$attr_sale_dateArr[$size_key]); 
                            // dd($attr_sale_dateArr1);
                            $productAttrArr['attr_sale_start']=\Carbon\Carbon::parse($attr_sale_dateArr1[0])->format('Y-m-d');
                            $productAttrArr['attr_sale_end']=\Carbon\Carbon::parse($attr_sale_dateArr1[1])->format('Y-m-d');                
                            $productAttrArr['attr_sale_date'] = $attr_sale_dateArr1[0].' - '.$attr_sale_dateArr1[1];
                        }
                    }
            
                    if($size_val2==''){
                        $productAttrArr['size_id']=0;
                    }else{
                    $productAttrArr['size_id']=$size_val2;
                    }
                        
                    if($request->hasFile("attr_image.$size_key")){
                        if($repeat_key == 0)
                        {
                            unset($image_name);
                            $attr_image=$request->file("attr_image.$size_key");
                            $ext=$attr_image->extension();
                            //image name check
                            do {
                                $image_name = mt_rand( 1000000000, 9999999999 ).time().'.'.$ext;
                            } while ( \DB::table( 'product_attributes' )->where( 'attr_image', $attr_systematic_sku )->exists() );     
                            //image name check
                            // $image_name=md5(date('Y:m:d')). time().'.'.$ext;
                            $attr_image->move($path, $image_name);
                            $productAttrArr['attr_image']=$image_name;
                            $old_image_name = $image_name;
                        }
                        else{
                            $product = ProductAttribute::find($product_att);
                            $new_image = md5(date('Y:m:d')). time().$size_val2.'.'.$ext;
                            File::copy(public_path($path.$product->attr_image), public_path($path.$new_image));
                            $productAttrArr['attr_image']=$new_image;
                            unset($new_image);
                        }
                        $repeat_key++;      
                    }
                    
                    // dump($productAttrArr);
                    $product_att = DB::table('product_attributes')->insertGetId($productAttrArr);
                    // DB::table('product_attributes')->insert($productAttrArr);
                }
            }                
        }
        else{
            foreach($request->color_id as $size_key => $size_val)
            {
                    $productAttrArr['product_id']=$productStore->id;
                    $productAttrArr['sku']=$skuArr[$size_key];
                    $productAttrArr['price']=$priceArr[$size_key];
                    $productAttrArr['quantity']=$qtyArr[$size_key];
                    $productAttrArr['attr_sale_price']=$attr_sale_priceArr[$size_key];   
                    // $productAttrArr['attr_sale_date']=$attr_sale_dateArr[$size_key];   
                    if(($color_idArr[$size_key]=='')||($color_idArr[$size_key]=='null')){
                    $productAttrArr['color_id']=0;
                    }else{
                    $productAttrArr['color_id']=$color_idArr[$size_key];
                    }
            
                    if($attr_sale_priceArr[$size_key]==''){
                        $productAttrArr['attr_sale_price']=0;
                    }else{
                    $productAttrArr['attr_sale_price']=$attr_sale_priceArr[$size_key];
                    }
            
                    // $attr_sale_dateArr[$size_key]==''?'':$attr_sale_dateArr[$size_key];
                    do {
                        $attr_systematic_sku = mt_rand( 1000000000, 9999999999 ).'_PK'.time();
                    } while ( \DB::table( 'product_attributes' )->where( 'attr_systematic_sku', $attr_systematic_sku )->exists() );
                    $productAttrArr['attr_systematic_sku'] = $attr_systematic_sku;  
                    
                    if(isset($attr_sale_dateArr[$size_key]))
                    {
                        $attr_sale_dateArr2 =explode('-',$attr_sale_dateArr[$size_key]); 
                        $productAttrArr['attr_sale_start']=\Carbon\Carbon::parse($attr_sale_dateArr2[0])->format('Y-m-d');
                        $productAttrArr['attr_sale_end']=\Carbon\Carbon::parse($attr_sale_dateArr2[1])->format('Y-m-d');      
                        $productAttrArr['attr_sale_date'] = $attr_sale_dateArr2[0].' - '.$attr_sale_dateArr2[1];
                    }
            
                    if(!$request->size_id){
                        $productAttrArr['size_id']=0;
                    }
                    else{
                        $productAttrArr['size_id']=$size_idArr[$size_key];
                    }
                    if($request->hasFile("attr_image.$size_key")){
                        $file_attr =null;
                        $attr_image=$request->file("attr_image.$size_key");
                        $file_attr = md5($attr_image->getClientOriginalName()) . time() . "." . $attr_image->getClientOriginalExtension();
                        $attr_image->move($path, $file_attr);
                        $productAttrArr['attr_image']=$file_attr;
                    }
                    DB::table('product_attributes')->insert($productAttrArr);
            }                
        }
        // dd($request->all());

//-----------------------------------
        $productStore->tag($tags);
        return back()->with('success', 'Product ['.$productStore->title.'-'.$productStore->id.']'.' added successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Product::find($id);
        // foreach (json_decode($product->size_name) as $key => $value) {
        //     print_r($value);
        //     print_r('<br>');

        // }
        // die;
        $category = Categories::where('parent_id', 0)->get();
        $parentcategory = ParentCategory::get();
        $childcategory = ChildCategory::get();
        $brands = Brand::get();
        $colors = Color::get();
        $sizes = Size::get();
        $productAttrArr=DB::table('product_attributes')->where(['product_id'=>$id])->get();

        $checkSaleStatus = json_encode($product->sale_status);

        // dd($jsonProduct);
        // return response()->json($jsonProduct);

        // return response()->json([
        //     'product' => $product,
        //     'category' => $category,
        //     'parentcategory' => $parentcategory,
        //     'childcategory' => $brands,
        //     'colors' => $colors,
        //     $checkSaleStatus
        // ]);

        return view('vendor_panel.product.edit')
        ->with(compact('product','category','parentcategory','childcategory','brands','colors','sizes','productAttrArr'));

    }

    public function check_sale_status($id)
    {
        $product = Product::find($id);

        $checkSale = $product->sale_status;

        return response()->json(['status' => $checkSale]);

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
        // dd($request->all());
        // $this->validate($request, [
        //     'image_1' => 'image|mimes:jpeg,png,jpg',
        //     'image_2' => 'image|mimes:jpeg,png,jpg',
        //     'image_3' => 'image|mimes:jpeg,png,jpg',
        //     'image_4' => 'image|mimes:jpeg,png,jpg',
        //     'image_5' => 'image|mimes:jpeg,png,jpg',
        //     'image_6' => 'image|mimes:jpeg,png,jpg',
        // ]);
        $product = Product::find($id);
        $product_attr_image = ProductAttribute::select('id','attr_image')->where('product_id',$id)->get();
        $att_img_array = $product_attr_image->toArray();


        $currentImage1 = $product->image_1;
        $currentImage2 = $product->image_2;
        $currentImage3 = $product->image_3;
        $currentImage4 = $product->image_4;
        $currentImage5 = $product->image_5;
        $currentImage6 = $product->image_6;
        $currentSizeChart = $product->size_chart;

        $path = 'uploads/product_images/';


        $file1 = null;

        if($request->hasFile('image_1'))
        {
            $fileGet = request()->file('image_1');
            $file1 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file1);
        }
        else{
            if(empty($request['image1'])){
                if($product->image_1){
                    $path1 = 'uploads/product_images/'.$product->image_1;
                    unlink($path1); 
                    $file1 = '';
                }
            }
        }

        $file2 = null;

        if($request->hasFile('image_2'))
        {
            $fileGet = request()->file('image_2');
            $file2 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file2);
        }
        else{
            if(empty($request['image2'])){

                if($product->image_2){
                $path2 = 'uploads/product_images/'.$product->image_2;
                unlink($path2); 
                    $file2 = '';
                }
            }
        }

        $file3 = null;

        if($request->hasFile('image_3'))
        {
            $fileGet = request()->file('image_3');
            $file3 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file3);
        }
        else{
            if(empty($request['image3']))
            {
                if($product->image_3){
                    $path3 =  'uploads/product_images/'.$product->image_3;
                    unlink($path3); 
                    $file3 = '';

                }
            }
        }

        $file4 = null;

        if($request->hasFile('image_4'))
        {
            $fileGet = request()->file('image_4');
            $file4 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file4);
        }
        else{
            if(empty($request['image4']))
            {
                if($product->image_4){
                    $path4 = 'uploads/product_images/'.$product->image_4;
                    unlink($path4); 
                    $file4 = '';

                }
            }
        }

        $file5 = null;

        if($request->hasFile('image_5'))
        {
            $fileGet = request()->file('image_5');
            $file5 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file5);
        }
        else{
            if(empty($request['image5']))
            {
                if($product->image_5){
                    $path5 = 'uploads/product_images/'.$product->image_5;
                    unlink($path5); 
                    $file5 = '';
                }
            }
        }

        $file6 = null;

        if($request->hasFile('image_6'))
        {
            $fileGet = request()->file('image_6');
            $file6 = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $file6);
        }
        else{
            if(empty($request['image6']))
            {
                if($product->image_6){
                    $path6 = 'uploads/product_images/'.$product->image_6;
                    unlink($path6); 
                    $file6 = '';
                }
            }
        }

        $size_chart = null;

        if($request->hasFile('size_chart'))
        {
            $fileGet = request()->file('size_chart');
            $size_chart = md5($fileGet->getClientOriginalName()) . time() . "." . $fileGet->getClientOriginalExtension();

            $fileGet->move($path, $size_chart);
        }

        $tags = explode(",", $request->tags);

        do {
            $systematic_sku = mt_rand( 1000000000, 9999999999 ).'_PK'.time();
        } while ( \DB::table( 'product' )->where( 'systematic_sku', $systematic_sku )->exists() );

        //Update Sitemap
        if(($product->vendor_status =='ACTIVE')&&($product->admin_status =='APPROVED'))
        {        
        $this->SitemapProduct($request,$product,'product','product','update');
        }
        //Sitemap

        $product->update([
            'vendor_id' => Auth::guard('vendor')->user()->id,
            'category_id' => $request['category_id'],
            'parent_id' => $request['parent_id'],
            'child_id' => $request['child_id'],
            'brand_id' => $request['brand_id'],
            'title' => $request['title'],
            //comments 18Nov2021
            /*'slug' => ($product->title == $request['title'])? $product->slug : str_slug($request['title'],'-').'-'.$id,*/
            // 'slug' => str_slug($request['title'],'-').'-'.strtolower(str_random(10)),
            // 'product_sku' => $request['product_sku'],
            'product_sku' => $request['product_sku'] ,
            'systematic_sku'  =>  $systematic_sku,
            'search_sku' => $request['vendor_id'] ."-". $request['category_id'] ."-". $request['product_sku'],
            'model' => $request['model'],
            'short_description' => $request['short_description'],
            'product_description' => $request['product_description'],
            'image_1' => ($file1) ? $file1 : $currentImage1,
            'image_2' => ($file2) ? $file2 : $request['image2'],
            'image_3' => ($file3) ? $file3 : $request['image3'],
            'image_4' => ($file4) ? $file4 : $request['image4'],
            'image_5' => ($file5) ? $file5 : $request['image5'],
            'image_6' => ($file6) ? $file6 : $request['image6'],

            'color_check' => (empty($request->color_check )) ? 0 :  $request['color_check'],
            'colors' => (empty($request->color_check )) ? null :  json_encode($request->colors),
            'condition' => ($request->condition == '') ? $product->condition : $request->condition  ,
            'size_check' => (empty($request->size_check)) ? 0 : $request['size_check'], 
            'size_name' => (empty($request->size_check)) ? null : json_encode($request->size_name),
            'size_qty' => (empty($request->size_check)) ? null : json_encode($request->size_qty),
            'size_chart' => ($size_chart) ? $size_chart : $currentSizeChart,


            // 'colors' => $request['colors'],
            // 'sizes' => $request['sizes'],
            'tagss' => json_encode($tags),
            'sale_status' => (empty($request->sale_status)) ? 0 :  $request['sale_status'],
            'sale_price' => (empty($request->sale_status)) ? 0 : $request['sale_price'],
            'sale_details' => (empty($request->sale_status)) ? 0 : $request['sale_details'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
            'condition' => $request['condition'],
            'additional_details' => $request['additional_details'],
            'warrenty_type' => $request['warrenty_type'],
            'warrenty_period' => $request['warrenty_period'],
            'warrenty_policy' => $request['warrenty_policy'],
            // 'status' => 'DEACTIVE',
            'vendor_status' => 'ACTIVE',
            'video_url' => $request['video_1'],
            // 'admin_status' => 'PENDING',
        ]);
        
        if($file1)
            File::delete($path. $currentImage1);
        if($file2)
            File::delete($path. $currentImage2);
        if($file3)
            File::delete($path. $currentImage3);
        if($file4)
            File::delete($path. $currentImage4);
        if($file5)
            File::delete($path. $currentImage5);
        if($file6)
            File::delete($path. $currentImage6);
        if($size_chart)
            File::delete($path. $currentSizeChart);

            /* Product Attribute Start */ 
            $skuArr=$request->post('sku'); 
            // $mrpArrImg=$request->post('attr_image'); 
            $priceArr=$request->post('attr_price'); 
            $qtyArr=$request->post('qty'); 
            $size_idArr=$request->post('size_id'); 
            $color_idArr=$request->post('color_id'); 
            $paidArr = $request->post('paid');
            $attr_sale_dateArr=$request->post('attr_sale_date'); 
            $attr_sale_priceArr=$request->post('attr_sale_price'); 
            $attr_status = $request->post('attr_status');                        
            // dd($request->all());
            foreach($skuArr as $key=>$val)
            {
                $productAttrArr['product_id']=$product->id;
                // $productAttrArr['product_id']=$product_id;
                $productAttrArr['sku']=$skuArr[$key];
                $productAttrArr['price']=$priceArr[$key];
                // $productAttrArr['attr_status']=$attr_status[$key];
                $productAttrArr['quantity']=$qtyArr[$key];
                $productAttrArr['attr_sale_price']=$attr_sale_priceArr[$key];   
                $productAttrArr['attr_sale_date']=$attr_sale_dateArr[$key];

                if($size_idArr[$key]==''){
                    $productAttrArr['size_id']=0;
                }else{
                        $productAttrArr['size_id']=$size_idArr[$key];
                }

                if($color_idArr[$key]==''){
                $productAttrArr['color_id']=0;
                }else{
                        $productAttrArr['color_id']=$color_idArr[$key];
                }            

                if($attr_sale_priceArr[$key]==''){
                    $productAttrArr['attr_sale_price']=0;
                }else{
                    $productAttrArr['attr_sale_price']=$attr_sale_priceArr[$key];
                }

                $attr_sale_dateArr[$key]==''?'':$attr_sale_dateArr[$key];
                if(isset($attr_sale_dateArr[$key]))
                {
                    $attr_sale_dateArr2 =explode('-',$attr_sale_dateArr[$key]); 
                    $productAttrArr['attr_sale_start']=\Carbon\Carbon::parse($attr_sale_dateArr2[0])->format('Y-m-d');
                    $productAttrArr['attr_sale_end']=\Carbon\Carbon::parse($attr_sale_dateArr2[1])->format('Y-m-d');      
                    $productAttrArr['attr_sale_date'] = $attr_sale_dateArr2[0].' - '.$attr_sale_dateArr2[1];
                }
                //Product Update Attribute Image Start
                $img_key = $key;
                
                if($request->hasFile("attr_image.$key"))
                {
                    $attr_image=$request->file("attr_image.$key");
                    if($paidArr[$key])
                    {
                        $att_img = ProductAttribute::where('id',$paidArr[$key])->get();
                        // dd($att_img[0]->attr_image);
                        if($att_img[0]->attr_image)
                        {
                            if(File::exists($path.$att_img[0]->attr_image)){
                                unlink($path.$att_img[0]->attr_image);
                            }
                        }
                        $file_attr = md5($attr_image->getClientOriginalName()) . time() . "." . $attr_image->getClientOriginalExtension();
                        $attr_image->move($path, $file_attr);
                        $productAttrArr['attr_image']=$file_attr;
                    }
                }
                
                if($paidArr[$key]!=''){
                    // dump('Im in attribute update'.$paidArr[$key]);
                    // dump($productAttrArr);
                    DB::table('product_attributes')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
                    unset($productAttrArr['attr_image']);
                    unset($productAttrArr['attr_sale_date']);
                    unset($productAttrArr['attr_sale_start']);
                    unset($productAttrArr['attr_sale_end']);
                }else{
                    do {
                        $attr_systematic_sku = mt_rand( 1000000000, 9999999999 ).'_PK'.time();
                    } while ( \DB::table( 'product_attributes' )->where( 'attr_systematic_sku', $attr_systematic_sku )->exists() );
                    $productAttrArr['attr_systematic_sku'] = $attr_systematic_sku;

                    DB::table('product_attributes')->insert($productAttrArr);
                }

            }
            // dd($productAttrArr);
        //Product Update Attribute End
            

        // $product->tag($tags);
            // dd('test');
        return back()->with('success', 'Your product has been edit successfully!');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        //Delete Sitemap
        $this->SitemapProduct(NULL,$product,'product','product','delete');

        $path = 'uploads/product_images/';

        $currentImage1 = $product->image_1;
        $currentImage2 = $product->image_2;
        $currentImage3 = $product->image_3;
        $currentImage4 = $product->image_4;
        $currentImage5 = $product->image_5;
        $currentImage6 = $product->image_6;
        $currentSizeChart = $product->size_chart;
//Attribute has image then delete images too
        if(sizeof($product->productAttribute)>0)
        {
            foreach($product->productAttribute as $key=>$value)
            {
                File::delete($path. $value->attr_image);
            }
        }

        $product->delete();
        File::delete($path. $currentImage1);
        File::delete($path. $currentImage2);
        File::delete($path. $currentImage3);
        File::delete($path. $currentImage4);
        File::delete($path. $currentImage5);
        File::delete($path. $currentImage6);
        File::delete($path. $currentSizeChart);

        return back()->with('success', 'Your product [product'.$product->slug.'] has been deleted!');
    }

    // public function product_colors()
    // {
    //     $productColors = Color::get();

    //     return response()->json($productColors);
    // }

        // $result['colors'] = OptionsValue::where('option_id',1)->get();
    // $result['sizes'] = OptionsValue::where('option_id',2)->get();
    // public function colors(request $request)
    // {
    //     // $data = Color::get();
    //     $data = OptionsValue::where('option_id',1)->get();
    //     return response([
    //         'data'=>$data,
    //     ]);
    // }
    
    // public function sizes(request $request)
    // {
    //     // $data = Color::get();
    //     $data = OptionsValue::where('option_id',2)->get();
    //     return response([
    //         'data'=>$data,
    //     ]);
    // }
    public function colors(Request $request)
    {
        $search = $request->search;
        if($search == '')
        {
            $productColors = Color::orderby('title','asc')
                            ->select('id','title')
                            ->limit(5)
                            ->get();    
        }else{
            $productColors = Color::orderby('title','asc')
                            ->select('id','title')
                            ->where('name','like','%'.$search.'%')
                            ->limit(5)
                            ->get();    

        }
        $response = array();
        foreach ($productColors as $colors)
        {
            $response[] = array(
                "id"=>$colors->id,
                "text"=>$colors->title
           );
        }
        return response()->json($response);
    }

    public function status(Request $request,$id)
    {
        $data = Product::find($id);
        $data->vendor_status = $data->vendor_status =='ACTIVE' ? 'DEACTIVE' : 'ACTIVE';

        $data->save();
        return redirect()->back();
    }

    public function check_size($id)
    {
        $product = Product::find($id);
        $checkSize = $product->size_check;

        return response()->json(['size' => $checkSize]);
    }

    public function check_color($id)
    {
        $product = Product::find($id);
        $checkColor = $product->color_check;

        return response()->json(['color' => $checkColor]);
    }

    public function check_sale($id)
    {
        $product = Product::find($id);
        $checkSale = $product->sale_status;

        return response()->json(['sale' => $checkSale]);
    }
    
    public function remove_image1(Request $request , $id)
    {
        $product = Product::find($id);
        $path = 'uploads/product_images/'.$product->image_1;
        if(!empty($product->image_1)){
        unlink($path); 
        $product->image_1 = $request->image_1;
        $product->save();
        }

        return response()->json(['success' => 'Remove Success']);
    }

    public function remove_image2(Request $request , $id)
    {
        $product = Product::find($id);
        $path = 'uploads/product_images/'.$product->image_2;
        if(!empty($product->image_2))
        {
            unlink($path); 
            $product->image_2 = $request->image_2;
            $product->save();
        }
        return response()->json(['success' => 'Remove Success']);
    }

    public function remove_image3(Request $request , $id)
    {
        $product = Product::find($id);
        $path = 'uploads/product_images/'.$product->image_3;
        if(!empty($product->image_3))
        {
            unlink($path); 
            $product->image_3 = $request->image_3;
            $product->save();
        }
        return response()->json(['success' => 'Remove Success']);
    }

    public function remove_image4(Request $request , $id)
    {
        $product = Product::find($id);
        $path = 'uploads/product_images/'.$product->image_4;
        if(!empty($product->image_4))
        {
            unlink($path); 
            $product->image_4 = $request->image_4;
            $product->save();
        }

        return response()->json(['success' => 'Remove Success']);
    }

    public function remove_image5(Request $request , $id)
    {
        $product = Product::find($id);
        $path = 'uploads/product_images/'.$product->image_5;
        if(!empty($product->image_5))
        {
            unlink($path); 
            $product->image_5 = $request->image_5;
            $product->save();
        }

        return response()->json(['success' => 'Remove Success']);
    }

    public function remove_image6(Request $request , $id)
    {
        $product = Product::find($id);
        $path = 'uploads/product_images/'.$product->image_6;
        if(!empty($product->image_6))
        {
            unlink($path); 
            $product->image_6 = $request->image_6;
            $product->save();
        }

        return response()->json(['success' => 'Remove Success']);
	}
    public function product_attr_delete(Request $request,$paid,$pid){
        $product_attr = ProductAttribute::find($paid);
        $path = 'uploads/product_images/';
        if($product_attr->attr_image)
        {
            // unlink($path. $product_attr->image); 
            File::delete($path. $product_attr->attr_image);
        }
        DB::table('product_attributes')->where(['id'=>$paid])->delete();
        return back()->with('success', 'Product Attribute Deleted Successfully!');
    }

    public function product_images_delete(Request $request,$paid,$pid){
        DB::table('product_images')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

    //web php set route for ajax  changeAttrStatus
    public function changeAttrStatus(Request $request)
   {
        $data = ProductAttribute::find($request->att_id);
        $data->attr_status = $request->status;
        $data->save();
        return response()->json(['success'=>'Status change successfully.']);
    }    
}