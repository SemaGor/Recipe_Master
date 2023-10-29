<?php

namespace App\Models\RecipesModel;

function findAllRecipes(\PDO $connexion): array 
{
    $sql = "SELECT 
                d.id AS dish_id,
                d.name AS dish_name,
                d.prep_time AS dish_prep_time,
                d.portions AS portions,
                d.type_id AS dish_type,
                d.user_id AS user_id,
                d.type_id AS category_id,
                t.name AS category_name,
                ROUND(AVG(r.value), 2) AS avg_rating,
                d.description AS dish_description, 
                u.name AS user_name,
                GROUP_CONCAT(DISTINCT i.name ORDER BY i.name ASC) AS ingredients_names,
                COUNT(c.id) AS comment_count,
                d.picture AS dish_picture
            FROM dishes d
            LEFT JOIN ratings r ON d.id = r.dish_id
            LEFT JOIN users u ON d.user_id = u.id
            LEFT JOIN types_of_dishes t ON d.type_id = t.id
            LEFT JOIN dishes_has_ingredients di ON d.id = di.dish_id
            LEFT JOIN ingredients i ON di.ingredient_id = i.id
            LEFT JOIN comments c ON d.id = c.dish_id
            GROUP BY d.id, u.name, t.name
            ORDER BY d.created_at DESC;
        ";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

function findOneById(\PDO $connexion, int $id): array
{
    $sql = "SELECT 
            d.id AS dish_id,
            d.name AS dish_name,
            d.description AS dish_description,
            d.prep_time AS dish_prep_time,
            d.portions AS dish_portions,
            u.name as user_name, 
            u.id as user_id
            FROM dishes d
            JOIN users u on u.id = d.user_id
            WHERE d.id =:id;
            ";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetch(\PDO::FETCH_ASSOC);
}

function findIngByDishId(\PDO $connexion, int $id): array
{
    $sql = "SELECT ingredient_id
    FROM dishes_has_ingredients
    WHERE dish_id = :id;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_COLUMN);
}

function insert(\PDO $connexion, array $data): int
{
    $sql = "INSERT INTO dishes
            SET name = :name,
                description = :description,
                prep_time = :prep_time,
                user_id = :user_id,
                type_id = :type_id,
                created_at = now();";
            
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':name', $data['name'], \PDO::PARAM_STR);
    $rs->bindValue(':description', $data['description'], \PDO::PARAM_STR);
    $rs->bindValue(':prep_time', $data['prep_time'], \PDO::PARAM_STR);
    $rs->bindValue(':user_id', $data['user_id'], \PDO::PARAM_INT);
    $rs->bindValue(':type_id', $data['type_id'], \PDO::PARAM_INT); 
   

    $rs->execute();

    return $connexion->lastInsertId();
}

function insertDishIngredients(\PDO $connexion, int $id, int $ingredientId,string $quantity) 
{
    $sql = "INSERT INTO dishes_has_ingredients 
            SET dish_id = :dish_id,
                ingredient_id = :ingredient_id, 
                quantity = :quantity;";
    
    $rs = $connexion->prepare($sql);
    
    $rs->bindValue(':dish_id', $id, \PDO::PARAM_INT);
    $rs->bindValue(':ingredient_id', $ingredientId, \PDO::PARAM_INT);
    $rs->bindValue(':quantity', $quantity, \PDO::PARAM_STR);
    $rs->execute();

    return $rs->fetchAll(\PDO::FETCH_COLUMN);
}

function delete(\PDO $connexion, int $id): bool
{
    // 1. Je supprime d'abord les relations associées dans `dishes_has_ingredients`
    $sql = "DELETE FROM dishes_has_ingredients 
                   WHERE dish_id 
                   IN (SELECT id FROM dishes WHERE id = :id)";
    $rs = $connexion->prepare($sql);
    $rs->bindParam(":id", $id, \PDO::PARAM_INT);
    $rs->execute();
    
    // 2. Je supprime la recette
    $sql = "DELETE FROM dishes WHERE id = :id";
    $rs = $connexion->prepare($sql);
    $rs->bindParam(":id", $id, \PDO::PARAM_INT);
   
    return $rs->execute();
}

function update(\PDO $connexion, array $data)
{
    $sql = "UPDATE dishes
            SET name = :name
            WHERE id = :id;
           ";

    $rs = $connexion->prepare($sql);
    
    // Liaison de la valeur 'dish_name' du tableau de données à la variable :name dans la requête SQL.
    $rs->bindValue(":name", $data["dish_name"], \PDO::PARAM_STR);
    
    // Liaison de la valeur 'dish_id' du tableau de données à la variable :id dans la requête SQL.
    $rs->bindValue(":id", $data["dish_id"], \PDO::PARAM_INT);

    //par exemple où l'id est 3
    // bindValue va dire "prend ce que tu as dans $data['user_name'] et associe le au champ :name de ma table (où l'id est 3) 

    return $rs->execute();
}