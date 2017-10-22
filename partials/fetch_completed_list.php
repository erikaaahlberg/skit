<?php

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

$array = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $array;
}
?>