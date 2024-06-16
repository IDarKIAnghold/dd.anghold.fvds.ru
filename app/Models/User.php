<?php

declare(strict_types=1);

namespace App\Models;

use App\Orchid\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Orchid\Access\UserAccess;
use Orchid\Access\UserInterface;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;
use Orchid\Support\Facades\Dashboard;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class User extends Authenticatable implements UserInterface
{
    use AsSource, Chartable, Filterable, HasFactory, Notifiable, UserAccess;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'nickname',
        'img',
        'email',
        'password',
        'permissions',
        'email_verification_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verification_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'array',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id' => Where::class,
        'first_name' => Like::class,
        'last_name' => Like::class,
        'nickname' => Like::class,
        'email' => Like::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'first_name',
        'last_name',
        'nickname',
        'email',
        'updated_at',
        'created_at',
    ];

    public function generateEmailVerificationToken()
    {
        $this->email_verification_token = Str::random(60);
        $this->save();

        // Отправка письма
        Mail::to($this->email)->send(new VerifyEmail($this));
    }

    /**
     * Throw an exception if email already exists, create admin user.
     *
     * @throws \Throwable
     */
    public static function createAdmin(string $firstname, string $lastname, string $nickname, string $email, string $password): void
    {
        throw_if(static::where('email', $email)->exists(), 'User exists');

        static::create([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'nickname' => $nickname,
            'email' => $email,
            'password' => Hash::make($password),
            'permissions' => Dashboard::getAllowAllPermission(),
        ]);
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'user_id');
    }

    public function role()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    /**
     * @return UserPresenter
     */
    public function presenter()
    {
        return new UserPresenter($this);
    }
}
