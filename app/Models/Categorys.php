<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'name_ru'
    ];
    protected $allowedFilters = [
        'id' => Where::class,
        'name' => Where::class,
        'name_ru' => Like::class,
    ];

    public function ProductType()
    {
        return $this->hasMany(ProductType::class, 'category_id');
    }
    public function attributes()
    {
        return $this->hasMany(Attributes::class, 'category_id');
    }
}
