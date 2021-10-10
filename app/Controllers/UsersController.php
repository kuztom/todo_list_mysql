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

    public function account()
    {
        $this->usersRepository->find();
        require_once 'app/Views/Users/account.template.php';
    }

    public function register()
    {
        require_once 'app/Views/Users/register.template.php';
    }

    public function login()
    {
        require_once 'app/Views/Users/login.template.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        require_once 'app/Views/Users/login.template.php';
    }

    public function save()
    {
        if ($_POST['pwd1'] !== $_POST['pwd2']) {
            header('Location: /error');
        } else {

            $user = new User(Uuid::uuid1(), $_POST['username'], $_POST['email'], $_POST['pwd1']);

            $this->usersRepository->add($user);

            header('Location: /login');
        }
    }

    public function error()
    {
        require_once 'app/Views/Users/error.template.php';
    }
}