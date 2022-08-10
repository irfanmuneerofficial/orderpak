<?php

namespace App\Http\Controllers\Api\V1\Vendor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Vendor;
use Hash;
use DB;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
     /**
     * @OA\Post(
     ** path="/api/v1/vendor/reset-password/",
     *   tags={"Vendor"},
     *   summary="Reset Password",
     *   operationId="vendor_reset_password",
     ** @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"email","password","password_confirmation"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="token", type="string", example="fdasfde3432dsfsfdsfgs"),
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
     * updatePassword api
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $success = array();
        $error =  array();

        $vendor = DB::table('password_resets')
                            ->where(['email' => $request->email, 'token' => $request->token])
                            ->first();

        if(!$vendor){
            $error['status'] = 'fail';
            $error['status_code'] = 200;
            $error['message'] = 'Invalid token!';
            return response()->json(['response' => $error])->setStatusCode(200);
        }

        $user = Vendor::where('business_email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
     
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        $success['status'] = 'success';
        $success['status_code'] = Response::HTTP_ACCEPTED;
        $success['message'] = 'Your password has been changed!';
        
        return response()->json(['response' => $success])->setStatusCode(Response::HTTP_ACCEPTED);

        // return response()->json(['success' => $success])->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
