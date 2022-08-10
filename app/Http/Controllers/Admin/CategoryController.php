<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\CategoryBanner;
use App\Models\Categories;
use App\Traits\SitemapTrait;

class CategoryController extends Controller
{
    use SitemapTrait;
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(request $request)
    {
        $categories = Categories::where('parent_id', 0)->get();
        return view('admin.category.index')->with(compact('categories'));
    }
    
    public function banner(request $request)
    {
        // Post Banner
        if ($request->isMethod('post')) {
            $banner = $request['banner_img'];
            $link = $request['link'];

            $fileName = null;
            if($request->hasFile('banner_img')) 
            {
                $files = $request->file('banner_img');
                $destinationPath = 'uploads/category/'; // upload path
                // Upload Orginal Image           
                $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $fileName);
            }    
            CategoryBanner::Create([
                'link' => $request->link,
                'banner_img' => $fileName,
            ]);
            return redirect()->back();
        }

        // Update Bnner
        elseif ($request->isMethod('put')) {

            $userData = CategoryBanner::find($request['id']);
            $currentImage = $userData->banner_img;
            $productImageName=null;
            if(request()->hasFile('banner_img')){
                $productImage = $request->file('banner_img');
                $productImageName = rand() . '.' . $productImage->getClientOriginalExtension();
                $productImage->move('uploads/category/', $productImageName);
            }

            $userData->link = request('link');
            $userData->banner_img = ($productImageName) ? $productImageName : $currentImage;
            
            $userData->save();
            return redirect()->back();
        }

        elseif ($request->isMethod('delete')) 
        {
            // print_r($id);die;
            $attachments = CategoryBanner::find($request['id']);
            $path = public_path().'/uploads/category/'. $attachments->banner_img;
            // unlink($path);
            $attachments->delete();
            return redirect()->back();

        }

        // get Banner
        else
        {
            $categories = CategoryBanner::get();
            return view('admin.category.banner')->with(compact('categories'));
        }
    }

    public function check_slug(Request $request)
    {
        $data = Categories::where('title',$request->title)->first();
        if(!empty($data)){
            return response()->json(['error' => 'Category Name Is Already Taken']);
        }
        else{
            $slug = str_slug($request->title);
            return response()->json(['slug' => $slug]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $categories = Categories::where('parent_id', 0)->get();
        return view('admin.category.index.create', compact('categories'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // validation...
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories,title',
            'meta_title' => 'max:255',
            'meta_description' => 'max:500',
            'head' => 'max:50000',
            'description' => 'max:50000',
            'category_img' => 'required',
            'category_icon' => 'required',
            'slug' => 'required|unique:categories,slug'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fileName = null;
        if($request->hasFile('category_img')) 
        {
            $files = $request->file('category_img');
            $destinationPath = 'uploads/category/'; // upload path
            // Upload Orginal Image           
            $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $fileName);
        }

        $fileName1 = null;
        if($request->hasFile('category_icon')) 
        {
            //print_r($request->category_icon);die;
            $files = $request->file('category_icon');
            $destinationPath1 = 'uploads/category/'; // upload path
            // Upload Orginal Image           
            $fileName1 = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath1, $fileName1);
        }
        $parent_id = isset($request->parent_id) ? $request->parent_id : 0;
        // echo '<pre>';
        // print_r($request->all());die;
        $data= Categories::Create([
            'title' => $request->title,
            'slug' => $request->slug,
            'category_img' => $fileName,
            'category_icon' => $fileName1,
            'showtext' =>  $request->head,
            'hidetext' =>  $request->description,
            'meta_title' =>  $request->meta_title,
            'meta_description' =>  $request->meta_description,
            'parent_id' => $parent_id,
            'status' => 1,
            'script_text' => $request->script_text
        ]);
        
        //ADD Sitemap
        $this->SitemapCategories($request,$data,'category','category','add');        
     
        return redirect()->to('admin/category')->with('success', 'Category added successfully!');

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



    //view_category

    public function view_category(Request $request)
    {

        try
        {
            $input = $request->only('id');

            $rules = [
                'id' => 'required|exists:categories,id',

            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                $code = 406;
                $output = ['error' => ['code' => $code, 'messages' => $validator->messages()->all()]];
            } else {

                $category  = Categories::find($input['id']);

                    $code = 200;
                    $message = "Request Completed Successfully ";
                    $output = ['response' => ['code' => $code, 'messages' => [$message] , 'data' => $category]];
            }
        } catch (\Exception $e){
            $code = 401;
            $message = $e->getFile().' '.$e->getLine().' '.$e->getMessage();
            Log::debug($message);
            $message = "Server Side Error!";
            $output = ['error' => ['code' => $code, 'messages' => [$message]]];
        }
        return response()->json($output, $code);

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
        $category = Categories::where('id', $id)->first();
        $categories = Categories::where('parent_id', 0)->get();
        // $category  = Category::find($id);
           return view('admin/category/index/edit')->with(compact('category', 'categories'));
    
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
        // validation...
        $validator = Validator::make($request->all(), [
            'meta_title' => 'max:255',
            'meta_description' => 'max:500',
            'head' => 'max:50000',
            'description' => 'max:50000',
            'title' => 'required|unique:categories,title,'.$id
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator);
        
        try {
            $categpory = Categories::find($id);
 
            $productImageName=null;
            if(request()->hasFile('category_img')){
                $productImage = $request->file('category_img');
                $productImageName = rand() . '.' . $productImage->getClientOriginalExtension();
                $productImage->move('uploads/category/', $productImageName);
            }
    
            $productImageName1=null;
            if(request()->hasFile('category_icon')){
                $productImage1 = $request->file('category_icon');
                $productImageName1 = rand() . '.' . $productImage1->getClientOriginalExtension();
                $productImage1->move('uploads/category/', $productImageName1);
            }
            
            //UPDATE Sitemap
            @$this->SitemapCategories($request,$categpory,'category','category','update');
            
            $categpory->title = $request->title;
            $categpory->parent_id = isset($request->parent_id) ? $request->parent_id : 0;
            $categpory->slug = $request->slug;
            $categpory->showtext = $request->head; 
            $categpory->hidtext = $request->description;
            $categpory->meta_title = $request->meta_title;
            $categpory->meta_description = $request->meta_description;
            $categpory->category_img = ($productImageName) ? $productImageName : $categpory->category_img ;
            $categpory->category_icon = ($productImageName1) ? $productImageName1 : $categpory->category_icon ;
            $categpory->script_text = $request->script_text;

            $categpory->save();
       
        
            return redirect()->to('admin/category')->with('success', 'Category edit successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryObj = Categories::find($id);
        // $path = public_path().'/uploads/slider/'. $attachments->category_img;
        // unlink($path);
        $categoryObj->delete();
        
        //Delete Sitemap
        $this->SitemapCategories(NULL,$categoryObj,'category','category','delete');
        
        return redirect()->back()->withSuccess('Category has been deleted successfully.');
    }
}
