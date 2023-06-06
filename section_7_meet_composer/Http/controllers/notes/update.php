<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

//Identifing a note
$note = $db->query(
    'select * from notes where id = :id',
    [
        'id' => $_POST['id']
    ]
)->findOrFail();

//Authorizing user
authorize($note['user_id'] === $currentUserId);

//Validating the form
$errors = [];
if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required';
}

//if no validation errors, update the record
if (count($errors)) {
    return view('notes/edit.view.php', [
        'errors' => $errors,
        'note' => $note,
        'heading' => 'Edit Note'
    ]);
}

$db->query('update notes set body = :body where id = :id', [
    'body' => $_POST['body'],
    'id' => $_POST['id']
]);

//redirect to notes list
header('location: /notes');
die();
