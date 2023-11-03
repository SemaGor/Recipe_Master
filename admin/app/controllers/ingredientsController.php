<?php

namespace App\Controllers\IngredientsController;

use App\Models\ingredientsModel;

/**
 * Summary of App\Controllers\IngrediensController\indexAction
 * @param \PDO $connexion
 * @return void
 */
function indexAction(\PDO $connexion)
{
    include_once '../app/models/ingredientsModel.php';
    $allIngredients = IngredientsModel\findAllIngredients($connexion);

    global $title, $content;

    $title = "Ingrédients";
    ob_start();
        include '../app/views/ingredients/index.php';
    $content = ob_get_clean();

}
