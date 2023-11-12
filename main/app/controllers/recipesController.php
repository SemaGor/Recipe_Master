<?php

namespace App\Controllers\RecipesController;

use App\Models\RecipesModel;
use App\Models\CommentsModel;
use App\Models\IngredientsModel;

function indexAction(\PDO $connexion)
{
    include_once '../app/models/recipesModel.php';
    $recipes = recipesModel\findAllRecipes($connexion);

    global $title, $content;
    $title = "Recipes";
    ob_start();
    include '../app/views/recipes/index.php';
    $content = ob_get_clean();

}

function showAction(\PDO $connexion, int $id)
{
    include_once '../app/models/recipesModel.php';
    $recipe = RecipesModel\findOneById($connexion, $id);

    include_once'../app/models/commentsModel.php';
    $comments = commentsModel\findAllCommentsByDishId($connexion, $id);

    include_once '../app/models/ingredientsModel.php';
    $ingredients = ingredientsModel\findAllIngredientsByDishId($connexion, $id);

    global $title, $content;
    $title = $recipe['dish_name']; //vient de la bdd
    // avec le tampon, on inclut la vue dans le $content
    ob_start();

    include '../app/views/recipes/show.php';
    $content = ob_get_clean();
}