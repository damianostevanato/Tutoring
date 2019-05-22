<?php


class Routes
{
    public static function route(){
        if(isset($_GET['controller'])&& $_GET['action']){
            $controller = $_GET['controller'];
            $action =$_GET['action'];

        }else{
            $controller = "HomepageController";
            $action = "make";
        }
        require_once './controller/'.$controller.'.php';
        $controller = new $controller();
        $controller -> $action();
    }
}