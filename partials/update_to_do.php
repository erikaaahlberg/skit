<?php

function update_to_do ($title_id)
{
    require "partials/database.php";
    $completed = true;
    
    $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$my_sql = $pdo2->prepare(
    
    "UPDATE to_do 
     SET completed = 1
     WHERE id = $title_id");
    
    $my_sql->execute();
                 
}

function check_if_completed ($array)
{
    for($i = 0; $i < count($array); $i++)
    {
        if ($array[$i]["completed"] > 0)
        {
            $completed = array(
   array(
    "title"    => $array[$i]["title"],
    "completed"   => $array[$i]["completed"],
    "createdBy"   => $array[$i]["createdBy"]
       ));
       
       return $completed;
        }
    }
}



?>