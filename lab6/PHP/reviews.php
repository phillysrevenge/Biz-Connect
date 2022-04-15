<?php
//Initialize the session
//Full frontend code written by Femi and Fawole
//Full server-side code written by Oluwaferanmi Fawole
session_start();
//check if the user is logged in, if not then redirect him to login page.

?>

<?php
 require_once "dbconnection.php";
  try{
    $sql = "SELECT * FROM reviews";
    $stmt = $pdo ->prepare($sql);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = count($reviews);
 }
 catch(PDOException $e){
    echo $e->getMessage();
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/indexm.css">
  </head>
    <body>
        <header>
            <div class="biz-name">
                <img src="../images/logo.jpg" alt="" style="width: 90px; height: 50px;">
                <p class="description">A Place to find the expertise you require</p>
            </div>
            <h1>Hi Welcome to BizConnect</h1>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link" target="">logout</a></li>
                    <li class="nav-item"><a href="manageprofile.php" class="nav-link" target="">Profile</a>
                    </li>
                    <li class="nav-item"><a href="bizfeedbackform.php" class="nav-link">Feedback</a></li>
                    <li class="nav-item"><a href="Password.php" class="nav-link">Reset Password</a></li>
                    <li class="nav-item"><a href="Contactus.php" class="nav-link">Contact Us</a></li>
                </ul>
            </nav>
            <form class="form-search">
                <input class="input-form-search" type=" text" name="searchfield" placeholder="Search">
                <input type="submit" value="Submit">
            </form>
        </header>
          <h1 class="display-3 text-center p-4 mt-5">REVIEWS</h1>
       <div class="container p-5 mb-5" style="border: 23px solid grey; border-radius: 10px; background-color: rgb(250, 242, 242);" >
            
           <div class="row justify-content-between mb-5">
             <?php 
              foreach($reviews as $review){
             ?>
                <div class="card col-5 mb-5" style="border: 10px solid grey;">
                    <div class="card-body p-3">
                        <h5 class="card-title"><?php echo $review["username"]; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $review["service"]; ?></h6>
                        <p class="card-text"> <b><i><?php echo $review["feedback"]; ?></b></i></p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
                <?php }?>

                <!--<div class="card col-4" style="border: 10px solid grey;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>-->

            </div>

            <!--<div class="row justify-content-between">
                <div class="card col-4" style="border: 10px solid grey;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>

                <div class="card col-4" style="border: 20px solid grey;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>

            </div>-->

            
       </div>
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