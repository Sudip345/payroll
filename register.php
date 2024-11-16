<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
// Include the database connection
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_code = $_POST['employee_code'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if the employee code already exists
    $sql_check = "SELECT * FROM users WHERE `Employee Code`='$employee_code'";
    $result = $conn->query($sql_check);
    
    if ($result->num_rows > 0) {
        // Employee code already exists
        echo "Employee code already taken. Please choose another one.";
    } else {
        // Insert the new user into the database (without the ID field since it auto increments)
        $sql = "INSERT INTO users (`Employee Code`, `Password`, `Role`) VALUES ('$employee_code', '$password', '$role')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New user registered successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>
