<?php

namespace App\Http\Controllers\Api\V1\Product\Interfaces;

use Illuminate\Http\Request;

interface ProductInterface
{
    public function allProduct(Request $request);

    public function findProduct($id);

    public function deleteProduct($id);

    public function addProduct(Request $request);

    public function validateaddProduct(Request $request);

    public function editProduct(Request $request,$id);

    public function allCategory();

    public function SubCategory($parent_id);

    public function ChildCategory($parent_id);

    public function colors();

    public function addProductImage(Request $request);

    public function removeProductImage($name);

    public function bestSellingProducts(Request $request);
}