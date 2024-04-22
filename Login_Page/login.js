// document.addEventListener("DOMContentLoaded", function() {
//     const passwordInput = document.getElementById("password");
//     const togglePasswordButton = document.getElementById("toggle-password");

//     togglePasswordButton.addEventListener("click", function() {
//       if (passwordInput.type === "password") {
//         passwordInput.type = "text";
//         togglePasswordButton.textContent = "";
//       } else {
//         passwordInput.type = "password";
//         togglePasswordButton.textContent = "👁️";
//       }
//     });
//   });

// var a;
// function pass() {
//   if (a == 1) {
//     document.getElementById('password').type = 'password';
//     document.getElementById('eye-icon').src = 'eye-hide.png';
//     a = 0;
//   }
//   else {
//     document.getElementById('password').type = 'text';
//     document.getElementById('eye-icon').src = 'eye.png';
//   }
// }


const passwordField = document.getElementById("password");
const togglePassword = document.querySelector(".password-toggle-icon i");

togglePassword.addEventListener("click", function () {
  if (passwordField.type === "password") {
    passwordField.type = "text";
    togglePassword.classList.remove("fa-eye");
    togglePassword.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    togglePassword.classList.remove("fa-eye-slash");
    togglePassword.classList.add("fa-eye");
  }
});