<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppointmentController extends BaseController
{
    public function __construct()
    {
        $this->class = Appointment::class;
        $this->hash = Hash::class;
    }

    public function index() 
    {
        return $this->class::with('user')->with('client')->get();
    }

    public function show(int $id)
    {
        $resource = $this->class::with('user')->with('client')->find($id);
        if (is_null($resource)) {
            return response()->json('No Data', 204);
        }
        return response()->json($resource);
    }
}
