<?php

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
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
     *      title="Full Name",
     *      description="Full Name",
     *      example="John Kendy"
     * )
     *
     * @var string
     */
    public $fullname;

    /**
     * @OA\Property(
     *     title="Customer Email",
     *     description="Customer Email",
     *     example="john@yahoo.com",
     *     pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$", 
     *     format="email"
     * )
     *
     * @var string
     */
   public $email;

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
    public $phone;

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
}