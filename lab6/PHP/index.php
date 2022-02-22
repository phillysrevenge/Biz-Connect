<!DOCTYPE html>
<html lang="en">

<head>

    <title>Document</title>
</head>

<body>
    <p>
        <?php
        echo "Hello World";
        ?>
    </p>
<p>
    <?php
    $name="Philly";
    $myage=2;
    if($myage > 17){
        print $name . " Buy Specs";
    }
     
    elseif($myage >18){
        print $name . "Buy Mugs";
    }
    else{
        print $name . " Buy Sausage rolls <br>";
    }
    echo str_replace("Hello", "Philly", "Hello World") . "<br>";
    echo(min(1, 4, 7, 0.5, 6, 7, 8, 9)) . "<br>";
    echo(sqrt(9.5));
    ?>

</p>
</body>

</html>