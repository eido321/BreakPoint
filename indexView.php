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
//get data from DB
$projId = $_GET["projId"];
$query = "SELECT * FROM tbl_214_test where id=" . $projId;
// echo $query;
$result = mysqli_query($connection, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result); //there is only 1 with id=X
} else
    die("DB query failed.");
$img = $row["img_url"];
if (!$img)
    $img = 'images/projectsImages/default.png';


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
                                    <a href="index.php" class="nav-link"><b>Projects</b></a>
                                    <div></div>
                                </section>
                                <section class="nav-item">
                                    <a href="" class="nav-link"><b>Contests</b></a>
                                </section>
                                <section class="nav-item">
                                    <a href="indexView.php" class="nav-link" id="selectedNav"><b>View Personal
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
            </header>
        </div>
        <div class="mobileBody">
            <section id="navbar2">
                <div class="MainTxtMobile">
                    <span>TagTool - By Menachem Avshalom and Jhon Doe</span>
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
                        Additnal Project files <div class="FileLogo2"></div>
                    </div>
                    <div>
                        <section class="share2">
                            Share
                        </section>
                        <section class="share2">
                            Bookmark
                        </section>
                    </div>

                </div>
                <div class="middleRight">
                    <div class="Rating">
                        <div class="ratingTitle">
                            <span class="threeContainer"> General Rating:<span class="threeText">3</span></span>
                            <div class="redStar"></div>
                        </div>
                        <div class="starRating">
                            <section class="starsList">
                                <span>creativity:&nbsp;</span>
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars2"></div>
                                <div class="stars2"></div>
                            </section>
                            <section class="starsList">
                                <span>refined:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars2"></div>
                                <div class="stars2"></div>
                            </section>
                            <section class="starsList">
                                <span>Stylish:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars2"></div>
                                <div class="stars2"></div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="graybox">
                <span class="ProjectRivew2"></span>
                <section class="left">
                    <span> Want to know more?</span>
                    <div class="PlayButtonImage"></div>
                </section>
                <section class="right">
                    <span>requirements:</span>
                    <div class="FileLogo"></div>
                </section>
            </div>
            <section class="bottomLefSide">
                <img src="images/ranProfile.png" alt="ranProfile" class="ranProfileImage2">
                <br>
                <span>&nbsp;&nbsp;Menachem Avshalom</span>
            </section>
        </div>
        <section class="body-con">
            <div class="breadCrumbs">
                <span><a href="" class="breadCrumbsLinks">Home Page</a> > <a href="index.php"
                        class="breadCrumbsLinks">Projects</a> > <a href="indexView.php" class="breadCrumbsLinks">Project
                        View</a></span>
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
                        <li><a href=""><b>Favorites</b>
                                <div class="favImage"></div>
                            </a></li>
                        <li><a href=""><b>Recent</b>
                                <div class="recImage"></div>
                            </a></li>
                        <li><a href="logout.php"><b>Log Out</b>
                                <div class="logout"></div>
                            </a></li>
                    </ul>
                </section>
                <div class="underLineChoise"></div>
            </div>
            <div class="View-con">
                <div class="LeftSide">
                    <section class="projectNameTitleView">
                        <h1 class="projectNameView">
                            <?php echo $row["title"] ?>
                        </h1>
                        <section class="bottns">
                            <section class="share">
                                Share
                            </section>
                            <section class="share">
                                Bookmark
                            </section>
                        </section>
                    </section>
                    <section class="RedLine"></section>
                    <span class="ProjectRivew">Project review</span>
                    <section class="WhiteBox">
                        <p class="pForm">
                            <?php echo $row["des_txt"]; ?>
                        </p>
                    </section>
                    <br>
                    <span class="ProjectRivew">Want to know more
                        <span class="PlayButtonImage"></span>
                    </span>
                    <section class="requirements">
                        <span>The project's software requirements specification </span>
                        <section class="Srs">
                            srs<div class="FileLogo"></div>
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
                            <span>8</span>
                            <img src="images/Dan.png" alt="ranImage" class="ranProfileImage2">
                            <span>Menachem Avshalom</span>
                        </section>
                        <section class="leftCommentSection">
                            <section class="leftCommentSectionLine">
                                <section>
                                    <span class="leftCommentSectionText1">Comments</span>
                                    <button class="leftCommentSectionText1Icon"></button>
                                </section>
                                <section>
                                    <span class="leftCommentSectionText2">Sort</span>
                                    <span class="leftCommentSectionText2Icon" id="sortIconImageDesktop"></span>
                                </section>
                            </section>
                            <section class="leftCommentSectionDown">
                                <span>Add a comment...</span>
                            </section>
                        </section>
                    </section>
                    <br>
                    <br>
                    <div id="coomentSection">
                        <div class="comment">
                            <section class="CommentName">
                                <img src="images/Dan.png" alt="ranProfile" class="ranProfileImage2">Dan Moalem
                            </section>
                            <section class="coomentWhiteBox">
                                <p class="commentsText">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                </p>
                            </section>
                            <button class="ClappImage" data-is-active="true">
                                <br>
                                <span>3</span>
                            </button>
                        </div>
                        <div class="comment">
                            <section class="CommentName">
                                <img src="images/Dana.png" alt="ranProfile" class="ranProfileImage2">Dana Asayag
                            </section>
                            <section class="coomentWhiteBox">
                                <p class="commentsText">
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                    doloremque
                                </p>
                            </section>
                            <button class="ClappImage" data-is-active="true">
                                <br>
                                <span>3</span>
                            </button>
                        </div>
                        <div class="comment">
                            <section class="CommentName">
                                <img src="images/Amir.png" alt="ranProfile" class="ranProfileImage2">Dana Asayag
                            </section>
                            <section class="coomentWhiteBox">
                                <p class="commentsText">
                                    At vero eos et accusamus et iusto odio dignissimos ducimus qu.
                                </p>
                            </section>
                            <button class="ClappImage" data-is-active="true">
                                <br>
                                <span>3</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="RightSide">
                    <span class="formRatingDesktop"> General Rating:&nbsp;<span class="number">3</span>
                        &nbsp;&nbsp;<span class="redStar desktopRedStar"></span></span>
                    <div class="Rating">
                        <section class="starsListSec">
                            <span>creativity:</span>
                            <section class="StarCn1">
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars2"></div>
                                <div class="stars2"></div>
                            </section>
                        </section>
                        <section class="starsListSec">
                            <span>refined:</span>
                            <section class="StarCn2">
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars2"></div>
                                <div class="stars2"></div>
                            </section>
                        </section>
                        <section class="starsListSec">
                            <span>Stylish:</span>
                            <section class="StarCn3">
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars"></div>
                                <div class="stars2"></div>
                                <div class="stars2"></div>
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
                                <?php echo $row["p1_first_name"] ?>&nbsp;
                                <?php echo $row["p1_last_name"] ?>
                            </span>
                        </section>
                        <section class="participant2">
                            <div class="RedDot"></div>
                            <span class="firstname">
                                <?php echo $row["p2_first_name"] ?>&nbsp;
                                <?php echo $row["p2_last_name"] ?>
                            </span>
                        </section>
                    </section>
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