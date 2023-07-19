<?php
include 'config.php';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

session_start();
if (mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}

if (!empty($_POST["loginMail"])) {
    $query = "SELECT * FROM tbl_214_users WHERE email='"
        . $_POST["loginMail"]
        . "' and password = '"
        . $_POST["loginPass"]
        . "'";

    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);


    if (is_array($row)) {
        $_SESSION["u_id"] = $row['u_id'];
        $_SESSION["user_type"] = $row['user_type'];
        header('Location: ' . URL . 'index.php');
    } else {
        $message = "Invalid Username or Password";
    }
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <section class="screen">
        <div id="headerContainer">
            <header>
                <nav class="navbar navbar-light bg-light" id="navbarLogin">
                    <a href="index.php" class="navbar-brand">
                        <div id="logo"></div>
                    </a>
                    <a target="_blank" href="https://www.shenkar.ac.il/he/departments/engineering-software-department"
                        class="navbar-brand">
                        <div id="shenkarLogoImage"></div>
                    </a>
                </nav>
            </header>
        </div>
        <section class="body-conForm login">
            <section id="loginFormContainer">
                <section id="loginFormContainerBox">
                    <h1><b>Login</b></h1>
                    <form action="#" method="post" id="loginForm">
                        <div class="form-group">
                            <label for="loginMail"><b>Email: </b></label>
                            <input type="email" class="form-control" name="loginMail" id="loginMail"
                                placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="loginPass"><b>Password: </b></label>
                            <input type="password" class="form-control" name="loginPass" id="loginPass"
                                placeholder="Enter Password" required>
                        </div>
                        <div class="form-group">
                            <button id="submitLoginSign" type="submit" class="btn btn-primary login"><b>Log
                                    In</b></button>
                        </div>
                        <div class="error-message">
                            <?php if (isset($message)) {
                                echo $message;
                            } ?>
                        </div>
                        <div class="form-group" id="loginLink">
                            <a href="signUp.php">Sign Up</a>
                        </div>
                    </form>
                </section>
            </section>
        </section>
        <script src="js/script.js"></script>
    </section>
</body>

</html>

<?php
mysqli_close($connection);
?>