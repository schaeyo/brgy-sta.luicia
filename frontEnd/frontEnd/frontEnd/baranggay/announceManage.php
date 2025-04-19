<?php
session_start();

include '../../db_connection.php';

// Get user ID from session
$user_id = $_SESSION['user_id'] ?? null;

// Fetch user details
$user = null;
if ($user_id) {
    $query = "SELECT first_name FROM users WHERE user_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

// Fetch all announcements
$announcements = [];
$query = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = $con->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Announcement Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../public/css/home.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
</head>
<body>

<!-- Sidebar, header, and modal here (unchanged) -->
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
      <div class="mt-5">
        <a href="accountInfo.php" class="active p-2"><i class="bi bi-person-circle mx-3"></i>Hi, <?php echo htmlspecialchars($user['first_name']); ?></a>
        <a href="admin_dashboard.php"><i class="bi bi-house-door"></i> Home</a>
        <a href="data-analytics.php"><i class="bi bi-graph-up"></i> Data Analytics</a>
        <a href="reviewRequest.php"><i class="bi bi-file-earmark-check"></i> Review Request</a>
        <a href="incidentReport.html"><i class="bi bi-clipboard-chec"></i> View and Approve Reports</a>
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

    <div class="container mt-4">
  <h2>Create New Announcement</h2>
  <?php if (isset($_GET['success'])): ?>
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title">Success</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">Announcement posted successfully!</div>
          <div class="modal-footer"><button class="btn btn-success" data-bs-dismiss="modal">OK</button></div>
        </div>
      </div>
    </div>
  <?php elseif (isset($_GET['deleted'])): ?>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">Deleted</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">Announcement deleted successfully.</div>
          <div class="modal-footer"><button class="btn btn-danger" data-bs-dismiss="modal">OK</button></div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <form action="../../announceProcess.php" method="POST" enctype="multipart/form-data">
    <div class="row mb-3">
      <label class="col-md-3 col-form-label">Announcement Title:</label>
      <div class="col-md-9">
        <input type="text" name="title" class="form-control" required />
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-md-3 col-form-label">Description:</label>
      <div class="col-md-9">
        <textarea name="description" class="form-control" rows="3" required></textarea>
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-md-3 col-form-label">Category:</label>
      <div class="col-md-9">
        <select name="category" class="form-select" required>
          <option value="Barangay Events">Barangay Events</option>
          <option value="Public Notice">Public Notice</option>
          <option value="Emergency Alerts">Emergency Alerts</option>
          <option value="Community Program">Community Program</option>
        </select>
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-md-3 col-form-label">Upload File:</label>
      <div class="col-md-9">
        <input type="file" name="file_upload" class="form-control" />
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-md-3 col-form-label">Schedule Date:</label>
      <div class="col-md-9 d-flex">
        <input type="date" name="schedule_date" class="form-control me-2" required />
        <button type="reset" class="btn btn-secondary me-2">Clear</button>
        <button type="submit" class="btn btn-primary">Post</button>
      </div>
    </div>
  </form>
</div>

<div class="container mt-5">
  <h2>List of Past Announcements</h2>

  <!-- Category Filter Pills -->
  <ul class="nav nav-pills justify-content-center mb-4">
    <li class="nav-item"><a class="nav-link <?= !isset($_GET['category']) ? 'active' : '' ?>" href="announceManage.php">All</a></li>
    <li class="nav-item"><a class="nav-link <?= ($_GET['category'] ?? '') === 'Barangay Events' ? 'active' : '' ?>" href="?category=Barangay Events">Barangay Events</a></li>
    <li class="nav-item"><a class="nav-link <?= ($_GET['category'] ?? '') === 'Public Notice' ? 'active' : '' ?>" href="?category=Public Notice">Public Notice</a></li>
    <li class="nav-item"><a class="nav-link <?= ($_GET['category'] ?? '') === 'Emergency Alerts' ? 'active' : '' ?>" href="?category=Emergency Alerts">Emergency Alerts</a></li>
    <li class="nav-item"><a class="nav-link <?= ($_GET['category'] ?? '') === 'Community Program' ? 'active' : '' ?>" href="?category=Community Program">Community Program</a></li>
  </ul>

  <div class="row g-4">
    <?php foreach ($announcements as $announce): ?>
      <div class="col-md-4">
        <div class="border p-3 shadow-sm">
          <?php if (!empty($announce['file_path'])): ?>
            <img src="<?= htmlspecialchars($announce['file_path']) ?>" class="img-fluid mb-2" style="max-height:150px;" alt="Attachment">
          <?php else: ?>
            <img src="https://via.placeholder.com/150" class="img-fluid mb-2" alt="Default Image">
          <?php endif; ?>
          <h5><?= htmlspecialchars($announce['title']) ?></h5>
          <span class="badge bg-secondary mb-2"><?= htmlspecialchars($announce['category']) ?></span>
          <p><?= nl2br(htmlspecialchars($announce['description'])) ?></p>
          <p><small>Scheduled on: <?= htmlspecialchars($announce['schedule_date']) ?></small></p>
          <p><small>Posted on: <?= htmlspecialchars($announce['created_at']) ?></small></p>
          <a href="#" class="btn btn-warning btn-sm me-2 disabled">Edit</a>
          <a href="../../deleteAnnouncement.php?id=<?= $announce['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');">Delete</a>
        </div>
      </div>
    <?php endforeach; ?>
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
    
    <script>
  document.addEventListener('DOMContentLoaded', () => {
    if (window.location.search.includes('success')) {
      const successModal = new bootstrap.Modal(document.getElementById('successModal'));
      successModal.show();
    }

    if (window.location.search.includes('deleted')) {
      const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
      deleteModal.show();
    }
  });
</script>
<script src="../public/js/toggle.js"></script>
</body>
</html>
