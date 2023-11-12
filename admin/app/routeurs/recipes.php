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

    // case 'edit':
    //     // Vérifier si la clé "id" existe dans $_GET
    //     if (isset($_GET['id'])) {
    //         // Si elle existe, appeler la fonction editAction avec l'id
    //         recipesController\editAction($connexion, $_GET['id']);
    //     } else {
    //         // Si elle n'existe pas, gérer l'erreur ou rediriger l'utilisateur, selon votre logique
    //         // Par exemple :
    //         echo "L'identifiant 'id' n'a pas été spécifié.";
    //     }
    //     break;


    case 'index':
        recipesController\indexAction($connexion);
        break;

endswitch;

