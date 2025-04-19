function checkPasswordStrength() {
    const password = document.getElementById("password").value;
    const strengthIndicator = document.getElementById("passwordStrength");
    let strength = "";
  
    // Check password strength
    if (password.length === 0) {
      strength = "";
    } else if (password.length < 6) {
      strength = "<span style='color: red;'>Weak: Too short</span>";
    } else if (
      /[a-z]/.test(password) &&
      /[A-Z]/.test(password) &&
      /[0-9]/.test(password) &&
      /[@$!%*?&#]/.test(password)
    ) {
      strength = "<span style='color: green;'>Strong</span>";
    } else if (
      (/[a-z]/.test(password) || /[A-Z]/.test(password)) &&
      /[0-9]/.test(password)
    ) {
      strength = "<span style='color: orange;'>Medium</span>";
    } else {
      strength = "<span style='color: red;'>Weak</span>";
    }
  
    // Update the strength indicator
    strengthIndicator.innerHTML = strength;
  }