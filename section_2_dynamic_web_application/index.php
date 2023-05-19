<?php
    require 'functions.php';
    // require 'router.php';
    require 'Database.php';       


    $config = require 'config.php';

    $db = new Database($config['database']);
    $posts = $db->query('select * from posts')->fetchAll(PDO::FETCH_ASSOC);

    foreach($posts as $post){
        echo '<li>'.$post['name'].'</li>';
    }