<?php
require_once "dbconnection.php";

$username = $email = $password = $phone = "";
$usernameerror = $emailerror = $passworderror = $phone_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //validate the username
    if(empty(trim($_POST["username"]))){
        $usernameerror = "Please enter a username.";
     
    } 
    //The below code acts as a security against sql injection or an xss attack.
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $usernameerror = "Username can only contain letters, numbers, and underscores.";
    }
    else{
        //we now prepare the select statement after getting the username without any dangerous characters.
        $sql = "SELECT id FROM users WHERE username = :username or email = :email";
        if($stmt = $pdo->prepare($sql)){
            //binds variables username and email to the prepared statement as parameters:username and :email
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
    
            //The code below sets the parameters and assigns them the variables. 
            $param_username = trim($_POST["username"]);
            $param_email = trim($_POST["email"]);
    
            //Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    //the code above checks if a user with that username exists and returns the error below if so.
                    $usernameerror = "This username or email is already taken.";
                } 
                else{
                    $username = trim($_POST["username"]);
                }
            }
            else{
                echo "Ouch! Something went wrong. Please try again later.";
            }
           
            //we will now close the statement
            unset($stmt);
        }
    }

    //We validate the password also
    if(empty(trim($_POST["password"]))){
        $passworderror = "Please enter a password";
        //if the password field is empty display the error above.
    }
    elseif(strlen(trim($_POST["password"])) <5){
        $passworderror = "Password must have atleast 5 characters.";
        //if the password is less than 5 characters an error is displayed. This helps for security also
    }
    else{
        $password = trim($_POST["password"]);
    }
    //Validate the other details below too.
    //validate email
    if(empty(trim($_POST["email"]))){
        $emailerror = "Please enter an email address.";
    }
    else{
        $email = trim($_POST["email"]);
    }

    //validate phone
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter a Phone number.";
    }
    else{
        $phone = trim($_POST["phone"]);
    }

    //check if there's an error before sending to database to avoid wrong entries
    if(empty($usernameerror) && empty($passworderror) && empty($emailerror) && empty($phone_err)){
    
        //create an sql insert statement to put the values in the database table users.
        $sql = "INSERT INTO users (username, password, email, phone) VALUES (:username, :password, :email, :phone)";
    
     if($stmt = $pdo->prepare($sql)){
         //bind the variables to the prepared sql statement as parameters
         $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
         $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
         $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
         $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);
         //Assign values to the paramters
         $param_username = $username;
         $param_password = password_hash($password, PASSWORD_DEFAULT); //This code hashes the password for security using the default php feature.
         $param_email = $email;
         $param_phone = $phone;

         //attemt to execute the prepared statement
         if($stmt->execute()){
           //Redirect the user to login page if he/she has successfully logged in.
            header("location: logintest.php");
           }
          else{
            echo "Oops! Something went wrong buddy. Please try again later.";
           }
    
    
         //close the statement
         unset($stmt);
        }
    
    }
    //close connection
    unset($pdo);
    
}

?>


<!--HTML code-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/indexm.css">
    <link rel="stylesheet" href="../CSS/signup.cs">
    
</head>


<body>
    <header style="margin-bottom: 5em;">
        <div class="biz-name">
            <img src="../images/logo.jpg" alt="" style="width: 90px; height: 50px;">
            <p class="description">A Place to find the expertise you require</p>
        </div>
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="logintest.php" class="nav-link" >Login</a></li>
                <li class="nav-item"><a href="Contactus.php" class="nav-link" >Contact Us</a>
                </li>
                <li class="nav-item"><a href="bizfeedbackform.php" class="nav-link">Feedback</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
            </ul>
        </nav>
        <form class="">
            <input class="input-form-search type=" text" name="searchfield" placeholder="Search">
            <input type="submit" value="Submit">
        </form>
    </header>

    <div class="mt-2 signcontainer">
        <div class="form-header text-center">
            <h1>Create an Account</h1>

        </div>
    </div>
    <div class="container mt-5 formcontainer">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-3 signform" method="post">
            <div class="row">
                <div class="col-6">
                    <input type="text" name="username" class="form-control <?php 
    echo (!empty($usernameerror)) ? 'is-invalid' : ''; ?>" placeholder="Username" value="<?php echo $username; ?>">
            
            <span class="invalid-feedback">
        <?php echo $usernameerror; ?></span>
            </div>
                <div class="col-6">
                    <input type="text" name="email" class="form-control bg-white <?php echo (!empty($usernameerror)) ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?php echo $email; ?>">
                    <span class="invalid-feedback">
        <?php echo $usernameerror; ?></span>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6">
                    <input type="password" name="password" id="" class="form-control <?php echo (!empty($passworderror)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Password" value="<?php echo $password; ?>">
                    <span class="invalid-feedback">
        <?php echo $passworderror; ?></span>
                </div>
                <div class="col-6">
                    <input type="text" name="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>" placeholder="Phone (+44)">
                    <span class="invalid-feedback">
        <?php echo $phone_err; ?>
    </span>
                </div>
            </div>
            <div class="row mt-5">
                <div class="form-group col-12">
                    <label for="occupation">Select Occupation</label>


                    <select name="occupation" id="occupation" class="form-control">
                        <option value="None">--Kindly Select an Occupation--</option>
                        <option value="Barber">Barber</option>
                        <option value="Tailor">Tailor</option>
                        <option value="Tailor">Chef</option>
                        <option value="Plumber">Plumber</option>
                        <option value="Hair dresser">Hair dresser</option>
                    </select>

                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6">
                    <input type="text" name="address" class="form-control" placeholder="Address">
                </div>
                <div class="col-6">
                    I agree with the <span><a href="Terms.php" target="_blank">Terms of use</a></span>
                    <input type="checkbox" name="agree" >
                </div>
            </div>
            <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit">
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script> 


</div>
    <footer class="">
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