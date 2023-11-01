<?php

namespace App\Models\CategoriesModel;

function findAllCategories(\PDO $connexion): array
{

    $sql = "SELECT
                id AS category_id, 
                name AS category_name,
                description AS category_description
            FROM types_of_dishes
            ORDER BY created_at DESC;
           ";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

function insert(\PDO $connexion, array $data)
{
    $data['created_at'] = date('Y-m-d H:i:s');

    $sql = "INSERT INTO types_of_dishes
            SET name= :name,
                description= :description,
                created_at= :created_at;
           ";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(":name", $data["name"], \PDO::PARAM_STR);
    $rs->bindValue(":description", $data["description"], \PDO::PARAM_STR);
    $rs->bindValue(":created_at", $data["created_at"], \PDO::PARAM_STR);
    
    $rs->execute();

    return $connexion->lastInsertId();
}
