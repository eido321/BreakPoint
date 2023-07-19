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
?>
<?php
$queryProj = "SELECT * FROM tbl_214_projects_and_users WHERE u_id='"
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
$queryAll = "SELECT * FROM tbl_214_projects order by id";
$resultAll = mysqli_query($connection, $queryAll);
if (!$resultAll) {
    die("DB query failed.");
}
?>

<?php
$searchValue = '';
if (isset($_GET["query"]) && $_GET["query"] != '') {
    $searchValue = $_GET["query"];
    $queryAll = "SELECT * FROM tbl_214_projects WHERE title Like '" . $_GET["query"] . "%'";
    $resultAll = mysqli_query($connection, $queryAll);

    if (!$resultAll) {
        die("DB query failed.");
    }
}
?>

<?php
if (isset($_POST['deleteProject'])) {
    $queryDel = "DELETE FROM `tbl_214_projects` WHERE (`id` = '" . $projId . "');";
    $resultDel = mysqli_query($connection, $queryDel);

    if (!$resultDel) {
        die("DB query failed.");
    }
    $queryDel = "    DELETE FROM `tbl_214_projects_and_users` WHERE (`id` = '" . $projId . "');";
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
    $linkPart1 = isset($_POST['linkPrefix']) ? mysqli_real_escape_string($connection, $_POST['linkPrefix']) : null;
    $linkPart2 = isset($_POST['linktotheMoqupspage']) ? mysqli_real_escape_string($connection, $_POST['linktotheMoqupspage']) : null;
    if ($linkPart2 == null) {
        $combinedLink = "";
    } else {
        $combinedLink = $linkPart1 . $linkPart2;
    }
    $state = isset($_POST['state']) ? $_POST['state'] : null;
    $projIdQ = isset($_POST['projId']) ? $_POST['projId'] : null;
    if ($ProjectName !== null && $ProjectType !== null && $Participant1Name !== null && $Participant1NameSecond !== null && $Participant2Name !== null && $Participant2NameSecond !== null && $ProjectType !== null && $state !== null) {
        if ($state == "Creation") {
            $queryAdd = "INSERT INTO tbl_214_projects (title,proj_type, p1_first_name, p1_last_name,p2_first_name,p2_last_name,moqups_link) VALUES ('$ProjectName', '$ProjectType' ,'$Participant1Name', '$Participant1NameSecond','$Participant2Name','$Participant2NameSecond','$combinedLink')";
            $resultIns = mysqli_query($connection, $queryAdd);

            if (!$resultIns) {
                die("DB query failed insert.");
            }
            $queryProj = "SELECT * FROM tbl_214_projects WHERE title='" . $ProjectName . "'";
            $resultIns = mysqli_query($connection, $queryProj);

            if (!$resultIns) {
                die("DB query failed find proj.");
            }

            $tmpProj = mysqli_fetch_assoc($resultIns);
            $queryAddProj = "INSERT INTO tbl_214_projects_and_users (id, u_id) VALUES ('" . $tmpProj["id"] . "', '" . $_SESSION["u_id"] . "')";
            $resultIns = mysqli_query($connection, $queryAddProj);

            if (!$resultIns) {
                die("DB query failed insert proj user.");
            }


        } else {
            $queryAdd = "UPDATE tbl_214_projects SET title='$ProjectName',proj_type='$ProjectType', p1_first_name='$Participant1Name', p1_last_name='$Participant1NameSecond', p2_first_name='$Participant2Name',p2_last_name='$Participant2NameSecond' WHERE id='$projIdQ'";
            $resultIns = mysqli_query($connection, $queryAdd);

            if (!$resultIns) {
                die("DB query failed.");
            }
        }

    }
    header("Location: index.php?success");
}
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
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 exampleModalLabel"><b>Pay Attention</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    A personal project file does not exists, To create, edit or delete a project click the
                    "Add Project" button to add a project.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 exampleModalLabel">Pay Attention</h1>
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
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 exampleModalLabel">Pay Attention</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete your personal project?
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <input type="submit" class="btn btn-secondary" id="deletePostButton" name="deleteProject"
                            value="Delete">
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                                <a href="Profile.php" class="nav-link"><img src="<?php echo $tmpUser["user_img"]; ?>"
                                        alt="ranProfile" class="ranProfileImage"></a>
                            </div>
                            <section class="searchBarSecDrop">
                                <form action="index.php" class="searchForm" method="GET">
                                    <div id="searchBar1" class="input-group">
                                        <input type="text" class="form-control" id="inputSearch1" name="query"
                                            placeholder="Search Project" value="<?php echo $searchValue; ?>">
                                        <button class="btn btn-outline-secondary searchBarSecSubmit" type="submit">
                                            <span id="search1"></span>
                                        </button>
                                    </div>
                                </form>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle searchSort" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="sortIconImageDesktop"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form method="post" action="index.php" id="formTypeMobile1">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit" class="dropdown-item typeItem typeOptionMobile"
                                                    id="formType1SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" id="formTypeMobile2">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit" class="dropdown-item typeItem typeOptionMobile"
                                                    id="formType2SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" id="formTypeMobile3">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit" class="dropdown-item typeItem typeOptionMobile"
                                                    id="formType3SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" id="formTypeMobile4">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit" class="dropdown-item typeItem typeOptionMobile"
                                                    id="formType4SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" id="formTypeMobile5">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit" class="dropdown-item typeItem typeOptionMobile"
                                                    id="formType5SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" id="formTypeMobile6">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit" class="dropdown-item typeItem typeOptionMobile"
                                                    id="formType6SubmitMobile"></button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation" id="humburger">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <div id="desktopNav">
                                <section class="searchBarSecDrop">
                                    <form action="index.php" class="searchForm" method="GET">
                                        <div id="searchBar2" class="input-group">
                                            <input type="text" class="form-control" id="inputSearch2" name="query"
                                                placeholder="Search Project" value="<?php echo $searchValue; ?>">
                                            <button class="btn btn-outline-secondary searchBarSecSubmit" type="submit">
                                                <span id="search2"></span>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle searchSort" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="sortIconImageDesktop"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form method="post" action="index.php" id="formType1">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit" class="dropdown-item typeItem typeOption"
                                                        id="formType1Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" id="formType2">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit" class="dropdown-item typeItem typeOption"
                                                        id="formType2Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" id="formType3">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit" class="dropdown-item typeItem typeOption"
                                                        id="formType3Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" id="formType4">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit" class="dropdown-item typeItem typeOption"
                                                        id="formType4Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" id="formType5">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit" class="dropdown-item typeItem typeOption"
                                                        id="formType5Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" id="formType6">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit" class="dropdown-item typeItem typeOption"
                                                        id="formType6Submit"></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </section>

                                <div class="navbar-nav ms-auto">
                                    <section id="shenkarLogo" class="nav-item">
                                        <a target="_blank"
                                            href="https://www.shenkar.ac.il/he/departments/engineering-software-department"
                                            class="nav-link">
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
                                        <a href="Profile.php" class="nav-link"><img
                                                src="<?php echo $tmpUser["user_img"]; ?>" alt="ranProfile"
                                                class="ranProfileImage"></a>
                                    </section>
                                </div>
                            </div>
                            <div id="mobileNav">
                                <div class="navbar-nav " id="mobileNavContainer">
                                    <section class="nav-item">
                                        <a class="nav-item sideLinks allProjectButton" href="index.php">
                                            <b>All Projects</b>
                                        </a>
                                    </section>
                                    <section class="nav-item">
                                        <a class="nav-item sideLinks allProjectButton" href="" id="selectedNav">
                                            <b>Project View</b>
                                        </a>
                                    </section>
                                    <?php if ($_SESSION["user_type"] != "Guest") {
                                        echo '
                                
<section class="nav-item">
    <a class="indexViewButton nav-item sideLinks" href="View.php?projId=' . $projId . '">
        <b>My Project</b>
    </a>
</section>
<section class="nav-item sideLinks">
    <a href="Creation.php" class="addProjectButton nav-item">
        <b>Add Project</b>
    </a>
</section>
<section class="nav-item sideLinks">
    <form method="POST" action="Creation.php">
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
    <a class="indexViewButton sideLinks" href="View.php?projId=' . $projId . '">
        <b>My Project</b>
        <div class="viewImageList"></div>
    </a>
</li>
<li>
    <a href="Creation.php" class="addProjectButton sideLinks" >
        <b>Add Project</b>
        <div class="addImage"></div>
    </a>
</li>
<li>
    <form method="POST" action="Creation.php">
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
                <div class="container text-center gridBody" id="projectsMain">
                    <?php
                    $check = 0;
                    $count = 0;
                    echo '<div class="row rowM">';
                    while ($row = mysqli_fetch_assoc($resultAll)) {
                        $check++;
                        $img = $row["img_url"];
                        if (!$img)
                            $img = 'images/projectsImages/default.png';
                        echo '
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
                            echo '</div><div class="row rowM">';
                        }
                    }
                    while ($count % 3 != 0) {
                        echo '<div class="col"></div>';
                        $count++;
                    }
                    echo '</div>';
                    if ($check == 0) {
                        echo '<section id="noProjMsg"><span>Sorry, but there are no projects of this title available at the moment.</span></section>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </section>

    <div id="projIdElement" data-projId="<?php echo $projId; ?>"></div>
    <script src="js/script.js"></script>
    <script src="js/getType.js"></script>

</body>

</html>

<?php
mysqli_free_result($resultProj);
mysqli_free_result($resultUser);
mysqli_free_result($resultAll);
mysqli_close($connection);
?>