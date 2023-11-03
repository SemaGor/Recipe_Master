<?php

// Paramètres de connexion à la DB
define('DB_HOST', '127.0.0.1:3306');
define('DB_NAME', 'recipe_master');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');

// Initialisation des zones dynamiques
$title = '';
$content = '';

// Fichiers et Dossiers
define('PUBLIC_FOLDER', 'main');
define('ADMIN_FOLDER', 'admin');
define('DISPATCHER_NAME', 'index.php');

// Définissions des titres

define('TITRE_USERS_DASHBOARD', "Dashboard");
define('TITRE_USERS_INDEX', "Liste des utilisateurs");
define('TITRE_USERS_ADDFORM', "Ajout d'utilisateur");
define('TITRE_USERS_EDITFORM', "Modification d'utilisateur");


define('TITRE_RECIPES_INDEX', "Liste des Recettes");
define('TITRE_RECIPES_ADDFORM', "Ajout de Recette");
define('TITRE_RECIPES_EDITFORM', "Modification de Recette");

define('TITRE_CATEGORIES_INDEX', "Liste des Categories");
define('TITRE_CATEGORIES_ADDFORM', "Ajout de Categorie");
define('TITRE_CATEGORIES_EDITFORM', "Modification de Categories");

define('TITRE_INGREDIENTS_INDEX', "Liste des Ingrédients");
