<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'CustomerID',
        'OrderDate',
        'TotalAmount',
        'ShippingAddress',
        'ShippingCity',
        'ShippingState',
        'ShippingZipCode',
        'ShippingCountry',
        'OrderStatus',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'OrderID');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'OrderID');
    }
}
