<?php
// MySQL connection settings
$host = 'localhost';
$db = 'portfolio';
$user = 'root';      // Default user for XAMPP/WAMP
$pass = '';          // Leave empty if no password is set

// Connect to database
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$message = htmlspecialchars(trim($_POST['message']));

// Prepare SQL statement
$sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

// Execute and check
if ($stmt->execute()) {
    echo "<script>alert('Message sent successfully!'); window.location.href='index.html';</script>";
} else {
    echo "<script>alert('Error: Could not save your message.'); window.location.href='index.html';</script>";
}

// Close connection
$stmt->close();
$conn->close();
?>
