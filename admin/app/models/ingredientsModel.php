<?php

namespace App\Models\IngredientsModel;
// l'utilisation d'une sous-requête permet d'éviter les doublons dans l'affichage, DISTINCT ne fonctionne pas
function findAllIngredients(\PDO $connexion): array
{
    $sql = "SELECT
                i.id AS ingredient_id,
                i.name AS ingredient_name,
                i.unit AS ingredient_unit,
                GROUP_CONCAT(dhi.quantity) AS quantity
            FROM ingredients i
            LEFT JOIN (
                SELECT ingredient_id, GROUP_CONCAT(quantity) AS quantity
                FROM dishes_has_ingredients
                GROUP BY ingredient_id
            ) dhi ON i.id = dhi.ingredient_id
            GROUP BY i.id, i.name, i.unit
            ORDER BY ingredient_name ASC;";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}
