<?php

function fetch_completed_list ()
{

require "partials/database.php";

$completed = $pdo2->prepare(
  "SELECT DISTINCT * FROM to_do
  WHERE completed = 1"
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
?>