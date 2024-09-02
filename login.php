<?php
$servername = "mysql-182496-db.mysql-182496:10022"; // Your server
$username = "admin"; // Your database username
$password = "ayRQOegK"; // Your database password
$dbname = "Login"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    
    // Execute the statement
    $stmt->execute();
    
    // Check if user exists
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Login successful!";
    } else {
        echo "Invalid username or password.";
    }
    
    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

