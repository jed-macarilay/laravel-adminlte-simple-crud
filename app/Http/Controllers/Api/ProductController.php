<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show() {
        return [
            "message" => "Get all products successful.",
            "data" => Product::latest(),
        ];
    }
    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'category' => 'required',
                'description' => 'required'
            ]);
    
            if ($request->validated()) {
                $product = Product::create($request->all());
    
                return [
                    "message" => "Added new product.",
                    "data" => $product,
                ];
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function update(
        Request $request,
        Product $product
    ) {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'category' => 'required',
                'description' => 'required'
            ]);
    
            if ($request->validated()) {
                $product->update($request->all());
    
                return [
                    'message' => 'Update product successful.',
                    'data' => $product,
                ];
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy(Product $product) {
        try {
            if ($product->destroy()) {
                return ['message' => 'Delete product successful.'];
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
