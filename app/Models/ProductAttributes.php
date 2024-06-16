<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    use HasFactory;

    protected $table = 'product_attributes';


    protected $fillable = [
        'attributes_id',
        'product_id',
        'value',
        'created_at',
        'updated_at',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function attributes()
    {
        return $this->belongsTo(Attributes::class, 'attributes_id');
    }
}
