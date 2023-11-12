<?php

namespace App\Controllers\UsersController;

use App\Models\UsersModel;

function indexAction(\PDO $connexion)
{
    include_once '../app/models/usersModel.php';
    $allUsers = usersModel\findAllUsers($connexion);

    global $title, $content;
    $title = "Users";
    ob_start();
    include '../app/views/users/index.php';
    $content = ob_get_clean();
}


function showAction(\PDO $connexion, int $id)
{
    include_once '../app/models/usersModel.php';
    $user = UsersModel\findOneById($connexion, $id);

    global $title, $content;
    $title = $user['user_name']; //vient de la bdd
    // avec le tampon, on inclut la vue dans le $content
    ob_start();
    include '../app/views/users/show.php';
    $content = ob_get_clean();
}

function loginFormAction(\PDO $connexion)
{
    // je charge la vue loginForm dans $content
    include_once '../app/models/usersModel.php';
    global $title, $content;
    $title = TITRE_USERS_LOGINFORM;
    ob_start();
    include '../app/views/users/loginForm.php';
    $content = ob_get_clean();
}

function loginAction(\PDO $connexion, $data)
{
    // je demande le user qui correspond au name/password
    include_once '../app/models/usersModel.php';
    $user = UsersModel\findOneByLoginPwd($connexion, $data);
  
    if ($user && password_verify($data['password'], $user['password'])):
        // je redirige vers le backoffice, en lui créant une variable de session si c'est ok
        $_SESSION['user'] = $user;
        header('location: ' . ADMIN_ROOT);
        // je redirige vers le loginForm si pas ok
    else:
        header('location:' . PUBLIC_ROOT . 'users/login/form');
    endif;
}