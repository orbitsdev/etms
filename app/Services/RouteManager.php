<?php
namespace App\Services;

use Illuminate\Support\Facades\Session;

class RouteManager
{

    
    public function test(){
        return 'dadsa';
    }
    public function isCurrentPage($route, $routes ,$activeClass, $inActiveClass )
    {
        return in_array($route,$routes) ? $activeClass : $inActiveClass;
    }

    public function route($route) : String
    {
        Session::put('route', $route);
        return $route;
    }

}
