<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorPayout;
use File;use Auth;

class VendorPayoutController extends Controller
{
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
        
        $data=VendorPayout::where('vendor_id',Auth::guard('vendor')->user()->id)->get();
        return view('vendor_panel.bankinfo.index')
        ->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor_panel.bankinfo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $front_id = null;
        // if($request->hasFile('front_id')) 
        // {
        //     $files = $request->file('front_id');
        //     $destinationPath = 'uploads/vendor/account/'; // upload path
        //     // Upload Orginal Image           
        //     $front_id = date('YmdHis') . "." . $files->getClientOriginalExtension();
        //     $files->move($destinationPath, $front_id);
        // }

        // $back_id = null;
        // if($request->hasFile('back_id')) 
        // {
        //     $files = $request->file('back_id');
        //     $destinationPath = 'uploads/vendor/account/'; // upload path
        //     // Upload Orginal Image           
        //     $back_id = date('YmdHis') . "." . $files->getClientOriginalExtension();
        //     $files->move($destinationPath, $back_id);
        // }
        $this->validate($request, [
            'account_title' => 'required',
            'account_no' => 'required|max:24',
            'bank_name' => 'required|max:50',
            // 'branch_code' => 'required|max:6',
        ]);
                
        VendorPayout::Create([
            'vendor_id' => Auth::guard('vendor')->user()->id,
            'account_title' => $request->account_title,
            'account_no' => $request->account_no,
            'bank_name' => $request->bank_name,
            'branch_code' => $request->branch_code,
        ]);

        return redirect('/vendor/payout');
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
        $data = VendorPayout::find($id);
        return view('vendor_panel.bankinfo.edit')
        ->with(compact('data'));
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
        $this->validate($request, [
            'account_title' => 'required',
            'account_no' => 'required|max:24',
            'bank_name' => 'required|max:50',
            // 'branch_code' => 'required|max:6',
        ]);

        $data = VendorPayout::find($id);
        $data->account_title = $request->account_title;
        $data->account_no = $request->account_no;
        $data->bank_name = $request->bank_name;
        $data->branch_code = $request->branch_code;

        $data->save();

        return redirect()->to('/vendor/payout');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = VendorPayout::find($id);

        $data->delete();

    }
}