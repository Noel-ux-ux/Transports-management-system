<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us - TRNSGO</title>
    <link rel="stylesheet" href="index.css">
    <script src="INDEX.JS"> defer </script>
    <style>#preloader {
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
    border: 4px solid #ffc1c1;
    border-top-color: #ff0000;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.v a {
    color: #ffffff;
    font-size: clamp(0.9rem, 2vw, 1.05rem);
    font-weight: 600;
    padding: 8px 4px;
    transition: color 0.3s ease, border-bottom 0.3s ease;
}

.v a:hover {
    color: #d7ecff;
    border-bottom: 3px solid #ffdede;
}
</style>
</head>

<body>

<!-- PRELOADING EFFECT-->
    <div id="preloader">
       
        <div class="spinner"></div>
    </div>
    <!-- 1. NAVBAR - Same as About -->
    <header style="background:#0b1e33;
    margin: auto;
    min-height: 75px;
    display: flex;
    align-items: center;
    justify-content: center;">

         <section class="hdd">
        <div class="header">


            <nav class="navbar">
                <div class="op">
                    <div class="v"><a href="index.php">Home</a></div>
                    <div class="v"> <a href="about.php">About</a></div>
                    <div class="v"> <a href="testimonials.php"> Testimonials</a></div>
                    <div class="v"><a href="contact.php">Contact</a></div>
                </div>
            </nav>
        </div>
    </section>
    </header>

    <!-- 2. BANNER - Same as About with ship image -->
    <section
        style="background:url('img/feature.jpg') no-repeat center/cover; height:300px; display:flex; align-items:center; justify-content:center; position:relative;">
        <div style="background:rgba(0,0,0,0.5); position:absolute; top:0; left:0; width:100%; height:100%;"></div>
        <h1 style="color:#fff; font-size:48px; position:relative; z-index:2;">
            CONTACT <span style="color:#ff4500;">US</span>
        </h1>
    </section>

    <!-- 3. CONTENT SECTION - White background -->
    <section style="background:#f5f5f5; padding:60px 20px;">
        <div
            style="max-width:800px; margin:0 auto; background:#fff; padding:40px; border-radius:8px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">

            <h3 style="color:#ff4500; text-align:center; margin-bottom:5px;">GET IN TOUCH</h3>
            <h2 style="text-align:center; margin-bottom:20px;">We Are Always Ready To Serve You</h2>
            <p style="text-align:center; color:#666; margin-bottom:30px;">
                Have questions about our transportation and logistics services? Send us a message.
            </p>

            <?php 
        if(isset($_POST['send'])){
            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $phone = $conn->real_escape_string($_POST['phone']);
            $message = $conn->real_escape_string($_POST['message']);
            $conn->query("INSERT INTO contacts (name, email, phone, message, status, date_submitted) VALUES ('$name','$email','$phone','$message','new',NOW())");
            echo "<p style='background:#d4edda; color:#155724; padding:12px; border-radius:5px; text-align:center;'>✅ Thank you! We will get back to you soon.</p>";
        }
        ?>

            <form method="POST">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                    <input type="text" name="name" placeholder="Your Name *" required
                        style="padding:12px; border:1px solid #ddd; border-radius:5px;">
                    <input type="email" name="email" placeholder="Your Email *" required
                        style="padding:12px; border:1px solid #ddd; border-radius:5px;">
                </div>
                <input type="text" name="phone" placeholder="Your Phone"
                    style="width:100%; padding:12px; border:1px solid #ddd; border-radius:5px; margin-bottom:20px;">
                <textarea name="message" placeholder="Your Message *" rows="6" required
                    style="width:100%; padding:12px; border:1px solid #ddd; border-radius:5px; margin-bottom:20px;"></textarea>
                <button type="submit" name="send"
                    style="background:#ff4500; color:#fff; padding:14px 30px; border:none; border-radius:5px; cursor:pointer; font-size:16px; width:100%;">
                    Send Message
                </button>
            </form>

        </div>
    </section>

    <!-- 4. FOOTER - Same as About -->
    <footer style="  background: #0b1e33;
    color: #ffffff;
    padding: 35px 20px;
    text-align: center;">
        <p style="margin-bottom:15px;">You Can Find Us On</p>
        <div>
            <a href="#"
                style="display:inline-block; width:35px; height:35px; border:1px solid #fff; border-radius:50%; margin:0 5px;"></a>
            <a href="#"
                style="display:inline-block; width:35px; height:35px; border:1px solid #fff; border-radius:50%; margin:0 5px;"></a>
            <a href="#"
                style="display:inline-block; width:35px; height:35px; border:1px solid #fff; border-radius:50%; margin:0 5px;"></a>
            <a href="#"
                style="display:inline-block; width:35px; height:35px; border:1px solid #fff; border-radius:50%; margin:0 5px;"></a>
            <a href="#"
                style="display:inline-block; width:35px; height:35px; border:1px solid #fff; border-radius:50%; margin:0 5px;"></a>
        </div>
    </footer>

</body>

</html>