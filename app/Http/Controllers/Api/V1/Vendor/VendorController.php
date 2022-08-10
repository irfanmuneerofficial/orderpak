<?php

namespace App\Http\Controllers\Api\V1\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class VendorController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/v1/vendor/logout/",
     *      operationId="vendor_logout",
     *      tags={"Vendor"},
     *      security={{ "apiAuth": {} }},
     *      summary="Logout",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function logout(Request $request)
    {

        $request->user()->token()->revoke();
        return response()->json(['response'=> [
            'status' => 'success',
            'status_code'  => 200,
            'message' => 'You are logged out'
        ]]);
    }
}
