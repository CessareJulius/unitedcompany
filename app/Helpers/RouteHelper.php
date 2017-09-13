<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class RouteHelper
{
    public static function NamedResourceRoute($route, $controller, $named, $except = array())
    {
        $routes = RouteHelper::GetDefaultResourceRoutes($route);
        foreach($routes as $method => $options) {
            RouteHelper::GetRoute($route, $controller, $method, $options['type'], $options['name'], $named);
        }
    }

    public static function GetRoute($route, $controller, $method, $type, $name, $named) {
        App::make('router')->$type($named.'/'.$name, ['as' => $route.'.'.$method, 'uses' => $controller.'@'.$method]);
    }
    public static function GetDefaultResourceRoutes($route) {
       return [
        'store' => [
            'type' => 'post',
            'name' => ''
        ],
        'index' => [
            'type' => 'get',
            'name' => ''
        ],
        'create' => [
            'type' => 'get',
            'name' => trans('routes.create')
        ],
        'update' => [
            'type' => 'put',
            'name' => '{'.$route.'}'
        ],
        'show' => [
            'type' => 'get',
            'name' => '{'.$route.'}'
        ],
        'destroy' => [
            'type' => 'delete',
            'name' => '{'.$route.'}'
        ],
        'edit' => [
            'type' => 'get',
            'name' => '{'.$route.'}/'.trans('routes.edit')
        ]
    ];
}
}