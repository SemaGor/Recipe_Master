<?php

namespace App\Controllers\CategoriesController;

use App\Models\CategoriesModel;

/**
 * Summary of App\Controllers\CategoriesController\indexAction
 * @param \PDO $connexion
 * @return void
 */
function indexAction(\PDO $connexion)
{
    include_once '../app/models/categoriesModel.php';
    $allCategories = CategoriesModel\findAllCategories($connexion);

    global $title, $content;
    $title = "Categories";
    ob_start();
    include '../app/views/categories/index.php';
    $content = ob_get_clean();

}

function showAction(\PDO $connexion, int $id)
{
    include_once '../app/models/categoriesModel.php';
    $categorie = CategoriesModel\findOneById($connexion, $id);

    global $title, $content;
    $title = $categorie['name']; //vient de la bdd
    // avec le tampon, on inclut la vue dans le $content
    ob_start();
    include '../app/views/categories/show.php';
    $content = ob_get_clean();
}