<?php
function sort_list($boolean)
{  
    if($boolean)
    {
        require "partials/database.php";

        $statement = $pdo->prepare(
          "SELECT * FROM to_do
          ORDER BY priority ASC
          WHERE completed = 0"
        );

        $statement->execute(array(
            ":id" => "id",
            ":title" => "title",
            ":completed" => "completed",
            ":createdBy" => "createdBy",
            ":priority" => "priority"
        ));

        $to_do_list = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $to_do_list;
    }
}
?>