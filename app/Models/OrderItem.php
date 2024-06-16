<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class OrderItem extends Model
{
    use AsSource, Chartable, Filterable, HasFactory;

    protected $table = 'order_items';


    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
