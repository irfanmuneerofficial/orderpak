<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
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


    /**
     * Get home page
     *
     * @return view
     */
    public function gethome()
    {
        return view('admin.home.content.index');
    }


    /**
     * Get home data.
     *
     * @return \Illuminate\Http\Response
     */

    public function getHomeData()
    {
        $content = Content::where('id', '1')->first();
        $code = 200;
        $message = "Request Completed Successfully";
        $output = ['response' => ['code' => $code, 'messages' => [$message], 'data' => $content]];
        return response()->json($output, $code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validation...
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:content,id',
            'meta_title' => 'max:255',
            'meta_description' => 'max:500'
        ]);

        try {
            
            if ($validator->fails()) : 
                $output = ['response' => [
                    'code' => 402, 
                    'messages' => [$validator],
                    'data' => []
                ]];
                return response()->json($validator, 402);
            
            else :
                $data = Content::find( $request['id']);
                $data->update([
                    'title' => $request['title'],
                    'meta_title' => $request['meta_title'],
                    'description' => $request['description'],
                    'meta_description' => $request['meta_description']
                ]);
    
                $code = 200;
                $message = "Request Completed Successfully ";
                $output = ['response' => [
                    'code' => $code, 
                    'messages' => [$message],
                    'data' => $data
                ]];

            endif;
            
            return response()->json($output, $code);

        }  catch (\Exception $ex) {
            $code = 200;
            $message = "Failed ! server have some error.";
            $output = ['response' => [
                'code' => $code, 
                'messages' => [$message],
                'data' => $ex
            ]];
            return response()->json($output, $code);
        } 
    }

   
}
