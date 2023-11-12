<?php

namespace App\Models\CommentsModel;

/**
 * Undocumented function
 *
 * @param \PDO $connexion
 * @param integer $dish_id
 * @return array
 */
function findAllCommentsByDishId(\PDO $connexion, int $dish_id): array
{
    $sql = "SELECT 
                c.*, 
                u.name AS user_name,
                u.picture AS user_picture,
                COUNT(DISTINCT c.id) AS comment_count
            FROM comments c
            INNER JOIN users u ON c.user_id = u.id
            WHERE c.dish_id = :dish_id
            GROUP BY c.id, u.name, u.picture
            ORDER BY c.created_at DESC;
";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':dish_id', $dish_id, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

// function findAllCommentsByDishId(\PDO $connexion, int $dish_id): array
// {
//     $sql = "SELECT 
//             c1.content,
//             c1.id,
//             u.name AS user_name,
//             u.picture AS user_picture
//         FROM comments c1
//         INNER JOIN users u ON c1.user_id = u.id
//         WHERE c1.dish_id = :dish_id
//             AND c1.created_at = (
//                 SELECT MAX(c2.created_at)
//                 FROM comments c2
//                 WHERE c2.dish_id = :dish_id
//                     AND c2.content = c1.content
//             )
//         ORDER BY c1.created_at DESC;";


//     $rs = $connexion->prepare($sql);
//     $rs->bindValue(':dish_id', $dish_id, \PDO::PARAM_INT);
//     $rs->execute();
//     return $rs->fetchAll(\PDO::FETCH_ASSOC);
// }

