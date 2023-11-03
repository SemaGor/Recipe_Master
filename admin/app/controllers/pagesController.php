<?php

namespace App\Controllers\PagesController;

use App\Models\RecipesModel;
use App\Models\UsersModel;


/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @return void
 */
function homeAction(\PDO $connexion)
{

    include_once '../app/models/recipesModel.php';
    $randomRecipe = RecipesModel\findRandomRecipe($connexion);
    $popularRecipes = RecipesModel\findAllPopularRecipes($connexion);


    include_once '../app/models/usersModel.php';
    $topUser = UsersModel\findTopUser($connexion);
    $topUserLastRecipes = UsersModel\findLastRecipesByUserId($connexion, $topUser['user_id']);

    global $title, $content;

    $title = "TITRE_ACCUEIL"; //ça ne vient pas de la bdd et ça apparaît dans l'onglet du serveur.

    ob_start();
        include '../app/views/pages/home.php';
    $content = ob_get_clean();
}