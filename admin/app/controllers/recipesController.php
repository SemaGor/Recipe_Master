<?php

namespace App\Controllers\RecipesController;

use App\Models\RecipesModel;
use App\Models\UsersModel;
use App\Models\CategoriesModel;
use App\Models\IngredientsModel;


function indexAction(\PDO $connexion)
{
    // Je demande la liste des recettes au modèle

    include_once '../app/models/recipesModel.php';
    $allRecipes = recipesModel\findAllRecipes($connexion);

    // Je charge la vue index dans $content

    global $title, $content;
    $title = "TITRE_RECIPES_INDEX";
    ob_start();
    include '../app/views/recipes/index.php';
    $content = ob_get_clean();

}


function addFormAction(\PDO $connexion)
{
    // je recherche les chefs
    include_once '../app/models/usersModel.php';
    $allUsers = UsersModel\findAllUsers($connexion);

    // je recherche les categories
    include_once '../app/models/categoriesModel.php';
    $allCategories = CategoriesModel\findAllCategories($connexion);

    // je recherche les ingrédients
    include_once '../app/models/ingredientsModel.php';
    $allIngredients = IngredientsModel\findAllIngredients($connexion);

    // Je charge la vue recipes/addForm dans $content
    global $title, $content;

    $title = "TITRE_RECIPES_ADDFORM";
    ob_start();
    include '../app/views/recipes/addForm.php';
    $content = ob_get_clean();
}


function addAction(\PDO $connexion)
{
    //je demande au modèle d'ajouter la recette
    include_once '../app/models/recipesModel.php';
    $id = RecipesModel\insert($connexion, $_POST);

    // je demande au modèle d'ajouter les ingredients correspondants
    foreach ($_POST['ingredients'] as $ingredient_id) {
        $quantity = $_POST['quantity'][$ingredient_id];
        $return = RecipesModel\insertIngredientById($connexion, [
            'dish_id' => $id,
            'ingredient_id' => $ingredient_id,
            'quantity' => $quantity
        ]);
    }

    // Je redirige vers la liste des recettes
    header('location: ' . ADMIN_ROOT . '/recipes');
}
function deleteAction(\PDO $connexion, int $id)
{

    // Je demande au modèle de supprimer la recette
    include_once '../app/models/recipesModel.php';

    $return = RecipesModel\delete($connexion, $id);

    // Je redirige vers la liste des recettes
    header('location: ' . ADMIN_ROOT . '/recipes');
}

function editFormAction(\PDO $connexion, int $id)
{
    // Je demande au modèle la recette à afficher dans le formulaire
    include_once '../app/models/recipesModel.php';
    $recipe = RecipesModel\findOneById($connexion, $id);

    // Je cherche le chef de la recette
    include_once '../app/models/usersModel.php';
    $users = \App\Models\UsersModel\findAllUsers($connexion);

    // Je cherche la catégorie de la recette
    include_once '../app/models/categoriesModel.php';
    $categories = \App\Models\CategoriesModel\findAllCategories($connexion);

    // je cherche les ingrédients associés à cette recette
    include_once '../app/models/ingredientsModel.php';
    $ingredients = \App\Models\IngredientsModel\findAllIngredients($connexion);

    // Je charge la vue editForm dans $content
    global $title, $content;
    $title = "TITRE_RECIPES_EDITFORM";
    ob_start();
    include '../app/views/recipes/editForm.php';
    $content = ob_get_clean();
}

function editAction(\PDO $connexion,int $id)
{
    // je demande au modèle de supprimer toutes les ingredients correspondents
    include_once '../app/models/recipesModel.php';
    $return1 = RecipesModel\deleteDishHasIngredientsById($connexion, $id);
    

    //je demande au modèle de modifier le dish
    $return2 = RecipesModel\updateOneById($connexion, $id, $_POST);

    //je demande au modèle d'ajouter les ingredients correspondents 
    foreach ($_POST['ingredients'] as $ingredient_id) {
        $return = RecipesModel\insertIngredientById($connexion, [
            'dish_id' => $id,
            'ingredient_id' => $ingredient_id,
            'quantity' => $_POST['quantity'.$ingredient_id]
        ]);
    }
 
    //rediriger vers la liste des categories
    header('location: ' . ADMIN_ROOT . '/recipes');
}
