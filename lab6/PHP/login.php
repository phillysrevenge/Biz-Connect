<?php
//Front-end and server side code written by Oluwaferanmi Fawole.
//initialize the session
session_start();

//The below code checks if the user is already logged in, if he/she is, then redirect him to the welcome page

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

//include the database connection file 
require_once "dbconnection.php";

//define the variables as empty values at first.
$username = $password = "";
$usernameerror = $passworderror = $loginerror = "";



//process the form data when the form is submitted and the method is post. If the method is not post this will be skipped.
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //echo "entered form processor\n";

    //check if username field is empty, if it is empty, display an error.
    if(empty(trim($_POST["username"]))){
     $usernameerror = "Please enter a username.";
    
    }
    //if the username field is not empty, get the username entered and assign it to the variable username
    else{
        $username = trim($_POST["username"]);
    }
      //echo $_POST["username"];

    //check if password is empty, if empty generate the error below.
    if(empty(trim($_POST["password"]))){
        $passworderror = "Please enter a password.";
    }
    //If it's not empty then store the password in the variable.
    else{
        $password = trim($_POST["password"]);
    }

    //Now we validate the input to be sure there is no error, if there is no error we send the details to DB.
 if(empty($usernameerror) && empty($passworderror)){
        //echo "\nentered database processing";
        //prepare the sql statement below, and insert the users details in the users table.
     $sql = "SELECT id, username, password FROM users WHERE username = :username";
          
        if($stmt = $pdo->prepare($sql)){
            //We have to bind the values :username to a parameter. The statement below binds it to the username parameter 
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
           // echo $sql;
            //set parameters
            $param_username = trim($_POST["username"]);
            //attempt to execute the prepared statement
            if($stmt->execute()){
                //check if username exists in the database, if yes then verify the password the user entered.
           // echo"executed";
                if($stmt->rowCount() == 1){
                    //echo "username already exists";

                    if($row = $stmt->fetch()){
                     //echo"details fetched";
                     $id = $row["id"];
                     $username = $row["username"];
                     $hashed_password = $row["password"];
                     //the $variable was defined above. the code below compares the hash and normal password. Thpassword was hashed upon signup for security reasons.
                        if(password_verify($password, $hashed_password)){
                         //password is correct, so start a new session
                         session_start();

                            //store the data below in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            //After verifying the user has correct details, redirect the user to the homepage to progress with their life.
                            header("location: index.php");
                         
                        }else{
                            //display an error as password is not valid
                            $loginerror = "Invalid username or password.";
                        }
                        
                    }
                }else{
                    //display an error as username does not exist
                    $loginerror = "Invalid username or password.";
                
                    //echo "WRONG DETAILS BOSS";
                }
                    
            }else{
                echo "Oops! Something is wrong. Kindly try again later.";
            }
            //close the statement
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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/indexm.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg " style="background-color: coral;">
        <div class="container">
            <img src="../images/logo.jpg" alt="" class="" style="width: 90px; height: 50px;">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navs">
                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse" id="navs">
                <div class="navbar-nav">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="bizfeedbackform.php" class="nav-item nav-link">Feedback</a>
                    <a href="signup.php" class="nav-item nav-link">Signup</a>
                    <a href="Password.php" class="nav-item nav-link">Reset password</a>

                </div>
                

                </form>
            </div>
        </div>
    </nav>

    <div class="container  mt-5 mb-5 h-100 w-80" style="background-color: white; border: 40px solid grey; border-radius: 20px;">
        <div class="form-header text-center">
            <h1 class="mt-5">Login</h1>
            <h3 class="mt-3">Log In here using your Username and Password</h3>
        </div>
        <!--The php statement below displays the login error defined in a variable above. Uses the bootstrap class to style the color of the error message-->
        <?php
        if(!empty($loginerror)){
            echo '<div class ="alert alert-danger">' . $loginerror . '</div>';
        }
        ?>
        <form class= " justify-content-center p-5 logincont" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
           <div class="row ">
                <div class="col-md-6">
                   <div class=" mt-5">

                     <input type="text" name="username" id="username" class="form-control <?php echo (!empty($usernameerror)) ? 'is-invalid' : ''; ?> value="<?php echo $username; ?>" placeholder="Username">
                
                     <span class="invalid-feedback"><?php echo $usernameerror; ?></span>
                    </div>
            
                
               
                   <div class=" mt-5">

                     <input type="Password" placeholder="Password" name="password" class="form-control <?php echo (!empty($passworderror)) ? 'is-invalid' : ''; ?>">
                     <span class="invalid-feedback"><?php echo $passworderror; ?></span>  
                   </div>
                
                
            
                  <div class="mt-5 mb-5">
                    <input type="submit" class="btn btn-secondary btn-lg" value="Login">
                    <a href="Password.php" class="reset">Reset Password</a>

                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                <img style="height: 30rem;" src="https://images.unsplash.com/photo-1555212697-194d092e3b8f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mjl8fHdvcmt8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    class="img-fluid img-thumbnail" alt="">
            </div>
           </div>
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