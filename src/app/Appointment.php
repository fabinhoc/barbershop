<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\AccessPermission;

class Appointment extends Authenticatable
{
    use Notifiable;
    use AccessPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serviceName', 
        'user_id', 
        'client_id',
        'dateExecution',
        'initialHour',
        'endHour',
        'isConfirmed'
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
     * Related App\Client::class
     *
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
