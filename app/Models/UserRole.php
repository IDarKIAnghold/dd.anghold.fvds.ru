<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;
class UserRole extends Model
{
    use AsSource, Chartable, Filterable, HasFactory;

        /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_users';

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role_id'
    ];
}
