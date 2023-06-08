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
  $query = "SELECT * FROM tbl_214_users WHERE email='"
    . $_POST["loginMail"]
    . "' and password = '"
    . $_POST["loginPass"]
    . "'";

  // echo $query;

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
</head>

<body>
    <section class="screen">
        <div id="headerContainer">
            <header>
                <nav class="navbar navbar-light bg-light" id="navbarLogin">
                    <a href="index.php" class="navbar-brand" id="logoContainer">
                        <div id="logo"></div>
                    </a>
                    <a href="index.php" class="navbar-brand" id="logoContainer">
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
                <section>
                    <h1><b>Login</b></h1>
                    <form action="#" method="post" class="needs-validation" novalidate id="loginForm">
                        <div class="form-group">
                            <label for="loginMail"><b>Email: </b></label>
                            <input type="email" class="form-control" name="loginMail" id="loginMail"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="loginPass"><b>Password: </b></label>
                            <input type="password" class="form-control" name="loginPass" id="loginPass"
                                placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary login"><b>Log Me In</b></button>
                        </div>
                        <div class="error-message">
                            <?php if (isset($message)) {
                                echo $message;
                            } ?>
                        </div>
                    </form>
                </section>
            </section>
        </section>
        <script src="js/script.js"></script>
</body>

</html>

<?php
mysqli_close($connection);
?>