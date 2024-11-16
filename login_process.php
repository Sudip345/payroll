<?php
// Include the database connection
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_code = $_POST['employee_code'];
    $password = $_POST['password'];

    // Query to get user data by employee code
    $sql = "SELECT * FROM users WHERE `Employee Code`='$employee_code' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found
        $user = $result->fetch_assoc();
        
        // Check if the password matches
        if ($user['Password'] == $password) {  // Plain text comparison
            // Start a session and store user details
            session_start();
            $_SESSION['employee_code'] = $user['Employee Code'];
            $_SESSION['role'] = $user['Role'];
            
            // Redirect to the appropriate dashboard
            if ($user['Role'] == 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: employee_dashboard.php");
                exit();
            }
        } else {
            // Incorrect password
            echo "Incorrect password!";
        }
    } else {
        // No user found
        echo "No user found with that employee code!";
    }
}

// Close connection
$conn->close();
?>
