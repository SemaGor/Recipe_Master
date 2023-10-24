<?php

namespace App\Models\UsersModel;

function truncateDescription(string $description, int $limit = 3): string
{
    $sentences = explode('.', $description);
    $shortDescription = implode('.', array_slice($sentences, 0, $limit));

    if (count($sentences) > $limit) {
        $shortDescription .= '...';
    }

    return $shortDescription;
}

function findTopUser(\PDO $connexion): array
{
    $sql = "SELECT 
            u.id AS user_id,
            u.name AS user_name,
            u.picture AS user_picture,
            DATE_FORMAT(u.created_at, '%d-%m-%Y') AS formatted_user_subscription,
            AVG(r.value) AS avg_rating,
            COUNT(d.id) AS total_recipes_posted
            FROM 
                users u
            JOIN 
                dishes d ON d.user_id = u.id
            LEFT JOIN 
                ratings r ON d.id = r.dish_id
            GROUP BY 
                u.id, u.name, u.picture
            ORDER BY 
                avg_rating DESC
            LIMIT 1;";

    $rs = $connexion->query($sql);
    return $rs->fetch(\PDO::FETCH_ASSOC);
}
/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @param integer $user_id
 * @return array
 */
function findLastRecipesByUserId(\PDO $connexion, int $user_id): array
{
    $sql = "
        SELECT 
            d.id,
            d.name AS dish_name,
            d.created_at,
            d.picture AS dish_picture,
            d.description,
            u.picture AS user_picture,
            u.created_at AS user_membership,
            (SELECT ROUND(AVG(value), 2) 
                FROM ratings 
                WHERE dish_id = d.id) AS avg_rating
        FROM dishes d
        JOIN users u ON d.user_id = u.id
        LEFT JOIN ratings r ON d.id=r.dish_id
        WHERE d.user_id = :user_id
        GROUP BY d.id, d.name, d.created_at, d.picture, d.description, u.picture
        ORDER BY d.created_at DESC
        LIMIT 3;
        ";

    $rs = $connexion->prepare($sql);
    $rs->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
    $rs->execute();
    $recipes = $rs->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($recipes as &$recipe) {
        $sentences = explode('.', $recipe['description']);
        $shortDescription = implode('.', array_slice($sentences, 0, 3));
        if (count($sentences) > 3) {
            $shortDescription .= '...';
        }
        $recipe['short_description'] = $shortDescription;
    }

    return $recipes;
}

function findAllUsers(\PDO $connexion): array
{
    $sql = "SELECT 
                u.id AS user_id,
                u.name AS user_name, 
                u.created_at AS registration_date,
                u.picture AS user_picture,
                COUNT(d.id) AS recipe_count
            FROM users u
            LEFT JOIN dishes d ON d.user_id = u.id
            GROUP BY u.id
            ORDER BY u.created_at DESC
            LIMIT 9;
            ";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($recipes as &$recipe) {
        $recipe['short_description'] = truncateDescription($recipe['description']);
    }
    return $recipes;
}

/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @return array
 */
function findAll(\PDO $connexion): array
{
    $sql = "SELECT 
                u.id AS user_id,
                u.name AS user_name,
                u.created_at AS user_created_at,
                COUNT(d.id) AS recipe_count
            FROM users u
            LEFT JOIN dishes d ON u.id = d.user_id
            GROUP BY u.id
            ORDER BY u.created_at DESC;";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}
/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @param integer $dish_id
 * @return array
 */

function findCommentsByDishId(\PDO $connexion, int $dish_id): array
{
    $sql = "SELECT 
                c.content AS comment_content,
                c.created_at AS comment_date,
                u.name AS user_name,
                u.picture AS user_picture
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.dish_id = :dish_id
            ORDER BY c.created_at DESC";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':dish_id', $dish_id, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
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
    $sql = "
        SELECT 
            u.name AS user_name,
            u.email AS user_email,
            u.biography AS user_biography,
            u.picture AS user_picture,
            u.created_at AS user_creation_date
        FROM users u
        WHERE u.id = :id";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetch(\PDO::FETCH_ASSOC);
}

function findOneByLoginPwd(\PDO $connexion, array $data = null)
{
    $sql = "SELECT *
            FROM users
            WHERE email = :email
                AND password = :password;
            ";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(":email", $data["email"], \PDO::PARAM_STR);
    $rs->bindValue(":password", $data["password"], \PDO::PARAM_STR);
    $rs->execute();
    return $rs->fetch(\PDO::FETCH_ASSOC);
}
