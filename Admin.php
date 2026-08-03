<?php
session_start();
include 'config.php';

// 1. FORCE LOGIN
if(!isset($_SESSION['super_admin']) || empty($_SESSION['super_admin'])){
    header("Location: login.php");
    exit();
}

// 2. YOUR IMPORTANT COLUMNS
$important_cols = [
    'admins' => ['id', 'Name','phone'],
    'clients' => ['id', 'Name','phone'],
    'contacts' => ['id', 'name','phone',],
  
    'transactions' => ['id', 'clients','goods'],
    'transporters' => ['id', 'Name','phone'],
    'yearly_summarry' => ['id', 'Number_of_Imported_Transaction', 'Number_of_Exported_Transaction']
];

// 3. AUTO LOAD ALL TABLES FROM DB
$tables_result = $conn->query("SHOW TABLES");
$all_tables = [];
while($row = $tables_result->fetch_array()){
    $all_tables[] = $row[0];
}
foreach($all_tables as $t){
    if(!array_key_exists($t, $important_cols)){
        $important_cols[$t] = [];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Super Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons-1.13.1/font/bootstrap-icons.min.css">
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

        .bi {
            display: inline-block;
            vertical-align: middle;
        }

        .sidebar nav a {
            display: flex:align-items:center;
            gap: 10px
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            display: flex;
        }

        /* SIDEBAR WITH LOGOUT AT BOTTOM */
        .sidebar {
            width: 260px;
            background: var(--bg-card);
            height: 100vh;
            position: fixed;
            padding: 30px 20px;
            border-right: 1px solid var(--bg-hover);
             border-right: 1px solid var(--bg-hover);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
        }

        .logo {
            font-size:20px; 
            font-weight:700; 
            color:var(--accent); 
            margin-bottom:20px; 
        }

        .sidebar-top.user {
            color: var(--text-secondary);
            font-size: 13px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--bg-hover);
        }

        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 8px;
            margin: 4px 0;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            transition: 0.2s;
            font-size: 14px;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active {
            background: var(--bg-hover);
            color: var(--accent);
        }

        .sidebar-bottom1 {
            margin-top: auto;
            padding-top: 20px;
           
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

        /* CONTENT */
        .content {
            margin-left: 260px;
            padding: 30px 40px;
            width: calc(100% - 260px);
        }

        .content-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .welcome {
            background: linear-gradient(90deg, var(--bg-card), var(--bg-hover));
            color: var(--accent);
            padding: 18px 25px;
            border-radius: 12px;
            border-left: 4px solid var(--accent);
            margin-bottom: 25px;
            font-weight: 600;
        }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--bg-hover);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th {
            background: var(--bg-hover);
            color: var(--accent);
            padding: 14px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--bg-hover);
            font-size: 13px;
        }

        tr:hover {
            background: rgba(100, 255, 218, 0.05);
        }

        .btn {
            padding: 7px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            font-size: 12px;
            margin-right: 5px;
            display: inline-block;
        }

        .btn-view {
            background: var(--info);
            color: #fff;
        }

        .btn-view:hover {
            background: #4090ff;
        }

        .btn-edit {
            background: var(--accent);
            color: var(--bg-dark);
        }

        .btn-edit:hover {
            background: var(--accent-hover);
        }

        .btn-delete {
            background: var(--danger);
            color: #fff;
        }

        .btn-delete:hover {
            background: #ff5252;
        }

        .empty {
            color: var(--text-secondary);
            text-align: center;
            padding: 40px;
        }

        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
            /* make text white */
        }

        .sidebar nav a img {
            filter: brightness(0) invert(1);
            /* turns black SVG to white */
            width: 20px;
            height: 20px;
            opacity: 0.8;
            transition: 0.3s;
        }

        /* Active + Hover = Gold icons + text */
        .sidebar nav a:hover,
        .sidebar nav a.active {
            color: gold;
        }

        .sidebar nav a:hover img,
        .sidebar nav a.active img {
            filter: invert(84%) sepia(12%) saturate(400%) hue-rotate(355deg) brightness(102%);
            /* turns to #FFB400 */
            opacity: 1;
        }

        .content-header {
            display: flex;
            flex-direction: column;
            /* stack H1 and button */
            align-items: flex-start;
            /* push everything left */
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn-add {
            background: var(--accent);
            color: #000;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-add:hover {
            background: #e6a300;
            transform: translateY(-2px);
        }

    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-top">
            <div>
                <div class="logo">⚡ Super Admin</div>
                <div class="user">
                    <?= htmlspecialchars($_SESSION['super_admin_name'])?>
                </div>
            </div>
            <nav>

                <a href="Admin.php" class="<?=!isset($_GET['table'])? 'active' : ''?>">
                    <img src="bootstrap-icons-1.13.1/0-circle.svg" width="18"> Dashboard
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
    
    foreach($important_cols as $table => $cols):
        $icon = isset($icons[$table]) ? $icons[$table] : 'folder.svg'; 
    ?>
                <a href="Admin.php?table=<?= $table?>"
                    class="<?= (isset($_GET['table']) && $_GET['table']==$table)? 'active' : ''?>">
                    <img src="bootstrap-icons-1.13.1/<?= $icon ?>" width="18">
                    <?= ucfirst(str_replace("_"," ",$table))?>
                </a>
                <?php endforeach;?>

            </nav>
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

    <div class="content">
        <div class="content-header">
            <h1>
                <?= isset($_GET['table'])? ucfirst(str_replace("_"," ",$_GET['table'])) : 'Dashboard'?>
            </h1>

            <?php if(isset($_GET['table'])): 
        $table = $_GET['table'];
        $singular = ucfirst(rtrim($table,'s')); // clients -> Client
    ?>
            <a href="add.php?table=<?= $table ?>" class="btn-add">+ Add New
                <?= $singular ?>
            </a>
            <?php endif; ?>
        </div>




        <?php if(isset($_GET['login']) && $_GET['login'] == 'success'):?>
        <div class="welcome">✅ Welcome back Super Admin
            <?= htmlspecialchars($_SESSION['super_admin_name'])?>!
        </div>
        <?php endif;?>

        <div class="card">
            <?php
    if(isset($_GET['table']) && array_key_exists($_GET['table'], $important_cols)){
        $table = $conn->real_escape_string($_GET['table']);
        $cols_config = $important_cols[$table];

        if(!empty($cols_config)){ $cols = $cols_config; }
        else {
            $cols = [];
            $col_result = $conn->query("SHOW COLUMNS FROM `$table`");
            while($c = $col_result->fetch_assoc()){ $cols[] = $c['Field']; }
        }

        $primary_key = $cols[0];
        $col_list = "`".implode("`,`", $cols)."`";
        $result = $conn->query("SELECT $col_list FROM `$table` ORDER BY `$primary_key` DESC LIMIT 300");

        if($result && $result->num_rows > 0){
            echo "<table><tr>";
            foreach($cols as $col){ echo "<th>".ucfirst(str_replace("_"," ",$col))."</th>"; }
            echo "<th>Actions</th></tr>";
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                foreach($cols as $col){ echo "<td>".htmlspecialchars($row[$col])."</td>"; }
                echo "<td>
                        <a href='view.php?table=$table&id=".$row[$primary_key]."' class='btn btn-view'>Details</a>
                        <a href='edit.php?table=$table&id=".$row[$primary_key]."' class='btn btn-edit'>Edit</a>
                        <a href='delete.php?table=$table&id=".$row[$primary_key]."' class='btn btn-delete' onclick=\"return confirm('Delete this record?')\">Delete</a>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else { echo "<p class='empty'>No records found in <b>$table</b></p>"; }
    } else { echo "<p class='empty'>Select a table from the sidebar to manage data.</p>"; }
?>
        </div>
    </div>
</body>

</html>