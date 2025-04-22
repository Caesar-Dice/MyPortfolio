<?php
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
    echo json_encode(array('error' => true, 'message' => 'Please fill in all fields'));
    exit;
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Email recipient - CHANGE THIS TO YOUR EMAIL ADDRESS
$to = "pelaez065@gmail.com";

// Email headers
$headers = "From: " . $name . " <" . $email . ">\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Email content
$email_content = "
<html>
<head>
    <title>Contact Form Message</title>
</head>
<body>
    <h2>Contact Form Message</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>Subject:</strong> {$subject}</p>
    <p><strong>Message:</strong></p>
    <p>" . nl2br($message) . "</p>
</body>
</html>
";

// Send email
$success = mail($to, "New Contact Form Message: $subject", $email_content, $headers);

if ($success) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('error' => true, 'message' => 'Could not send mail! Please try again later.'));
}
?>
