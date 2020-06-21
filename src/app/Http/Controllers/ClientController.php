<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends BaseController
{
    public function __construct()
    {
        $this->class = Client::class;
        $this->hash = Hash::class;
    }

    public function index() 
    {
        return $this->class::with('user')->get();
    }

    public function show(int $id)
    {
        $resource = $this->class::with('user')->find($id);
        if (is_null($resource)) {
            return response()->json('No Data', 204);
        }
        return response()->json($resource);
    }
}
