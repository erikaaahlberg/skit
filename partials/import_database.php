<?php

if (isset($_POST["createdBy"]) && isset($_POST["title"]))
{
    $completed = false;
    
    $my_sql = $pdo->prepare(
     "INSERT INTO to_do (title, completed, createdBy) 
     VALUES (:title, :completed, :createdBy)"
     ); 


    $my_sql->execute(array( 
        ":title" => $_POST["title"],  
        ":completed" => $completed,
        ":createdBy" => $_POST["createdBy"] )); 
    
}


?>
