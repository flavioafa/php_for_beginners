<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$form = new LoginForm();

$email = $_POST['email'];
$password = $_POST['password'];

if (! $form->validate($email, $password)) {
    return view('session/create.view.php', [
        'errors' => $form->errors()
    ]);
}

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {

        login($user);

        header('location: /');
        exit();
    }
}

return view('session/create.view.php', [
    'errors' => [
        'email' => 'No matching account found for that email address and password.'
    ]
]);
