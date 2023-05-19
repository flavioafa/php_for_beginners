<?php
    require 'functions.php';
    // require 'router.php';
    require 'Database.php';       


    $config = require 'config.php';

    $db = new Database($config['database']);

    $id = $_GET['id'];

    //Pode usar ? também
    $query = 'select * from posts where id = :id';

    //Se usar o parametro nomeado tem que mandar um array associativo
    $posts = $db->query($query,['id' => $id])->fetch();
    
    dd($posts);