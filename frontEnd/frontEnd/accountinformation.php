<?php
include 'db_connection.php'; 
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

// Get user details from session (assuming session has 'user_id')
$user_id = $_SESSION['user_id'];



// Fetch current user data from the database
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}

// Update the user information when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = $_POST['middle_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $name_extension = $_POST['name_extension'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $occupation = $_POST['occupation'] ?? '';
    $residence_since = $_POST['residence_since'] ?? '';
    $house_number = $_POST['house_number'] ?? '';
    $street = $_POST['street'] ?? '';
    $barangay = $_POST['barangay'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Handle the password change if needed
    if (!empty($new_password) && $new_password == $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_password_sql = "UPDATE users SET password = '$hashed_password' WHERE user_id = '$user_id'";
        $con->query($update_password_sql);
    }

    // Update user information
    $update_sql = "UPDATE users SET 
                        first_name = '$first_name', 
                        middle_name = '$middle_name', 
                        last_name = '$last_name', 
                        name_extension = '$name_extension', 
                        birthdate = '$birthdate', 
                        email = '$email', 
                        phone_number = '$phone_number', 
                        occupation = '$occupation', 
                        residence_since = '$residence_since', 
                        house_number = '$house_number', 
                        street = '$street', 
                        barangay = '$barangay'
                    WHERE user_id = '$user_id'";

if ($con->query($update_sql) === TRUE) {
    // Redirect to account information page after update
    header("Location: frontEnd/baranggay/accountinfo.php");
    exit(); // Ensure no further code is executed after the redirect
} else {
    echo "Error updating record: " . $con->error;
}
}
$con->close();
?>