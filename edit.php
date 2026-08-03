<?php
include 'config.php'; // your db connection
include 'sidebar.php';

$table = $_GET['table'] ?? '';
$id = intval($_GET['id'] ?? 0);

$important_cols = [
    'admins' => ['id','Name','phone','email'],
    'clients' => ['id','name','phone','email'],
    'contacts' => ['id','name','email','phone','message','status','admin_note','replied_at','date_submitted'],
   
    'transactions' => ['id','tracking_number','client_id','transporter_id','service_type','origin','destination','weight_kg','amount','status','date_created','date_delivered','clients','transporter','goods'],
    'transporters' => ['id','Name','phone','email'],
    'yearly_summarry' => ['id','Number_of_Successful_Imported_Transaction','Number_of_Unsuccessful_Imported_Transaction','Number_of_Successful_Imported_Transaction' ],
];

if(!array_key_exists($table, $important_cols)) die("Invalid table");
$cols = $important_cols[$table];

$stmt = $conn->prepare("SELECT * FROM `$table` WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
if(!$data) die("Record not found");

// Handle Update
if(isset($_POST['update'])){
    $set = [];
    foreach($cols as $col){
        if($col == 'id') continue;
        $set[] = "`$col` = '". $conn->real_escape_string($_POST[$col]) ."'";
    }
    $sql = "UPDATE `$table` SET ".implode(", ", $set)." WHERE id = $id";
    if($conn->query($sql)){
        echo "<script>alert('Updated successfully'); window.location = 'view.php?table=$table&id=$id';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit
        <?= ucfirst(rtrim($table,'s')) ?> Details
    </title>
    <style>
        
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family: 'Inter', sans-serif; background: var(--bg-dark); color: var(--text-primary); display:flex; }

       
        .wrapper { display: flex; min-height: 100vh; }

        .container {
            display: flex;
        }


        .main-content {
            flex: 1;
            padding: 30px 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 26px;
            font-weight: 700;
        }

        .btn-back {
            background: #00f5ff;
            color: #000;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
        }

        .btn-back:hover {
            background: #52e0c4;
        }

        .card {
            background: linear-gradient(145deg, #13203a, #0f1a30);
            border: 1px solid #1e2d52;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 245, 255, 0.05);
        }

        .card h3 {
            color: #00f5ff;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .field {
            background: #1a2a4a;
            border: 1px solid #2a3d66;
            border-left: 3px solid #00f5ff;
            padding: 14px 16px;
            border-radius: 8px;
        }

        .field label {
            display: block;
            font-size: 12px;
            color: #8aa0d1;
            text-transform: uppercase;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }

        .field input {
            width: 100%;
            background: transparent;
            border: none;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            outline: none;
        }

        .field input:focus {
            color: #00f5ff;
        }

        .btn-group {
            margin-top: 25px;
            display: flex;
            gap: 12px;
        }

        .btn-save:hover {
            background: #52e0c4;
        }

        .btn-save {
            background: linear-gradient(90deg, #00f5ff, #00c8ff);
            color: #000;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-cancel {
            background: #1a2342;
            color: #fff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            border: 1px solid #2a3d66;
        }

        .btn-cancel:hover {
            border-radius: 1px solid #00f5ff;
        }

        /* SIDEBAR */
     

       

        

        /* MAIN */
       

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
            background: #1e3a73;
            padding: 18px 20px;
            /* more padding */
            border-radius: 10px;
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
    <!-- ===== SIDEBAR END ===== -->

    <main class="content">
        <div class="header">
            <h1>Edit
                <?= ucfirst(rtrim($table,'s')) ?> Details
            </h1>
            <a href="view.php?table=<?= $table ?>&id=<?= $id ?>" class="btn-back">← Back</a>
        </div>

        <div class="card">
            <h3>Record ID: #
                <?= $id ?>
            </h3>
            <form method="POST">
                <div class="form-grid">
                    <?php foreach($cols as $col): 
    $value = isset($data[$col]) ? $data[$col] : ''; 
?>
                    <div class="field">
                        <label>
                            <?= strtoupper(str_replace("_"," ",$col)) ?>
                        </label>
                        <?php if($col == 'id'): ?>
                        <input type="text" value="<?= htmlspecialchars($value) ?>" readonly>
                        <?php else: ?>
                        <input type="text" name="<?= $col ?>" value="<?= htmlspecialchars($value) ?>">
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>

                    <div class="btn-group">
                        <button type="submit" name="update" class="btn-save">Save Changes</button>
                        <a href="view.php?table=<?= $table ?>&id=<?= $id ?>" class="btn-cancel">Cancel</a>

                    </div>
            </form>
        </div>
    </main>
    </div>
</body>

</html>