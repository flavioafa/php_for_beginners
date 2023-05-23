<?php

$config = require 'config.php';
$db = new Database($config['database']);

$heading = 'Create Note';


require "views/note-create.view.php";
