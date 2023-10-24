<?php
// fichier qui gère la connexion à ma bdd

require_once '../app/config/params.php';

try {
    $connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}