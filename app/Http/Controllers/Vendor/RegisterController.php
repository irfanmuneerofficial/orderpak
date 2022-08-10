<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor_panel.register.index');
    }

    protected function phone_verify(Request $request)
    {
        /* Get credentials from .env */
        $token = 'e06e8f90164448f1ae698f1f6a3ca164';
        $twilio_sid = 'AC1f1ccb1686e28c2b24b6439c13c7ee22';
        $twilio_verify_sid = 'VA70083c33aac15bce41b4bb72336330a7';
        // print_r($token);die;
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($request['phone_number'], "sms");
    }

    protected function phone_confirm(Request $request)
    {
        
        $token = 'e06e8f90164448f1ae698f1f6a3ca164';
        $twilio_sid = 'AC1f1ccb1686e28c2b24b6439c13c7ee22';
        $twilio_verify_sid = 'VA70083c33aac15bce41b4bb72336330a7';
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($request['confirmno'], ['to' => $request['phone_number']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
