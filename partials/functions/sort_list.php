<?php
function add_column($boolean)
{
    if ($boolean)
    {
        
    require "partials/database.php";
    
    $my_sql = $pdo->execute(
    
    "ALTER TABLE to_do 
     ADD 'priority' INT(100)"
    );
    
    $my_sql->commit(); 
          
    }

}

function sort_list($array)
{
    
}
?>