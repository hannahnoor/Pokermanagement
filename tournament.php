<?php
require_once 'checkLogin.php';

function getPlayers()
{
    $tourID = $_SESSION['tour_id'];

    include('connectDB.php');
    $getParticipants = $conn->prepare('SELECT `user`.Name, participant.*  FROM participant INNER JOIN `user` ON participant.player_id = `user`.id WHERE tournament_id = :tourID');
    $getParticipants->bindParam(':tourID', $tourID);
    $getParticipants->setFetchMode(PDO::FETCH_ASSOC);
    $getParticipants->execute();
    return $getParticipants->fetchAll();

}

getPlayers();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8"/>
    <title>Tournament</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7dd5b04b57.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&family=Quicksand&display=swap"
          rel="stylesheet">

</head>

<body class="background">

<div class="container centerScreen">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"><?= $_SESSION['tour_name'] ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><?= $_SESSION['tour_code'] ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!--Lijst van deelnemers-->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Deelnemers</h2>

                    <ul class="list-group">
                        <?php foreach (getPlayers() as $key => $value) { ?>
                            <li class="list-group-item">
                                <?= $value['Name'] ?>
                            </li>
                        <?php } ?>
                    </ul>
                    <div>
                        <button class="btn" type="button" id="Starten"><a href="/speelscherm.php"></a>Ga naar spel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>