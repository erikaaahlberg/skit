<?php

if (isset($_POST["clear"])){
    
$clear_database = $pdo->prepare(
     "DELETE FROM to_do"
     ); 
 
    $clear_database->execute();
}
    
?>