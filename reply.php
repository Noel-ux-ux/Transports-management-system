<?php 
include "db.php"; 
 if (!isset($_GET['id'])) {
    echo "<script>alert('No message Found');window locariom='admin.php';</script>";
    exit();
    $id = $_GET['id'];
 }
$id = $_GET['id']; // get message id from admin.php

// Fetch that one message
$stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// When admin clicks Send Reply
if(isset($_POST['send_reply'])){
    $reply_message = $_POST['reply_message'];
    $to = $row['email'];
    $customer_name = $row['name'];
    $subject = "Re: Your message to Transgo";

    // Email headers
    $headers = "From: support@transgo.com\r\n"; // change to your company email
    $headers .= "Reply-To: support@transgo.com\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    // Email body
    $body = "
    <div style='font-family:Arial; padding:20px;'>
        <h2 style='color:#d32f2f;'>Transgo</h2>
        <p>Hi $customer_name,</p>
        <p>Thank you for contacting Transgo. Here is our response:</p>
        <div style='background:#f5f5f5; padding:15px; border-left:4px solid #d32f2f;'>
            $reply_message
        </div>
        <br><hr>
        <p><b>Your Original Message:</b></p>
        <p>".nl2br($row['message'])."</p>
    </div>";

    // Send email first
    if(mail($to, $subject, $body, $headers)){
        // If email sent, then update DB
        $update = $conn->prepare("UPDATE contacts SET status='Replied', replied_at=NOW() WHERE id=?");
        $update->bind_param("i", $id);
        $update->execute();
        
        echo "<script>alert('Reply sent to $to'); window.location = 'admin.php';</script>";
    }else{
        echo "<script>alert('Failed to send email. Check mail settings on server');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reply - Admin</title>
    <style>
        body {
            font-family: Arial;
            padding: 30px;
            background: #f9f9f9;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }

        .msg-box {
            background: #f5f5f5;
            padding: 15px;
            border-left: 4px solid #d32f2f;
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 12px 25px;
            background: #d32f2f;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #b71c1c;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reply to Customer</h2>

        <p><b>Name:</b>
            <?php echo $row['name']; ?>
        </p>
        <p><b>Email:</b>
            <?php echo $row['email']; ?>
        </p>
        <p><b>Phone:</b>
            <?php echo $row['phone']; ?>
        </p>

        <p><b>Customer Message:</b></p>
        <div class="msg-box">
            <?php echo nl2br($row['message']); ?>
        </div>

        <form method="POST">
            <label><b>Your Reply:</b></label><br>
            <textarea name="reply_message" rows="10" required
                placeholder="Type your response here..."></textarea><br><br>
            <button type="submit" name="send_reply">Send Reply & Mark as Replied</button>
        </form>
        <br>
        <a href="admin.php">← Back to Dashboard</a>
    </div>
</body>

</html>