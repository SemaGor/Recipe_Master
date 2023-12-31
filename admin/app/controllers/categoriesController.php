<?php

namespace App\Controllers\CategoriesController;

use App\Models\CategoriesModel;

include_once '../app/models/categoriesModel.php';

/**
 * Summary of App\Controllers\CategoriesController\indexAction
 * @param \PDO $connexion
 * @return void
 */
function indexAction(\PDO $connexion)
{
    // J'inclus le modèle pour récupérer toutes les catégories
    include_once '../app/models/categoriesModel.php';
    $allCategories = CategoriesModel\findAllCategories($connexion);

    global $title, $content;

    $title = "Categories";
    ob_start();
    include '../app/views/categories/index.php';
    $content = ob_get_clean();

}

function addFormAction()
{
    global $title, $content;

    $title = "TITRE_CATEGORIES_ADDFORM";
    ob_start();
    include '../app/views/categories/addForm.php';
    $content = ob_get_clean();

}

function addAction(\PDO $connexion, array $data = null)
{
    // Je demande au modèle d'ajouter la catégorie

    include_once '../app/models/categoriesModel.php';
    $id = CategoriesModel\insert($connexion, $data);

    // Quand c'est fait, je redirige vers la liste des utilisateurs

    header('location: ' . ADMIN_ROOT . '/categories');
}

function editFormAction(\PDO $connexion, int $id)
{
    // Je demande au modèle de modifier la catégorie

    include_once '../app/models/categoriesModel.php';
    $category = CategoriesModel\findOneById($connexion, $id);

    // Je charge la vue editForm dans $content

    global $title, $content;

    $title = "TITRE_CATEGORIES_EDITFORM";
    ob_start();
    include '../app/views/categories/editForm.php';
    $content = ob_get_clean();
}

function editAction(\PDO $connexion, int $category_id, array $data)
{
    include_once '../app/models/categoriesModel.php';

    $return = CategoriesModel\update($connexion, $category_id, $data);

    // Une fois la modification effectuée, je redirige vers la liste des catégories
    header('location: ' . ADMIN_ROOT . '/categories');
}

function deleteAction(\PDO $connexion, int $id)
{
    include_once '../app/models/categoriesModel.php';

    $return = CategoriesModel\delete($connexion, $id);
    
    // Je redirige vers la liste des catégories une fois la suppression effectuée
    header('location: ' . ADMIN_ROOT . '/categories');
}