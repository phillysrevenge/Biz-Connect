<?php
//Full server side and frontend code written by Oluwaferanmi Fawole and Femi.
  //Initialize the session
  session_start();
  //check if the user is logged in, if not then redirect him to login page.
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
  exit;
}
?>

<?php
   require_once "dbconnection.php";
   $name = $email =$service =$rating = $feedback = "";
   $nameerror= $emailerror = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(empty(trim($_POST["name"]))){
          $nameerror = "Enter a name.";
      }
      elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))){
       $nameerror = "You have entered dangerous characters";
      }
      else{
          $name = trim($_POST["name"]);
       }
       echo "got name";
      if(empty(trim($_POST["email"]))){
       $emailerror = "Enter an email";
      }
      else{
          $email = trim($_POST["email"]);
       }

       if(empty(trim($_POST["service"]))){
        echo"Select a service";
       }
       else{
           $service = trim($_POST["service"]);
        }
        
        if(empty(trim($_POST["rating"]))){
            echo "Rate the service";
        }
        else{
            $rating = trim($_POST["rating"]);
        }

        if(empty(trim($_POST["feedback"]))){
            echo "Enter an comment";
        }
        else{
            $feedback = trim($_POST["feedback"]);
        }
        echo "got details";
         
        if(empty($nameerror) && empty($emailerror)){
            echo "gotten info";
            $sql = "INSERT INTO reviews (username, email, feedback, service, rating) VALUES (:username, :email, :feedback, :service, :rating)";
            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                $stmt->bindParam(":feedback", $param_feedback, PDO::PARAM_STR);
                $stmt->bindParam(":service", $param_service, PDO::PARAM_STR);
                $stmt->bindParam(":rating", $param_rating, PDO::PARAM_STR); 


                $param_username = $name;
                $param_email = $email;
                $param_feedback = $feedback;
                $param_service = $service;
                $param_rating = $rating;

                if($stmt->execute()){
                    header("location: Fedbackresponse.php");
                }
                else{
                    echo "Sorry something went wrong";
                }
                unset($stmt);

            }
        
        }
        else{
            echo "something went wrong";
        }
        unset($pdo);


  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="../CSS/indexm.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg " style="background-color: coral;">
        <div class="container" >
            <img src="../images/logo.jpg" alt="" style="width: 90px; height: 50px;">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navs">
                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse" id="navs">
                <div class="navbar-nav">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="Contactus.php" class="nav-item nav-link">Contact Us</a>
                    <a href="login.php" class="nav-item nav-link">Login</a>
                    <a href="signup.php" class="nav-item nav-link">Signup</a>

                </div>
                


            </div>
        </div>
    </nav>


    <div class="container mt-5 " style="border: 20px solid grey; background-color: rgba(128,128,128, 0.2); border-radius:20px;">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="p-5" method="post">

            <h3 class="text-center">CUSTOMER FEEDBACK FORM</h3>
            <div class=" row">
                <div class="form-group col-md-6">
                    <label for="Name">
                        <h5>Name</h5>
                    </label>
                    <input type="text" class="form-control <?php 
                    echo (!empty($nameerror)) ? 'is-invalid' : ''; ?> bg-white" name="name" required value="<?php echo $name; ?>">
                      <span class="invalid-feedback">
                      <?php echo $nameerror; ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">
                        <h5>Email</h5>
                    </label>
                    <input type="email" name="email" id="email" class="form-control">

                </div>
            </div>
            <div class="form-group">
                <label for="Service">Service Received</label>
                <select name="service" id="service" class="form-control">
                    <option value="pick">--Pick an Option--</option>
                    <option value="Barbing">Barbing</option>
                    <option value="Phone Repair">Phone Repairs</option>
                    <option value="Tailor">Tailor</option>
                    <option value="Chef">Chef</option>
                </select>
            </div>
            <h5>How was the service?</h5>
            <div class="row justify-content-center">

                <div class="col">
                    <label for="excellent">Excellent</label> <br>
                    <input type="radio" class="" name="rating" id="excellent">
                </div>
                <div class="col">
                    <label for="good">Good</label> <br>
                    <input type="radio" name="rating" id="good">
                </div>
                <div class="col">
                    <label for="average">Average</label> <br>
                    <input type="radio" class="align-self-center" name="rating" id="average">
                </div>
                <div class="col">
                    <label for="dissatisfied">Dissatisfied</label> <br>
                    <input type="radio" name="rating" id="Dissatisfied">
                </div>
            </div>
            

            <div class=" row justify-content-center">
                <div>
                    <textarea class="form-control" name="feedback" id="" cols="80" rows="10"></textarea>
                </div>
            </div>

            <div class=" mt-3">
               
                <input type="submit" class="btn btn-secondary" value="Submit">
            </div>
    </div>
    </form>

    </div>
    <footer class="mt-3">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
</body>

</html>