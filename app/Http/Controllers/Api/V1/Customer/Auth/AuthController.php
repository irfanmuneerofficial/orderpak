<?php

namespace App\Http\Controllers\Api\V1\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    use AuthenticatesUsers;
    /**
     * @OA\Post(
     ** path="/api/v1/customer/login/",
     *   tags={"Customer"},
     *   summary="Login",
     *   operationId="login",
     *
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
     *      )
     *)
     **/
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $success = array();
        $error = array();

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user()->makeHidden(['profile_photo_url']); 
            $success['token'] =  $user->createToken('authToken')->accessToken; 
            $success['data']['customer'] =  $user;
            $success['message'] = 'User login successfully.';
            $success['status'] = 'success';
            $success ['status_code'] = Response::HTTP_ACCEPTED;
            
            return response()->json(['response' => $success]);
        } 
        else{ 
            $error['status'] = 'fail';
            $error['message']  =  'Your email or password is not correct';
            $error['status_code'] = 401;
            return response()->json(['response' => $error]);
        } 
    }

    /**
     * @OA\Post(
     ** path="/api/v1/customer/registration/",
     *   tags={"Customer"},
     *   summary="Register",
     *   operationId="register",
     *
   *  @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCustomerRequest")
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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'phone' => 'required|unique:users'
        ]);

        $success = array();
        $error = array();

        if ($validator->fails()) {
            $error['status'] = 'fail';
            $error['error'] = $validator->errors();
            $error['status_code'] = 401;
            return response()->json(['response'  => $error]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['is_admin'] = 0;
        //$input['isVerified']  = true;
        $user = User::create($input);

        $success['token'] =  $user->createToken('authToken')->accessToken;
        $success['status'] = 'success';
        $success['status_code'] = Response::HTTP_CREATED;
        $success['message'] = 'Thank you for registration';
        $success['data']['customer'] = $user->makeHidden(['profile_photo_url']);

        return response()->json(['response'  =>  $success]);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user()->makeHidden(['profile_photo_url']);
        return response()->json(['success' => $user], $this->successStatus);
    }
}