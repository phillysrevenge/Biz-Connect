<?php
//Initialize the session
//Full frontend code written by Femi
//Full server-side code written by Oluwaferanmi Fawole
session_start();
//check if the user is logged in, if not then redirect him to login page.

?>

<?php
 require_once "dbconnection.php";
  try{
    $sql = "SELECT * FROM uploads";
    $stmt = $pdo ->prepare($sql);
    $stmt->execute();
    $uploads = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = count($uploads);
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
    <link rel="stylesheet" href="../CSS/indexm.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&family=Roboto+Serif:ital,wght@0,100;0,200;0,600;1,100;1,200;1,400;1,500;1,600&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="../CSS/indexm.css">
    <title>Document</title>
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
            <input class="input-form-search type=" text" name="searchfield" placeholder="Search">
            <input type="submit" value="Submit">
        </form>
    </header>

    <main>
        <div class="skills">
            <?php 
            foreach($uploads as $upload){
             ?>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="<?php echo $upload["image"];?>" alt="skill1">
                    <h3><?php echo $upload["name"];?></h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location"><?php echo $upload["location"];?></span>
                        </span>
                        <span>
                            Price($): <span class="skills-availability"><?php echo $upload["price"];?> </span>
                        </span>
                        <span>
                            Contact: <span class="skills-availability"> <?php echo $upload["contact"];?></span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Description</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'> <b> <i><?php echo $upload["description"];?></i></b></div>
                </div>
            </div>
            <?php }?>
            <!--
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill2.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Jason Plumber</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill3.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill4.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill5.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill6.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill7.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill8.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill9.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill5.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill10.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill4.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill5.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill4.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill1.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill2.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill5.jpeg" alt="skill5">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill6.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill8.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>
            <div class="skills-container card">
                <div class="skill">
                    <img class="skill-img" src="../images/skill9.jpeg" alt="skill1">
                    <h3>Lumidee Barber</h3>
                    <span class='skills-detail'>
                        <span>
                            Location: <span class="skills-location">AB25 1LE</span>
                        </span>
                        <span>
                            Available: <span class="skills-availability">Yes </span>
                        </span>
                    </span>
                </div>
                <div class="skills-info">
                    <div class='skills-name'>Lumidee's Saloon</div>
                    <div class='skills-tagline'>Just a try will convince you.</div>
                    <div class='skills-description'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                        placeat nostrum atque architecto corrupti rem consequatur ipsa, similique repellendus iure illum
                        et vel quibusdam sint sit animi ea. Aliquid, quis!</div>
                </div>
            </div>

        </div> -->

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