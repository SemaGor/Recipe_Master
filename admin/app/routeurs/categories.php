<?php

use \app\controllers\categoriesController;

include_once '../app/controllers/categoriesController.php';

switch ($_GET['categories']):

    case 'index':
        CategoriesController\indexAction($connexion);
        break;

    case 'addForm':
        CategoriesController\addFormAction($connexion);
        break;

    case 'add':
        CategoriesController\addAction($connexion, $_POST);
        break;
    
    case 'editForm':
        CategoriesController\editFormAction($connexion, $_GET['id']);
        break;

    case 'edit':
        CategoriesController\editAction($connexion, (int)$_POST['category_id'], [
            'name' => $_POST['category_name'],
            'description' => $_POST['category_description']
    ]);


        break;

    case 'delete':
        CategoriesController\deleteAction($connexion, $_GET['id']);
        break;
    
        // Note POur la révison: faut-il mettre l'index en défault?
endswitch;