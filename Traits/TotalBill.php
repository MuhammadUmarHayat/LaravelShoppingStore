<?php

namespace App\Traits;

trait TotalBill
{
    public function calculateBill($email) 
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;
        $filteredCart = [];
    
        if (isset($cart[$email])) {
            foreach ($cart[$email] as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
                $filteredCart[] = $item;
            }
        }
    
        return ['totalPrice' => $totalPrice, 'cartItems' => $filteredCart];
    }
}
