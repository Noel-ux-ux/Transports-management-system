<?php include "config.php"; ?>

<?php
$msg = "";
if(isset($_POST['submit'])){
    $service_type = $conn->real_escape_string($_POST['service_type']);
    $goods = $conn->real_escape_string($_POST['goods']);
    $origin = $conn->real_escape_string($_POST['origin']);
    $destination = $conn->real_escape_string($_POST['destination']);

    $sql = "INSERT INTO `transactions` (`service_type`, `goods`, `origin`, `destination`, `status`, `date_created`) 
            VALUES ('$service_type', '$goods', '$origin', '$destination', 'pending', NOW())";

    if ($conn->query($sql) === TRUE){
        $msg = "<div class='alert success'>Request Submitted Successfully!</div>";
    }else{
        $msg = "<div class='alert error'>Db Error: ". $conn->error ."</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaction - Transport Management</title>
<script src="INDEX.JS"> defer </script>
<style>
    * {
        margin: 0; /* KEY FIX 1: remove default margin */
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    html, body {
        height: 100%;
        background: #f4f6f9;
    }
    .wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .content {
        flex: 1;
        padding: 40px 20px; /* KEY FIX 2: no top padding so navbar touches top */
    }

    /* NAVBAR - FLUSH TOP */
    .navbar {
        background: #0a1a3a;
        padding: 18px 0;
        text-align: center;
        width: 100%; /* KEY FIX 3: full width */
        position: relative;
        top: 0;
        left: 0;
    }
    .navbar a {
        color: white;
        text-decoration: none;
        margin: 0 25px;
        font-weight: 600;
        font-size: 16px;
        padding-bottom: 5px;
        transition: 0.3s;
    }
    .navbar a:hover, .navbar a.active {
      color: #d7ecff;
    border-bottom: 3px solid #ffdede;
    }

    /* FORM CARD */
    .form-container {
        max-width: 500px;
        margin: 0 auto; /* center */
        background: #00a8ff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        color: #fff;
    }
    .form-container h2 {
        text-align: left;
        margin-bottom: 20px;
        color: #0a1a3a;
        font-size: 22px;
    }
    .form-group { margin-bottom: 18px; }
    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #0a1a3a;
    }
    .form-group input, .form-group select {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        outline: none;
    }
    .btn-submit {
        width: 100%;
        padding: 14px;
        background: #ff4d4d;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-submit:hover { background: #e63939; }

    /* ALERT */
    .alert {
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 15px;
        text-align: center;
        font-weight: 600;
    }
    .alert.success { background: #2ecc71; color: white; }
    .alert.error { background: #e74c3c; color: white; }

    /* FOOTER - FLUSH BOTTOM */
    .footer {
        background: #0a1a3a;
        color: white;
        text-align: center;
        padding: 30px 0;
        width: 100%; /* KEY FIX 4: full width */
    }
    .footer h3 { margin-bottom: 15px; font-size: 18px; }
    .social-icons span {
        display: inline-block;
        width: 35px;
        height: 35px;
        border: 2px solid #ccc;
        border-radius: 50%;
        margin: 0 8px;
        cursor: pointer;
        transition: 0.3s;
    }
    .social-icons span:hover {
        border-color: #00a8ff;
        background: #00a8ff;
    }

    #preloader {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 18px;
}

.loader-logo {
    width: 90px;
    height: auto;
}

.spinner {
    width: 42px;
    height: 42px;
    border: 4px solid #ffb7b7;
    border-top-color: #ff0d0d;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

</style>
</head>
<body>

<!-- PRELOADING EFFECT-->
    <div id="preloader">
       
        <div class="spinner"></div>
    </div>

<div class="wrapper">

    <!-- NAVBAR OUTSIDE CONTENT SO IT TOUCHES TOP -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="Transaction.php" class="active">Testimonials</a>
        <a href="contact.php">Contact</a>
    </div>

    <div class="content">
        <!-- FORM -->
        <div class="form-container">
            <h2>Transaction Form</h2>
            <?php echo $msg; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Type Of Service</label>
                    <select name="service_type" required>
                        <option value="">Select Service</option>
                        <option value="Export">Export</option>
                        <option value="Import">Import</option>
                        <option value="Local Delivery">Local Delivery</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Name of Goods</label>
                    <input type="text" name="goods" placeholder="eg Garri" required>
                </div>
                <div class="form-group">
                    <label>Sending From</label>
                    <input type="text" name="origin" placeholder="eg Douala port" required>
                </div>
                <div class="form-group">
                    <label>To</label>
                    <input type="text" name="destination" placeholder="eg New York" required>
                </div>
                <button type="submit" name="submit" class="btn-submit">Submit Request</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    <footer class="footer">
        <h3>You Can Find Us On</h3>
        <div class="social-icons">
            <span></span><span></span><span></span><span></span><span></span>
        </div>
    </footer>
</div>

</body>
</html>