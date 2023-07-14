<?php
//create a mySQL DB connection:
include "config.php";

session_start();
if (!$_SESSION["user_type"]) {
    header('Location: ' . URL . 'login.php');
}

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//testing connection success
if (mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}
if(isset($_POST['user_id'])) {
    // escape variables for security
    $txt  = mysqli_real_escape_string($connection, $_POST['commnetText']);
    $user  = mysqli_real_escape_string($connection, $_POST['user_id']);
    $proj  = mysqli_real_escape_string($connection, $_POST['proj_id']);
    
    //SET: insert new data to DB
    $query2 = "insert into tbl_214_comments(p_id,u_id,comment) values ('$proj','$user','$txt')";
    $result = mysqli_query($connection, $query2);

    //GET: get data again
    $query3 = "SELECT * FROM tbl_214_users us
    INNER JOIN tbl_214_comments co ON us.u_id = co.u_id
    WHERE p_id = '" . $proj . "';";
    $result = mysqli_query($connection, $query3);

}

// GET: get data again
   $str  = "<ul>";
   while($row = mysqli_fetch_assoc($result)) {//results are in an associative array. keys are cols names
   //output data from each row
//    $str .= '<li>
//    <div class="comment">
//    <section class="CommentName">
//        <img src="'.$row["user_img"].'" alt="ranProfile" class="ranProfileImage2"><b>'.$row["name"].'</b>
//    </section>
//    <section class="coomentWhiteBox">
//        <p class="commentsText">
//        '.$row["comment"].'
//        </p>
//    </section>
//    <button class="ClappImage" data-is-active="true">
//        <br>
//        <span>3</span>
//    </button>
// </div>
//    </li>';

   }
$str  .= "</ul>";
// echo $str;
echo '{"retVal":"' . $str . '"}';

// //release returned data
mysqli_free_result($result);

// //close DB connection
mysqli_close($connection);

?>
