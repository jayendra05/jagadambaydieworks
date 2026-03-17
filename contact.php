<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $name    = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mobile  = htmlspecialchars(trim($_POST["mobile"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate inputs
    if (empty($name) || empty($email) || empty($mobile) || empty($message)) {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.history.back();</script>";
        exit;
    }

    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo "<script>alert('Invalid mobile number!'); window.history.back();</script>";
        exit;
    }

    // Email details
    $to = "jayendra05mishra@gmail.com";   // Change if needed
    $subject = "New Contact Form Message from $name";

    $body = "You have received a new message:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Mobile: $mobile\n\n";
    $body .= "Message:\n$message\n";

    // Headers
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send mail
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('✅ Message sent successfully!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('❌ Failed to send message. Try again later.'); window.history.back();</script>";
    }

} else {
    echo "<script>alert('Invalid Request'); window.location.href='contact.html';</script>";
}

?>