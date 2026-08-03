<?php
session_start();
include 'config.php';

// 1. LOGIN CHECK
if(!isset($_SESSION['super_admin']) || empty($_SESSION['super_admin'])){
    header("Location: login.php");
    exit();
}

// 2. MENU DATA - same as other pages
$important_cols = [
    'admins' => ['id','Name','email','phone'],
    'clients' => ['id','name','phone','email'],
    'contacts' => ['id','name','email','phone','message','status'],
   
    'transactions' => ['id','tracking_number','client_id','transporter_id','service_type','origin','destination','weight_kg','amount','status','date_created','date_delivered','clients','transporter','goods'],
    'transporters' => ['id','Name','phone','email'],
    'yearly_summarry' => ['id','Number_of_Successful_Imported_Transaction','Number_of_Unsuccessful_Imported_Transaction','Number_of_Imported_Transaction','Number_of_Exported_Transaction','Number_of_Countries_Reached']
];

$table = $_GET['table'] ?? 'clients';
$id = $_GET['id'] ?? 0;

if(!array_key_exists($table, $important_cols)){
    $table = 'clients';
}

// 3. INCLUDE SIDEBAR FIRST
include 'sidebar.php'; 

// 4. GET RECORD
$result = $conn->query("SELECT * FROM `$table` WHERE id = '$id' LIMIT 1");
$row = $result->fetch_assoc();

if(!$row){ 
    die("Record not found"); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View <?= ucfirst($table) ?> Details</title>
<link rel="stylesheet" href="index.CSS">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>

     :root {
            --bg-dark: #0a192f;
            --bg-card: #112240;
            --bg-hover: #1e3a5f;
            --accent: #64ffda;
            --accent-hover: #52e0c4;
            --text-primary: #e6f1ff;
            --text-secondary: #8892b0;
            --danger: #ff6b6b;
            --info: #58a6ff;

        }
     body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0a0f1e 0%, #121a2e 100%);
            color: #fff;
            min-height: 100vh;
        }

.sidebar-bottom1 {
margin-top: auto;
padding-top:402px;;
}      
  
        .sidebar-bottom2 a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 15px;
            background: rgba(255, 107, 107, 0.1);
            /* Red transparent bg */
            color: var(--danger) !important;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            border: 1px solid rgba(255, 107, 107, 0.3);
            transition: 0.2s;
        }

        .sidebar-bottom1 :hover {
            background: var(--danger) !important;
            color: #fff !important;
            /* White text on hover */
            transform: translateY(-2px);
        }
        
   .content {
            margin-left: 260px;
            padding: 30px 40px;
            width: calc(100% - 260px);
            background-color: #0a192f;
        }


        .detail-card {
           background:rgb(20, 33, 65);
            padding: 30px;
            border-radius: 12px;
            margin-top: 10px;
        }

        .detail-value:focus {
            color: #00f5ff;
        }

  
    </style>
</head>
<body>

    <div class="sidebar">
            <div class="sidebar-top">
                <h2>⚡ Super Admin</h2>

                <a href="Admin.php" class="<?= !isset($_GET['table']) ? 'active' : '' ?>">
                    <img src="bootstrap-icons-1.13.1/0-circle.svg" width="20"> Dashboard
                </a>

                <?php
        $icons = [
            'admins' => 'shield-lock-fill.svg',
            'clients' => 'people-fill.svg',
            'contacts' => 'person-lines-fill.svg',
           
            'transactions' => 'cash-stack.svg',
            'transporters' => 'truck-front.svg',
            'yearly_summarry' => 'graph-up.svg'
        ];

        foreach($important_cols as $t => $c): 
            $icon = isset($icons[$t]) ? $icons[$t] : 'folder.svg';
            $active = (isset($_GET['table']) && $_GET['table']==$t) ? 'active' : '';
        ?>
                <a href="Admin.php?table=<?= $t ?>" class="<?= $active ?>">
                    <img src="bootstrap-icons-1.13.1/<?= $icon ?>" width="20">
                    <?= ucfirst(str_replace("_"," ", $t)) ?>
                </a>
                <?php endforeach; ?>
            </div>

            <div class="sidebar-bottom1">
                <hr>
                <br>
                <div class="sidebar-bottom2">
                    <a href="logout.php">
                    <img src="bootstrap-icons-1.13.1/box-arrow-right.svg" width="20"> Logout
                   </a>
                </div>
            </div>
        </div>
    </div>

    <main class="content">
        <div class="content-header">
            <h1>View <?= ucfirst(str_replace("_"," ",$table)) ?> Details</h1>
            <a href="Admin.php?table=<?= $table?>" class="btn-back">← Back</a>
        </div>

        <div class="detail-card">
            <div class="detail-header">
                <h2>Record ID: #<?= $row['id'] ?></h2>
            </div>

            <div class="detail-grid">
                <?php foreach($row as $key => $value): ?>
                <div class="detail-item">
                    <div class="detail-label"><?= ucfirst(str_replace("_", " ", $key)) ?></div>
                    <div class="detail-value"><?= htmlspecialchars($value) ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        
    </main>
    

</body>
</html>