<?php
    //require '../src/MyProject/Models/Articles/Users/User.php';
    //require '../src/MyProject/Models/Articles/Article.php';
    spl_autoload_register(function (string $className){
        //echo $className.'<br>';
        require_once '../src/'.str_replace('\\', '/', $className).'.php';
    });

    @$route=$_GET['route'];
    $routes=require 'routes.php';

    $isRouteFound=false;
    foreach($routes as $pattern => $controllerAndAction){
        preg_match($pattern, $route, $matches);
        if(!empty($matches)){
            $isRouteFound=true;
            break;
        }
    }

    if(!$isRouteFound){
        echo 'Страница не найдена!';
        return;
    }

    unset($matches[0]);
    $controllerName=$controllerAndAction[0];
    $actionName=$controllerAndAction[1];
    $controller=new $controllerName();
    $controller->$actionName(...$matches);
    //$pattern='~^hello/(.*)$~';
    //preg_match($pattern, $route, $matches);
    //var_dump($matches);

    //if(!empty($matches)){
        //$controller=new MyProject\Controllers\MainController();
        //$controller->sayHello($matches[1]);
        //return;
    //}
    //$controller=new MyProject\Controllers\MainController();
    //if(!empty($_GET['name'])) $controller->sayHello($_GET['name']);
    //else $controller->main();
    
    //$user=new MyProject\Models\Articles\Users\User('Sasha');
    //$article=new Myproject\Models\Articles\Article('Заголовок 1', 'Текст 1', $user);
    //var_dump($article);