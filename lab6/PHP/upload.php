<?php
//Frontend and server side code written by Oluwaferanmi Fawole.
  require_once "dbconnection.php";
   
  if($_SERVER["REQUEST_METHOD"] == "POST"){
      $dir = "uploads/";
      $filename = $dir . basename($_FILES["picture"]["name"]);
     
      $uploadOk = 1;
      $file_type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
      echo '<pre>'; print_r($_FILES); echo '</pre>';

      if($_FILES["picture"]["size"] > 500000){
          echo "File is too large";
          $uploadOk = 0;
       }
       if($uploadOk = 0){
           echo "Upload not successful";
       }
       else{
           if(move_uploaded_file($_FILES["picture"]["tmp_name"], $filename)){
               if(isset($_POST["name"])) $name = $_POST["name"];
               if(isset($_POST["location"])) $location = $_POST["location"];
               if(isset($_POST["occupation"])) $occupation = $_POST["occupation"];
               if(isset($_POST["price"])) $price = $_POST["price"];
               if(isset($_POST["contact"])) $contact = $_POST["contact"];
               if(isset($_POST["description"])) $description = $_POST["description"];
               $picture = $filename;
               
               $sql = "INSERT INTO uploads (name, location, occupation, price, contact, image, description) VALUES ('$name', '$location', '$occupation', '$price', '$contact', '$picture', '$description')";
                $result = $pdo->exec($sql);

                header("location: index.php");
           }
           else{
               echo "Sorry your upload was not successful";
           }
       }
  }
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/upload.css">
    <link rel="stylesheet" href="../CSS/indexm.css">
</head>

<header>
        <div class="biz-name">
            <img src="../images/logo.jpg" alt="" style="width: 90px; height: 50px;">
            <p class="description">A Place to find the expertise you require</p>
        </div>
        
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
        
    </header>
<body>
    <h1 class="display-4 text-center py-5 mt-5">Share your work with others</h1>

    <div class="container">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row p-5 mb-5" method="post" enctype="multipart/form-data" >
            <div class="col-md-6 col-sm-6">

                <div class="mb-5">


                    <input type="text" class="form-control" id="inputPassword" placeholder="Name" name="name" required>
                </div>

                <div class="mb-5">


                    <input type="text" class="form-control" id="inputPassword" placeholder="Location" name="location" required>
                </div>

                <input class="form-control mb-5" list="datalistOptions" id="exampleDataList" name="occupation"
                    placeholder="Select Occupation..." required>
                <datalist id="datalistOptions">
                    <option value="Barber">
                    <option value="Tailor">
                    <option value="Carpenter">
                    <option value="Chef">
                    <option value="Artist">
                </datalist>
                <div class="mb-5">


                    <input type="number" class="form-control" id="inputPassword" placeholder="Price($)" name="price" required>
                </div>
                <div class="mb-5">


                    <input type="text" class="form-control" id="inputPassword" placeholder="Contact" name="contact">
                </div>
                <div class="mb-5">
                    <input type="file" name="picture" class="form-control" id="picture" required>
                </div>
                
                <div class="mb-3">
                 <label for="Description" class="form-label">Description</label>
                  <textarea class="form-control" id="Description" name="description" rows="4" required></textarea>
                </div>
                <input type="submit" class="btn bg-secondary mb-3" value="upload">
            </div>

            <div class="col-md-6 col-sm-6">
                <img src="https://images.unsplash.com/photo-1555212697-194d092e3b8f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mjl8fHdvcmt8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    class="img-fluid img-thumbnail" alt="">
            </div>
        </form>

    </div>
    <div class="buffer">

    </div>
    <footer class="mt-5">
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