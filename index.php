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
//get data from DB
$queryAll = "SELECT * FROM tbl_214_test order by id";
$resultAll = mysqli_query($connection, $queryAll);
if (!$resultAll) {
    die("DB query failed.");
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process the form data and perform necessary actions
    // ...
    $ProjectName = isset($_POST['ProjectName']) ? mysqli_real_escape_string($connection, $_POST['ProjectName']) : null;
    $Participant1Name = isset($_POST['Participant1Name']) ? mysqli_real_escape_string($connection, $_POST['Participant1Name']) : null;
    $Participant1NameSecond = isset($_POST['Participant1NameSecond']) ? mysqli_real_escape_string($connection, $_POST['Participant1NameSecond']) : null;
    $Participant2Name = isset($_POST['Participant2Name']) ? mysqli_real_escape_string($connection, $_POST['Participant2Name']) : null;
    $Participant2NameSecond = isset($_POST['Participant2NameSecond']) ? mysqli_real_escape_string($connection, $_POST['Participant2NameSecond']) : null;
    $ProjectType = isset($_POST['ProjectType']) ? mysqli_real_escape_string($connection, $_POST['ProjectType']) : null;
    $state = isset($_POST['state']) ? $_POST['state'] : null;
    $projIdQ = isset($_POST['projId']) ? $_POST['projId'] : null;

    if ($ProjectName !== null && $Participant1Name !== null && $Participant1NameSecond !== null && $Participant2Name !== null && $Participant2NameSecond !== null && $ProjectType !== null && $state !== null) {
        // Set: Insert/update data in DB
        if ($state == "insert") {
            $queryAll = "INSERT INTO tbl_214_test (title, p1_first_name, p1_last_name,p2_first_name,p2_last_name) VALUES ('$ProjectName', '$Participant1Name', '$Participant1NameSecond','$Participant2Name','$Participant2NameSecond')";
        } else {
            $queryAll = "UPDATE tbl_214_test SET title='$ProjectName', p1_first_name='$Participant1Name', p1_last_name='$Participant1NameSecond', p2_first_name='$Participant2Name',p2_last_name='$Participant2NameSecond' WHERE id='$projIdQ'";

        }
    }
    $resultIns = mysqli_query($connection, $queryAll);

    if (!$resultIns) {
        die("DB query failed.");
    }

    // Redirect the user to a new page
    header("Location: index.php");
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Pay Attention</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    A personal project file does not exists, To create or edit a project click the
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
    <section class="screen">
        <div id="headerContainer">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
                    <a href="index.php" class="navbar-brand" id="logoContainer">
                        <div id="logo"></div>
                    </a>
                    <div class="mobileHeader">
                        <a href="index.php">
                            <div id="logoExpanded"></div>
                        </a>
                        <div>
                            <a href="" class="nav-link"><img src="images/ranProfile.png" alt="ranProfile"
                                    class="ranProfileImage"></a>
                        </div>
                        <div id="searchBar1" class="input-group">
                            <input type="text" class="form-control" id="inputSearch1" placeholder="Search"
                                aria-label="Search for...">
                            <button class="btn btn-outline-secondary" type="button">
                                <span id="search1"></span>
                            </button>
                            <button class="btn btn-outline-secondary" type="button">
                                <span id="sortIconImageMobile"></span>
                            </button>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation" id="humburger">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div id="desktopNav">
                            <div id="searchBar2" class="input-group">
                                <input type="text" class="form-control" id="inputSearch2" placeholder="Search"
                                    aria-label="Search for...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <span id="search2"></span>
                                </button>
                                <button class="btn btn-outline-secondary" type="button">
                                    <span id="sortIconImageDesktop"></span>
                                </button>
                            </div>
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
                                    <a href="" class="nav-link"><img src="images/ranProfile.png" alt="ranProfile"
                                            class="ranProfileImage"></a>
                                </section>
                            </div>
                        </div>
                        <div id="mobileNav">
                            <div class="navbar-nav " id="mobileNavContainer">
                                <section class="nav-item">
                                    <a href="" class="nav-link"><b>Home Page</b></a>
                                </section>
                                <section class="nav-item">
                                    <a href="index.php" class="nav-link" id="selectedNav"><b>Projects</b></a>
                                    <div></div>
                                </section>
                                <section class="nav-item">
                                    <a href="" class="nav-link"><b>Contests</b></a>
                                </section>
                                <section class="nav-item">
                                    <a href="indexView.php" class="nav-link"><b>View Personal
                                            Project</b></a>
                                </section>
                                <section class="nav-item">
                                    <a href="indexForm.php" class="nav-link"><b>Add Personal Project</b></a>
                                </section>
                                <section class="nav-item">
                                    <a href="" class="nav-link"><b>Edit Project</b></a>
                                </section>
                                <section class="nav-item">
                                    <a href="" class="nav-link"><b>Settings</b></a>
                                </section>
                            </div>
                        </div>
                    </div>
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
                <span><a href="" class="breadCrumbsLinks">Home Page</a> > <a href="index.php"
                        class="breadCrumbsLinks">Projects</a></span>
            </div>
            <div class="sideBar">
                <section class="choiseList">
                    <ul class="triangle-list">
                        <?php if ($_SESSION["user_type"] != "Guest") {
                            echo '
<li>
    <a id="indexViewButton" href="indexView.php?projId=' . $projId . '">
        <b>View Personal Project</b>
        <div class="viewImageList"></div>
    </a>
</li>
<li>
    <a href="indexForm.php" class="aLinks" id="addProjectButton">
        <b>Add Personal Project</b>
        <div class="addImage"></div>
    </a>
</li>
<li>
    <form method="POST" action="indexForm.php">
        <input type="hidden" name="projId" value="' . $projId . '">
        <button type="submit" id="editButton">
            <b>Edit Project</b>
        </button>
        <div class="editImage"></div>
    </form>
</li>';
                        }
                        ?>

                        <li><a href="" class="aLinks"><b>Favorites</b>
                                <div class="favImage"></div>
                            </a></li>
                        <li><a href="" class="aLinks"><b>Recent</b>
                                <div class="recImage"></div>
                            </a></li>
                        <li><a href="logout.php"><b>Log Out</b>
                                <div class="logout"></div>
                            </a></li>

                    </ul>
                </section>
                <div class="underLineChoise"></div>
            </div>
            <div class="projectsBody">
                <div class="container text-center gridBody">
                    <?php
                    $count = 0;
                    echo '<div class="row">';
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
                            echo '</div><div class="row">';
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