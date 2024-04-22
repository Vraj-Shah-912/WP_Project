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

var a;
function pass() {
  if (a == 1) {
    document.getElementById('password').type = 'password';
    document.getElementById('pass-icon').src = 'eye-hide.png';
    a = 0;
  }
  else {
    document.getElementById('password').type = 'text';
    document.getElementById('pass-icon').src = 'eye.png';
  }
}