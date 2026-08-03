<?php
// sidebar.php
$important_cols = [
    'admins' => ['id','Name','email','phone'],
    'clients' => ['id','name','phone','email'],
    'contacts' => ['id','name','email','phone','message','status'],

    'transactions' => ['id','clients','transporter','goods'],
    'transporters' => ['id','Name','phone','email'],
    'yearly_summarry' => ['id','Number_of_Successful_Imported_Transaction',
    'Number_of_Unsuccessful_Imported_Transaction','Number_of_Imported_Transaction',
    'Number_of_Exported_Transaction','Number_of_Countries_Reached']
];

$icons = [
    'admins' => 'shield-lock-fill.svg',
    'clients' => 'people-fill.svg',
    'contacts' => 'person-lines-fill.svg',

    'transactions' => 'cash-stack.svg',
    'transporters' => 'truck-front.svg',
    'yearly_summarry' => 'graph-up.svg'
];

$current_table = $_GET['table'] ?? '';
?>
<!DOCTYPE html>
<html>

<head>
    <title>View
        <?= ucfirst($current_table) ?> Details
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        /* SIDEBAR SAME AS ADMIN */
        .sidebar {
            width: 260px;

            background: var(--bg-card);
            height: 100vh;
            position: fixed;
            padding: 30px 20px;
            border-right: 1px solid var(--bg-hover);
            border-bottom: 1px solid var(--bg-hover);
        }

        .sidebar-top h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 20px;
            font-family: 'Inter', sans-serif;
        }

        .sidebar a {
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

        .sidebar a:hover {
            background: var(--bg-hover);
            color: var(--accent);
        }

        /* CONTENT */
        .content {
            margin-left: 260px;
            padding: 30px 40px;
            width: calc(100% - 260px);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .content-header h1 {
            font-size: 28px;
            font-weight: 700;
        }

        /* DETAIL CARD */
        .card {

            background: var(--bg-card);
            border: 1px solid var(--bg-hover);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .detail-header {
            border-bottom: 1px solid var(--bg-hover);
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .detail-header h2 {
            color: var(--accent);
            font-size: 20px;
            font-weight: 600;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .detail-item {
            background: var(--bg-hover);
            padding: 15px 20px;
            border-radius: 8px;
            border-left: 3px solid var(--accent);
        }

        .form-box input:focus {
            color: #00f5ff;
        }

        .detail-label {
            font-size: 12px;
            color: var(--text-secondary);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .detail-value {
            font-size: 15px;
            color: var(--text-primary);
            font-weight: 500;
        }

        .btn-back {
            padding: 10px 18px;
            background: var(--accent);
            color: var(--bg-dark);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
        }

        .btn-back:hover {
            background: #52e0c4;
        }



        /* MAKE SVG WHITE BY DEFAULT */
        .sidebar a img {
            filter: brightness(0) invert(1);
            /* turns black svg to white */
            transition: 0.3s;
        }

        /* HOVER AND ACTIVE = GOLD */
        .sidebar a:hover,
        .sidebara.active {
            background: var(--bg-hover);
            color: gold;
        }

        .sidebar a:hover img,
        .sidebar a.active img {
            filter: invert(84%) sepia(12%) saturate(400%) hue-rotate(355deg) brightness(102%);
            /* turns to #FFB400 */
            opacity: 1;
            /* this filter turns white svg to gold */
        }

        /* LOGOUT SPECIAL */


       
    </style>
</head>

<div class="sidebar">
    <div class="sidebar-top">
        <h2>⚡ Super Admin</h2>

        <a href="Admin.php" class="<?= $current_table == '' ? 'active' : '' ?>">
            <img src="bootstrap-icons-1.13.1/0-circle.svg" width="18"> Dashboard
        </a>

        <?php foreach($important_cols as $t => $c): 
            $icon = isset($icons[$t]) ? $icons[$t] : 'folder.svg';
            $active = ($current_table == $t) ? 'active' : '';
        ?>
        <a href="Admin.php?table=<?= $t ?>" class="<?= $active ?>">
            <img src="bootstrap-icons-1.13.1/<?= $icon ?>" width="18">
            <?= ucfirst(str_replace("_"," ", $t)) ?>
        </a>
        <?php endforeach; ?>
    </div>


</div>