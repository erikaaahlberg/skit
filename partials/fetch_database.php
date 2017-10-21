<?php

$statement = $pdo->prepare(
  "SELECT title, createdBy FROM to_do"
);

$statement->execute();

$to_do_list = $statement->fetchAll(PDO::FETCH_ASSOC);


?>