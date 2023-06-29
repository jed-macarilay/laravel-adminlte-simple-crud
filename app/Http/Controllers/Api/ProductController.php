<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        try {
            return response()->json([
                "message" => "Get all products successful.",
                "data" => Product::latest(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                $e->getMessage()
            ]);
        }
    }
    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'category' => 'required',
                'description' => 'required'
            ]);
    
            if ($validated) {
                $product = Product::create($request->all());
    
                return response()->json([
                    "message" => "Added new product.",
                    "data" => $product,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                $e->getMessage()
            ]);
        }
    }
    public function update(
        Request $request,
        Product $product
    ) {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'category' => 'required',
                'description' => 'required'
            ]);
    
            if ($validated) {
                $product->update($request->all());
    
                return response()->json([
                    'message' => 'Update product successful.',
                    'data' => $product,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                $e->getMessage()
            ]);
        }
    }
    public function destroy(Product $product) {
        try {
            if ($product->delete()) {
                return response()->json([
                    'message' => 'Delete product successful.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                $e->getMessage()
            ]);
        }
    }
}
