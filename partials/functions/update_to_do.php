<?php

function update_to_do ($completed, $title, $createdBy, $id)
{
    require "partials/database.php";
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $my_sql = $pdo->prepare(
    
    "UPDATE to_do 
     SET completed = :completed,
     title = :title,
     createdBy = :createdBy
     WHERE id = $id"
    );
    
    $my_sql->execute(array(
        ":completed" => $completed,
        ":title"    => $title,
        ":createdBy" => $createdBy
    
    ));
    
    header("Location: index.php");
                 
}

?>