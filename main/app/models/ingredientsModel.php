<?php

namespace App\Models\IngredientsModel;

function findAllIngredients(\PDO $connexion): array {
    $sql = "SELECT DISTINCT *
            FROM ingredients 
            ORDER BY name ASC;";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

function findAllIngredientsByDishId(\PDO $connexion, $id): array 
{
    $sql = "SELECT CONCAT(CEIL(quantity), ' ' , i.unit, ' ', i.name) AS ingredient, 
                   d.name
            FROM ingredients i
            JOIN dishes_has_ingredients dhi on dhi.ingredient_id = i.id
            JOIN dishes d on dhi.dish_id=d.id
            WHERE d.id = :id
            ORDER BY d.name ASC;
         ";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    $rs->execute();
    

return $rs->fetchAll(\PDO::FETCH_ASSOC);
}