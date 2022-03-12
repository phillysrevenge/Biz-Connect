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
                <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="newlogin.html" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="signup004.html" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="bizfeedbackform.html" class="nav-link">Feedback</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
            </ul>
        </nav>
        <form class="form-search">
            <input class="input-form-search type=" text" name="searchfield" placeholder="Search">
            <input type="submit" value="Submit">
        </form>
    </header>
    <main>
        <div class="feedback-container">
            <div>
                <img class="image" src="../images/site-pix.jpg" alt="bizconnect">
            </div>
            <div class="feedback-main">
                <h2>Forgot your password ?</h2>
                <p>No worries if you've forgotten your password, we have you covered! Enter your email below and you'll
                    receive instructions to be ble to reset your password.</p>

                <form action="" class="password-reset-form">
                    <label for="email">Email:</label><br>
                    <input type="email">
                    <input type="submit" name="" id="submit" value="Reset password">
                    <div class="form-group">
                     <label>New Password</label>
                      <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                       <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                   </div> 
                   <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>

                 </div> 
                 <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Submit">
                   <a class="btn-btn-link ml-2" href="welcome.php">Cancel</a>

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