<?php 
include 'config.php';

$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? '';

if(!in_array($table, $tables)){ die("Invalid table"); }

// Get primary key
$cols_result = $conn->query("SHOW COLUMNS FROM `$table`");
$primary_key = 'id';
while($c = $cols_result->fetch_assoc()){
    if($c['Key'] == 'PRI') $primary_key = $c['Field'];
}

// Delete
$stmt = $conn->prepare("DELETE FROM `$table` WHERE `$primary_key` = ?");
$stmt->bind_param("s", $id);
$stmt->execute();

header("Location: admin.php?table=$table");
exit;
?>