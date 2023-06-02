<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

//Validate data
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password between 7 and 255 characters';
}

//Return if has validation errors
if (!empty($errors)) {
    return view('registration/create.view.php', ['errors' => $errors]);
}

//Check if email already in database
$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    // User exists, redirect to home page
    header('location: /');
    exit();
} else {
    // User not exists, create them
    $db->query('insert into users (email, password) values (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // Add user to Session
    login($user);

    // Then redirect to home page
    header('location: /');
    exit();
}
