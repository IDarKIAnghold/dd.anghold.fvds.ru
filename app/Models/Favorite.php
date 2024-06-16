<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class Favorite extends Model
{
    use AsSource, Chartable, Filterable, HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}