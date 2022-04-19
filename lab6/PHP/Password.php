<?php
//Frontend code written by Femi
//Full server side code written by Oluwaferanmi Fawole.
//Start the session
session_start();

//confirm the user is logged in, if not send him to the login page.

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//include our database connection file

require_once "dbconnection.php";

//define the variables with empty values initially

$email = $newpassword =$confirmpassword = "";
$emailerror = $newpassworderror = $confirmpassworderror = ""; 

//now we process the form data
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // first validate the email field
    if(empty(trim($_POST["email"]))){
       $emailerror = "Please enter a valid email address.";
    }
    else{
        $email = trim($_POST["email"]);
    }

    //validate the password field also.
    if(empty(trim($_POST["newpassword"]))){
        $newpassworderror = "Please enter a password";
    }
    else{
        $newpassword = trim($_POST["newpassword"]);
    }

    //validate the confirmpassword field also
    if(empty(trim($_POST["confirmpassword"]))){
        $confirmpassworderror = "Please confirm the password entered above.";
    }
    else{
        $confirmpassword = trim($_POST["confirmpassword"]);
        if(empty($newpassworderror) && ($newpassword != $confirmpassword)){
            $confirmpassworderror = "The passwords did not match.";
        }
    }

    //ensure there is no input error before sending to the database
    if(empty($emailerror) && empty($newpassworderror) && empty($confirmpassworderror)){
        //prepare the sql statement to update the password in the database
        $sql = "UPDATE users SET password = :password WHERE id = :id";

        if($stmt =$pdo->prepare($sql)){
            //Bind the variables :password and :id to something called parampassword and paramid
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            //after binding them, now we set the password to be hashed using php's default algorithm
            $param_password = password_hash($newpassword, PASSWORD_DEFAULT);
            //set the parameter for id too using the session id since the user is already loggedin
            $param_id = $_SESSION["id"];

            //execute the statement
            if($stmt->execute()){
                //the password has been updated successfully so we can destroy the session
                session_destroy();
                //after destroying the session, redirect the user to the login page
                header("location: login.php");
                exit();
            }
            else{
                echo "Sorry buddy something went wrong. Try again after a cup of tea.";
            }
            //now we can close the statement
            unset($stmt);
        }
    }

    //close the connection
    unset($pdo);


}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&family=Roboto+Serif:wght@100;200&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="../CSS/indexm.css">
    <title>forgot password</title>
</head>

<body>
    <header>
        <div class="biz-name">
            <img src="../images/logo.jpg" alt="" class="" style="width: 90px; height: 50px;">
        </div>
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="signup.php" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="bizfeedbackform.php" class="nav-link">Feedback</a></li>
              
            </ul>
        </nav>
        
    </header>
    <main>
        <div class="feedback-container">
            <div>
                <img class="image" src="../images/site-pix.jpg" alt="bizconnect">
            </div>
            <div class="feedback-main">
                <h2>Forgot your password ?</h2>
                <p>No worries if you've forgotten your password, we have you covered! Enter your email below and you'll
                    receive instructions to be ble to reset your password.
                </p>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="password-reset-form" method="post">
                <!-- the htmlspecialchars above converts all evil strings attackers may use to html entities-->
                    <div>
                     <label for="email">Email:</label><br>

                     <input type="email" name="email" id="submit" placeholder="Email" class="form-control <?php echo (!empty($emailerror)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                     <span class="invalid-feedback"><?php echo $emailerror; ?></span>
                    </div>
                    <div class="form-group">
                     <label>New Password</label>
                      <input type="password" name="newpassword" class="form-control <?php echo (!empty($newpassworderror)) ? 'is-invalid' : ''; ?>" value="<?php echo $newpassword; ?>">
                       <span class="invalid-feedback"><?php echo $newpassworderror; ?></span>
                   </div> 
                   <div class="form-group">
                     <label>Confirm Password</label>
                     <input type="password" name="confirmpassword" class="form-control <?php echo (!empty($confirmpassworderror)) ? 'is-invalid' : ''; ?>">
                     <span class="invalid-feedback"><?php echo $confirmpassworderror; ?></span>
                    </div> 
                    <div class="form-group">
                     <input type="submit" class="btn btn-secondary" value="Submit">
                     <a class="btn-btn-link ml-2" href="index.php">Cancel</a>
                    </div>  

                </form>
            </div>
        </div>
    </main>
    <footer>
        <div class="skill-footer">
            <p>© Copyright Bizconnect 2022</p>
            <div class="footer-social-media">
                <span><a href="#">Instagram</a> </span>
                <span><a href="#">Facebook</a></span>
                <span><a href="#">Twitter</a></span>
                <span><a href="#">LinkedIn</a></span>
            </div>
        </div>
    </footer>
</body>

</html>