<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\AccessPermission;
use Illuminate\Console\Scheduling\Appointment;

class Client extends Authenticatable
{
    use Notifiable;
    use AccessPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'user_id',
        'phone'

    ];

    /**
     * Related App\User::class
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Related App\Appointment::class
     *
     * @return BelongsTo
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'client_id', 'id');
    }
}
