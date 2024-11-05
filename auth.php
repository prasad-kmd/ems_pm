<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up</title>
    <link rel="stylesheet" href="assets/css/auth.css">
    <link rel="stylesheet" href="assets/css/loader.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="signup_process.php" method="POST">
                <h1>Create Account</h1>
                <input placeholder="Name" type="text" id="name" name="name" required />
                <input placeholder="Email" type="email" id="email" name="email" required />
                <input placeholder="Password" type="password" id="password" name="password" required />
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="signin_process.php" method="POST">
                <h1>Sign in</h1>
                <input placeholder="Email" type="email" id="email" name="email" required />
                <input placeholder="Password" type="password" id="password" name="password" required />
                <!-- <a href="#">Forgot your password?</a> -->
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button><br>
                    <button class="ghost" style="cursor: progress;"><span id="signInAdmin">Sign In(Admin)</span> <div id="loader" class="loader" style="display:none"></div></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
    <script>
        document.getElementById("signInAdmin").addEventListener("click", function() {
            document.getElementById("signInAdmin").style.display='none';
            const loader = document.getElementById("loader");
            loader.style.display='block';
            setTimeout(function() {
                window.location.href = "admin_login.php";
            }, 2000);
        });
    </script>
</body>

</html>