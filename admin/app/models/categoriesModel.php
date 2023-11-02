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
                created_at= :NOW()
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