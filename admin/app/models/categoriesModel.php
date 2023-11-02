<?php

namespace App\Models\CategoriesModel;

function findAllCategories(\PDO $connexion): array
{

    $sql = "SELECT
                id AS category_id, 
                name AS category_name,
                description AS category_description
            FROM types_of_dishes
            ORDER BY id DESC;
           ";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

function findOneById(\PDO $connexion, int $id):array
{
    $sql= "SELECT
                c.id AS category_id,
                c.name AS category_name,
                c.description AS category_description,
                c.created_at AS category_creation_at
            FROM types_of_dishes c
            WHERE c.id = :id";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
   
    $rs->execute();

    return $rs->fetch(\PDO::FETCH_ASSOC);       
}
function insert(\PDO $connexion, array $data)
{
    // $data['created_at'] = date('Y-m-d H:i:s');

    $sql = "INSERT INTO types_of_dishes
            SET name= :name,
                description= :description,
                created_at= NOW()
           ";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(":name", $data["name"], \PDO::PARAM_STR);
    $rs->bindValue(":description", $data["description"], \PDO::PARAM_STR);
    //  $rs->bindValue(":created_at", $data["created_at"], \PDO::PARAM_STR);
    
    $rs->execute();

    return $connexion->lastInsertId();
}

function update(\PDO $connexion, int $category_id, array $data)
{
     
    $sql = "UPDATE types_of_dishes
            SET name = :name,
                description = :description,
                created_at = NOW()
                WHERE id = :category_id;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':name', $data['name'], \PDO::PARAM_STR);
    $rs->bindValue(':description', $data['description'], \PDO::PARAM_STR);
    $rs->bindValue(':category_id', $category_id, \PDO::PARAM_INT);

    return $rs->execute();
   
}
// JE N'AI PAS REUSSI A REGLER LE PROBLEME D'OCCURENCE DE LA CATEGORIE A SUPPRIMER DANS LES RECETTES. MA FONCTION DELETE N'EFFACE QUE LES CATEGORIES QUI N'ONT PAS DE RECETTES


function delete(\PDO $connexion, int $id)
{
    $sql = "DELETE FROM types_of_dishes
            WHERE id = :id;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    return intval($rs->execute());
}

// TENTATIVE N°1 D'EFFACER LES CATEGORIES DANS LES RECETTES

// function delete(\PDO $connexion, int $category_id)
// {
//         // 1. Mettre à jour les recettes (dishes) liées à la catégorie pour les définir sur une catégorie par défaut (par exemple, "Aucune Catégorie")
//         $defaultCategoryName = "Aucune"; // Remplacez par le nom de la catégorie par défaut

//         $sqlUpdateDishes = "UPDATE dishes SET type_id = NULL WHERE type_id = :id"
//         $rsUpdateDishes = $connexion->prepare($sqlUpdateDishes);
//         $rsUpdateDishes->bindValue(':id', $category_id, \PDO::PARAM_INT);
//         $rsUpdateDishes->execute();

//         // 2. Supprimer la catégorie
//         $sqlDeleteCategory = "DELETE FROM types_of_dishes WHERE id = :id";
//         $rsDeleteCategory = $connexion->prepare($sqlDeleteCategory);
//         $rsDeleteCategory->bindValue(':id', $category_id, \PDO::PARAM_INT);
//         $rsDeleteCategory->execute();

// }

// TENTATIVE N°2 D'EFFACER LES CATEGORIES DANS LES RECETTES

// function delete(\PDO $connexion, string $category_name)
// {
//     $connexion->beginTransaction();
// // 1. je mets à jour la colonne "type_id" dans la table "dishes" pour les recettes qui sont actuellement associées au type_of_dishes que je souhaite supprimer.
// try {
    
//         // Mettre à jour les recettes associées à la catégorie pour les définir sur une catégorie par défaut (par exemple, "Aucune Catégorie")
//         $defaultCategoryName = "Aucune Catégorie";
//         $sqlUpdateDishes = "UPDATE dishes 
//                             SET type_of_dishes_id = (SELECT id 
//                                                     FROM types_of_dishes 
//                                                     WHERE name = :default_category) 
//                             WHERE type_id IN (SELECT id 
//                                               FROM types_of_dishes 
//                                               WHERE name = :category_name)";

//         $rsUpdateDishes = $connexion->prepare($sqlUpdateDishes);

//         $rsUpdateDishes->bindValue(":default_category", $defaultCategoryName, \PDO::PARAM_STR);

//         $rsUpdateDishes->bindValue(":category_name", $category_name, \PDO::PARAM_STR);

//         $rsUpdateDishes->execute();

//         // Suppression de la catégorie par son nom

//         $sqlDeleteCategory = "DELETE FROM types_of_dishes 
//                               WHERE name = :category_name";

//         $rsDeleteCategory = $connexion->prepare($sqlDeleteCategory);

//         $rsDeleteCategory->bindValue(":category_name", $category_name, \PDO::PARAM_STR);

//         $rsDeleteCategory->execute();

//         $connexion->commit(); // Valide la transaction
//         return true;
//     } catch (\PDOException $e) {
//         $connexion->rollBack(); // Annule la transaction en cas d'erreur
//         return false;
//     }
// }