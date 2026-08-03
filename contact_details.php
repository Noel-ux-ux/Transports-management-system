<?php
include 'config.php';
$id = $_GET['id'] ?? 0;
$res = $conn->query("SELECT * FROM contacts WHERE id=$id");
$contact = $res->fetch_assoc();
if(!$contact) die("Contact not found");
?>
<!DOCTYPE html>
<html>
<head><title>Details</title>
<style>
body{font-family:Arial; padding:20px; background:#f5f5f5;}
.card{background:#fff; padding:20px; border-radius:8px; max-width:700px; margin:auto;}
.row{margin-bottom:12px;} .label{font-weight:bold; width:160px; display:inline-block;}
.btn{padding:8px 14px; background:#4c6ef5; color:#fff; text-decoration:none; border-radius:4px; margin-right:5px;}
</style>
</head>
<body>
<div class="card">
<h2>Contact Details #<?= $contact['id'] ?></h2>
<?php foreach($contact as $key => $val): ?>
<div class="row"><span class="label"><?= ucfirst(str_replace('_',' ',$key)) ?>:</span> <?= nl2br(htmlspecialchars($val)) ?></div>
<?php endforeach; ?>
<br>
<a href="contacts.php" class="btn">← Back</a>
<a href="contacts.php?action=edit&id=<?= $contact['id'] ?>" class="btn" style="background:#ffc107; color:#000;">Edit</a>
</div>
</body>
</html>