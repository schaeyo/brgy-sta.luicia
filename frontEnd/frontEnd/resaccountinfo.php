<?php
// filepath: c:\Users\mnava\Desktop\frontEnd\frontEnd\resaccountinfo.php
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
    $birthdate = $_POST['birthdate'] ?? null; // Use null if empty
    $email = $_POST['email'] ?? '';
    $phone_number = $_POST['phone_number'] ?? null; // Use null if empty
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

    // Build the update query dynamically
    $update_fields = [];
    if (!empty($first_name)) $update_fields[] = "first_name = '$first_name'";
    if (!empty($middle_name)) $update_fields[] = "middle_name = '$middle_name'";
    if (!empty($last_name)) $update_fields[] = "last_name = '$last_name'";
    if (!empty($name_extension)) $update_fields[] = "name_extension = '$name_extension'";
    if (!empty($birthdate)) $update_fields[] = "birthdate = '$birthdate'";
    if (!empty($email)) $update_fields[] = "email = '$email'";
    if (!empty($phone_number)) $update_fields[] = "phone_number = '$phone_number'";
    if (!empty($occupation)) $update_fields[] = "occupation = '$occupation'";
    if (!empty($residence_since)) $update_fields[] = "residence_since = '$residence_since'";
    if (!empty($house_number)) $update_fields[] = "house_number = '$house_number'";
    if (!empty($street)) $update_fields[] = "street = '$street'";
    if (!empty($barangay)) $update_fields[] = "barangay = '$barangay'";

    if (!empty($update_fields)) {
        $update_sql = "UPDATE users SET " . implode(", ", $update_fields) . " WHERE user_id = '$user_id'";

        if ($con->query($update_sql) === TRUE) {
            // Redirect to account information page after update
            header("Location: frontEnd/resident/accountInfo.php?update=success");
            exit();
        } else {
            echo "Error updating record: " . $con->error;
        }
    } else {
        echo "No fields to update.";
    }
}

$con->close();
?>