<?php
//initialize the session
session_start();

//check if the user is already logged in, if yes then redirect him to the welcome page

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

//include the database connection file 
require_once "dbconnection.php";

//define the variables and initialize them with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";



//process the form data when the form is submitted and the method is post
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //echo "entered form processor\n";

    //check if username is empty
    if(empty(trim($_POST["username"]))){
     $username_err = "Please enter a username.";
    
    }
    //if user is not empty, get the username entered
    else{
        $username = trim($_POST["username"]);
    }
      //echo $_POST["username"];

    //check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    }
    else{
        $password = trim($_POST["password"]);
    }

    //Now we validate the input to be sure there is no error
 if(empty($username_err) && empty($password_err)){
        //echo "\nentered database processing";
        //prepare the sql statement
     $sql = "SELECT id, username, password FROM users WHERE username = :username";
          
        if($stmt = $pdo->prepare($sql)){
            //bind the variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
           // echo $sql;
            //set parameters
            $param_username = trim($_POST["username"]);
            //attempt to execute the prepared statement
            if($stmt->execute()){
                //check if username exists, if yes then verify password
           // echo"executed";
                if($stmt->rowCount() == 1){
                    echo "username already exists";

                    if($row = $stmt->fetch()){
                     echo"details fetched";
                     $id = $row["id"];
                     $username = $row["username"];
                     $hashed_password = $row["password"];
                     //the $vairable was defined above. the code below compares the hash an normal password
                        if(password_verify($password, $hashed_password)){
                         //password is correct, so start a new session
                         session_start();

                            //store the data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            //redirect the user to the homepage
                            header("location: index.php");
                         
                        }else{
                            //display an error as password is not valid
                            $login_err = "Invalid username or password.";
                        }
                        
                    }
                }else{
                    //display an error as username does not exist
                    $login_err = "Invalid username or password.";
                
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
                    <!--<a href="index.html" class="nav-item nav-link">Home</a>-->
                    <a href="" class="nav-item nav-link">Feedback</a>
                    <a href="newlogin.html" class="nav-item nav-link">Login</a>
                    <a href="signuptest.php" class="nav-item nav-link">Signup</a>
                    <a href="Password.php" class="nav-item nav-link">Reset password</a>

                </div>
                <form class="d-flex ml-auto">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>

                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="background-color: coral;">
        <div class="form-header text-center">
            <h1>Login</h1>
            <h3>Log In here using your Username and Password</h3>
        </div>
        <?php
        if(!empty($login_err)){
            echo '<div class ="alert alert-danger">' . $login_err . '</div>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row g-1 justify-content-center">
                <div class="col-6 mt-5">

                    <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> value="<?php echo $username; ?>" placeholder="Username">
                
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
                </div>
                
            <div class="row g-1 justify-content-center">
                <div class="col-6 mt-5">

                    <input type="Password" placeholder="Password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>  
                </div>
                
            </div>
            <div class="row justify-content-center">
                <div class="col-6 mt-5 justify-content-between">
                <input type="submit" class="btn btn-primary btn-lg" value="Login">
                    <a href="Password.php" class="reset">Reset Password</a>

                </div>
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