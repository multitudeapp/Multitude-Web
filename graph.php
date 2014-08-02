<?php

$dsn = 'mysql:dbname=maindb;host=127.0.0.1';
$user = 'root';
$password = 'temppassword123!';

$pdo = new PDO($dsn, $user, $name);

$result = $pdo->query('select * from responses');
foreach ($result as $row) {

$rows[] = "['{$row['station']}',{$row['feedback']}]";

}

$rowsString = implode(',', $rows);
?>





