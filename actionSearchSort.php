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
if (isset($_POST['typeProj'])) {
    // escape variables for security
    $projType = mysqli_real_escape_string($connection, $_POST['typeProj']);


    //GET: get data again

    $query = "SELECT * FROM tbl_214_test
    WHERE proj_type = '" . $projType . "';";
    $result = mysqli_query($connection, $query);

}

// // GET: get data again
// $str = "<ul id='commentSecList'>";
// $sum = 0;
// while ($row = mysqli_fetch_assoc($result)) {
//     // Output data from each row
//     $sum += 1;
//      "<li>
//       <div class='comment'>
//          <section class='CommentName'>
//             <img src=" . $row["user_img"] . " alt='ranProfile' class='ranProfileImage2'><b>" . $row["name"] . "</b>
//          </section>
//          <section class='coomentWhiteBox'>
//             <p class='commentsText'>
//                " . $row["comment"] . "
//             </p>
//          </section>
//          <button class='ClappImage' data-is-active='true' onclick='toggleLike(this)'>
//             <br>
//             <span>0</span>
//          </button>
//       </div>
//    </li>";
// }
// $str .= "</ul>";

$check = 0;
$count = 0;
$str = '<div class="row rowM">';
while ($row = mysqli_fetch_assoc($result)) {
    $check++;
    $img = $row["img_url"];
    if (!$img)
        $img = 'images/projectsImages/default.png';
        $str .= '
            <div class="col">
                <div class="projectContainer">
                    <a href="indexView.php?projId=' . $row["id"] . '"><img src="' . $img . '" alt="projectImg" class="projectImages"></a>
                    <a href="indexView.php?projId=' . $row["id"] . '" class="projectName">' . $row["title"] . '</a>
                    <span class="fromSpan">By ' . $row["p1_first_name"] . ' ' . $row["p1_last_name"] . ' and ' . $row["p2_first_name"] . ' ' . $row["p2_last_name"] . '</span>
                    <section class="underlineProject"></section>
                </div>
            </div>
            ';
    $count++;
    if ($count % 3 == 0) {
        $str .= '</div><div class="row rowM">';
    }
}
while ($count % 3 != 0) {
    $str .= '<div class="col"></div>';
    $count++;
}
if($check==0){
    $str.= '<section id="noProjMsg"><span>Sorry, but there are no projects of this type available at the moment.</span></section>';
}
$str .= '</div>';

$response = array('retVal' => $str);

echo json_encode($response);



// //release returned data
mysqli_free_result($result);

// //close DB connection
mysqli_close($connection);

?>