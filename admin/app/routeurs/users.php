<?php
use \App\Controllers\UsersController;

include_once '../app/controllers/UsersController.php';

switch ($_GET['users']):

    case 'logout':
        
        UsersController\logoutAction();
        break;

    case 'addForm':
        
        UsersController\addFormAction($connexion);
        break;

    case 'add':
        
        UsersController\addAction($connexion, $_POST);
        break;

    case 'delete':
        
        UsersController\deleteAction($connexion, $_GET['id']);
        break;

    case 'editForm':
        
        UsersController\editFormAction($connexion, $_GET['id']);
        break;
    
    case 'edit':
          
        UsersController\editAction($connexion, [
            'user_id' => $_POST['user_id'],
            'user_name' => $_POST['user_name'],
            'user_email' => $_POST['user_email'],
            'user_password' => $_POST['user_password'],
            'user_biography' => $_POST['user_biography']
        ]);
        break;

    default:

        UsersController\indexAction($connexion);
        break;
endswitch;
