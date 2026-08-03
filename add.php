<?php
session_start();
include 'config.php';
include 'sidebar.php';
if(!isset($_SESSION['super_admin']) || empty($_SESSION['super_admin'])){
    header("Location: login.php");
    exit();
}

$table = $_GET['table'] ?? 'clients';

$important_cols = [
    'admins' => ['id','Name','email','phone'],
    'clients' => ['id','name','phone','email'],
    'contacts' => ['id','name','email','phone','message','status','admin_note','replied_at','date_submitted'],

    'transactions' => ['id','tracking_number','client_id','transporter_id','service_type','origin','destination','weight_kg','amount','status','date_created','date_delivered','clients','transporter','goods'],
    'transporters' => ['id','Name','phone','email'],
    'yearly_summarry' => ['id','Number_of_Successful_Imported_Transaction','Number_of_Unsuccessful_Imported_Transaction',
    'Number_of_Imported_Transaction','Number_of_Exported_Transaction','Number_of_Countries_Reached']
];

if(!array_key_exists($table, $important_cols)){
    $table = 'clients'; 
}

$cols = $important_cols[$table];
$page_title = "Add New " . ucfirst(str_replace("_"," ", $table));

if(isset($_POST['save'])){
    $set = [];
    foreach($cols as $col){
        if($col == 'id') continue;
        $set[] = "`$col` = '".$conn->real_escape_string($_POST[$col] ?? '')."'";
    }
    $sql = "INSERT INTO `$table` SET ".implode(", ", $set);
   if($conn->query($sql)){
    // Don't use header. Use JS alert + redirect
    echo "<script>
            alert('New ". ucfirst($table) ." Added Successfully!');
            window.location.href = 'Admin.php?table=$table';
          </script>";
    exit;
} else {
    echo "<script>
            alert('Insert Failed: ". addslashes($conn->error) ."');
            window.location.href = 'add.php?table=$table';
          </script>";
    exit;
}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?= $page_title ?>
    </title>
    <link rel="stylesheet" href="index.CSS">
    <style>

        :root {
    --bg-dark: #0a192f; 
    --bg-card: #112240; 
    --bg-hover: #1e3a5f;
    --accent: #64ffda; 
    --text-primary: #e6f1ff; 
    --text-secondary: #8892b0;
}
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0d1b3f;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
        }


        /* SIDEBAR */



        /* MAIN */
        .main {
            flex: 1;
            padding: 40px 50px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .top-bar h1 {
            font-size: 24px;
            font-weight: 700;
        }

        /* BUTTONS */
        .btn-teal {
            background: #00e6d0;
            color: #000;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-teal:hover {
            background: #00bfa5;
        }

        .btn-dark {
            background: #1e2f5a;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-dark:hover {
            background: #2a3f8f;
        }

        /* CARD */
        .card {
            background: #162b5c;
            padding: 30px;
            border-radius: 12px;
            margin-top: 10px;
        }

        .card h4 {
            color: #00e6d0;
            margin-bottom: 25px;
            font-size: 15px;
            font-weight: 600;
        }

        /* FORM GRID - BIGGER INPUTS */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        /* gap increased */
        .form-box {
           background: var(--bg-card);
            background: #1e3a5f;
            padding: 15px 17px;
            /* more padding */
            border-radius: 10px;
            border-left: 3px solid var(--accent);
            /* rounder */
            min-height: 75px;
            /* taller box */
        }

        .form-box label {
            display: block;
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 10px;
            /* more space */
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .form-box input {
            width: 100%;
            background: transparent;
            border: none;
            color: #fff;
            font-size: 16px;
            /* bigger text */
            outline: none;
            font-weight: 600;
            padding: 4px 0;
            /* input breathing space */
        }

        .form-box input:focus {
            outline: none;
            box-shadow: none;
        }

        /* NO FOCUS */

        .form-actions {
            margin-top: 30px;
            display: flex;
            gap: 12px;
        }

.card {
    background: var(--bg-card); 
    border: 1px solid var(--bg-hover); 
    border-radius:12px; 
    padding:30px; 
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
}

.sidebar-bottom1 {
margin-top: auto;
padding-top:402px;
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

        /* MAKE SVG WHITE BY DEFAULT */

        /* HOVER AND ACTIVE = GOLD */



        /* LOGOUT SPECIAL */
    </style>
</head>

<body>
    <div class="wrapper">

        <!-- ===== SIDEBAR START - COPY THIS TO ALL PAGES ===== -->
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
    <!-- ===== SIDEBAR END ===== -->


    <div class="content">
        <div class="top-bar">
            <h1>
                <?= $page_title ?>
            </h1>
            <a href="Admin.php?table=<?= $table ?>" class="btn-teal">← Back</a>
        </div>

        <div class="card">
            <h4>New Record</h4>
            
  <form method="POST">
    <div class="form-grid">
    <?php foreach($cols as $col):
        if($col == 'id') continue;
        $val = $_POST[$col] ?? '';
    ?>
        <div class="form-box">
            <label><?= strtoupper(str_replace("_"," ", $col)) ?></label>
            <input type="text" name="<?= $col ?>" value="<?= htmlspecialchars($val) ?>" class="form-control" required>
        </div>
    <?php endforeach; ?>
</div>
    <div class="form-actions">
        <button type="submit" name="save" class="btn-teal">Save Changes</button>
        <a href="Admin.php?table=<?= $table ?>" class="btn-dark">Cancel</a> <!-- Changed to <a> not button -->
    </div>
</form>
            </form>
        </div>
    </div>

    </div>
</body>

</html>