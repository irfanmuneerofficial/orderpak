<?php
/**
 * @OA\Schema(
 *      title="Store Vendor request",
 *      description="Store Vendor request body data",
 *      type="object",
 *      required={"first_name", "last_name", "phone_no", "password", 
 *                  "password_confirmation", "business_name", "business_name",
 *                  "business_email", "business_address", "city", "state", "cnic"
 *              }
 * )
 */

class StoreVendorRequest
{

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="First Name",
     *      description="First Name",
     *      example="John",
     *      type="string"
     * )
     *
     * @var string
     */
    public $first_name;

    /**
     * @OA\Property(
     *      title="Last Name",
     *      description="Last Name",
     *      example="Mike",
     *      type="string"
     * )
     *
     * @var string
     */
    public $last_name;

    /**
     * @OA\Property(
     *     title="Phone Number",
     *     description="Phone Number",
     *     example="+923453289764",
     *     type="string"
     * )
     *
     * @var string
     */
    public $phone_no;

    /**
     * @OA\Property(
     *     title="Password",
     *     description="Password",
     *     example="123456",
     *     type="string"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *     title="Confirm Password",
     *     description="Confirm Password",
     *     example="123456",
     *     type="string"
     * )
     *
     * @var string
     */
    public $password_confirmation;

    /**
     * @OA\Property(
     *      title="Business Name",
     *      description="Business Name",
     *      example="Abc Company Inc",
     *      type="string"
     * )
     *
     * @var string
     */
    public $business_name;

    /**
     * @OA\Property(
     *     title="Business Email",
     *     description="Business Email",
     *     example="test@yahoo.com",
     *     type="string"
     * )
     *
     * @var string
     */
    public $business_email;

    /**
     * @OA\Property(
     *     title="Business Address",
     *     description="Business Address",
     *     example="Abc Street 4",
     *     type="string"
     * )
     *
     * @var string
     */
    public $business_address;

    /**
     * @OA\Property(
     *     title="City",
     *     description="City",
     *     example="Karachi",
     *     type="string"
     * )
     *
     * @var string
     */
    public $city;

    /**
     * @OA\Property(
     *     title="State",
     *     description="State",
     *     example="Sindh",
     *     type="string"
     * )
     *
     * @var string
     */
    public $state;
    
    /**
     * @OA\Property(
     *     title="Nic Number",
     *     description="Nic Number",
     *     example="42101-6324567-6",
     *     type="string"
     * )
     *
     * @var string
     */
    public $cnic;
}