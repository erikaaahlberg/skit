<?php

function completed_to_do ($title_id)
{
    require "partials/database.php";
    $completed = true;
    
$my_sql = $pdo->prepare(
     "UPDATE to_do 
     SET completed = $completed
     WHERE id = $title_id"
     );
    
    $my_sql->execute();
                 
}

function fetch_completed_list ($array)
{

require "partials/database.php";

$completed = $pdo->prepare(
  "SELECT DISTINCT * FROM to_do
  WHERE completed = true"
);

$completed->execute(array(
    ":id" => "id",
    ":title" => "title",
    ":completed" => "completed",
    ":createdBy" => "createdBy"
));

$array = $completed->fetchAll(PDO::FETCH_ASSOC);
    
    return $array;
}

function check_if_completed ($array)
{
    for ($i = 0; $i < count($array); $i++)
    {
        if ($array[$i]["completed"])
        {
            return $array[$i];
        }
    }
}
?>