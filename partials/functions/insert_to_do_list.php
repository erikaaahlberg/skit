<?php

function insert_to_do_list ($title, $completed, $createdBy)
{
    require "partials/database.php";

            $my_sql = $pdo->prepare(
             "INSERT INTO to_do (title, completed, createdBy) 
             VALUES (:title, :completed, :createdBy)"
             ); 


            $my_sql->execute(array( 
                ":title" => $title,  
                ":completed" => $completed,
                ":createdBy" => $createdBy)); 
    
       
            echo '<br/><p class="succes_message">
            Your task was successfully added</p>';
 
}


?>
