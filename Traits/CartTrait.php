<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;

trait CartTrait
{
    use TotalBill;

    public function showCartitems()
    {
        $email = Auth::user()->email;
        $total = $this->calculateBill($email);

        session()->put('total', $total);
    }

    public function addToCartitem($id)
    {
        $email = Auth::user()->email;
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        $productData = [
            'id' => $id,
            'email' => $email,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->Price,
            'ImageURL' => $product->ImageURL,
        ];

        $cart[$email][$id] = $productData;

        session()->put('cart', $cart);
    }
    public function updateCartitem(Request $request, $id)
    {
        $email = Auth::user()->email;
        $cart = session()->get('cart', []);

        if (isset($cart[$email]) && isset($cart[$email][$id])) {
            $cart[$email][$id]['quantity'] = $request->input('quantity');
            session()->put('cart', $cart);
            return true;
        }

        return false;
    }
    public function deleteCartitem($id)
    {
        $email = Auth::user()->email;
        $cart = session()->get('cart', []);

        if (isset($cart[$email]) && isset($cart[$email][$id])) {
            unset($cart[$email][$id]);
            if (empty($cart[$email])) {
                unset($cart[$email]);
            }
            session()->put('cart', $cart);
            return true;
        }

        return false;
    }


}
?>
