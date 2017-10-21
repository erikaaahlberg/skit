if (isset($_POST[completed_$to_do["id"]]))
{
$my_sql = $pdo->prepare(
     "UPDATE to_do 
     SET completed = 'true'"
     );

}