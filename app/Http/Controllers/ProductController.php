<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    //store products
    public function AddProducts(Request $request)
    {

        // return $request->user();
        // دریافت اطلاعات کاربر نیم و پس


        $request->validate([
        'title' => 'required',
        'description' => 'required',
        'price'=>'numeric'
        ]);


        $product=[
            'title' =>$request->title,
            'description' =>$request->description,
            'price'=>$request->price
        ];


        product::create($product);


        return response()->json([
                'message' => 'add shod !...'
            ], 500);


    }


    // update product
    public function update_product(Request $request,string $id)
    {

        $productData = $request->validate([
            'title' => ['string'],
            'description' => ['string'],
            'price'=> ['integer'],
            // 'status' => ['in:pending,rejected,accepted']
        ]);


        $product = product::where('id', $id)->first();

        if (empty($product))
        {
            return response()->json([
                'message' => 'in product vojod nadarad !...'
            ], 404);
        }

        $product->update($productData);

        return response()->json([
            'message' => 'update shod !...'
        ], 500);

    }


    // delete product
    public function delete_product(Request $request,string $id)
    {

        $product=product::where('id', $id)->first();

        if (empty($product))
        {
            return response()->json([
                'message' => 'in product vojod nadarad !...'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'delete shod !...'
        ], 500);


    }

    // get all products

    public function get_products()
    {

        $products=product::get();

        return response()->json($products, 500);

    }


    // get product by id
    public function get_product_by_id(string $id)
    {

        // $product=product::where('id', $id)->first();


        return new ProductResource(product::where('id', $id)->first());


        if (empty($product)) {

            return response()->json([
                'message' => 'id vojod nadarad ...!'
            ],404);

        }

        return response()->json($product);


    }






}
