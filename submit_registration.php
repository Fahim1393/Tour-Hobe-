<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Default for XAMPP/WAMP
$password = ""; // Default for XAMPP/WAMP
$dbname = "tour_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data to prevent SQL injection
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $department = $conn->real_escape_string($_POST['department']);
    
    $year = isset($_POST['year']) ? implode(", ", $_POST['year']) : "";

    $student_id = $conn->real_escape_string($_POST['student_id']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $email = $conn->real_escape_string($_POST['email']);
    $how_do_you_know = $conn->real_escape_string($_POST['how_do_you_know']);
    $transaction_id = $conn->real_escape_string($_POST['transaction_id']);

    // SQL query to insert data
    $sql = "INSERT INTO registrations (full_name, gender, department, year, student_id, phone_number, email, how_do_you_know, transaction_id)
            VALUES ('$full_name', '$gender', '$department', '$year', '$student_id', '$phone_number', '$email', '$how_do_you_know', '$transaction_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Thank you for registering! Your data has been successfully stored.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>