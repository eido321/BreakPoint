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
    $state = "Creation";

    if ($result) {
        $row = mysqli_fetch_assoc($result); //there is only 1 with id=X
        $title = $row["title"];
        $state = "Edit";
    }
} else {
    $projId = null;
    $state = "Creation";
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
        <section class="body-conForm">
            <div class="breadCrumbsNoneSideBar">
                <span><a class="breadCrumbsLinks"
                        href="index.php">All Projects</a> > <a class="breadCrumbsLinks selectedBreadCrumbs"
                        href="indexForm.php">Project
                        <?php echo $state; ?></a></span>
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
                                    placeholder="* Microsoft" required <?php if ($state == 'Edit') {
                                        echo "value='" . htmlspecialchars($title, ENT_QUOTES) . "'";
                                    } ?>>
                            </div>
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>Project
                                        Type</b></label>
                                <input type="text" class="form-control inputForm ProjectType" name="ProjectType"
                                    placeholder="* Social" required <?php if ($state == 'Edit') {
                                        echo "value=" . $row["proj_type"] . "";
                                    } ?>>
                            </div>
                        </div>
                        <label>&nbsp;&nbsp;<b>Participant 1</b></label>
                        <div class="formInfo1Line2">
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>First
                                        Name</b></label>
                                <input type="text" class="form-control inputForm ProjectName" name="Participant1Name"
                                    placeholder="* Bill" required <?php if ($state == 'Edit') {
                                        echo "value=" . $row["p1_first_name"] . "";
                                    } ?>>
                            </div>
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>Last
                                        Name</b></label>
                                <input type="text" class="form-control inputForm ProjectType"
                                    name="Participant1NameSecond" placeholder="* Gates" required <?php if ($state == 'Edit') {
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
                                    placeholder="* John" required <?php if ($state == 'Edit') {
                                        echo "value=" . $row["p2_first_name"] . "";
                                    } ?>>
                            </div>
                            <div class="mb-3 formInfo">
                                <label class="form-label"><b>Last
                                        Name</b></label>
                                <input type="text" class="form-control inputForm ProjectType"
                                    name="Participant2NameSecond" placeholder="* Doe" required <?php if ($state == 'Edit') {
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