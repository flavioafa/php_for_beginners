<?php

namespace Core;

class Authenticator
{
    public function attempt(string $email, string $password)
    {
        $db = App::resolve(Database::class);
        $user = $db->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                $this->login($user);

                return true;
            }
        }
        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
