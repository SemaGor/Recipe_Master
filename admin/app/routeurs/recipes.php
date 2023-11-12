<?php

use \app\controllers\recipesController;

include_once '../app/controllers/recipesController.php';


switch ($_GET['recipes']):

    case 'addForm':
        recipesController\addFormAction($connexion);
        break;

    case 'add':
        recipesController\addAction($connexion);
        break;

    case 'delete':
        recipesController\deleteAction($connexion, $_GET['id']);
        break;

    case 'editForm':
        recipesController\editFormAction($connexion, $_GET['id']);
        break;

    case 'edit':
        recipesController\editAction($connexion, $_GET['id']);
        break;

    case 'index':
        recipesController\indexAction($connexion);
        break;

endswitch;

