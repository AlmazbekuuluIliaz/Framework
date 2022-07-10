<?php
include __DIR__.'/../header.php';
?>
            <h2>
                <?= $article->getName();?>
            </h2>
            <p>
                <?= $article->getText();?>
            </p>
            <hr>
<?php
include __DIR__.'/../footer.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Sorter</title>
</head>
<body>
    <div class="col-12 d-flex flex-column align-items-center m-3">
        <h1 class="text-center">Добавить комментарий</h1>
        <form action="admessage.php" class="d-flex flex-column nx-2 flex-5 col-4" name="SMS-form" method="post">
            <div class="mb-3">
                <label class="nx-2" for="canal" class="form-label">Автор</label>
                <input name="name" type="text" class="form-control n-2" id="canal" placeholder="Введите свой никнейм" required>
            </div>
            <div class="mb-3">
                <label class="nx-2" for="channel" class="form-label">Дата</label>
                <input name="data" type="text" class="form-control n-2" id="channel" placeholder="00/00/00" required>
            </div>
            <div class="mb-3">
                <label class="nx-2" for="text" class="form-label">Сообщение</label>
                <input name="content" type="text" class="form-control n-2 rows="3"" id="text" placeholder="Введите сообщение" required>
            </div>
            <div class="d-grid gap-2 col-12 mx-auto">
                <button class="btn btn-dark" type="submit">Отправить</button>
                <a class="btn btn-danger" href="comment.php" role="button">Посмотри свой коммент</a>
            </div>
        </form>
    </div>
</body>
