<?php
include 'config.php';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

session_start();
//testing connection success
if (mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}

if (!empty($_POST["loginMail"])) {
    $query = "INSERT INTO `tbl_214_users` (`name`, `email`, `password`) VALUES ('" . $_POST["firstName"] . " " . $_POST["lastName"] . "', '" . $_POST["loginMail"] . "', '" . $_POST["loginPass"] . "');";

    $result = mysqli_query($connection, $query);
    header('Location: ' . URL . 'login.php');
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Project Creation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body>
    <section class="screen">
        <div id="headerContainer">
            <header>
                <nav class="navbar navbar-light bg-light" id="navbarLogin">
                    <a href="index.php" class="navbar-brand" id="logoContainer">
                        <div id="logo"></div>
                    </a>
                    <a href="https://www.shenkar.ac.il/he/departments/engineering-software-department"
                        class="navbar-brand" id="logoContainer">
                        <div id="shenkarLogoImage"></div>
                    </a>
                    <div class="mobileHeader">
                        <a href="index.php">
                            <div id="login"></div>
                        </a>
                    </div>
                </nav>
            </header>
        </div>
        <section class="body-conForm login">
            <section id="loginFormContainer">
                <section id="signFormContainerBox">
                    <h1><b>SignUp</b></h1>
                    <form action="#" method="post" class="needs-validation" novalidate id="loginForm">
                        <div class="rowS">
                            <div class="colS" id="leftColS">
                                <label for="loginMail"><b>Full Name</b></label>
                                <input type="text" class="form-control" name="firstName" placeholder="First name"
                                    aria-label="First name" required>
                            </div>
                            <div class="colS" id="rightColS">
                                <label for="loginMail"><b>&nbsp;</b></label>

                                <input type="text" class="form-control" name="lastName" placeholder="Last name"
                                    aria-label="Last name" required>
                            </div>
                        </div>
                        <div class="form-group rowS">
                            <label for="loginMail"><b>Email </b></label>
                            <input type="email" class="form-control" name="loginMail" id="loginMail"
                                aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="loginPass"><b>Password </b></label>
                            <input type="password" class="form-control" name="loginPass" id="loginPass"
                                placeholder="Enter Password" required>
                        </div>
                        <div class="form-group">
                            <button id="submitLoginSign" type="submit" class="btn btn-primary login"><b>Sign
                                    Up</b></button>
                        </div>
                        <div class="form-group" id="loginLink">
                            <a href="login.php">Log In</a>
                        </div>
                    </form>
                </section>
            </section>
        </section>
        <script src="js/script.js"></script>
</body>

</html>

<?php
mysqli_free_result($result);
mysqli_close($connection);
?>