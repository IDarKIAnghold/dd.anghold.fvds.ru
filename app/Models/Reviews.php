<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class Reviews extends Model
{
    use AsSource, Chartable, Filterable, HasFactory;

    protected $table = 'reviews';
    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'grade',
        'plus',
        'minus',
        'comment',
    ];
    public function Product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
