<?php

function clear_database ($boolean)
{
    require "partials/database.php";
    
$clear_database = $pdo->prepare(
     "DELETE FROM to_do"
     ); 
 
    $clear_database->execute();

}
    
?>