document.getElementById("registerForm").addEventListener("submit", function(event) {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;

    if (password !== confirmPassword) {
        alert("Şifreler uyuşmuyor.");
        event.preventDefault();
    }
});
