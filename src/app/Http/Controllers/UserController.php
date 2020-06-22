<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Traits\AccessPermission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->class = User::class;
        $this->hash = Hash::class;
    }

    // public function store(Request $request, $rules = [])
    // {        
    //     if ($rules) {
    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json(["errors" => $validator->errors()]);
    //         }
    //     }

    //     if (isset($request['password'])) {
    //         $request['password'] = $this->hash::make($request['password']);
    //     }

    //     return $this->class::create($request->all());
    // }
}
