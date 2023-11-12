<?php

namespace App\Models\CategoriesModel;

/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @return array
 */

function findAllCategories(\PDO $connexion): array
{

    $sql = "SELECT
                id, 
                name 
            FROM types_of_dishes
            ORDER BY name ASC;
           ";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}