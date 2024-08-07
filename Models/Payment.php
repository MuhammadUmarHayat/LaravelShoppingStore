<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'OrderID',
        'PaymentDate',
        'PaymentAmount',
        'PaymentMethod',
        'PaymentStatus',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID');
    }
}
