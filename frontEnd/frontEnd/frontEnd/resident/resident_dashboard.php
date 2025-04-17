<?php
session_start();

include '../../db_connection.php'; // your DB connection file

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
        <a href="accountInfo.php" class="p-2">
          <i class="bi bi-person-circle mx-3"></i>Hi, username
        </a>
        <a href="resident_dashboard.php" class="active"><i class="bi bi-house-door"></i> Home</a>
        
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
    <div class="mt-2 p-3" style="background-color: #001a4f">
      <div class="container" style="background-color: #0e2d4c">
        <div class="row g-4">
          <!-- Heading 1 -->
          <div class="col-12 col-md-4">
            <h1 class="text-center text-light">Pending Approvals</h1>
          </div>

          <!-- Heading 2 -->
          <div class="col-12 col-md-4">
            <h1 class="text-center text-light">Emergency Alerts</h1>
          </div>

          <!-- Heading 3 -->
          <div class="col-12 col-md-4">
            <h1 class="text-center text-light">Total Residents</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Cards Container -->
    <div class="container mt-4">
      <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-12 col-sm-6 col-md-4">
          <div class="card mb-2" style="background-color: #001a4f">
            <div class="card-body">
              <h3 class="text-center text-light">Recent Service Request</h3>
              <!-- Center the image -->
              <div class="d-flex justify-content-center">
                <img src="pic.jpg" alt="" width="180px" height="180px" />
              </div>
              <!-- Paragraph description below the image -->
              <p class="text-center text-light mt-2">
                This is a description about the service request. Here you can
                add more details related to the image or the request.
              </p>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-2">
              <a href="#" class="btn btn-primary btn-md">View More</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-sm-6 col-md-4">
          <div class="card mb-2" style="background-color: #001a4f">
            <div class="card-body">
              <h3 class="text-center text-light">Trace Request</h3>
              <table class="table table-bordered">
                <thead class="table-primary">
                  <tr>
                    <th>Request Type</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Data 1</td>
                    <td>Data 2</td>
                    <td>Data 3</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-2">
              <a href="#" class="btn btn-warning btn-md px-5">Track Request</a>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-sm-6 col-md-4">
          <div class="card mb-2" style="background-color: #001a4f">
            <div class="card-body">
              <h3 class="text-center text-light">Emergency Reporting</h3>
              <table class="table table-bordered">
                <thead class="table-primary">
                  <tr>
                    <th>Emergency type</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Data 1</td>
                    <td>Data 2</td>
                    <td>Data 2</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-2">
              <a href="#" class="btn btn-danger btn-md">Report Emergency</a>
            </div>
          </div>
        </div>
      </div>
    </div>

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
              <li><a href="#" class="text-light">Home</a></li>
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
