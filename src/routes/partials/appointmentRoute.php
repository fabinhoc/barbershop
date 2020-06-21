<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Request;
use App\Http\Controllers\AppointmentController;

// company routes
$router->group(['middleware' => 'jwt-auth'], function () use ($router) {
    $router->get('appointments', 'AppointmentController@index');
    $router->get('appointments/{id}', 'AppointmentController@show');
    $router->post('appointments', function (Request $request) {
        $rules = [
            'serviceName' => 'required',
            'dateExecution' => 'required|date',
            'initialHour' => 'required|time',
            'endHour' => 'required|time',
            'client_id' => 'required|exists:App\Client,id',
            'user_id' => 'required|exists:App\User,id'
        ];
        
        $resource = new AppointmentController();
        return $resource->store($request, $rules);
    });
    $router->put('appointments/{id}', function(Request $request){
        $rules = [
            'dateExecution' => 'date',
            'initialHour' => 'time',
            'endHour' => 'time',
            'client_id' => 'exists:App\Client,id',
            'user_id' => 'exists:App\User,id'
        ];
        
        $resource = new AppointmentController();
        $id = $request->id;
        return $resource->update($id, $request, $rules);
    });
    $router->delete('appointments/{id}', 'AppointmentController@destroy');
});
