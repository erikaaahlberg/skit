<?php

function insert_to_do_list ($title, $creator)
{
    require "partials/database.php";
    $completed = 0;
    
    $my_sql = $pdo->prepare(
     "INSERT INTO to_do (title, completed, createdBy) 
     VALUES (:title, :completed, :createdBy)"
     ); 


    $my_sql->execute(array( 
        ":title" => $title,  
        ":completed" => $completed,
        ":createdBy" => $creator)); 
    
}


?>
