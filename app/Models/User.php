<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Order;
use App\Models\Unit;
use App\Models\Cfo;

use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The username of user
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * The user's orders
     *
     * @return array
     */
    public function getUserOrders() {
        $records = Order::select('order.order_name', 'status.status_name', 'order.updated_at')
            ->orderBy('order.id', 'desc')
            ->where([
                ['order.user_id', $this->id],
                ['order.isActual', 1]
            ])
            ->leftJoin('status', 'status.id', '=', 'order.status_id')
            ->get();
        return $records;
    }
}

