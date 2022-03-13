<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg " style="background-color: coral;">
        <div class="container">
            <img src="../images/logo.jpg" alt="" style="width: 90px; height: 50px;">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navs">
                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse" id="navs">
                <div class="navbar-nav">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="" class="nav-item nav-link">Contact Us</a>
                    <a href="logintest.php" class="nav-item nav-link">Login</a>
                    <a href="signuptest.php" class="nav-item nav-link">Signup</a>

                </div>
                <form class="d-flex ml-auto">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>


            </div>
        </div>
    </nav>


    <div class="container mt-5" style="background-color: coral;">

        <form action="">

            <h3 class="text-center">CUSTOMER FEEDBACK FORM</h3>
            <div class=" row">
                <div class="form-group col-md-6">
                    <label for="Name">
                        <h5>Name</h5>
                    </label>
                    <input type="text" class="form-control bg-white" name="" id="">
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
                    <input type="radio" class="" name="service" id="excellent">
                </div>
                <div class="col">
                    <label for="good">Good</label> <br>
                    <input type="radio" name="service" id="good">
                </div>
                <div class="col">
                    <label for="average">Average</label> <br>
                    <input type="radio" class="align-self-center" name="service" id="average">
                </div>
                <div class="col">
                    <label for="dissatisfied">Dissatisfied</label> <br>
                    <input type="radio" name="service" id="Dissatisfied">
                </div>
            </div>
            <h5>Comments</h5>
            <p>We would love to hear your comments or suggestion to help us serve you better.</p>
            <div class="row justify-content-center">
                <div class="col-4">
                    <input type="radio" name="comment" id="Comments">
                    <label for="Comments">Comments</label>
                </div>
                <div class="col-4 ">
                    <input type="radio" name="comment" id="Suggestion">
                    <label for="Suggestion">Suggestion</label>
                </div>
            </div>

            <div class=" row justify-content-center">
                <div>
                    <textarea class="form-control" name="input" id="" cols="80" rows="10"></textarea>
                </div>
            </div>

            <div class=" mt-3">
                <button class="btn " style="background-color: cornsilk;">Submit</button>
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
</body>

</html>