<?php

function update_to_do ($completed, $title, $createdBy, $id, $priority)
{
    require "partials/database.php";
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $my_sql = $pdo->prepare(
    
    "UPDATE to_do 
     SET completed = :completed,
     title = :title,
     createdBy = :createdBy,
     priority = :priority
     WHERE id = :id"
    );
    
    $my_sql->execute(array(
        ":completed" => $completed,
        ":title"    => $title,
        ":createdBy" => $createdBy,
        ":priority" => $priority,
        ":id" => $id
    
    ));
    
    
    header("Location: index.php");
                 
}

?>