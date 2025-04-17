<?php
session_start();



include '../../db_connection.php'; // your DB connection file

if (!isset($_SESSION['username'])) {
    header("Location: /frontEnd/login/signin.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bayanihan Hub - Account Information</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons CDN -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../public/css/home.css" />
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="mt-5">
        <a href="accountInfo.php" class="active p-2">
          <i class="bi bi-person-circle mx-3"></i>Hi, username
        </a>
        <a href="resident_dashboard.html"><i class="bi bi-house-door"></i> Home</a>
        <a href="submitReqForm.php"
          ><i class="bi bi-file-earmark-check"></i> Submit Request</a
        >
        <a href="reportEmergency.html"
          ><i class="bi bi-clipboard-check"></i> Report Emergencies</a
        >
        <a href="viewAnnouncements.html"
          ><i class="bi bi-people"></i> View Announcements</a
        >
        <a href="bookAppointment.html"
          ><i class="bi bi-megaphone"></i> Appointments</a
        >
        <a href="notifications.html"
          ><i class="bi bi-exclamation-triangle"></i> Notifications</a
        >
        <a href="submitFeedback.html"
          ><i class="bi bi-chat-dots"></i> Submit Feedback</a
        >
        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </div>
    </div>
    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggleBtn" onclick="toggleSidebar()">
      <i class="bi bi-list"></i>
    </button>

    <!-- Logo and Name Header -->
    <div class="text-light" style="background-color: #001a4f">
      <div class="container brand-header">
        <img
          src="../media/logo2.png"
          alt="Bayanihan Hub Logo"
          width="90px"
          height="90px"
          style="border-radius: 50%"
        />
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
    <main class="container mt-4">
      <h2>My Account Information</h2>
      <!-- Form updated to include action and method -->
      <form method="POST" action="../../resaccountinfo.php"> <!-- Specify your PHP file here -->
        <!-- Profile Section -->
        <div class="row align-items-center mb-3">
          <div class="col-md-3 text-center">
            <label>Choose Profile</label>
            <div class="border rounded p-3">
              <i class="bi bi-person-circle" style="font-size: 80px"></i>
            </div>
            <input type="file" class="form-control mt-2" />
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-3">
                <label>First Name *</label>
                <input type="text" class="form-control" name="first_name" />
              </div>
              <div class="col-md-3">
                <label>Middle Name (Optional)</label>
                <input type="text" class="form-control" name="middle_name" />
              </div>
              <div class="col-md-3">
                <label>Last Name *</label>
                <input type="text" class="form-control" name="last_name" />
              </div>
              <div class="col-md-3">
                <label>Name Extension</label>
                <input type="text" class="form-control" name="name_extension" />
              </div>
            </div>

            <!-- Row 2 -->
            <div class="row mt-3">
              <div class="col-md-3">
                <label>Birthdate *</label>
                <input type="date" class="form-control" name="birthdate" />
              </div>
              <div class="col-md-3">
                <label class="mb-2">Civil Status *</label><br />
                <select class="form-control" name="civil_status" id="civil_status" required>
                <option value="" disabled selected>Select civil status</option>
              <option value="Single">Single</optio>
            <option value="Married">Married</option>
              <option value="Widowed">Widowed</option>
              <option value="Separated">Separated</option>
            <option value="Divorced">Divorced</option>
            </select>
              </div>
              <div class="col-md-3">
                <label>Email *</label>
                <input type="email" class="form-control" name="email" />
              </div>
              <div class="col-md-3">
                <label class="mb-2">Gender *</label><br />
                <select name="gender" class="form-control" required>
                <option value="" disabled selected>Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="LGBTQIA">LGBTQIA+</option>
              </select>
              </div>
            </div>
          </div>
        </div>
        <!-- Row 3 -->
        <div class="row mt-3">
          <div class="col-md-3">
            <label>Phone Number *</label>
            <input type="tel" class="form-control" name="phone" />
          </div>
          <div class="col-md-3">
            <label>Occupation</label>
            <input type="text" class="form-control" name="occupation" />
          </div>
          <div class="col-md-3">
            <label>Residence Since</label>
            <input type="text" class="form-control" name="residence_since" />
          </div>
        </div>

        <!-- Home Address -->
        <h4 class="mt-4">Home Address</h4>
        <div class="row">
          <div class="col-md-6">
            <label>House Address</label>
            <input type="text" class="form-control" name="house_no" />
          </div>
          <div class="col-md-3">
  <label>Barangay</label>
  <input 
    type="text" 
    class="form-control" 
    name="barangay" 
    value="Sta. Lucia" 
    readonly 
    style="background-color: #e9ecef; color: #6c757d;" 
  />
</div>

          <div class="col-md-3 d-flex align-items-end">
            <button type="reset" class="btn btn-secondary w-100">Clear</button>
            <button type="submit" name="save" class="btn btn-primary w-100 mx-2">
              Save
            </button>
          </div>
        </div>

        <!-- Change Password -->
        <h4 class="mt-4">Change Password</h4>
        <div class="row">
          <div class="col-md-6">
            <label>New Password</label>
            <input type="password" class="form-control" name="new_password" />
          </div>
          <div class="col-md-6">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" />
          </div>
        </div>

        <!-- Buttons -->
        <div class="row mt-4">
          <div class="col-md-6">
            <button type="button" class="btn btn-secondary w-30">Home</button>
          </div>
          <div class="col-md-6 text-end">
            <button type="button" class="btn btn-danger">
              Deactivate Account
            </button>
          </div>
        </div>
      </form>
    </div>
        <!-- Deactivate Account Confirmation Modal -->
        <div class="modal fade" id="deactivateModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Deactivate Account</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to deactivate your account? This action cannot be undone.</p>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Cancel
                </button>
                <button
                  type="button"
                  class="btn btn-danger"
                  onclick="deactivateAccount()"
                >
                  Yes, Deactivate
                </button>
              </div>
            </div>
          </div>
        </div>
        </div>
      </form>
      </main>

    <footer
      class="mt-4 py-4 text-light position-relative"
      style="background: #130d33"
    >
      <!-- Image Outside the Container -->
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

          <!-- Quick Links -->
          <div class="col-md-3 text-start">
            <h5>Quick Links</h5>
            <ul class="list-unstyled">
              <li><a href="resident_dashboard.html" class="text-light">Home</a></li>
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

          <!-- My Account -->
          <div class="col-md-3 text-start">
            <h5>My Account</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-light">Profile</a></li>
              <li><a href="#" class="text-light">Change Password</a></li>
              <li><a href="#" class="text-light">Data Management</a></li>
              <li><a href="#" class="text-light">Logout</a></li>
            </ul>
          </div>

          <!-- Social Media -->
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
