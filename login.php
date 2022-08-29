<?php 
include("includes/config.php"); 
include("includes/classes/FormSanitizer.php"); 
include("includes/classes/Constants.php"); 
include("includes/classes/Account.php"); 

$account = new Account($connection); 

if(isset($_POST["submitButton"])) {
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]); 
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $success = $account->login($username, $password); 

    if($success) {
        $_SESSION["userLoggedIn"] = $username; 
        header("Location: index.php"); 
    }
}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name]; 
    }
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
                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username"); ?>" required> 

                <input type="password" name="password" placeholder="password" required> 

                <input type="submit" name="submitButton" value="SUBMIT">
            </form>

            <a href="register.php" class="signInMessage">Don't have an account? Sign up here!</a>
        </div>
    </div>

</body>


</html>