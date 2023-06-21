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
if (isset($_POST["projId"])) {
    $projId = $_POST["projId"];
    $query = "SELECT * FROM tbl_214_test WHERE id=" . $projId;
    $result = mysqli_query($connection, $query);
    $state = "insert";

    if ($result) {
        $row = mysqli_fetch_assoc($result); //there is only 1 with id=X
        $title = $row["title"];
        $state = "edit";
    }
} else {
    $projId = null;
    $state = "insert";
}
// else die("DB query failed.");//i dont want it to fail. i want it to cont.


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
                <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
                    <a href="index.php" class="navbar-brand" id="logoContainer">
                        <div id="logo"></div>
                    </a>
                    <div class="mobileHeader">
                        <a href="index.php">
                            <div id="logoExpanded"></div>
                        </a>
                        <div>
                            <a href="" class="nav-link"><img src="<?php echo $tmpUser["user_img"]; ?>" alt="ranProfile"
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
                                    <a href="" class="nav-link"><img src="<?php echo $tmpUser["user_img"]; ?>" alt="ranProfile"
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
                                <?php if ($_SESSION["user_type"] != "Guest") {
                                    echo '
<section class="nav-item">
    <a class="indexViewButton" href="indexView.php?projId=' . $projId . '">
        <b>View Personal Project</b>
    </a>
</section>';
                                    if ($state == "insert") {
                                        echo '<section class="nav-item">
 <a href="indexForm.php" class="addProjectButton" id="selectedNav">
     <b>Add Personal Project</b>
 </a>
</section>
<section class="nav-item">
 <form method="POST" action="indexForm.php">
     <input type="hidden" name="projId" value="' . $projId . '">
     <button type="submit" class="editButton">
         <b>Edit Project</b>
     </button>
 </form>
</section>';
                                    } else {
                                        echo '<section class="nav-item">
    <a href="indexForm.php" class="addProjectButton">
        <b>Add Personal Project</b>
    </a>
</section>
<section class="nav-item">
    <form method="POST" action="indexForm.php">
        <input type="hidden" name="projId" value="' . $projId . '">
        <button type="submit" class="editButton"  id="selectedNav">
            <b>Edit Project</b>
        </button>
    </form>
</section>';
                                    }

                                }
                                ?>
                                <section class="nav-item">
                                    <a href="" class="nav-link"><b>Settings</b></a>
                                </section>
                                <section class="nav-item">
                                    <a href="logout.php" class="nav-link"><b>Log Out</b></a>
                                </section>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
        </div>
        <section class="body-conForm">
            <div class="breadCrumbsNoneSideBar">
                <span><a href="" class="breadCrumbsLinks">Home Page</a> > <a class="breadCrumbsLinks"
                        href="index.php">Projects</a> > <a class="breadCrumbsLinks" href="indexForm.php">Project
                        Creation</a></span>
            </div>
            <section class="formTitle">
                <p>&nbsp;
                    <?php
                    if ($state == 'insert') {
                        echo "Project Creation";
                    } else {
                        echo "Edit Project";
                    }
                    ?>
                </p>
            </section>
            <section class="formContainer">
                <form action="index.php" method="post" class="needs-validation" novalidate>
                    <div class="leftSide">
                        <div class="formInfo1Line1">
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>Project
                                        Name
                                    </b></label>
                                <input type="text" class="form-control inputForm validationServer01" name="ProjectName"
                                    placeholder="* Microsoft" required <?php if ($state == 'edit') {
                                        echo "value='" . htmlspecialchars($title, ENT_QUOTES) . "'";
                                    } ?>>
                            </div>
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>Project
                                        Type</b></label>
                                <input type="text" class="form-control inputForm ProjectType" name="ProjectType"
                                    placeholder="* Social" required>
                            </div>
                        </div>
                        <label>&nbsp;&nbsp;<b>Participant 1</b></label>
                        <div class="formInfo1Line2">
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>First
                                        Name</b></label>
                                <input type="text" class="form-control inputForm ProjectName" name="Participant1Name"
                                    placeholder="* Bill" required <?php if ($state == 'edit') {
                                        echo "value=" . $row["p1_first_name"] . "";
                                    } ?>>
                            </div>
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>Family
                                        Name</b></label>
                                <input type="text" class="form-control inputForm ProjectType"
                                    name="Participant1NameSecond" placeholder="* Gates" required <?php if ($state == 'edit') {
                                        echo "value=" . $row["p1_last_name"] . "";
                                    } ?>>
                            </div>
                        </div>
                        <label>&nbsp;&nbsp;<b>Participant 2</b></label>
                        <div class="formInfo1Line3">
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>First
                                        Name</b></label>
                                <input type="text" class="form-control inputForm ProjectName" name="Participant2Name"
                                    placeholder="* John" required <?php if ($state == 'edit') {
                                        echo "value=" . $row["p2_first_name"] . "";
                                    } ?>>
                            </div>
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>Family
                                        Name</b></label>
                                <input type="text" class="form-control inputForm ProjectType"
                                    name="Participant2NameSecond" placeholder="* Doe" required <?php if ($state == 'edit') {
                                        echo "value=" . $row["p2_last_name"] . "";
                                    } ?>>
                            </div>
                        </div>
                        <div class="projectDes">
                            <div class="mb-3">
                                <label class="form-label"><b>Project Description</b></label>
                                <textarea class="form-control inputForm ProjectDes" name="ProjectDescription"
                                    rows="5"></textarea>
                            </div>
                        </div>
                        <div class="formSec">
                            <label class="rights"><b>This submission is original, belongs to me, was prepared by me
                                    and
                                    in
                                    this
                                    submission I take responsibility for the originality of what is written in
                                    it.<br>

                                    With the exception of the places where I have indicated that the work was done
                                    by
                                    others and a suitable link is found in the bibliography or in the necessary
                                    place
                                    for this.</b></label>
                            <div class="rights">
                                <div class="form-check">
                                    <input class="form-check-input formCheck flexCheckDefault" type="checkbox" value=""
                                        required>
                                    <label class="form-check-label">
                                        <b class="checkText">I am aware and agree that this assignment will be
                                            checked
                                            for
                                            plagiarism by
                                            an originality rating group and I agree to the <a
                                                href="https://www.originality.co.il/termsOfUse.html" class="terms">terms
                                                of use.</a></b>
                                    </label>
                                </div>
                            </div><br>
                            <button type="submit" class="btn btn-primary formButton submit">Submit</button>
                            <button class="btn btn-primary formButton was-validated" id="cancel"
                                onclick="goBack()">Cancel</button>
                        </div>
                    </div>
                    <div class="rightSide">
                        <div class="mb-3">
                            <label class="form-label"><b>Project Image</b></label>
                            <input type="file" class="form-control fileInput ProjectImageForm" name="ProjectIMage"
                                accept=".png,.jpeg,.SVG">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><b>Project Srs</b></label>
                            <input type="file" class="form-control fileInput ProjectImageForm" name="ProjectSrs"
                                accept=".pdf">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><b>Link To Moqups Page</b></label>
                            <div class="input-group moqupsUrl">
                                <span class="input-group-text basic-addon3">https://app.moqups.com/</span>
                                <input type="text" class="form-control inputForm basic-url" name="linktotheMoqupspage">
                            </div>
                        </div>
                        <label class="form-label"><b>&nbsp;&nbsp;&nbsp;Upload additional
                                files</b></label>
                        <section class="fileContainer">
                            <span class="fileInputText">Files can be copied from the PC to the component below, by
                                dragging and dropping.</span>
                            <div class="input-group mb-3 " id="fileInputContainer">

                                <input type="file" class="form-control" name="fileList[]" id="inputGroupFile01" multiple
                                    accept=".docx,.epub,.gdoc,.odt,.oth,.ott,.pdf,.rtf,.cpp,.hpp,.png">
                                <span class="input-group-text" id="fileCount"></span>
                            </div>
                            <ul id="fileListContainer"></ul>
                        </section>
                        <span>Possible file types:</span>
                        <span>Document files doc .docx .epub .gdoc .odt .oth .ott .pdf .rtf .cpp .hpp</span>
                    </div>
                    <input type="hidden" name="state" value="<?php echo $state; ?>">
                    <input type="hidden" name="projId" value="<?php echo $projId; ?>">
                </form>
            </section>
        </section>
    </section>
    <div id="formFunc"></div>
    <script src="js/script.js"></script>
</body>

</html>

<?php
mysqli_close($connection);
?>