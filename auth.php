<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up</title>
    <link rel="stylesheet" href="assets/css/auth.css">
    <script>
        // Function to toggle between Sign In and Sign Up
        function openTab(tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
        }
    </script>
</head>
<body onload="openTab('SignIn')"> <!-- Default to Sign In tab -->

    <!-- Tab Buttons -->
    <div class="tab">
        <button class="tablinks" onclick="openTab('SignIn')">Sign In</button>
        <button class="tablinks" onclick="openTab('SignUp')">Sign Up</button>
    </div>

    <!-- Sign In Form -->
    <div id="SignIn" class="tabcontent">
        <h2>Sign In</h2>
        <form action="signin_process.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Sign In</button>
        </form>
    </div>

    <!-- Sign Up Form -->
    <div id="SignUp" class="tabcontent">
        <h2>Sign Up</h2>
        <form action="signup_process.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">

            <button type="submit">Sign Up</button>
        </form>
    </div>

</body>
</html>
