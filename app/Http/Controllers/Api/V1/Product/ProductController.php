<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Api\V1\Product\Interfaces\ProductInterface;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $productRepository;
    public function __construct(ProductInterface $productRepository){
        $this->productRepository=$productRepository;
    } 

    public function allProduct(Request $request){
        
        $products=$this->productRepository->allProduct($request);
        $message_success = 'All products have been listed successfully';
        return $this->successResponse($products,$message_success,200);
       
    }

    public function findProduct($id){
        $products=$this->productRepository->findProduct($id);
        if(empty($products)){
            $message_failure="No such product found";
            return $this->errorResponse($message_failure,422);
        }
        $message_success = 'Products have been retrieved successfully';
        return $this->successResponse($products,$message_success,200);
    }

    public function deleteProduct($id){
        $products=$this->productRepository->findProduct($id);
        if(empty($products)){
            $message_failure="No such product found";
            return $this->errorResponse($message_failure,422);
        }
        $this->productRepository->deleteProduct($id);
        $message_success = 'Product has been deleted';
        return $this->successResponse(null,$message_success,200);
    }

    public function addProduct(Request $request){

        $response=$this->productRepository->validateaddProduct($request);
        if($response!=null)
        {
            return $this->errorResponse($response,422);
        }
        
        $this->productRepository->addProduct($request);
        $message_success = 'Product has been added';
        return $this->successResponse(null,$message_success,200);
    }

    public function editProduct(Request $request,$id){
        $products=$this->productRepository->findProduct($id);
        if(empty($products)){
            $message_failure="No such product found";
            return $this->errorResponse($message_failure,422);
        }
        $this->productRepository->editProduct($request,$id);
        $message_success = 'Product has been updated';
        return $this->successResponse(null,$message_success,200);
    }

    public function allCategory(){
        $category=$this->productRepository->allCategory();
        $message_success = 'List of Category';
        return $this->successResponse($category,$message_success,200);
    }

    public function SubCategory($parent_id){
        $category=$this->productRepository->SubCategory($parent_id);
        $message_success = 'List of Sub Category against selected Category';
        return $this->successResponse($category,$message_success,200);
    }

    public function ChildCategory($parent_id){
        $category=$this->productRepository->ChildCategory($parent_id);
        $message_success = 'List of Child Category against selected Sub Category';
        return $this->successResponse($category,$message_success,200);
    }

    public function colors(){
        $color=$this->productRepository->colors();
        $message_success = 'List of colors';
        return $this->successResponse($color,$message_success,200);
    }

    public function addProductImage(Request $request){
        
        $img_name=$this->productRepository->addProductImage($request);
        $message_success = 'Editor Image has been added';
        return $this->successResponse($img_name,$message_success,200);
    }

    public function removeProductImage($name){
        
        $this->productRepository->removeProductImage($name);
        $message_success = 'Editor Image has been removed';
        return $this->successResponse(null,$message_success,200);
    }

    public function bestSellingProducts(Request $request){
        
        $prodcuts=$this->productRepository->bestSellingProducts($request);
        $message_success = 'Best selling product retrieved successfully';
        return $this->successResponse($prodcuts,$message_success,200);
    }
    
}
