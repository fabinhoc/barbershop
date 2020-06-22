<?php

namespace App\Traits;
use App\Http\Controllers\AuthController;
use Illuminate\Database\Eloquent\Builder;

trait AccessPermission {

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('permission', function (Builder $builder) {
            $user = (new AuthController)->me();
            
            if ($user) {
                $loggedUser = json_decode((new AuthController)->me()->content());
                if ($loggedUser && $loggedUser->accessType == "employee") {
                    $builder->where('user_id', $loggedUser->id);
                }
            }
        });
    }
}