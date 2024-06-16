<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
use Orchid\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class Orders extends Model
{
    use AsSource, Chartable, Filterable, HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id',
        'user_id',
        'full_name',
        'phone_number',
        'address',
        'Status',
    ];

    public function item()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
