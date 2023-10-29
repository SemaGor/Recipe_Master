<?php

namespace App\Controllers\UsersController;

use App\Models\UsersModel;

function dashboardAction(\PDO $connexion)
{
    // je charge la vue dashBoard dans $content
    global $title, $content;
    $title = "TITRE_USERS_DASHBOARD";
    ob_start();
    include '../app/views/users/dashboard.php';
    $content = ob_get_clean();
}

function logoutAction()
{
    // Je tue la variable de session user

    unset($_SESSION['user']);

    // Je redirige vers le site public

    header('Location: ' . PUBLIC_ROOT);

}

function indexAction(\PDO $connexion)
{
    // Je demande la liste des users au modèle
    include_once '../app/models/usersModel.php';
    $allUsers = usersModel\findAllUsers($connexion);

    // Je charge la vue index dans $content
    global $title, $content;
    $title = "TITRE_USERS_INDEX";
    ob_start();
    include '../app/views/users/index.php';
    $content = ob_get_clean();

}

function addFormAction()
{
    global $title, $content;
    $title = "TITRE_USERS_ADDFORM";
    ob_start();
    include '../app/views/users/addForm.php';
    $content = ob_get_clean();

}

function addAction(\PDO $connexion, array $data = null)
{
    // Je demande au modèle d'ajouter l'utilisateur
    include_once '../app/models/usersModel.php';
    $id = UsersModel\insert($connexion, $data);

    // Je redirige vers la liste des utilisateurs
    header('location: ' . ADMIN_ROOT . '/users');
}

function deleteAction(\PDO $connexion, int $id)
{
    // Je demande au modèle de supprimer l'utilisateur
    include_once '../app/models/usersModel.php';
    
        $return = UsersModel\delete($connexion, $id);
        
    // Je redirige vers la liste des utilisateurs
    header('location: ' . ADMIN_ROOT . '/users');
}

function editFormAction(\PDO $connexion, int $id)
{
    // Je demande au modèle de modifier l'utilisateur
    include_once '../app/models/usersModel.php';
    $user = UsersModel\findOneById($connexion, $id);
        
    // Je charge la vue editForm dans $content
    global $title, $content;
    $title = "TITRE_USERS_EDITFORM";
    ob_start();
        include '../app/views/users/editForm.php';
    $content = ob_get_clean();
}

function editAction(\PDO $connexion, array $data = null)
{
    // Je demande au modèle de mettre à jour l'utilisateur
    include_once '../app/models/usersModel.php';
    $return = UsersModel\update($connexion, $data);
        
    //Je redirige vers la liste des utilisateurs
    
    header('location: ' . ADMIN_ROOT . '/users');

}