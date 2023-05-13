<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section >
        <h1> Welcome to my shop :</h1>
        <br>
        <br>
        <?php
        $ShirtColor = $_GET['ShirtColor'];
        $ShirtSize = $_GET['ShirtSize'];
        $ShirtLogo = $_GET['ShirtLogo'];
        $count = 0;
        $colors = array("red", "green", "blue", "yellow", "orange", "Red", "Green", "Blue", "Yellow", "Orange");
        $Logo = array("Nike", "nike", "Adidas", "adidas", "Poma", "poma");
        for ($i = 0; $i < 10; $i++) 
        {
            if ($ShirtColor == $colors[$i]) {
                $count = $count + 1;
            }
        }
        for ($i = 0; $i < 6; $i++) 
        {
            if ($ShirtLogo == $Logo[$i]) {
                $count = $count + 1;
            }
        }
        if ($count > 1) 
        {
            echo "We have it in stock " . "<br>";
            echo "Shirt Logo: " . $ShirtLogo . "<br>";
            echo "Shirt Color: " . $ShirtColor . "<br>";
            echo "ShirtSize: " . $ShirtSize . "<br>";
        } else {
            echo "We dont have it in stock ): " . "<br>";
        }
        ?>
    </section>
</body>

</html>