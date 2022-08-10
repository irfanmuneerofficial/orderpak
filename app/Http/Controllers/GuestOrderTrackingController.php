<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestOrderTrackingController extends Controller
{
    private $mp_username;
    private $mp_password;
    private $mp_location_id;
    private $mp_account;

    public function __construct()
    {
        if(config('app.env') == 'local'){
            $this->mp_username = 'Test_User';
            $this->mp_password = '12345';
            $this->mp_location_id = '';
            $this->mp_account = '4T154';
        }
        else{
            $this->mp_username = 'waseem_4o118';
            $this->mp_password = 'Orderpak12!';
            $this->mp_location_id = '11345';
            $this->mp_account = '4o118';
        }
    }
    
    //  track shipment by consignment number
    public function tracking_by_consignmentMP($consignment_number){
        $url = 'http://mnpcourier.com/mycodapi/api/Tracking/Consignment_Tracking?username='.$this->mp_username.'&password='.$this->mp_password.'&consignment='.$consignment_number;
        $response = $this->process_curl_get($url);

        if($response){
            return view('guestordertracking')
            ->with(array('tracking' => $response)); 
        } 
        else{
            return response()->json(['response' => 'Something went wrong']);
        }
    }

    public function process_curl_get($url){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }

}
