const passwordField = document.getElementById("floatingPassword");
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

document.addEventListener('DOMContentLoaded', function () {
    var errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
        errorAlert.classList.add('show');
        setTimeout(function () {
            errorAlert.classList.remove('show');
        }, 2000);
    }
});

