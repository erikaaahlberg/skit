<?php

function fetch_to_do_list ($int)
{
    require "partials/database.php";

    $statement = $pdo->prepare(
      "SELECT * FROM to_do
      WHERE completed = $int"
    );

    $statement->execute(array(
        ":id" => "id",
        ":title" => "title",
        ":completed" => "completed",
        ":createdBy" => "createdBy"
    ));

    $to_do_list = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $to_do_list;
}

?>