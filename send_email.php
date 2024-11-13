<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Email settings
    $to = "phoenix.inquire@gmail.com";
    $subject = "New Inquiry from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n" .
               "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        // Success - show thank you message
        $message_sent = true;
    } else {
        // Failure - show error message
        $message_sent = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Phoenix Consulting</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<!-- The Form Section (same as before) -->
<section class="wrapper style1 align-center">
    <div class="inner medium">
        <h2>Get in Touch</h2>

        <!-- Check if the message was sent successfully -->
        <?php if (isset($message_sent) && $message_sent === true): ?>
            <p class="success-message" style="color: green;">Thank you for reaching out! We have received your message and will get back to you shortly.</p>
        <?php elseif (isset($message_sent) && $message_sent === false): ?>
            <p class="error-message" style="color: red;">Oops! Something went wrong. Please try again later.</p>
        <?php endif; ?>

        <!-- The form -->
        <form method="post" action="send_email.php">
            <div class="fields">
                <div class="field half">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" id="name" required />
                </div>
                <div class="field half">
                    <label for="email">Your Email</label>
                    <input type="email" name="email" id="email" required />
                </div>
                <div class="field">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="6" required></textarea>
                </div>
            </div>
            <ul class="actions special">
                <li><input type="submit" name="submit" id="submit" value="Send Message" /></li>
            </ul>
        </form>
    </div>
</section>

</body>
</html>
