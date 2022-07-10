<?php 
    include __DIR__.'/../header.php';
    echo '<h3>'.$articles->getName().'</h3>';
    echo '<p>' .$articles->getText().'</h4>';
    echo '<p>'.$articles->getAuthor()->getNickName().'</p>';
    include __DIR__.'/../footer.php';
?>