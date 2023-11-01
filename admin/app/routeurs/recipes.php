<?php

use \app\controllers\recipesController;
use \app\controllers\UsersController;
use \app\controllers\CategoriesController;
use \app\controllers\IngredientsController;


include_once '../app/controllers/recipesController.php';


switch ($_GET['recipes']):

    case 'index':
        recipesController\indexAction($connexion);
        break;

    case 'addForm':
        recipesController\addFormAction($connexion);
        break;
    
    case 'add':
        recipesController\addAction($connexion, $_POST);
        break;

    case 'delete':
        recipesController\deleteAction($connexion, $_GET['id']);
        break;
    
    case 'editForm':
        recipesController\editFormAction($connexion, $_GET['id']);
        break;

    case 'edit':
        recipesController\editAction($connexion, [
            'dish_id' => $_POST['dish_id'],
            'dish_description' => $_POST['dish_description'],
            'dish_prep_time' => $_POST['dish_prep_time'],
            'portions' => $_POST['dish_portions'],
            'user_id' => $_POST['user_id'],
            'type_id' => $_POST['type_id']
        ]);
        break;
endswitch;

