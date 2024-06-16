<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class Products extends Model
{
    use AsSource, Chartable, Filterable, HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'manufacturer_id',
        'type_id',
        'name',
        'slug',
        'content',
        'description',
        'price',
        'discount',
        'count',
        'img',
        'updated_at',
        'created_at',
    ];

    protected $allowedFilters = [
        'id' => Where::class,
        'manufacturer_id' => Where::class,
        'type_id' => Where::class,
        'slug' => Like::class,
        'name' => Like::class,
        'content' => Like::class,
        'description' => Like::class,
        'discount' => Like::class,
        'count' => Like::class,
    ];

    protected $allowedSorts = [
        'id',
        'name',
        'slug',
        'content',
        'description',
        'price',
        'discount',
        'count',
        'img',
        'manufacturer_id',
        'type_id',
        'updated_at',
        'created_at',
    ];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }
    public function ProductAttributes()
    {
        return $this->hasMany(ProductAttributes::class, 'product_id');
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'product_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }
    public function favorite()
    {
        return $this->hasMany(Favorite::class, 'product_id');
    }
}
