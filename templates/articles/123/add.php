<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'db-blog');
    
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    
if (!$connect) {
    die('Error connect to database!');
}

$name = $_POST['name'];
$content = $_POST['content'];
mysqli_query($connect,"INSERT INTO `message` (`id`, `name`, `content`) VALUES (NULL, '$name', '$content')");

header("Location: Framework/templates/articles/123");
?>
