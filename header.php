<?php 
include 'config.php'; 
$current_table = isset($_GET['table']) ? $_GET['table'] : '';
?>
<!DOCTYPE html>
<html>
<head>
<title>Super Admin Panel</title>
<style>
body{margin:0; font-family:Arial; display:flex; background:#f4f4f4;}
.sidebar{width:220px; background:#2c3e50; color:#fff; height:100vh; padding:15px; position:fixed; left:0; top:0; overflow-y:auto;}
.sidebar h2{font-size:18px; margin-bottom:20px;}
.sidebar a{display:block; padding:10px; color:#ecf0f1; text-decoration:none; border-radius:4px; margin-bottom:5px;}
.sidebar a:hover, .sidebar a.active{background:#34495e;}
.content{margin-left:240px; padding:20px; width:100%;}
.card{background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.1);}
table{width:100%; border-collapse:collapse; margin-top:15px;}
th{background:#34495e; color:#fff; padding:10px; text-align:left;}
td{padding:10px; border-bottom:1px solid #eee;}
.btn{padding:6px 12px; margin:2px; border:none; border-radius:4px; text-decoration:none; font-size:13px; color:#fff; display:inline-block;}
.btn-edit{background:#3498db;} .btn-delete{background:#e74c3c;} .btn-details{background:#27ae60;} .btn-add{background:#2ecc71;}
</style>
</head>
<body>

<div class="sidebar">
<h2>Super Admin</h2>
<?php foreach($important_cols as $tbl => $cols): 
$active = ($current_table == $tbl) ? 'active' : '';
?>
<a class="<?= $active ?>" href="Admin.php?table=<?= $tbl ?>">
    <?= ucfirst(str_replace('_',' ', $tbl)) ?>
</a>
<?php endforeach; ?>
</div>

<div class="content">