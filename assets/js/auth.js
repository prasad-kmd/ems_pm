// This script is used for Sign In(Admin) button, it will redirect to admin_login.html page after 2 seconds but with a loader.
document.getElementById("signInAdmin").addEventListener("click", function () {
    document.getElementById("signInAdmin").style.display = 'none';
    const loader = document.getElementById("loader");
    loader.style.display = 'block';
    setTimeout(function () {
        window.location.href = "admin_login.html";
    }, 2000);
});

