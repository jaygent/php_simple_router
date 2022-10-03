# PHP SIMPLE ROUTER

# Installation

Just download green_api.php or use Composer:
```
git clone https://github.com/jaygent/php_simple_router
```

# Exmaple 
Simple examples Static route to get started fast
```
Router::get('/',[Controller::class,'index']);
Router::get('/login',function (){
    echo 'page login';
});
Router::get('/user','user.php');
```
Simple examples dynamic route to get started fast
```
Router::get('/',[Controller::class,'index']);
Router::post('/post/{id:\d+}',function ($id){
    echo "post id-$id";
});
Router::post('/tag/{tag:\w+}',[TagController::class,'index']);
```
TagController must accept $request and $params in __construct().

$request array with $_GET,$_POST holobal variables

[Controller::class,'index'] array that takes the class and method name

# Support
Use **Issues** to contact me