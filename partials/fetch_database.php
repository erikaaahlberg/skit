<?php

$statement = $pdo->prepare(
  "SELECT DISTINCT id, title, completed, createdBy FROM to_do"
);

$statement->execute(array(
    ":id" => "id",
    ":title" => "title",
    ":completed" => "completed",
    ":createdBy" => "createdBy"
));

$to_do_list = $statement->fetchAll(PDO::FETCH_ASSOC);


?>