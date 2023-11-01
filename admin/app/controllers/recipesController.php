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
    $allUsers = \App\Models\UsersModel\findAllUsers($connexion);

    // je recherche les categories
    include_once '../app/models/categoriesModel.php';
    $allCategories = \App\Models\CategoriesModel\findAllCategories($connexion);
    
    // je recherche les ingrédients
    include_once '../app/models/ingredientsModel.php';
    $allIngredients = \App\Models\IngredientsModel\findAllIngredients($connexion);

    // Je charge la vue recipes/addForm dans $content
    global $title, $content;
    $title = "TITRE_RECIPES_ADDFORM";
    ob_start();
        include '../app/views/recipes/addForm.php';
    $content = ob_get_clean();
}


function addAction(\PDO $connexion,  array $data = null)
{
    // Je demande au modèle d'ajouter la recette
    include_once '../app/models/recipesModel.php';
    
    $id = RecipesModel\insert($connexion, $data);

    // Si des ingrédients ont été cochés
    if (isset($data['ingredients']) && is_array($data['ingredients'])) {
        foreach ($data['ingredients'] as $ingredientId) {
            $quantity = $data['quantity-' . $ingredientId];
            RecipesModel\insertDishIngredients($connexion, $id, $ingredientId, $quantity);
        }
    }

    // Je redirige vers la liste des recettes
    header('location: ' . ADMIN_ROOT . '/recipes');
}

function deleteAction(\PDO $connexion, int $id)
{

    // Je demande au modèle de supprimer la recette
    include_once '../app/models/recipesModel.php';
    
        $return = RecipesModel\delete($connexion,$id);
        
    // Je redirige vers la liste des recettes
    header('location: ' . ADMIN_ROOT . '/recipes');
}

function editFormAction(\PDO $connexion, int $id)
{
    // demande au modèle la recette à afficher dans le formulaire
    include_once '../app/models/recipesModel.php';
    $recipe = RecipesModel\findOneById($connexion, $id);

    // cherche le chef de la recette
    include_once '../app/models/usersModel.php';
    $users = \App\Models\UsersModel\findAllUsers($connexion);

    // chercher les catégories
    include_once '../app/models/categoriesModel.php';
    $categories = \App\Models\CategoriesModel\findAllCategories($connexion);

    // chercher les ingrédients associés à cette recette
    include_once '../app/models/ingredientsModel.php';
    $ingredients = \App\Models\IngredientsModel\findAllIngredients($connexion, $id);

    // Je charge la vue editForm dans $content
    global $title, $content;
    $title = "TITRE_RECIPES_EDITFORM";
    ob_start();
    include '../app/views/recipes/editForm.php';
    $content = ob_get_clean();
}

function editAction(\PDO $connexion, array $data = null)
{
   include_once '../app/models/recipesModel.php';
   include_once '../app/models/usersModel.php';
   include_once '../app/models/categoriesModel.php';
   include_once '../app/models/ingredientsModel.php';

   $data = [
    'user_id' => $_POST['user_id'],
    'dish_id' => $_POST['dish_id'],
    'dish_name' => $_POST['dish_name'],
    'dish_description' => $_POST['dish_description'],
    'dish_prep_time' => $_POST['dish_prep_time'],
    'portions' => $_POST['dish_portions'],
    'type_id' => $_POST['type_id']
    ];

   
   // Je demande au modèle de mettre à jour la recette
   $return = RecipesModel\update($connexion, $data);

       // La mise à jour a réussi, vous pouvez rediriger ou effectuer d'autres actions.
       header('location: ' . ADMIN_ROOT . '/recipes');
}
