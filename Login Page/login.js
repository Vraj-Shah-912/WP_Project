document.addEventListener("DOMContentLoaded", function() {
    const passwordInput = document.getElementById("password");
    const togglePasswordButton = document.getElementById("toggle-password");
  
    togglePasswordButton.addEventListener("click", function() {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePasswordButton.textContent = "👁️";
      } else {
        passwordInput.type = "password";
        togglePasswordButton.textContent = "👁️";
      }
    });
  });
  