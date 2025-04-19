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

  <!-- Bootstrap CSS and Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../public/css/home.css" />

  <!-- Chart.js, jsPDF, html2canvas -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <style>
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .chart-container {
      height: 300px;
    }
  </style>
</head>
<body>

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

  <!-- Logo and Header -->
  <div class="text-light" style="background-color: #001a4f">
    <div class="container brand-header d-flex align-items-center py-2">
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

  <!-- Main Dashboard -->
  <div class="container-fluid">
    <div class="row header py-3">
      <div class="col-md-6"><h1 class="ms-3">Data Analytics Dashboard</h1></div>
      <div class="col-md-6 text-end pe-4">
        <button class="btn btn-light" onclick="exportToPDF()">Export Data</button>
      </div>
    </div>

    <div id="exportSection">
      <div class="row mt-4 g-4">
        <div class="col-md-6">
          <div class="card text-center bg-light">
            <div class="card-body">
              <h5 class="card-title">Population</h5>
              <input type="number" class="form-control mb-2" id="inputMale" value="6000" placeholder="Male Population">
              <input type="number" class="form-control" id="inputFemale" value="5000" placeholder="Female Population">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card text-center bg-light">
            <div class="card-body">
              <h5 class="card-title">Residential Areas</h5>
              <input type="number" class="form-control mb-2" id="inputOccupied" value="1500" placeholder="Occupied Units">
              <input type="number" class="form-control" id="inputVacant" value="740" placeholder="Vacant Units">
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Population Distribution</h5>
              <div class="chart-container"><canvas id="populationChart"></canvas></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Residential Distribution</h5>
              <div class="chart-container"><canvas id="residentialChart"></canvas></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Save Button -->
    <div class="text-center mt-4">
      <button class="btn btn-success" onclick="updateCharts()">Update Charts</button>
      <button class="btn btn-primary" onclick="saveToDatabase()">Save to Database</button>
    </div>
  </div>
        <!-- footer section -->
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

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../public/js/toggle.js"></script>
  <script>
    let populationChart, residentialChart;

    function updateCharts() {
      const male = parseInt(document.getElementById("inputMale").value) || 0;
      const female = parseInt(document.getElementById("inputFemale").value) || 0;
      const occupied = parseInt(document.getElementById("inputOccupied").value) || 0;
      const vacant = parseInt(document.getElementById("inputVacant").value) || 0;

      const popCtx = document.getElementById("populationChart").getContext("2d");
      if (populationChart) populationChart.destroy();
      populationChart = new Chart(popCtx, {
        type: "pie",
        data: {
          labels: ["Male", "Female"],
          datasets: [{ data: [male, female], backgroundColor: ["#007bff", "#ffc107"] }]
        }
      });

      const resCtx = document.getElementById("residentialChart").getContext("2d");
      if (residentialChart) residentialChart.destroy();
      residentialChart = new Chart(resCtx, {
        type: "pie",
        data: {
          labels: ["Occupied", "Vacant"],
          datasets: [{ data: [occupied, vacant], backgroundColor: ["#28a745", "#dc3545"] }]
        }
      });
    }

    async function exportToPDF() {
      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF("p", "mm", "a4");
      const content = document.getElementById("exportSection");

      pdf.setFontSize(18);
      pdf.text("Barangay Data Report", 15, 20);
      pdf.setFontSize(10);
      pdf.text("Generated on: " + new Date().toLocaleString(), 15, 27);

      const canvas = await html2canvas(content);
      const imgData = canvas.toDataURL("image/png");
      const imgProps = pdf.getImageProperties(imgData);
      const pdfWidth = pdf.internal.pageSize.getWidth() - 30;
      const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

      pdf.addImage(imgData, 'PNG', 15, 30, pdfWidth, pdfHeight);
      pdf.save("barangay-data-report.pdf");
    }

    function saveToDatabase() {
      const male = document.getElementById("inputMale").value;
      const female = document.getElementById("inputFemale").value;
      const occupied = document.getElementById("inputOccupied").value;
      const vacant = document.getElementById("inputVacant").value;

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "../../save_data.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        alert(this.responseText);
      };
      xhr.send(`male=${male}&female=${female}&occupied=${occupied}&vacant=${vacant}`);
    }

    // Initial Chart Load
    updateCharts();
  </script>
</body>
</html>
