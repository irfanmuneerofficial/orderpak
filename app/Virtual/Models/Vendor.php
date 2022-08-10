<?php

/**
 * @OA\Schema(
 *     title="Vendor",
 *     description="Vendor model",
 *     @OA\Xml(
 *         name="Vendor"
 *     )
 * )
 */
class Vendor
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
     *      example="John"
     * )
     *
     * @var string
     */
    public $first_name;

    /**
     * @OA\Property(
     *      title="Last Name",
     *      description="Last Name",
     *      example="Mike"
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
     *      example="Abc Company Inc"
     * )
     *
     * @var integer
     */
    public $business_name;


    /**
     * @OA\Property(
     *     title="Business Email",
     *     description="Business Email",
     *     example="john@yahoo.com",
     *     pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$", 
     *     format="email"
     * )
     *
     * @var string
     */
    public $business_email;

    /**
     * @OA\Property(
     *     title="Business Address",
     *     description="Business Address",
     *     example="Abc Street 4"
     * )
     *
     * @var string
     */
    public $business_address;

    /**
     * @OA\Property(
     *     title="City",
     *     description="City",
     *     example="Karachi"
     * )
     *
     * @var string
     */
    public $city;

    /**
     * @OA\Property(
     *     title="State",
     *     description="State",
     *     example="Sindh"
     * )
     *
     * @var string
     */
    public $state;
    
    /**
     * @OA\Property(
     *     title="Nic Number",
     *     description="Nic Number",
     *     example="42101-4765337-9"
     * )
     *
     * @var string
     */
    public $cnic;
}