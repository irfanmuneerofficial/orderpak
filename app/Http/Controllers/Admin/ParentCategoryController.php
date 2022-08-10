<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ParentCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ParentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $categories = ParentCategory::get();
        $category = Category::get();
        return view('admin.category.parent.parent')->with(compact('categories','category'));
    }

    public function check_slug(Request $request)
    {
        $data = ParentCategory::where('title',$request->title)->first();
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
        $category = Category::get();
        return view('admin.category.parent.create')->with(compact('category'));

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
            'meta_title' => 'max:255',
            'meta_description' => 'max:500',
            'head' => 'max:50000',
            'description' => 'max:50000'
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator);

        try {
            $fileName = null;
            if($request->hasFile('image')) 
            {
                $files = $request->file('image');
                $destinationPath = 'uploads/category/'; // upload path
                // Upload Orginal Image           
                $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $fileName);
            }
            ParentCategory::Create([
                'main_id' => $request->main_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'image' => $fileName,
                'showtext' => $request->head,
                'hidetext' => $request->description,
                'meta_title' =>  $request->meta_title,
                'meta_description' =>  $request->meta_description,
            ]);
    
            return redirect()->to('admin/subcategory')->with('success', 'Sub Category added successfully!');
        }  catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
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


    //view_subcategory
    public function view_subcategory(Request $request)
    {

        try
        {
            $input = $request->only('id');

            $rules = [
                'id' => 'required|exists:parent_category,id',

            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                $code = 406;
                $output = ['error' => ['code' => $code, 'messages' => $validator->messages()->all()]];
            } else {

                $category  = ParentCategory::find($input['id']);

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
        $categories = Category::get();
        $subcategory  = ParentCategory::find($id);
        return view('admin/category/parent/edit')->with(compact('subcategory','categories'));

        //
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
            'description' => 'max:50000'
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator);

        try {
            $products = ParentCategory::find($id);
    
            $path = "uploads/category/" . $products->image;
            $productImageName=null;
            if(request()->hasFile('image')){
                $productImage = $request->file('image');
                $productImageName = rand() . '.' . $productImage->getClientOriginalExtension();
                $productImage->move('uploads/category/', $productImageName);
            }
    
            $products->title = $request->title;
            $products->main_id = $request->main_id;
            $products->slug = $request->slug;
            $products->showtext = $request->head;
            $products->hidetext = $request->description;
            $products->meta_title = $request->meta_title;
            $products->meta_description = $request->meta_description;
            $products->image = ($productImageName) ? $productImageName : $products->image ;
            $products->script_text = $request->script_text;
            $products->save();
    
            return redirect()->to('admin/subcategory')->with('success', 'SubCategory edit successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
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
        $attachments = ParentCategory::find($id);
        $attachments->delete();
        return redirect()->back();
    }
}
