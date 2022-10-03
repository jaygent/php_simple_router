<?php
class Router{
    /**
     * @param string $route
     * @param mixed $params
     * @return void
     */
    public static function get( string $route, mixed $params):void{
        if( $_SERVER['REQUEST_METHOD'] == 'GET' ){self::run($route,$params);}
    }

    /**
     * @param string $route
     * @param mixed $params
     * @return void
     */
    public static function post( string $route, mixed $params):void{
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){self::run($route,$params);}
    }

    /**
     * @param string $route
     * @param mixed $param
     * @return void
     */
    public static function run(string $route, mixed $param):void{
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $url = $_SERVER['REQUEST_URI'];
        $request=['get'=>$_GET,'post'=>$_POST];
        $params=[];
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int)$match;
                        }
                        $params[$key] = $match;
                    }
                }
                if(is_callable($param)){
                    call_user_func_array($param,$params);
                }elseif(is_array($param)){
                    $class=$param[0];
                    $action=$param[1];
                    if (class_exists($class)) {
                        if (method_exists($class, $action)) {
                            $controller = new $class($params,$request);
                            $controller->$action();
                        }
                    }
                }elseif(is_file("{$_SERVER['DOCUMENT_ROOT']}/$param")){
                    require_once ("{$_SERVER['DOCUMENT_ROOT']}/$param");
                }
            }
    }
}



