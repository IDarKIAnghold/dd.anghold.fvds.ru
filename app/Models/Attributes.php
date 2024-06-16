<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;

    protected $table = 'attributes';


    protected $fillable = [
        'id',
        'category_id',
        'name',
        'name__eng',
        'created_at',
        'updated_at',
    ];
    public function attributes()
    {
        return $this->hasMany(ProductAttributes::class, 'attributes_id');
    }
}
