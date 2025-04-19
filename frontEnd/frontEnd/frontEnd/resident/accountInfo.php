<?php
session_start();

// Include the database connection file
include '../../db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /frontEnd/login/signin.php");
    exit;
}

// Check if the database connection is established
if (!$con) {
    die("Database connection failed.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and sanitize
    $user_id = $_SESSION['user_id'];
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($con, $_POST['middle_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $name_extension = mysqli_real_escape_string($con, $_POST['name_extension']);
    $birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
    $civil_status = mysqli_real_escape_string($con, $_POST['civil_status']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
    $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
    $residence_since = mysqli_real_escape_string($con, $_POST['residence_since']);
    $house_address = mysqli_real_escape_string($con, $_POST['house_address']);
    $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
    
    // Check if a profile picture is uploaded
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
        $profile_image = basename($_FILES['profilePic']['name']);
        $upload_dir = 'profile_photo/';
        $upload_file = $upload_dir . $profile_image;
        
        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $upload_file)) {
            // File uploaded successfully, update user profile image
        } else {
            $profile_image = $user['profile_image']; // Use the existing profile image if upload fails
        }
    } else {
        $profile_image = $user['profile_image']; // Use the existing profile image if no new file uploaded
    }

    // Update user information in the database
    $query = "UPDATE users SET
                first_name = '$first_name',
                middle_name = '$middle_name',
                last_name = '$last_name',
                name_extension = '$name_extension',
                birthdate = '$birthdate',
                civil_status = '$civil_status',
                email = '$email',
                gender = '$gender',
                phone_number = '$phone_number',
                occupation = '$occupation',
                residence_since = '$residence_since',
                house_address = '$house_address',
                barangay = '$barangay',
                profile_image = '$profile_image'
              WHERE user_id = $user_id";

    if (mysqli_query($con, $query)) {
        // After successful update, redirect with 'saved' status
        header('Location: accountInfo.php?status=saved');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

// Fetch user details for display
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Bayanihan Hub - Account Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../public/css/home.css" />
</head>
<body>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="mt-5">
    <a href="accountInfo.php" class="active p-2"><i class="bi bi-person-circle mx-3"></i>Hi, <?php echo htmlspecialchars($user['first_name']); ?></a>
    <a href="resident_dashboard.php"><i class="bi bi-house-door"></i> Home</a>
    <a href="submitReqForm.php"><i class="bi bi-file-earmark-check"></i> Submit Request</a>
    <a href="reportEmergency.php"><i class="bi bi-clipboard-check"></i> Report Emergencies</a>
    <a href="viewAnnouncements.php"><i class="bi bi-people"></i> View Announcements</a>
    <a href="bookAppointment.php"><i class="bi bi-megaphone"></i> Appointments</a>
    <a href="notifications.php"><i class="bi bi-exclamation-triangle"></i> Notifications</a>
    <a href="submitFeedback.php"><i class="bi bi-chat-dots"></i> Submit Feedback</a>
    <a href="../../signin.php" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
</div>

<!-- Toggle Button -->
<button class="toggle-btn" id="toggleBtn" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>

<!-- Header -->
<div class="text-light" style="background-color: #001a4f">
  <div class="container brand-header">
    <img src="../media/logo2.png" alt="Bayanihan Hub Logo" width="90" height="90" style="border-radius: 50%;" />
    <h3 class="mx-3 mt-2">Bayanihan Hub</h3>
  </div>
</div>
    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center">
            <h3>Are you sure you want to log out?</h3>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button
              type="button"
              class="btn btn-secondary px-4 text-center"
              data-bs-dismiss="modal"
            >
              Cancel
            </button>
            <a
              href="../login/signin.php"
              class="btn btn-danger text-center px-4 ms-3"
            >
              Yes, Logout
            </a>
          </div>
        </div>
      </div>
    </div>

<!-- Main Content -->
<main class="container mt-4">
  <h2>My Account Information</h2>
  <form action="accountInfo.php" method="POST" enctype="multipart/form-data">
    <div class="row align-items-start">
      <!-- Profile Section -->
      <div class="col-md-3 text-center">
        <label for="profilePic">Choose Profile</label>
        <div class="border rounded p-3">
          <?php if (!empty($user['profile_image'])): ?>
            <img src="profile_photo/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Picture" style="width:150px; height:150px; border-radius:50%;">
          <?php else: ?>
            <img src="default.jpg" alt="Default Profile Picture" style="width:150px; height:150px; border-radius:50%;">
          <?php endif; ?>
        </div>
        <div class="mt-3">
          <label for="profilePic" class="form-label">Upload New Profile Picture</label>
          <input class="form-control" type="file" id="profilePic" name="profilePic">
        </div>
      </div>

      <!-- Personal Information -->
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-3">
            <label>First Name *</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" />
          </div>
          <div class="col-md-3">
            <label>Middle Name</label>
            <input type="text" class="form-control" name="middle_name" value="<?php echo htmlspecialchars($user['middle_name']); ?>" />
          </div>
          <div class="col-md-3">
            <label>Last Name *</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" />
          </div>
          <div class="col-md-3">
            <label>Name Extension</label>
            <input type="text" class="form-control" name="name_extension" value="<?php echo htmlspecialchars($user['name_extension']); ?>" />
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-3">
            <label>Birthdate *</label>
            <input type="date" class="form-control" name="birthdate" value="<?php echo htmlspecialchars($user['birthdate']); ?>" />
          </div>
          <div class="col-md-3">
            <label>Civil Status *</label>
            <select class="form-control" name="civil_status">
              <?php
              $statuses = ["Single", "Married", "Widowed", "Separated", "Divorced"];
              foreach ($statuses as $status) {
                $selected = $user['civil_status'] === $status ? 'selected' : '';
                echo "<option value=\"$status\" $selected>$status</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <label>Email *</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" />
          </div>
          <div class="col-md-3">
            <label>Gender *</label>
            <select class="form-control" name="gender">
              <?php
              $genders = ["male" => "Male", "female" => "Female", "LGBTQIA" => "LGBTQIA+"];
              foreach ($genders as $value => $label) {
                $selected = $user['gender'] === $value ? 'selected' : '';
                echo "<option value=\"$value\" $selected>$label</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Additional Info -->
    <div class="row mt-4">
      <div class="col-md-3">
        <label>Phone Number *</label>
        <input type="tel" class="form-control" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" />
      </div>
      <div class="col-md-3">
        <label>Occupation</label>
        <input type="text" class="form-control" name="occupation" value="<?php echo htmlspecialchars($user['occupation']); ?>" />
      </div>
      <div class="col-md-3">
        <label>Residence Since</label>
        <input type="text" class="form-control" name="residence_since" value="<?php echo htmlspecialchars($user['residence_since']); ?>" />
      </div>
    </div>

    <!-- Home Address -->
    <h4 class="mt-4">Home Address</h4>
<div class="row">
  <div class="col-md-6">
    <label>House Address</label>
    <input type="text" class="form-control" name="house_address" value="<?php echo htmlspecialchars($user['house_address']); ?>" />
  </div>
  <div class="col-md-3">
    <label>Barangay</label>
    <input type="text" class="form-control" name="barangay" value="Sta. Lucia" readonly style="background-color: #e9ecef; color: #6c757d;" />
  </div>
  <div class="col-md-3 d-flex align-items-end">
    <button type="reset" class="btn btn-secondary w-100">Clear</button>
    <button type="submit" name="save" class="btn btn-primary w-100 mx-2">Save</button>
  </div>
</div>

    <!-- Password -->
    <h4 class="mt-4">Change Password</h4>
    <div class="row">
      <div class="col-md-6">
        <label>New Password</label>
        <input type="password" class="form-control" name="new_password" />
      </div>
      <div class="col-md-6">
        <label>Confirm New Password</label>
        <input type="password" class="form-control" name="confirm_password" />
      </div>
    </div>
  </form>
</main>

<!-- Success Modal -->
<?php if (isset($_GET['status']) && $_GET['status'] === 'saved'): ?>
  <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="saveModalLabel">Success</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Your account information has been successfully saved.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    var saveModal = new bootstrap.Modal(document.getElementById('saveModal'));
    saveModal.show();
  </script>
<?php endif; ?>

</body>
</html>


<footer
      class="mt-4 py-4 text-light position-relative"
      style="background: #130d33"
    >
      <div class="footer-logo" style="position: absolute; top: 20; left: 30px">
        <img
          src="../media/logo.png"
          alt="Logo"
          width="60"
          height="60"
          style="border-radius: 50%"
        />
      </div>

      <div class="container">
        <div class="row justify-content-start">
          <div class="col-md-3 text-start">
            <div class="d-flex align-items-center">
              <h5 class="mb-0">Barangay Information</h5>
            </div>
            <p><strong>Barangay Name, Province</strong></p>
            <p>
              <strong>Office Hours:</strong><br />Monday - Friday: 8:00 AM -
              5:00 PM
            </p>
            <p>
              <strong>Contact Info:</strong><br />Email: info@barangay.gov.ph
            </p>
          </div>

          <div class="col-md-3 text-start">
            <h5>Quick Links</h5>
            <ul class="list-unstyled">
              <li><a href="resident_dashboard.php" class="text-light">Home</a></li>
              <li><a href="#" class="text-light">Review Request</a></li>
              <li>
                <a href="#" class="text-light">View and Approve Reports</a>
              </li>
              <li><a href="#" class="text-light">Manage Users and Roles</a></li>
              <li>
                <a href="#" class="text-light">Announcement Management</a>
              </li>
              <li>
                <a href="#" class="text-light"
                  >Emergency Response Coordination</a
                >
              </li>
            </ul>
          </div>

          <div class="col-md-3 text-start">
            <h5>My Account</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-light">Profile</a></li>
              <li><a href="#" class="text-light">Change Password</a></li>
              <li><a href="#" class="text-light">Data Management</a></li>
              <li><a href="#" class="text-light">Logout</a></li>
            </ul>
          </div>

          <div class="col-md-3 text-start">
            <h5>Social Media</h5>
            <ul class="list-unstyled">
              <li>
                <a href="#" class="text-light"
                  ><i class="bi bi-globe"></i> Official Website</a
                >
              </li>
              <li>
                <a href="#" class="text-light"
                  ><i class="bi bi-facebook"></i> Facebook</a
                >
              </li>
            </ul>
          </div>
        </div>

        <div class="text-center mt-3">
          <p>&copy; 2025 Barangay Name. All Rights Reserved.</p>
        </div>
      </div>
    </footer>
<script src="../public/js/toggle.js"></script>
</body>
</html>

