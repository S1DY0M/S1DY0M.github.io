<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. Please enter a valid email address.";
        exit;
    }

    // Determine subject line based on website type
    $subject = isset($_POST["websiteType"]) && $_POST["websiteType"] === "portfolio" ?
        "Portfolio/Professional Website Contact" : "Educational Website Contact";

    // Email content
    $to = "abbgr2@umsystem.edu";
    $body = "First Name: $firstName\n";
    $body .= "Last Name: $lastName\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message\n";

    // Send email
    if (mail($to, $subject, $body)) {
        echo "Thank you for your message. We will contact you soon!";
    } else {
        echo "Sorry, there was an error sending your message. Please try again later.";
    }
}
?>
