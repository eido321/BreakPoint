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
$projId = $_GET["projId"];
$query = "SELECT * FROM tbl_214_projects where id=" . $projId;
$result = mysqli_query($connection, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
} else
    die("DB query failed.");
$img = $row["img_url"];
$creativity = $row["creativity"];
if (!$img)
    $img = 'images/projectsImages/default.png';
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
    $projIdUser = $tmp["id"];
} else {
    $projIdUser = 0;
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>View Project</title>
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
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

</head>

<body>
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
                    <form method="post" action="index.php">
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
                                            placeholder="Search Project">
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
                                            <form method="post" action="index.php" class="formTypeMobile">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit"
                                                    class="dropdown-item typeItem typeOptionMobile formTypeSubmitMobile"
                                                    id="formType1SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" class="formTypeMobile">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit"
                                                    class="dropdown-item typeItem typeOptionMobile formTypeSubmitMobile"
                                                    id="formType2SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" class="formTypeMobile">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit"
                                                    class="dropdown-item typeItem typeOptionMobile formTypeSubmitMobile"
                                                    id="formType3SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" class="formTypeMobile">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit"
                                                    class="dropdown-item typeItem typeOptionMobile formTypeSubmitMobile"
                                                    id="formType4SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" class="formTypeMobile">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit"
                                                    class="dropdown-item typeItem typeOptionMobile formTypeSubmitMobile"
                                                    id="formType5SubmitMobile"></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="index.php" id="formTypeMobile6">
                                                <input type="hidden" name="typeProj" value="" class="typeOptionMobile">
                                                <button type="submit"
                                                    class="dropdown-item typeItem typeOptionMobile formTypeSubmitMobile"
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
                                                placeholder="Search Project">
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
                                                <form method="post" action="index.php" class="formType1">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit"
                                                        class="dropdown-item typeItem typeOption formTypeSubmit"
                                                        id="formType1Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" class="formType2">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit"
                                                        class="dropdown-item typeItem typeOption formTypeSubmit"
                                                        id="formType2Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" class="formType3">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit"
                                                        class="dropdown-item typeItem typeOption formTypeSubmit"
                                                        id="formType3Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" class="formType4">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit"
                                                        class="dropdown-item typeItem typeOption formTypeSubmit"
                                                        id="formType4Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" class="formType5">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit"
                                                        class="dropdown-item typeItem typeOption formTypeSubmit"
                                                        id="formType5Submit"></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="index.php" class="formType6">
                                                    <input type="hidden" name="typeProj" value="" class="typeOption">
                                                    <button type="submit"
                                                        class="dropdown-item typeItem typeOption formTypeSubmit"
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
        <input type="hidden" name="projId" value="' . $projIdUser . '">
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
        <div class="mobileBody">
            <section>
                <div class="MainTxtMobile">
                    <span>
                        <?php echo '' . $row["title"] . ' - by ' . $row["p1_first_name"] . ' ' . $row["p1_last_name"] . ' and ' . $row["p2_first_name"] . ' ' . $row["p2_last_name"] . '' ?>
                    </span>
                </div>
            </section>
            <span class="ProjectRivew">Description:</span>
            <section class="ProjectD">
                <p class="projectDText">
                    <?php echo $row["des_txt"]; ?>
                </p>
            </section>

            <div class="middle">
                <div class="middleLeft">
                    <div class="Ad">

                        <div class="dropdown filesDropDown">
                            <button class="btn btn-secondary dropdown-toggle filesDropDown" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Project files
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">example.zip<div class="FileLogoSmall"></div></a>
                                </li>
                                <li><a class="dropdown-item" href="#">example.zip<div class="FileLogoSmall"></div></a>
                                </li>
                                <li><a class="dropdown-item" href="#">example.zip<div class="FileLogoSmall"></div></a>
                                </li>
                                <li><a class="dropdown-item" href="#">example.zip<div class="FileLogoSmall"></div></a>
                                </li>
                                <li><a class="dropdown-item" href="#">example.zip<div class="FileLogoSmall"></div></a>
                                </li>
                                <li><a class="dropdown-item" href="#">example.zip<div class="FileLogoSmall"></div></a>
                                </li>
                                <li><a class="dropdown-item" href="#">example.zip<div class="FileLogoSmall"></div></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="AdSection">
                        <a class="btn btn-primary shareButton" href="" role="button">
                            <div class="shareButtonImg"></div>
                        </a>
                        <button type="button" class="btn btn-primary indecViewTitleButton"
                            data-bs-toggle="button">&#x2665;</button>
                    </div>

                </div>
                <div class="middleRight">
                    <div class="Rating">
                        <div class="ratingTitle">
                            <span class="threeContainer"> General Rating:&nbsp;<span class="threeText">
                                    <?php
                                    $avgRate = ($row["creativity"] + $row["refined"] + $row["stylish"]) / 3;
                                    $avgRateRounded = number_format($avgRate, 1);
                                    echo $avgRateRounded;

                                    ?>
                                </span></span>
                            <div class="redStar"></div>
                        </div>
                        <div class="starRating">
                            <section class="starsListSec">
                                <span>Creativity:</span>
                                <section class="StarCn" <?php echo 'data-rating="' . $creativity . '"'; ?>>
                                </section>
                            </section>
                            <section class="starsListSec">
                                <span>Refined:</span>
                                <section id="starRow2" class="StarCn" <?php echo 'data-rating="' . $row["refined"] . '"'; ?>>

                                </section>
                            </section>
                            <section class="starsListSec">
                                <span>Stylish:</span>
                                <section id="starRow3" class="StarCn" <?php echo 'data-rating="' . $row["stylish"] . '"'; ?>>

                                </section>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="graybox">
                <span class="ProjectRivew2"></span>
                <section class="left">
                    <a class="linkProjectW" target="_blank" href="<?php echo $row["moqups_link"]; ?>">
                        <span>Want to know more?</span>
                        <span class="PlayButtonImage"></span>
                    </a>
                </section>
                <section class="right">
                    <span>Requirements:</span>
                    <a href="<?php echo $row["srs_link"]; ?>" target="_blank">
                        <div class="FileLogo"></div>
                    </a>
                </section>
            </div>
            <section class="mobileComments">
                <section id="mobileCommentsLeft">
                    <img src="<?php echo $tmpUser["user_img"]; ?>" alt="ranProfile" class="ranProfileImage2">
                    <span>
                        <?php echo $tmpUser["name"]; ?>
                    </span>
                </section>
                <section id="mobileCommentsRight">
                    <section>
                        <form method="post" action="View.php" id="mobileCommentForm">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION["u_id"]; ?>">
                            <input type="hidden" name="proj_id" value="<?php echo $projId; ?>">
                            <div class="input-group mb-3 commentInput">
                                <input type="text" class="form-control commentInput" name="commnetText"
                                    id="commentInputMobile" aria-label="Sizing example input"
                                    placeholder="Add a comment..." autocomplete="off">
                                <button type="submit" class="sendIcon" id="sendSubmitMobile">
                                </button>
                            </div>
                        </form>

                    </section>
                </section>
            </section>
            <section id="mobileCommentsTitle">
                <section>
                    <span class="totalComments"></span>
                    <span>&nbsp;Comments</span>
                    <section id="dropCommentsMobile">
                        <button id="commentMobileExpandButton" onclick="expanedCommentsMobile()"></button>
                    </section>
                </section>
                <section>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle commnetDropdown" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <b>Sort</b>
                        </button>
                        <ul class="dropdown-menu commentSortList">
                            <li>
                                <form method="post" action="View.php" id="oldFormMobile">
                                    <input type="hidden" name="asc" value="1">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION["u_id"]; ?>">
                                    <input type="hidden" name="proj_id" value="<?php echo $projId; ?>">

                                    <button type="submit" class="dropdown-item commentItem"
                                        id="oldSortMobile">Oldest</button>
                                </form>
                            </li>
                            <li>
                                <form method="post" action="View.php" id="newFormMobile">
                                    <input type="hidden" name="des" value="1">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION["u_id"]; ?>">
                                    <input type="hidden" name="proj_id" value="<?php echo $projId; ?>">
                                    <button type="submit" class="dropdown-item commentItem"
                                        id="newSortMobile">Newest</button>
                                </form>
                            </li>

                        </ul>
                    </div>
                </section>
                <br>
            </section>
            <section id="mobileComments">
            </section>
        </div>
        <section class=" body-con">
            <div class="breadCrumbs">
                <span><a href="index.php" class="breadCrumbsLinks">All Projects</a> > <a href="View.php"
                        class="breadCrumbsLinks selectedBreadCrumbs">Project
                        <?php echo $row["title"]; ?></a></span>
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
    <a class="indexViewButton sideLinks" href="View.php?projId=' . $projIdUser . '">
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
        <input type="hidden" name="projId" value="' . $projIdUser . '">
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
            <div class="View-con">
                <div class="LeftSide">
                    <section class="projectNameTitleView">
                        <span class="projectNameView">
                            <?php echo $row["title"] ?>
                        </span>
                        <section class="bottns">
                            <section>
                                <a class="btn btn-primary shareButton" href="" role="button">
                                    <div class="shareButtonImg"></div>
                                </a>
                            </section>
                            <section>
                                <button type="button" class="btn btn-primary indecViewTitleButton"
                                    data-bs-toggle="button">&#x2665;</button>
                            </section>
                        </section>
                    </section>
                    <section class="RedLine"></section>
                    <span class="ProjectRivew">Project review</span>
                    <section class="WhiteBox">
                        <div class="ScrollableContent">
                            <p class="pForm">
                                <?php echo $row["des_txt"]; ?>
                            </p>
                        </div>
                    </section>



                    <br>
                    <span class="ProjectRivew">
                        <a class="linkProjectW" target="_blank" href="<?php echo $row["moqups_link"]; ?>"><span>Want to
                                know more?</span>
                            <span class="PlayButtonImage"></span>
                        </a>
                    </span>
                    <section class="requirements">
                        <span>The project's software requirements specification:</span>
                        <section class="Srs">
                            <a target="_blank" href="<?php echo $row["srs_link"]; ?>">srs<div class="FileLogoSrs"></div>
                            </a>
                        </section>
                    </section>
                    <br>
                    <span>Additional project files</span>
                    <section class="Example">
                        <ul>
                            <li>Example.zip&nbsp;<div class="FileLogo dots"></div>
                                <div class="viewImage"></div>
                            </li>
                            <li>Example.zip&nbsp;<div class="FileLogo dots"></div>
                                <div class="viewImage"></div>
                            </li>
                            <li>Example.zip&nbsp;<div class="FileLogo dots"></div>
                                <div class="viewImage"></div>
                            </li>
                            <li>Example.zip&nbsp;<div class="FileLogo dots"></div>
                                <div class="viewImage"></div>
                            </li>
                            <li>Example.zip&nbsp;<div class="FileLogo dots"></div>
                                <div class="viewImage"></div>
                            </li>
                            <li>Example.zip&nbsp;<div class="FileLogo dots"></div>
                                <div class="viewImage"></div>
                            </li>
                        </ul>
                    </section>
                    <section class="commentSection ">
                        <section class="rightCommentSection">
                            <img src="<?php echo $tmpUser["user_img"]; ?>" alt="ranImage" class="ranProfileImage2">
                            <span>
                                <?php echo $tmpUser["name"]; ?>
                            </span>
                        </section>
                        <section class="leftCommentSection">
                            <section class="leftCommentSectionLine">
                                <section>
                                    <span class="leftCommentSectionText1"><span
                                            class="totalComments"></span>&nbsp;&nbsp;Comments</span>
                                    <button class="leftCommentSectionText1Icon" onclick="expanedComments()"></button>
                                </section>

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle commnetDropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <b>Sort</b>
                                    </button>


                                    <ul class="dropdown-menu commentSortList">
                                        <li>
                                            <form method="post" action="View.php" id="oldForm">
                                                <input type="hidden" name="asc" value="1">
                                                <input type="hidden" name="user_id"
                                                    value="<?php echo $_SESSION["u_id"]; ?>">
                                                <input type="hidden" name="proj_id" value="<?php echo $projId; ?>">

                                                <button type="submit" class="dropdown-item commentItem"
                                                    id="oldSort">Oldest</button>
                                            </form>
                                        </li>

                                        <li>
                                            <form method="post" action="View.php" id="newForm">
                                                <input type="hidden" name="des" value="1">
                                                <input type="hidden" name="user_id"
                                                    value="<?php echo $_SESSION["u_id"]; ?>">
                                                <input type="hidden" name="proj_id" value="<?php echo $projId; ?>">

                                                <button type="submit" name="des" class="dropdown-item commentItem"
                                                    id="newSort">Newest</button>
                                            </form>
                                        </li>

                                    </ul>
                                </div>
                            </section>
                            <section class="leftCommentSectionDown">
                                <form method="post" action="View.php" id="addComment">
                                    <input type="text" name="commnetText" id="inputComment"
                                        placeholder="Add a comment..." autocomplete="off">
                                    <button type="submit" class="sendIcon" id="sendSubmit">
                                    </button>
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION["u_id"]; ?>">
                                    <input type="hidden" name="proj_id" value="<?php echo $projId; ?>">
                                </form>
                            </section>
                        </section>
                    </section>
                    <br>
                    <div id="loading">

                    </div>
                    <div id="coomentSection">
                    </div>
                </div>
                <div class="RightSide">
                    <span class="formRatingDesktop"> General Rating:&nbsp;<span class="number">
                            <?php
                            $avgRate = ($row["creativity"] + $row["refined"] + $row["stylish"]) / 3;
                            $avgRateRounded = number_format($avgRate, 1);
                            echo $avgRateRounded;
                            ?>
                        </span>
                        &nbsp;&nbsp;<span class="redStar desktopRedStar"></span></span>
                    <div class="Rating">
                        <section class="starsListSec">
                            <span>Creativity:</span>
                            <section class="StarCn" <?php echo 'data-rating="' . $creativity . '"'; ?>>
                            </section>
                        </section>
                        <section class="starsListSec">
                            <span>Refined:</span>
                            <section class="StarCn" <?php echo 'data-rating="' . $row["refined"] . '"'; ?>>

                            </section>
                        </section>
                        <section class="starsListSec">
                            <span>Stylish:</span>
                            <section class="StarCn" <?php echo 'data-rating="' . $row["stylish"] . '"'; ?>>

                            </section>
                        </section>
                    </div>
                    <br><br>
                    <img src="<?php echo $img ?>" alt="Project" class="projectImages">
                    <section class="bottomRightSide">
                        <span>Project participants</span>
                        <section class="RedlineRigthSide"></section>
                        <section class="participant1">
                            <div class="RedDot"></div>
                            <span class="firstname">
                                <?php echo $row["p1_first_name"] ?>
                                <?php echo $row["p1_last_name"] ?>
                            </span>
                        </section>
                        <section class="participant2">
                            <div class="RedDot"></div>
                            <span class="firstname">
                                <?php echo $row["p2_first_name"] ?>
                                <?php echo $row["p2_last_name"] ?>
                            </span>
                        </section>
                    </section>
                </div>
            </div>
        </section>
    </section>
    <div id="projIdElement" data-projId="<?php echo $projIdUser; ?>"></div>
    <script src="js/script.js"></script>
    <script src="js/getType.js"></script>

</body>

</html>

<?php
mysqli_free_result($resultUser);
mysqli_free_result($resultProj);
mysqli_free_result($result);
mysqli_close($connection);
?>