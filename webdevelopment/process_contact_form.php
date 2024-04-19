<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form inputs
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Bad request
        echo "Invalid email format. Please enter a valid email address.";
        exit;
    }

    // Determine subject line based on website type
    $websiteType = isset($_POST["websiteType"]) ? $_POST["websiteType"] : "";
    $subject = ($websiteType === "portfolio") ?
        "Portfolio/Professional Website Contact" : "Educational Website Contact";

    // Email content
    $to = "abbgr2@umsystem.edu"; // Change to your email address
    $subject = '=?UTF-8?B?' . base64_encode($subject) . '?='; // Subject with UTF-8 encoding
    $headers = "From: $email\r\nReply-To: $email\r\nContent-type: text/plain; charset=UTF-8";

    $body = "First Name: $firstName\n";
    $body .= "Last Name: $lastName\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        http_response_code(200); // Success
        echo "Thank you for your message. We will contact you soon!";
    } else {
        http_response_code(500); // Internal server error
        echo "Sorry, there was an error sending your message. Please try again later.";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}
?>

