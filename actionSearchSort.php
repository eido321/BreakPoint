<?php
include "config.php";

session_start();
if (!$_SESSION["user_type"]) {
    header('Location: ' . URL . 'login.php');
}

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}
if (isset($_POST['typeProj'])) {
    $projType = mysqli_real_escape_string($connection, $_POST['typeProj']);
    $query = "SELECT * FROM tbl_214_projects
    WHERE proj_type = '" . $projType . "';";
    $result = mysqli_query($connection, $query);

}
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
                    <a href="View.php?projId=' . $row["id"] . '"><img src="' . $img . '" alt="projectImg" class="projectImages"></a>
                    <a href="View.php?projId=' . $row["id"] . '" class="projectName">' . $row["title"] . '</a>
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

mysqli_free_result($result);

mysqli_close($connection);
?>