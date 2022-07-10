<?php
    return [
        '~^hello/(.*)$~' => [MyProject\Controllers\MainController::class, 'sayHello'],
        '~^bye/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayBay'],
        '~^$~' => [MyProject\Controllers\MainController::class, 'main'],
        '~^article/(\d)$~' =>[MyProject\Controllers\ArticleController::class, 'view'],
        '~^article/(\d)/edit$~' =>[MyProject\Controllers\ArticleController::class, 'edit'],
        '~^article/add$~' =>[MyProject\Controllers\ArticleController::class, 'add'],
        '~^article/(\d)/delete$~' =>[MyProject\Controllers\ArticleController::class, 'delete'],
        '~^articles/(\d+)/comments$~' => [MyProject\Controllers\CommentsController::class, 'add'],
        '~^comments/(\d+)/edit$~' => [MyProject\Controllers\CommentsController::class, 'edit'],
    ]
?>