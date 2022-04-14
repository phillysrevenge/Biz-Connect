<?php
//Full server-side code written by Oluwaferanmi Fawole
//Full front end code written by Mitchell. 
//Initialize the session
session_start();
//check if the user is logged in, if not then redirect him to login page.
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: logintest.php");
exit;
}


 if($_SERVER["REQUEST_METHOD"] == "POST"){
     require_once "dbconnection.php";
     try{
         if(isset($_POST["username"])) $username = trim($_POST["username"]);
         if(isset($_POST["email"])) $email = trim($_POST["email"]);
         if(isset($_POST["phone"])) $phone = trim($_POST["phone"]);
         if(isset($_POST["address"])) $address = trim($_POST["address"]);
         if(isset($_POST["occupation"])) $occupation = trim($_POST["occupation"]);
         if(isset($_SESSION["id"])) $id = $_SESSION["id"];

         $sql = "update `users` set username = '$username', email = '$email', phone = '$phone', adderss = '$address', occupation = '$occupation' WHERE id = $id";
         $stmt = $pdo->prepare($sql);
         $stmt->execute();

         
         $message = "Successfully Updated details";
        }
        catch(PDOEXception $e){
            echo $e->getMessage();
        }
    }

    try{
        require_once "dbconnection.php";
        $id = $_SESSION["id"];
        $sql = "SELECT * FROM users WHERE id = $id";
        $stmt = $pdo->prepare($sql);

        
        $stmt->execute();

        $details = $stmt->fetch(PDO::FETCH_ASSOC);

        $pdo = null;
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
 ?>

<!DOCTYPE html>
<html lang="zxx" class=" mediaqueries csstransitions cssanimations">

<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- TITLE OF SITE -->
    <title>Bizconnect</title>

    <!-- favicon -->
    <link id="favicon" rel="icon" type="image/png" href="/lab6/CSS/assets/images/">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../CSS/bootstrap.css">

    <!-- Main style css -->
    <link rel="stylesheet" href="../CSS/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" href="../CSS/responsive.css">

    <!-- Main Color -->
    <link rel="stylesheet" href="../CSS/color_gray.css">


</head>

<body class="small_menu" style="background-color: coral;">
    <div id="page" class="site">

        <!--Start Preloader-->
        <div class="page-loader startLoad" style="opacity: 0.68892;">
            <div class="loader startLoad" style="opacity: 0.413248;"></div>
        </div>
        <!--End Preloader-->

        <div id="splitlayout" class="splitlayout open-right">

            <div class="intro">

                <div class="mob-menu-overlay"></div>
                <div class="mob-menu">
                    <div class="mob-menu-content">
                        <div class="float-left">
                            <h3 class="menu-title">
                                <h5>BIZZCONNECT</h5>
                            </h3>
                        </div>
                        <div class="float-right">
                            <nav class="navbar navbar-expand-lg container navbar-light bg-light">
                                <button class="navbar-toggler navbar-toggle collapsed" type="button">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>

                <!--.sidebar-->
                <div class="side side-right">
                    <div class="home-lines">
                        <div class="linesContent">
                            <span class="home-line"></span>
                            <span class="home-line"></span>
                            <span class="home-line"></span>
                            <span class="home-line"></span>
                        </div>
                        <div class="lines--content">
                            <span class="home--line"></span>
                            <span class="home--line"></span>
                            <span class="home--line"></span>
                            <span class="home---line"></span>
                            <span class="home---line"></span>
                            <span class="home---line"></span>
                        </div>
                    </div>
                    <div class="intro-content">
                        <div class="menu">
                            <!-- brand -->
                            <div class="my-4">
                                <img src="../images/logo.jpg" style="width: 100px">
                                <h6 class=""
                                    style="position: relative; bottom: 20px; font-size: 12px; font-weight: bold;">
                                    BIZZCONNECT</h6>
                            </div>

                            <!--Menu Items-->
                            <ul id="menu" class="list-unstyled menu_list">
                                <li class="menu-item ">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="menu-item">
                                    <a class="active_item" href="manageprofile.php">Edit Profile</a>
                                </li>
                                <li class="menu-item ">
                                    <a href="upload.php">Upload</a>
                                </li>
                                <li class="menu-item">
                                    <a href="bizfeedbackform.php">Feedback</a>
                                </li>
                            </ul>
                        </div>
                        <!--.menu-->
                    </div>
                    <!--.intro-content-->
                </div>
                <!--.sidebar-->
                <!-- content -->
                <div class="pag-e page-right page-right-zero-height">
                    <div id="pt-main" class="pt-perspective page-inner overFlowHidden">
                        <!--Start About Section-->
                        <section class="about pt-page pt-page-current" id="about">
                            <div class="scroll___content">
                                <div class="scroll__content">
                                    <div class="sec_title">
                                        <h2>Manage Profile</h2>
                                    </div>

                                    <div class="sec__content">
                                        <div class="container">

                                            <!-- Edit  Profile form -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mx-auto text-center">
                                                        <img class="img-avatar" src="/lab6/images/avatar.png" alt="">
                                                        <p><a href="">Change Profile</a></p>
                                                    </div>
                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                        <div class="card card-default p-3">
                                                            <div class="card-heading">
                                                                <p> Update Details </p>
                                                            </div>
                                                            <div class="card-body">
                                                                
                                                                <div class="form-group  mt-4">
                                                                    <label class=" control-label">Username <span
                                                                            class="asterisk">*</span></label>
                                                                    <div class="">
                                                                        <input type="text" name="username"
                                                                            class="form-control"
                                                                            value="<?php echo $details["username"]; ?>" required/>
                                                                    </div>
                                                                </div>

                                                                
                                                               

                                                                <div class="form-group  mt-4">
                                                                    <label class=" control-label"> Phone Number <span
                                                                            class="asterisk">*</span></label>
                                                                    <div class="">
                                                                        <input type="number" name="phone"
                                                                            class="form-control" value = "<?php echo $details["phone"]; ?>" required/>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group  mt-4">
                                                                    <label class=" control-label">Email <span
                                                                            class="asterisk">*</span></label>
                                                                    <div class="">
                                                                        <input type="email" name="email"
                                                                            class="form-control"
                                                                            value="<?php echo $details["email"]; ?>" required />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group  mt-4">
                                                                    <label class=" control-label">Address <span
                                                                            class="asterisk">*</span></label>
                                                                    <div class="">
                                                                        <input type="text" name="address"
                                                                            class="form-control"
                                                                            value="<?php echo $details["adderss"]; ?>" required />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group  mt-4">
                                                                    <label class=" control-label">Occupation <span
                                                                            class="asterisk">*</span></label>
                                                                    <div class="">
                                                                        <input type="text" name="occupation"
                                                                            class="form-control"
                                                                            value="<?php echo $details["occupation"]; ?>" required />
                                                                    </div>
                                                                </div>

                                                               

                                                               

                                                            </div><!-- card-body -->
                                                        </div><!-- card -->
                                                        <div class="card-footer">
                                                            <button type="submit">SAVE</button>
                                                            <button class="btn btn-warning">CANCEL</button>
                                                        </div>
                                                    </form>
                                                </div><!-- col-md-6 -->
                                            </div>
                                            <!-- END Edit  Profile info form -->

                                        </div>
                                        <!--.container-->
                                    </div>
                                    <!--.sec__content-->
                                </div>
                                <!--.scroll__content-->
                            </div>
                        </section>
                        <!--End About Section-->
                    </div>
                </div>
            </div>

        </div>
        <!--.splitlayout-->

    </div><!-- #page -->

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>

    <style type="text/css">
        label {
            display: block;
            text-align: left;
        }

        select {
            min-height: 50px;
        }

        .navbar-toggle .icon-bar {
            background-color: coral;
            height: 2px;
            width: 22px;
            transition: all 0.2s;
            border: 1px solid coral;
            margin: 0 2px;
        }

        .card-default {
            border: none;
        }

        .img-avatar {
            width: 150px;
        }
    </style>
</body>

</html>