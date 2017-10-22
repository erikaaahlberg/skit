<?php

require "partials/database.php";

$statement = $pdo->prepare(
  "SELECT DISTINCT * FROM to_do
  WHERE completed = 0"
);

$statement->execute(array(
    ":id" => "id",
    ":title" => "title",
    ":completed" => "completed",
    ":createdBy" => "createdBy"
));

$to_do_list = $statement->fetchAll(PDO::FETCH_ASSOC);


?>