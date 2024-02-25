<?php
require_once("config.php");
require_once("account.php");
require_once("Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account = new Account($conn);

if(isset($_POST['btnSubmit'])){
    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $pword = FormSanitizer::sanitizeFormPassword($_POST['pword']);

    $success = $account->login($username, $pword);

    if($success){
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
        exit(); // Ensure no further code execution after redirection
    } else {
        // Display the login failed error message
        $errorMessage = Constants::$loginFailed;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\styles\style.css">
    <title>Login</title>
</head>
<body>
    
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="images\netflixlogo.png" alt="Site logo">
                <h3>Sign In</h3>
                <span>to continue to SYNDFLIX</span>
            </div>
            <form method="POST">

                <?php 
                if(isset($errorMessage)) {
                    echo "<span class='errorMessage'>$errorMessage</span>";
                }
                ?>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" name="pword" placeholder="Password" required>
                <input type="submit" name="btnSubmit" value="Login">
                <a href="register.php" class="signInMessage">Don't have an account? Sign up here!</a>
            </form>
        </div>
    </div>

</body>
</html>