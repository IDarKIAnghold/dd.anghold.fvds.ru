<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
use Orchid\Filters\Filterable;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

use App\Models\Products;

class CartItem extends Model
{   

    use AsSource, Chartable, Filterable, HasFactory;

    protected $table = 'cart_items';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
