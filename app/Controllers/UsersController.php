<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\MySqlUsersRepository;
use Ramsey\Uuid\Uuid;

class UsersController
{

    private MySqlUsersRepository $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new MySqlUsersRepository();
    }

    public function login()
    {
        $user = $this->usersRepository->find($_POST['username']);

        if ($user !== null && password_verify($_POST['pwd'], $user->getPassword()))
        {
            $_SESSION['userId'] = $user->getId();
            header('Location: /');

        } else {
            header('Location: /login');
        }
    }

    public function loginForm()
    {
        require_once 'app/Views/Users/login.template.php';
    }

    public function registerForm()
    {
        require_once 'app/Views/Users/register.template.php';
    }

    public function register()
    {
        if ($_POST['pwd1'] !== $_POST['pwd2']) {
            header('Location: /error');
        } else {

            $user = new User(
                Uuid::uuid1(),
                $_POST['username'],
                $_POST['email'],
                password_hash($_POST['pwd1'], PASSWORD_DEFAULT));

            $this->usersRepository->add($user);

            header('Location: /login');
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /login');
    }

    public function error()
    {
        require_once 'app/Views/Users/error.template.php';
    }
}