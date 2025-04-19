<?php
session_start();
include '../../db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <base href="/frontEnd/frontEnd/resident/" />
  <title>Bayanihan Hub - Review Request</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../public/css/home.css" />
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    main {
      flex: 1;
    }
    footer a {
      text-decoration: none;
    }
  </style>
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
  <button class="toggle-btn" id="toggleBtn" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
  </button>

  <!-- Header -->
  <div class="text-light" style="background-color: #001a4f">
    <div class="container brand-header d-flex align-items-center py-3">
      <img src="../media/logo2.png" alt="Bayanihan Hub Logo" width="90" height="90" style="border-radius: 50%" />
      <h3 class="mx-3 mt-2">Bayanihan Hub</h3>
    </div>
  </div>

  <!-- Logout Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h3>Are you sure you want to log out?</h3>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
          <a href="../login/signin.php" class="btn btn-danger px-4 ms-3">Yes, Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="container px-3 mt-4">
    <h2 class="mb-4">Submit Request Form</h2>
    <form action="../../submit_request.php" method="POST" enctype="multipart/form-data">
      <!-- Row 1 -->
      <div class="row mb-3">
        <div class="col-md-2">
          <label class="form-label">First Name *</label>
          <input type="text" class="form-control" name="first_name" required />
        </div>
        <div class="col-md-2">
          <label class="form-label">Middle Name</label>
          <input type="text" class="form-control" name="middle_name" />
        </div>
        <div class="col-md-2">
          <label class="form-label">Last Name *</label>
          <input type="text" class="form-control" name="last_name" required />
        </div>
        <div class="col-md-2">
          <label class="form-label">Name Extension</label>
          <input type="text" class="form-control" name="name_extension" />
        </div>
        <div class="col-md-2">
          <label class="form-label">Birthdate *</label>
          <input type="date" class="form-control" name="birthdate" required />
        </div>
      </div>

      <!-- Row 2 -->
      <div class="row mb-3">
        <div class="col-md-2">
          <label class="form-label">Age</label>
          <input type="number" class="form-control" name="age" />
        </div>
        <div class="col-md-2">
          <label class="form-label">Birth Place *</label>
          <input type="text" class="form-control" name="birth_place" required />
        </div>
        <div class="col-md-2">
          <label class="form-label">Citizenship *</label>
          <input type="text" class="form-control" name="citizenship" required />
        </div>
        <div class="col-md-2">
          <label class="form-label">Civil Status *</label>
          <select class="form-control" name="civil_status" required>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
            <option value="Divorced">Divorced</option>
          </select>
        </div>
        <div class="col-md-2">
          <label class="form-label">Gender *</label>
          <select class="form-control" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="LGBTQIA+">LGBTQIA+</option>
          </select>
        </div>
      </div>

      <!-- Row 3 -->
      <div class="row mb-3">
        <div class="col-md-3">
          <label class="form-label">Email *</label>
          <input type="email" class="form-control" name="email" required />
        </div>
        <div class="col-md-2">
          <label class="form-label">Residence Since</label>
          <input type="date" class="form-control" name="residence_since" />
        </div>
        <div class="col-md-2">
          <label class="form-label">Residence Duration</label>
          <input type="number" class="form-control" name="residence_duration" placeholder="Years" />
        </div>
        <div class="col-md-2">
          <label class="form-label">Type of Request *</label>
          <select class="form-control" name="type_of_request" required>
            <option value="Barangay Clearance">Barangay Clearance</option>
            <option value="Business Permit">Business Permit</option>
            <option value="Indigency Certificate">Indigency Certificate</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Valid ID *</label>
          <input type="file" class="form-control" name="valid_id" required />
        </div>
      </div>

      <!-- Buttons -->
      <div class="row mt-5">
        <div class="col-md-12 d-flex justify-content-end">
          <button type="reset" class="btn btn-secondary me-3 px-4">Clear</button>
          <button type="submit" class="btn btn-primary px-4">Submit</button>
        </div>
      </div>
    </form>
  </main>

  <!-- Feedback Modal -->
  <div class="modal fade" id="submitModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Request Submitted</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Your request form has been successfully submitted!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

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
<script>
  // Show modal if the 'submitted' parameter is present in the URL
  document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('submitted') === '1') {
      const submitModal = new bootstrap.Modal(document.getElementById('submitModal'));
      submitModal.show();
    }
  });
</script>
</body>
</html>
