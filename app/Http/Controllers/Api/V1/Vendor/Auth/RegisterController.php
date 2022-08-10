<?php

namespace App\Http\Controllers\Api\V1\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\SendMailablee;
use Validator;
use Symfony\Component\HttpFoundation\Response;
class RegisterController extends Controller
{

    /**
     * @OA\Post(
     ** path="/api/v1/vendor/registration/",
     *   tags={"Vendor"},
     *   summary="Register",
     *   operationId="vendor_register",
     *
     *  @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreVendorRequest")
     *  ),
     *   @OA\Response(
     *      response=201,
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
     *      )
     *)
     **/
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    protected function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_no' => 'required|regex:/^(\+92)[\d]{10}$/|max:13|unique:vendors',
            'alternate_phone_no' => 'required|regex:/^(\+92)[\d]{10}$/|max:13|unique:vendors',
            'password' => 'required|confirmed',
            'business_name' => 'required',
            'business_email' => 'required|email|unique:vendors',
            'business_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'cnic' => 'required|regex:/^[0-9]{5}-[0-9]{7}-[0-9]$/|max:15',
            // 'slug'=>'required',
            't&cs'=>'required'
        ]);
        
        $success = array();
        $error = array();

        if ($validator->fails()) {
            $error['status']  = 'fail';
            $error['status_code']  = 401;
            $error['error'] = $validator->errors()->first();

            return response()->json(['response' => $error])->setStatusCode(401);
        }
 
        $request->request->add(['ip' =>$request->ip(),'agent'=>$request->server('HTTP_USER_AGENT')]);
        $request=$request->except(['t&cs']);
        $input = $request;
        $input['password'] = Hash::make($input['password']);
        // $input['slug'] = str_slug($input['business_name'],'-');
        $input['status'] = 'DEACTIVE';
        //$input['isVerified']  = true;
        $user = Vendor::create($input);
        $success['token'] =  $user->createToken('authToken')->accessToken;
        // $success['name'] =  $user->name;

        $success['status'] = 'success';
        $success['status_code'] = Response::HTTP_CREATED;
        $success['message']  = 'Thank you for registration';
        return response()->json(['response' => $success])->setStatusCode(Response::HTTP_CREATED);
    }
}
