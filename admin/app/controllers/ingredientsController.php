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
    // J'inclus le fichier du modèle gérant les opérations liées aux ingrédients
    include_once '../app/models/ingredientsModel.php';

    // Je récupère tous les ingrédients depuis la base de données en utilisant la fonction du modèle
    $allIngredients = IngredientsModel\findAllIngredients($connexion);

    // Je déclare les variables globales utilisées pour le titre et le contenu de la page
    global $title, $content;

    // Je définis le titre de la page
    $title = "Ingrédients";

    // Je démarre la temporisation de la sortie pour capturer le contenu de la vue
    ob_start();
    // J'inclus le fichier de la vue qui affiche la liste des ingrédients
    include '../app/views/ingredients/index.php';
    // Je récupère le contenu de la vue et je nettoie la temporisation
    $content = ob_get_clean();

}
