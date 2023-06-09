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
?>
<?php
$queryProj = "SELECT * FROM tbl_214_test_and_users WHERE u_id='"
    . $_SESSION["u_id"]
    . "'";

$resultProj = mysqli_query($connection, $queryProj);
if (!$resultProj) {
    die("DB query failed.");
}
$tmp = mysqli_fetch_assoc($resultProj);
if ($tmp) {
    $projId = $tmp["id"];
} else {
    $projId = 0;
}
?>

<?php
$queryUser = "SELECT * FROM tbl_214_users WHERE u_id='"
    . $_SESSION["u_id"]
    . "'";

$resultUser = mysqli_query($connection, $queryUser);
if (!$resultUser) {
    die("DB query failed.");
}
$tmpUser = mysqli_fetch_assoc($resultUser);
?>

<?php
//get data from DB
$queryAll = "SELECT * FROM tbl_214_test order by id";
$resultAll = mysqli_query($connection, $queryAll);
if (!$resultAll) {
    die("DB query failed.");
}
?>

<?php
$searchValue = '';
if (isset($_GET["query"]) && $_GET["query"] != '') {
    $searchValue = $_GET["query"];
    $queryAll = "SELECT * FROM tbl_214_test WHERE title='" . $_GET["query"] . "'";
    $resultAll = mysqli_query($connection, $queryAll);

    if (!$resultAll) {
        die("DB query failed.");
    }

}
?>

<?php
if (isset($_POST['deleteProject'])) {
    $queryDel = "DELETE FROM `tbl_214_test` WHERE (`id` = '" . $projId . "');";
    $resultDel = mysqli_query($connection, $queryDel);

    if (!$resultDel) {
        die("DB query failed.");
    }
    $queryDel = "    DELETE FROM `tbl_214_test_and_users` WHERE (`id` = '" . $projId . "');";
    $resultDel = mysqli_query($connection, $queryDel);

    if (!$resultDel) {
        die("DB query failed.");
    }
    header("Location: index.php?success");


}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ProjectName = isset($_POST['ProjectName']) ? mysqli_real_escape_string($connection, $_POST['ProjectName']) : null;
    $ProjectType = isset($_POST['ProjectType']) ? mysqli_real_escape_string($connection, $_POST['ProjectType']) : null;
    $Participant1Name = isset($_POST['Participant1Name']) ? mysqli_real_escape_string($connection, $_POST['Participant1Name']) : null;
    $Participant1NameSecond = isset($_POST['Participant1NameSecond']) ? mysqli_real_escape_string($connection, $_POST['Participant1NameSecond']) : null;
    $Participant2Name = isset($_POST['Participant2Name']) ? mysqli_real_escape_string($connection, $_POST['Participant2Name']) : null;
    $Participant2NameSecond = isset($_POST['Participant2NameSecond']) ? mysqli_real_escape_string($connection, $_POST['Participant2NameSecond']) : null;
    $ProjectType = isset($_POST['ProjectType']) ? mysqli_real_escape_string($connection, $_POST['ProjectType']) : null;
    $state = isset($_POST['state']) ? $_POST['state'] : null;
    $projIdQ = isset($_POST['projId']) ? $_POST['projId'] : null;

    if ($ProjectName !== null && $ProjectType !== null && $Participant1Name !== null && $Participant1NameSecond !== null && $Participant2Name !== null && $Participant2NameSecond !== null && $ProjectType !== null && $state !== null) {
        if ($state == "Creation") {
            $queryAdd = "INSERT INTO tbl_214_test (title,proj_type, p1_first_name, p1_last_name,p2_first_name,p2_last_name) VALUES ('$ProjectName', '$ProjectType' ,'$Participant1Name', '$Participant1NameSecond','$Participant2Name','$Participant2NameSecond')";
            $resultIns = mysqli_query($connection, $queryAdd);

            if (!$resultIns) {
                die("DB query failed insert.");
            }
            $queryProj = "SELECT * FROM tbl_214_test WHERE title='" . $ProjectName . "'";
            $resultIns = mysqli_query($connection, $queryProj);

            if (!$resultIns) {
                die("DB query failed find proj.");
            }

            $tmpProj = mysqli_fetch_assoc($resultIns);
            $queryAddProj = "INSERT INTO tbl_214_test_and_users (id, u_id) VALUES ('" . $tmpProj["id"] . "', '" . $_SESSION["u_id"] . "')";
            $resultIns = mysqli_query($connection, $queryAddProj);

            if (!$resultIns) {
                die("DB query failed insert proj user.");
            }


        } else {
            $queryAdd = "UPDATE tbl_214_test SET title='$ProjectName',proj_type='$ProjectType', p1_first_name='$Participant1Name', p1_last_name='$Participant1NameSecond', p2_first_name='$Participant2Name',p2_last_name='$Participant2NameSecond' WHERE id='$projIdQ'";
            $resultIns = mysqli_query($connection, $queryAdd);

            if (!$resultIns) {
                die("DB query failed.");
            }
        }

    }


    // Redirect the user to a new page
    header("Location: index.php?success");
}
// Get data from query string and escape variables for security

?>

<!doctype html>
<html lang="en">

<head>
    <title>Projects</title>
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
    <?php
    if (isset($_GET['success'])) {
        echo '
        <div class="modal" tabindex="-1" id="successModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
                        <div class="successImage"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>';
    }


    ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Pay Attention</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    A personal project file does not exists, To create, edit or delete a project click the
                    Add Project button to add a project.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pay Attention</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    A personal project file aleardy exists To create a new project, delete the old one or click the
                    edit project button to make changes.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pay Attention</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete your personal project.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <form method="post">
                        <input type="submit" class="btn btn-secondary" id="deletePostButton" name="deleteProject"
                            value="Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="screen">
        <div id="headerContainer">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
                    <a href="index.php" class="navbar-brand" id="logoContainer">
                        <div id="logo"></div>
                    </a>
                    <section id="headerRight">
                        <div class="mobileHeader">
                            <a href="index.php">
                                <div id="logoExpanded"></div>
                            </a>
                            <div>
                                <a href="" class="nav-link"><img src="<?php echo $tmpUser["user_img"]; ?>"
                                        alt="ranProfile" class="ranProfileImage"></a>
                            </div>
                            <form action="" id="searchFormMobile" method="GET">
                                <div id="searchBar1" class="input-group">
                                    <input type="text" class="form-control" id="inputSearch1" name="query"
                                        placeholder="Search Project" value="<?php echo $searchValue; ?>">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <span id="search1"></span>
                                    </button>
                                    <button class="btn btn-outline-secondary" type="button">
                                        <span id="sortIconImageMobile"></span>
                                    </button>
                                </div>
                            </form>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation" id="humburger">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <div id="desktopNav">
                                <form action="" id="searchForm" method="GET">
                                    <div id="searchBar2" class="input-group">
                                        <input type="text" class="form-control" id="inputSearch2" name="query"
                                            placeholder="Search Project" value="<?php echo $searchValue; ?>">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <span id="search2"></span>
                                        </button>
                                        <button class="btn btn-outline-secondary" type="button">
                                            <span id="sortIconImageDesktop"></span>
                                        </button>
                                    </div>
                                </form>

                                <div class="navbar-nav ms-auto">
                                    <section id="shenkarLogo" class="nav-item">
                                        <a href="" class="nav-link">
                                            <div id="shenkarLogoImage"></div>
                                        </a>
                                    </section>
                                    <section id="notification" class="nav-item">
                                        <a href="" class="nav-link">
                                            <div id="notificationImage"></div>
                                        </a>
                                    </section>
                                    <section id="settings" class="nav-item">
                                        <a href="" class="nav-link">
                                            <div id="settingsImage"></div>
                                        </a>
                                    </section>
                                    <section id="ranProfile" class="nav-item">
                                        <a href="" class="nav-link"><img src="<?php echo $tmpUser["user_img"]; ?>"
                                                alt="ranProfile" class="ranProfileImage"></a>
                                    </section>
                                </div>
                            </div>
                            <div id="mobileNav">
                                <div class="navbar-nav " id="mobileNavContainer">
                                    <section class="nav-item">
                                        <a class="nav-item sideLinks allProjectButton" id="selectedNav"
                                            href="index.php">
                                            <b>All Projects</b>
                                        </a>
                                    </section>
                                    <?php if ($_SESSION["user_type"] != "Guest") {
                                        echo '
                                
<section class="nav-item">
    <a class="indexViewButton nav-item sideLinks" href="indexView.php?projId=' . $projId . '">
        <b>My Project</b>
    </a>
</section>
<section class="nav-item sideLinks">
    <a href="indexForm.php" class="addProjectButton nav-item">
        <b>Add Project</b>
    </a>
</section>
<section class="nav-item sideLinks">
    <form method="POST" action="indexForm.php">
        <input type="hidden" name="projId" value="' . $projId . '">
        <button type="submit" class="editButton nav-item">
            <b>Edit Project</b>
        </button>
    </form>
</section>
    <section class="nav-item sideLinks">
        <a href="" class="deleteProjectButton nav-item">
    <b>Delete Project</b>
    </a>
</section>';
                                    }
                                    ?>
                                    <section class="nav-item sideLinks">
                                        <a href="" class="nav-link"><b>Settings</b></a>
                                    </section>
                                    <section class="nav-item sideLinks">
                                        <a href="logout.php" class="nav-link"><b>Log Out</b></a>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </section>
                </nav>
                <section id="navbar2">
                    <div class="container text-center" id="navbarContainer">
                        <div class="row" id="navbar2Row">
                            <div class="col projectBox" id="colNavbar1">
                                Projects
                            </div>
                            <div class="col" id="colNavbar2">
                                Favorites
                            </div>
                            <div class="col" id="colNavbar3">
                                Recent
                            </div>
                        </div>
                    </div>
                </section>
            </header>
        </div>
        <section class="body-con">
            <div class="breadCrumbs">
                <span><a href="index.php" class="breadCrumbsLinks selectedBreadCrumbs">All Projects</a></span>
            </div>

            <div class="sideBar">
                <section class="choiseList">
                    <ul class="triangle-list">
                        <li>
                            <a class="sideLinks" href="index.php">
                                <b>All Projects</b>
                                <div class="allProjects"></div>
                            </a>
                        </li>
                        <?php if ($_SESSION["user_type"] != "Guest") {
                            echo '
<li>
    <a class="indexViewButton sideLinks" href="indexView.php?projId=' . $projId . '">
        <b>My Project</b>
        <div class="viewImageList"></div>
    </a>
</li>
<li>
    <a href="indexForm.php" class="addProjectButton sideLinks" >
        <b>Add Project</b>
        <div class="addImage"></div>
    </a>
</li>
<li>
    <form method="POST" action="indexForm.php">
        <input type="hidden" name="projId" value="' . $projId . '">
        <button type="submit" class="editButton sideLinks">
            <b>Edit Project</b>
        </button>
        <div class="editImage"></div>
    </form>
</li>
<li>
<a href="" class="deleteProjectButton sideLinks"><b>Delete Project</b>
                                <div class="deleteImage"></div>
                            </a></li>';
                        }
                        ?>
                        <li><a href="" class="aLinks sideLinks"><b>Favorites</b>
                                <div class="favImage"></div>
                            </a></li>
                        <li><a href="" class="aLinks sideLinks"><b>Recent</b>
                                <div class="recImage"></div>
                            </a></li>
                        <li><a href="logout.php" class="sideLinks"><b>Log Out</b>
                                <div class="logout"></div>
                            </a></li>

                    </ul>
                </section>
            </div>
            <div class="projectsBody">
                <div class="container text-center gridBody">
                    <?php
                    $count = 0;
                    echo '<div class="row rowM">';
                    while ($row = mysqli_fetch_assoc($resultAll)) {
                        $img = $row["img_url"];
                        if (!$img)
                            $img = 'images/projectsImages/default.png';
                        echo '
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
                            echo '</div><div class="row rowM">';
                        }
                    }
                    while ($count % 3 != 0) {
                        echo '<div class="col"></div>';
                        $count++;
                    }
                    echo '</div>';
                    ?>
                </div>
            </div>
        </section>
    </section>

    <div id="projIdElement" data-projId="<?php echo $projId; ?>"></div>
    <script src="js/script.js"></script>
</body>

</html>

<?php
mysqli_close($connection);
?>