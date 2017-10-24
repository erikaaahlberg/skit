<?php

function clear_database ($boolean)
{
    if($boolean)
    {
        require "partials/database.php";

        $clear_database = $pdo->prepare
        (
        "TRUNCATE TABLE to_do"
        ); 
 
        $clear_database->execute();
        
        header("Location: index.php");
    }

}
    
?>