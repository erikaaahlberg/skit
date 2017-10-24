<?php
function edit_to_do ($id, $title, $createdBy)
{
        require "partials/database.php";
    
    $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $my_sql = $pdo2->prepare(
    
    "UPDATE to_do 
     SET completed = '$completed'
     WHERE id = '$title_id'");
    
    $my_sql->execute();
}

?>