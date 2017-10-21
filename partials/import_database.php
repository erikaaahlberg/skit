<?php

if (isset($_POST["createdBy"]) && isset($_POST["title"]))
{
    
    $my_sql = $pdo->prepare(
     "INSERT INTO to_do (title, createdBy) 
     VALUES (:title, :createdBy)"
     ); 


    $my_sql->execute(array( 
        ":title" => $_POST["title"],  
        ":createdBy" => $_POST["createdBy"] )); 
    
}


?>
