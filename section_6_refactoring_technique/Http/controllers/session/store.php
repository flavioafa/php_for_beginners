<?php

use Http\Forms\LoginForm;
use Core\Autenticator;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {    
    if ((new Autenticator())->attempt($email, $password)) {
        redirect('/');
    }    

    $form->error('email', 'No matching account found for that email address and password.');
}

return view('session/create.view.php', [
    'errors' => $form->errors()
]);
