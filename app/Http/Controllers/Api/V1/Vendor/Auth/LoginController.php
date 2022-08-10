<?php

namespace App\Http\Controllers\Api\V1\Vendor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Vendor;
use Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/v1/vendor/login/",
     *   tags={"Vendor"},
     *   summary="Login",
     *   operationId="vendor_login",
     ** @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="persistent", type="boolean", example="true"),
     *    ),
     * ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     *)
     **/
    /**
     * vendor login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $success = array();
        $error = array();

        $vendorObj = Vendor::where('business_email', $request->email)->first();
        
        if(empty($vendorObj)){
            $error['status'] =  'fail';
            $error['status_code'] = 422;
            $error['message'] =  'Please do correct Your Personal Email'; 

            return response()->json(['response' => $error])->setStatusCode(422);
        }
        if($vendorObj->status == 'ACTIVE')
        {
            if (Auth::guard('vendor')->attempt(['business_email' => $request->email, 'password' => $request->password])) 
            {
                // $user = $vendorObj;
                $success['token'] =  $vendorObj->createToken('authToken')->accessToken; 
                $success['data']['vendor'] = $vendorObj;
                $success['message'] = 'Vendor login successfully';
                $success['status'] = 'success';
                $success['status_code'] = Response::HTTP_ACCEPTED;

                return response()->json(['response' => $success]);
            }   
        }
        else
        {
            $error['status'] = 'fail';
            $error['status_code'] = 200;
            $error['message'] =  'Your account is deactivated from admin!';
            return response()->json(['response' => $error])->setStatusCode(200);
        }
     
        if(!Auth::guard('vendor')->attempt(['business_email' => $request->email, 'password' => $request->password])){
            $error['status'] = 'fail';
            $error['status_code'] = 401;
            $error['message'] =  'Your email or password is not correct';
            return response()->json(['response' => $error])->setStatusCode(401);
        }
    }
    
}
