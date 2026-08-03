<?php
session_start();
include 'config.php';

$error = '';

// If already logged in, go to admin
if(isset($_SESSION['super_admin'])){
    header("Location: Admin.php");
    exit();
}

// Handle login
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Check username in admins table
    $query = $conn->query("SELECT * FROM super_admin WHERE username = '$username' LIMIT 1");
    
    if($query && $query->num_rows == 1){
        $admin = $query->fetch_assoc();
        
        // CHECK 1: Plain password - for testing
        if($password == $admin['password']){ 

        // CHECK 2: For production use hashed passwords instead:
        // if(password_verify($password, $admin['password'])){ 

            $_SESSION['super_admin'] = $admin['id'];
            $_SESSION['super_admin_name'] = $admin['Name'];
            $_SESSION['super_admin_username'] = $admin['username'];
            header("Location: Admin.php?login=success");
            exit();
        } else {
            $error = "Invalid Username or Password";
        }
    } else {
        $error = "Invalid Username or Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Super Admin Login</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --bg-dark: #0a192f; --bg-card: #112240; --bg-hover: #1e3a5f;
    --accent: #64ffda; --accent-hover: #52e0c4;
    --text-primary: #e6f1ff; --text-secondary: #8892b0;
    --danger: #ff6b6b;
}
* { margin:0; padding:0; box-sizing:border-box; }
body { 
    font-family: 'Inter', sans-serif; 
    background: linear-gradient(135deg, #0a192f 0%, #112240 100%);
    color: var(--text-primary); 
    display:flex; justify-content:center; align-items:center; 
    height:100vh; 
}
.login-box {
    background: var(--bg-card);
    border: 1px solid var(--bg-hover);
    border-radius: 16px;
    padding: 40px 35px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    text-align: center;
}
.login-box .logo {
    font-size: 28px;
    font-weight: 700;
    color: var(--accent);
    margin-bottom: 10px;
}
.login-box .subtitle {
    color: var(--text-secondary);
    margin-bottom: 30px;
    font-size: 14px;
}
.input-group {
    text-align: left;
    margin-bottom: 20px;
}
.input-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-secondary);
    margin-bottom: 8px;
    text-transform: uppercase;
}
.input-group input {
    width: 100%;
    padding: 14px 16px;
    background: var(--bg-hover);
    border: 1px solid var(--bg-hover);
    border-radius: 8px;
    color: var(--text-primary);
    font-size: 15px;
    outline: none;
    transition: 0.2s;
}
.input-group input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.1);
}
.btn-login {
    width: 100%;
    padding: 15px;
    background: var(--accent);
    color: var(--bg-dark);
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
    margin-top: 10px;
}
.btn-login:hover {
    background: var(--accent-hover);
    transform: translateY(-2px);
}
.error {
    background: rgba(255,107,107,0.1);
    color: var(--danger);
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid rgba(255,107,107,0.3);
    font-weight: 500;
}
</style>
</head>
<body>

<div class="login-box">
    <div class="logo">⚡ Super Admin</div>
    <div class="subtitle">Secure access to management panel</div>

    <?php if($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="superadmin" required autocomplete="off">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn-login">Login to Panel</button>
    </form>
</div>

</body>
</html>