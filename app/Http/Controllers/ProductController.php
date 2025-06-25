<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        if ($products->isEmpty()) {
            $response = [
                'meesage' => 'No Data Found',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $products,
                'meesage' => 'Get Data successfully',
                'status' => 200,
            ];
        }

        return  response($response, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $miga = 1 * 1024;
        $request->validate([
            'title' => "required|string",
            'description' => "required|min:3|max:90",
            'price' => 'required|numeric',
            "image" => "required|file|max:$miga"
        ]);

        if ($request->hasFile("image")) {
            $image_data = $request->file("image");
            $image_name = $image_data->getClientOriginalName();
            $location = public_path('upload');
            $image_data->move($location, $image_name);
        } else {
            $image_name  = null;
        }
        $product =  Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image_name,
            'price' => $request->price
        ]);

        $response = [
            'data' =>   $product,
            'meesage' => 'Create Data successfully',

            'status' => 201,
        ];


        return response($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $products = Product::find($id);

        if ($products == null) {
            $response = [
                'meesage' => 'No Data Found',
                'status' => 200,
            ];
        } else {
            $response = [
                'data' => $products,
                'meesage' => 'Get Data successfully',
                'status' => 200,
            ];
        }


        return  response($response, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $miga = 1 * 1024;
        $request->validate([
            'title' => "required|string",
            'description' => "required|min:3|max:90",
            'price' => 'required|numeric',
            "image" => "required|file|max:$miga"
        ]);

        if ($request->hasFile("image")) {
            $image_data = $request->file("image");
            $image_name = $image_data->getClientOriginalName();
            $location = public_path('upload');
            $image_data->move($location, $image_name);
        } else {
            $image_name  = null;
        }
        $product =  Product::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image_name,
            'price' => $request->price
        ]);

        $response = [
            'data' =>   $product,
            'meesage' => 'Update Data successfully',
            'status' => 201,
        ];


        return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product =  Product::find($id);

        if ($product == null) {
            $response = [
                'data' =>   $product,
                'meesage' => 'Delete Data successfully',
                'status' => 200,
            ];
        } else {
            $product->delete();
            $response = [
                'data' =>   $product,
                'meesage' => 'Delete Data successfully',
                'status' => 200,
            ];
        }





        return response($response, 201);
    }
}
