<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <img src="/Logo/logo.png" >
    </header>
    <section>
        <h1>BrakePoint Project Details:</h1>
        <p><label>Project Name:</label><?php echo $_GET['ProjectName']; ?></p>
        <p><label>Project Type:</label><?php echo $_GET['ProjectType']; ?></p>
        <p><label>Participant 1:</label><?php echo $_GET['Participant1Name'] . ' ' . $_GET['Participant1NameSecond']; ?></p>
        <p><label>Participant 2:</label><?php echo $_GET['Participant2Name'] . ' ' . $_GET['Participant2NameSecond']; ?></p>
        <p><label>Project Description:</label><?php echo $_GET['ProjectDescription']; ?></p>
        <p><label>Project Image:</label><?php echo $_GET['ProjectIMage']; ?></p>
        <p><label>Project SRS:</label><?php echo $_GET['ProjectSrs']; ?></p>
        <p><label>Link to the Moqups Page:</label><?php echo $_GET['linktotheMoqupspage']; ?></p>
    </section>
</body>
</html>