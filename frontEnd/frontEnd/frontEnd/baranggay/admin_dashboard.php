<?php

session_start();
include '../../db_connection.php';

// Get user ID from session
$user_id = $_SESSION['user_id'] ?? null;

// Fetch user details from the database
$user = null;
if ($user_id) {
  $query = "SELECT first_name FROM users WHERE user_id = ?";
  $stmt = $con->prepare($query);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
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
        <a href="accountInfo.php" class="active p-2"><i class="bi bi-person-circle mx-3"></i>Hi, <?php echo htmlspecialchars($user['first_name']); ?></a>
        <a href="admin_dashboard.php"><i class="bi bi-house-door"></i> Home</a>
        <a href="data-analytics.php"><i class="bi bi-graph-up"></i> Data Analytics</a>
        <a href="reviewRequest.php"><i class="bi bi-file-earmark-check"></i> Review Request</a>
        <a href="incidentReport.php"><i class="bi bi-clipboard-chec"></i> View and Approve Reports</a>
        <a href="manageUsers.php"><i class="bi bi-people"></i>  Manage Users and Roles</a>
        <a href="announceManage.php"><i class="bi bi-megaphone"></i> Announcement Management</a>
        <a href="emergencyResponse.php"><i class="bi bi-exclamation-triangle"></i> Emergency Response Coordination</a>
        <a href="viewFeedback.php"><i class="bi bi-chat-dots"></i> View Feedback</a>
        <a href="dbManage.php"><i class="bi bi-database"></i> Data Management</a>
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
              <!-- Make the table responsive by adding the .table-responsive class -->
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead class="table-primary">
                    <tr>
                      <th>Resident Name</th>
                      <th>Resident Type</th>
                      <th>Date Submitted</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Data 1</td>
                      <td>Data 2</td>
                      <td>Data 3</td>
                      <td>Data 4</td>
                    </tr>
                    <tr>
                      <td>Data 1</td>
                      <td>Data 2</td>
                      <td>Data 3</td>
                      <td>Data 4</td>
                    </tr>
                    <tr>
                      <td>Data 1</td>
                      <td>Data 2</td>
                      <td>Data 3</td>
                      <td>Data 4</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-2">
              <a href="../baranggay/reviewRequest.html" class="btn btn-primary btn-md">View More</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-sm-6 col-md-4">
          <div class="card mb-2" style="background-color: #001a4f">
            <div class="card-body">
              <h3 class="text-center text-light">Emergency Response Reports</h3>
              <table class="table table-bordered">
                <thead class="table-primary">
                  <tr>
                    <th>Emergency Type</th>
                    <th>Date</th>
                    <th>Time</th>
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
              <a href="../baranggay/emergencyResponse.html" class="btn btn-danger btn-md px-5">View Alerts</a>
            </div>
            
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-sm-6 col-md-4">
          <div class="card mb-2" style="background-color: #001a4f">
            <div class="card-body">
              <h3 class="text-center text-light">User Role Management</h3>
              <table class="table table-bordered">
                <thead class="table-primary">
                  <tr>
                    <th>Name</th>
                    <th>Assigned Role</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Data 1</td>
                    <td>Data 2</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-2">
              <a href="../baranggay/manageUsers.php" class="btn btn-primary btn-md"
                >Edit Roles & Assign<br />Permissions</a
              >
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
              <li><a href="admin_dashboard.php" class="text-light">Home</a></li>
              <li>
                <a href="data-analytics.php" class="text-light" >Data Analytics</a>
              </li>
              <li><a href="reviewRequest.php" class="text-light">Review Request</a></li>
              <li>
                <a href="incidentReport.html" class="text-light">View and Approve Reports</a>
              </li>
              <li><a href="manageUsers.php" class="text-light">Manage Users and Roles</a></li>
              <li>
                <a href="announceManage.php" class="text-light">Announcement Management</a>
              </li>
              <li>
                <a href="emergencyResponse.php" class="text-light" >Emergency Response Coordination</a>
              </li>
              <li>
                <a href="dbManage.php" class="text-light" >Data Management</a>
              </li>
            </ul>
          </div>

          <div class="col-md-3 text-start">
            <h5>My Account</h5>
            <ul class="list-unstyled">
              <li><a href="admin_dashboard.php" class="text-light">Profile</a></li>
              <li><a href="../../signin.php" class="text-light">Logout</a></li>
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
