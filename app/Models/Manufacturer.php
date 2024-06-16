<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class Manufacturer extends Model
{
    use AsSource, Chartable, Filterable, HasFactory;

    /**
     * @var string
     */
    protected $table = 'manufacturers';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'updated_at',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id' => Where::class,
        'name' => Like::class,
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'updated_at',
        'created_at',
    ];

    public function products()
    {
        return $this->hasMany(Products::class);
    }

}
