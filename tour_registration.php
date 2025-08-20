<?php
// Update these with your actual database credentials
$servername = "localhost";
$username = "root"; // Default for XAMPP/WAMP
$password = ""; // Default for XAMPP/WAMP
$dbname = "tour_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and trim form data
$full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
$gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$department = isset($_POST['department']) ? trim($_POST['department']) : '';
$year = isset($_POST['year']) ? implode(', ', $_POST['year']) : '';
$student_id = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';
$phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$how_do_you_know = isset($_POST['how_do_you_know']) ? trim($_POST['how_do_you_know']) : '';
$transaction_id = isset($_POST['transaction_id']) ? trim($_POST['transaction_id']) : '';

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO registrations (full_name, gender, department, year, student_id, phone_number, email, how_do_you_know, transaction_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $full_name, $gender, $department, $year, $student_id, $phone_number, $email, $how_do_you_know, $transaction_id);

// Execute the statement and check for success
if ($stmt->execute()) {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Registration Submitted</title>
        <link rel='stylesheet' href='style/style.css'>
    </head>
    <body>
        <div style='text-align:center; margin-top:50px;'>
            <h2>Registration successful!</h2>
            <p>Thank you, " . htmlspecialchars($full_name) . ", for registering.</p>
            <a href='register.html'>Back to Registration</a>
        </div>
    </body>
    </html>";
} else {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Registration Error</title>
        <link rel='stylesheet' href='style/style.css'>
    </head>
    <body>
        <div style='text-align:center; margin-top:50px;'>
            <h2>Error submitting registration</h2>
            <p>" . htmlspecialchars($stmt->error) . "</p>
            <a href='register.html'>Try Again</a>
        </div>
    </body>
    </html>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
