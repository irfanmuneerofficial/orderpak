<?php

namespace App\Http\Controllers\Api\V1\Vendor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Vendor;
use DB;
use Carbon\Carbon;
use Mail;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/v1/vendor/forgot-password/",
     *   tags={"Vendor"},
     *   summary="Forgot Password",
     *   operationId="vendor_forgot_password",
     ** @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"email"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
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
     * sendResetEmail api
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResetEmail(Request $request)
    {
        $success = array();
        $error = array();

        $vendor = Vendor::where('business_email',request('email'))->first();

        if($vendor){

            $token = Str::random(60);

            DB::table('password_resets')->insert(
                ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
            );

            Mail::send('auth.vendor_verify',['token' => $token], function($message) use ($request) {
                $message->from('noreply@orderpak.com');
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });
            $success['status'] = 'success';
            $success['status_code']  = Response::HTTP_ACCEPTED;
            $success['reset_pas_token'] =  $token;
            $success['message'] = 'We have e-mailed your password reset link!';

            return response()->json(['response' => $success])->setStatusCode(Response::HTTP_ACCEPTED);
        }
        else{
            $error['status'] =  "fail";
            $error['status_code'] =  200;
            $error['message'] = 'This Email is Not Register in Our Record!';

            return response()->json(['response' => $error])->setStatusCode(200);
        }
    }
}
