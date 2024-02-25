<?php

require_once("config.php");
require_once("account.php");
require_once("Constants.php");
require_once("includes/classes/FormSanitizer.php");


    $account = new Account($conn);

   if(isset($_POST['btnSubmit'])){

    $firstName = FormSanitizer::sanitizeFormString($_POST['firstName']);
    $lastName = FormSanitizer::sanitizeFormString($_POST['lastName']);
    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
    $pword1 = FormSanitizer::sanitizeFormPassword($_POST['pword1']);
    $pword2 = FormSanitizer::sanitizeFormPassword($_POST['pword2']);

    $success = $account->register($firstName, $lastName, $username, $email, $pword1, $pword2);

    if($success){
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }

    
     /*
    if($pword1 != $pword2){
        echo "Passwords do not match";
    }else{
        $pword1 = md5($pword1);
        $pword2 = md5($pword2);

        $query = "INSERT INTO users (firstName, lastName, username, email, password) VALUES ('$firstName', '$lastName', '$username', '$email', '$pword1')";

        $result = mysqli_query($conn, $query);

        if($result){
            echo "User registered successfully";
        }else{
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
    */
   }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\styles\style.css">
    <title>Register</title>
</head>
<body>
    <div class="signInContainer">

    <div class="column">

    <div class="header">

        <img src="images/netflixlogo" alt="" tutle="">
        <h3>Sign Up</h3>
        <span>to continue to SYNDFLIX</span>
    
    <form method="POST">


        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
        <input type="text" placeholder="First name" name="firstName" required>

        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
        <input type="text" placeholder="Last name" name="lastName" required>

        <?php echo $account->getError(Constants::$usernameCharacters); ?>
        <?php echo $account->getError(Constants::$usernameTaken); ?>
        <input type="text" placeholder="Username" name="username" required>

        <?php echo $account->getError(Constants::$emailInvalid); ?>
        <?php echo $account->getError(Constants::$emailTaken); ?>
        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
        <input type="email" name="email" placeholder="Email" required>

        <?php echo $account->getError(Constants::$passwordDoNotMatch); ?>
        <?php echo $account->getError(Constants::$passwordLength); ?>
        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
        <?php echo $account->getError(Constants::$passwordCharacters); ?>
        <input type="password" name="pword1" placeholder="Password" required>

        <input type="password" name="pword2" placeholder="Confirm Password" required>

        <input type="submit" name="btnSubmit" value="SUBMIT">

        <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
        
    </form>
    </div>

    </div>

</body>
</html>