<?php 
if(isset($_POST["submitButton"])) {
    echo "this form was submitted"; 
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome to SubnetFlix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
</head>

<body>

    <div class="signInContainer">
        <div class="column">

            <div class="header">
                <img src="assets/images/subnetflix-logo.png" title="Logo" alt="Site Logo">
                <h3>Sign In</h3>
                <span>to continue to SubnetFlix</span>
            </div>

            <form method="POST">
                <input type="text" name="username" placeholder="Username" required> 

                <input type="password" name="password" placeholder="password" required> 

                <input type="submit" name="submitButton" value="SUBMIT">
            </form>

            <a href="register.php" class="signInMessage">Don't have an account? Sign up here!</a>
        </div>
    </div>

</body>


</html>