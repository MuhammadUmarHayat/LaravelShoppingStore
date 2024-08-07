<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Traits\CartTrait;

class CustomerController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('customer.dashboard', ['success' => 'Logged in successfully', 'products' => $products, 'categories' => $categories]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Product::where('ProductName', 'LIKE', "%{$searchTerm}%")->get();
        $categories = Category::all();
        return view('customer.dashboard', ['products' => $products, 'categories' => $categories]);
    }

    public function show($id)
    {
       // dd($id);
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
 

   
    use CartTrait;

    public function addToCart($id)
    {
        $this->addToCartitem($id);
        return redirect()->route('cart.show')->with('success', 'Product added to cart successfully!');
    }


    public function showCart()
    {
        $this->showCartitems();

        $cart = session()->get('cart', []);
        $total = session()->get('total', 0);

        return view('customer.cart', compact('cart', 'total'));
    }


public function updateCart(Request $request, $id)
    {
        $result = $this->updateCartitem($request, $id);
        if ($result) {
            return redirect()->route('cart.show')->with('success', 'Cart updated successfully!');
        }

        return redirect()->route('cart.show')->with('error', 'Product not found in cart!');
    }

    public function deleteCart($id)
    {
        $result = $this->deleteCartitem($id);
        if ($result) {
            return redirect()->route('cart.show')->with('success', 'Product removed from cart successfully!');
        }

        return redirect()->route('cart.show')->with('error', 'Product not found in cart!');
    }


}
?>
