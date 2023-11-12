<?php

namespace App\Models\RecipesModel;

use Core\Tools\truncateDescription;
use App\Controllers\recipesController;

/**
 * Undocumented function
 *
 * @param string $description
 * @param integer $limit
 * @return string
 */


/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @return array
 */
function findRandomRecipe(\PDO $connexion): array
{
    $sql = "SELECT 
                d.name AS dish_name,
                d.id AS id,
                d.description AS description,
                d.picture AS dish_picture,
                u.name AS user_name, 
                u.picture AS user_picture,
                ROUND(AVG(r.value), 2) AS avg_rating,
                COUNT(DISTINCT c.id) AS comment_count,
                MAX(c.content) AS comment
            FROM dishes d
            LEFT JOIN ratings r ON d.id = r.dish_id
            LEFT JOIN users u ON d.user_id = u.id
            LEFT JOIN comments c ON d.id = c.dish_id
            GROUP BY d.id, d.name, d.user_id, d.type_id,d.description,d.picture, u.name,u.picture, r.value, c.content
            ORDER BY RAND()
            LIMIT 1;";

    $rs = $connexion->query($sql);
    $recipe = $rs->fetch(\PDO::FETCH_ASSOC);

    // Pour remplacer la description originale par la version tronquée
    $recipe['description'] = \Core\Tools\truncateDescription($recipe['description']);

    return $recipe;
}


/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @return array
 */
function findAllPopularRecipes(\PDO $connexion): array
{
    $sql = "SELECT 
                d.id,
                d.name AS dish_name,
                ROUND(AVG(r.value), 2) AS avg_rating,
                d.description AS description, 
                d.picture AS dish_picture,
                u.name AS user_name,
                u.picture AS user_picture,
                COUNT(DISTINCT c.id) AS comment_count
            FROM dishes d
            LEFT JOIN ratings r ON d.id = r.dish_id
            LEFT JOIN users u ON d.user_id = u.id
            LEFT JOIN comments c ON d.id = c.dish_id
            GROUP BY 
                d.id, 
                d.name, 
                d.picture,
                d.description, 
                u.name, 
                u.picture,
                c.id
            ORDER BY 
                avg_rating DESC
            LIMIT 3;";

    $rs = $connexion->query($sql);
    $recipes = $rs->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($recipes as &$recipe) {
        $recipe['description'] = \Core\Tools\truncateDescription($recipe['description']);
    }
    return $recipes;
}
/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @return array
 */
function findAllRecipes(\PDO $connexion): array
{
    $sql = "SELECT 
                d.id AS dish_id,
                d.name AS dish_name,
                ROUND(AVG(r.value), 2) AS avg_rating,
                d.description AS description, 
                u.name AS user_name,
                COUNT(DISTINCT c.id) AS comment_count,
                c.content AS comment,
                d.picture AS dish_picture
            FROM dishes d
            LEFT JOIN ratings r ON d.id = r.dish_id
            LEFT JOIN users u ON d.user_id = u.id
            LEFT JOIN comments c ON d.id = c.dish_id
            GROUP BY d.id, d.name, d.description, u.name, c.content, d.picture
            ORDER BY d.created_at DESC
            LIMIT 9;

            ";

    $rs = $connexion->query($sql);
    $recipes = $rs->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($recipes as &$recipe) {
        $recipe['description'] = \Core\Tools\truncateDescription($recipe['description']);
    }
    return $recipes;
}
/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @param integer $id
 * @return array
 */
function findOneById(\PDO $connexion, int $id): array
{
    $sql = "SELECT 
                d.id AS id,
                d.name AS dish_name,
                d.picture AS dish_picture,
                ROUND(AVG(r.value), 2) AS avg_rating,
                d.prep_time AS prep_time,
                d.description AS dish_description,
                u.name AS user_name,
                u.picture AS user_picture,
                c.content AS comment,
                COUNT(DISTINCT c.id) AS comment_count,
                GROUP_CONCAT(DISTINCT i.name) AS ingredient_names,
                GROUP_CONCAT(DISTINCT i.unit) AS ingredient_units,
                GROUP_CONCAT(DISTINCT dhi.quantity) AS ingredient_quantities
            FROM dishes d
            LEFT JOIN ratings r ON d.id = r.dish_id
            LEFT JOIN users u ON d.user_id = u.id
            LEFT JOIN comments c ON d.id = c.dish_id
            LEFT JOIN dishes_has_ingredients dhi ON d.id = dhi.dish_id
            LEFT JOIN ingredients i ON dhi.ingredient_id = i.id
            WHERE d.id = :id
            GROUP BY d.id, d.name, d.picture, d.prep_time, d.description, u.name, u.picture, c.content;
            ";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetch(\PDO::FETCH_ASSOC);
}

function findAllByUserId(\PDO $connexion, int $id): array
{
    $sql = "SELECT *, 
            FROM dishes d
            WHERE d.user_id = :id;
            ";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    $rs->execute();
    $result = $rs->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
}
