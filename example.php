<?php
spl_autoload_register(function($name){
    $path = str_replace('\\', '/', $name) . '.php';
    if(file_exists($path)){
        include_once($path);
    }
});
//example use

Router::get('/',[Controller::class,'index']);
Router::get('/s/{id:\d+}',function ($id){
    echo $id;
});
Router::post('/s/{id:\d+}',function ($id){
    echo $id;
});
Router::get('/user','user.php');