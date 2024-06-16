<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class ProductType extends Model
{
    use AsSource, Chartable, Filterable, HasFactory;

    protected $table = 'product_types';

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'name__ru',
    ];
    protected $allowedFilters = [
        'id' => Where::class,
        'category_id' => Where::class,
        'name' => Like::class,
        'name__ru' => Like::class,
    ];

    protected $allowedSorts = [
        'id',
        'category_id',
        'name',
        'name__ru',
        'updated_at',
        'created_at',
    ];

    public function category()
    {
        return $this->belongsTo(Categorys::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }

}
