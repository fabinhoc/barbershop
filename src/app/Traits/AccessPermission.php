<?php

namespace App\Traits;
use App\Http\Controllers\AuthController;
use Illuminate\Database\Eloquent\Builder;

trait AccessPermission {

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('permission', function (Builder $builder) {
            $loggedUser = json_decode((new AuthController)->me()->content());
            if ($loggedUser->accessType == "employee") {
                $builder->where('user_id', $loggedUser->id);
            }
        });
    }
}