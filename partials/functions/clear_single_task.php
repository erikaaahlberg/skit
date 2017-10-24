<?php

function clear_single_task ($id)
{
    require "partials/database.php";
    
    $clear_single = $pdo->prepare(
     "DELETE FROM to_do
     WHERE id = '$id'"
     ); 
 
    $clear_single->execute();
    
    header("Location: index.php");
}

?>