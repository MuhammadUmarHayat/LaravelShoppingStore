<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Import Log for logging exceptions


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Fetch all catgories with their categories
         $categories = Category::all();
        // dd($products);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {

            //dd( $request);
        $request->validate([
            'CategoryName' => 'required|string|max:255',
            'Description' => 'nullable|string',
           'ImageURL' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 // Handle the file upload
 if ($request->hasFile('ImageURL')) 
 {
    $image = $request->file('ImageURL');
    $imagePath = $image->store('images', 'public'); // Store the image in the 'public/images' directory
}
 else {
    $imagePath = null;
}
       // Create the category
       Category::create([
        'CategoryName' => $request->input('CategoryName'),
        'Description' => $request->input('Description'),
        'ImageURL' => $imagePath,
    ]);
    return redirect()->route('categories.index')->with('success', 'Category created successfully.');
} catch (Exception $exp) 
{
    dd($exp);
}
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
       // dd($category);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
{
    $request->validate([
        'CategoryName' => 'required|string|max:255',
        'Description' => 'nullable|string',
        'ImageURL' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle the file upload
    if ($request->hasFile('ImageURL')) {
        $image = $request->file('ImageURL');
        $imagePath = $image->store('images', 'public'); // Store the new image in the 'public/images' directory

        // Delete the old image if exists
        if ($category->ImageURL) {
            Storage::delete('public/' . $category->ImageURL);
        }

        // Update the ImageURL path
        $category->ImageURL = $imagePath;
    }

    // Update the category
    $category->update([
        'CategoryName' => $request->input('CategoryName'),
        'Description' => $request->input('Description'),
        'ImageURL' => $category->ImageURL,
    ]);

    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Delete the old image if exists
            if ($category->ImageURL) {
                Storage::delete('public/' . $category->ImageURL);
            }
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Error deleting image: ' . $e->getMessage());
    
            // Optionally, you can set a session message to inform the user about the issue
            return redirect()->route('categories.index')->with('error', 'Failed to delete the category image. Please try again.');
        }
    
        // Delete the category
        $category->delete();
    
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
    

}
