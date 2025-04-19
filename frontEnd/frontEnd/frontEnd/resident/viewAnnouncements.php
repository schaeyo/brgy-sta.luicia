<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bayanihan Hub - Review Request</title>
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
    <div class="container">
      <div class="container">
        <h2 class="mb-4">Events and Announcements</h2>

        <!-- Filter Navigation -->
        <ul class="nav nav-pills justify-content-center mb-4">
          <li class="nav-item"><a class="nav-link active" href="#">All</a></li>
          <li class="nav-item">
            <a class="nav-link" href="#">Barangay Events</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Public Notice</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Emergency Alerts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Community Program</a>
          </li>
        </ul>

        <!-- Event Cards -->
        <div class="row g-4">
          <!-- Event Card 1 -->
          <div class="col-md-4">
            <div
              class="card text-light text-center p-3"
              style="background-color: #001a4f"
            >
              <img src="pic.png" class="card-img-top" alt="Event Image" />
              <div class="card-body">
                <h5 class="card-title">Barangay Cleanup Drive</h5>
                <p class="card-text">April 10, 2025</p>
              </div>
            </div>
          </div>

          <!-- Event Card 2 -->
          <div class="col-md-4">
            <div
              class="card text-light text-center p-3"
              style="background-color: #001a4f"
            >
              <img src="pic.png" class="card-img-top" alt="Event Image" />
              <div class="card-body">
                <h5 class="card-title">Vaccination Program</h5>
                <p class="card-text">April 15, 2025</p>
              </div>
            </div>
          </div>

          <!-- Event Card 3 -->
          <div class="col-md-4">
            <div
              class="card text-light text-center p-3"
              style="background-color: #001a4f"
            >
              <img src="pic.png" class="card-img-top" alt="Event Image" />
              <div class="card-body">
                <h5 class="card-title">Disaster Preparedness Seminar</h5>
                <p class="card-text">April 20, 2025</p>
              </div>
            </div>
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
