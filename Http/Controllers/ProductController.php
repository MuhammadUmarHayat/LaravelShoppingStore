<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Exception;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Fetch all products with their categories
         $products = Product::with('category')->get();

       // dd($products);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        //dd($categories);
        return view('products.create', compact('categories'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'ProductName' => 'required|string|max:255',
                'Description' => 'nullable|string',
                'Price' => 'required|numeric',
                'StockQuantity' => 'required|integer',
                'CategoryID' => 'required|exists:categories,id',
                'ImageURL' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imagePath = null;
            if ($request->file('ImageURL')) {
                $imagePath = $request->file('ImageURL')->store('images', 'public');
            }

            Product::create([
                'ProductName' => $request->ProductName,
                'Description' => $request->Description,
                'Price' => $request->Price,
                'StockQuantity' => $request->StockQuantity,
                'CategoryID' => $request->CategoryID,
                'ImageURL' => $imagePath,
            ]);

            return redirect()
                ->route('products.index')
                ->with('success', 'Product is created successfully.');
        } catch (Exception $e) {
            $var = 'Message: ' . $e->getMessage();
            dd($var);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch product with its category
        $product = Product::with('category')->find($id);
        
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'ProductName' => 'sometimes|required|string|max:255',
            'Description' => 'sometimes|nullable|string',
            'Price' => 'sometimes|required|numeric',
            'StockQuantity' => 'sometimes|required|integer',
            'CategoryID' => 'sometimes|required|exists:categories,id',
            'ImageURL' => 'sometimes|nullable|string',
        ]);

        $product = Product::find($id);

        if ($product) {
            $product->update($validatedData);
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully']);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
