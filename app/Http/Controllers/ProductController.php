<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $filters = $request->only('category');
            $searchQuery = $request->input('search', '');
            $sortBy = $request->input('sort', 'popularity');
            
            $query = Product::filter($filters)
                            ->search($searchQuery)
                            ->sortBy($sortBy);

            $products = $query->paginate(6);
            return response()->json($products);
    
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    'message' => 'Product not found',
                    'status' => 404
                ], 404);
            }
            return $product;
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    'message' => 'product not found',
                    'status' => 404
                ], 404);
            }
            $product->delete();
            return $product;
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
