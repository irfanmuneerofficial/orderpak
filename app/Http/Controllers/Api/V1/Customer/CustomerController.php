<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Resources\User as UserResource;
//use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
     /**
     * @OA\Get(
     *      path="/api/v1/customer/customers",
     *      operationId="getUserList",
     *      tags={"Customer"},
     *      security={{ "apiAuth": {} }},
     *      summary="Get list of customers",
     *      description="Returns list of users",
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
    public function allUsers()
    {
        $users = User::all()->makeHidden(['profile_photo_url']);
        
        return response()->json(['response' => [
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            'data' => [
                'users' => UserResource::collection($users)
            ],

            'message' => 'All users pulled out successfully'

        ]]);
    }
}
