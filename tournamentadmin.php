<?php
require_once('checkLogin.php');

function setTournament()
{
    // Controleer of alle velden zijn ingevuld
    if (empty($_POST['startAmount']) || empty($_POST['rounds']) || empty($_POST['whiteChip']) || empty($_POST['redChip']) || empty($_POST['greenChip']) || empty($_POST['blueChip']) || empty($_POST['blackChip'])) {
        return;
    };

    include('connectDB.php');

    $inputStartAmount = $_POST['startAmount'];
    $inputRoundAmount = $_POST['rounds'];
    $valueWhiteChip = $_POST['whiteChip'];
    $valueRedChip = $_POST['redChip'];
    $valueGreenChip = $_POST['greenChip'];
    $valueBlueChip = $_POST['blueChip'];
    $valueBlackChip = $_POST['blackChip'];
    $tourID = $_SESSION['tour_id'];

    $addSettings = $conn->prepare("UPDATE tournament SET start_amount = :startAmount, max_rounds = :maxRounds, chip_white = :valueWhite, chip_red = :valueRed, chip_green = :valueGreen, chip_blue = :valueBlue, chip_black = :valueBlack WHERE id = :id");

    $addSettings->bindParam(":startAmount", $inputStartAmount);
    $addSettings->bindParam(":maxRounds", $inputRoundAmount);
    $addSettings->bindParam(":valueWhite", $valueWhiteChip);
    $addSettings->bindParam(":valueRed", $valueRedChip);
    $addSettings->bindParam(":valueGreen", $valueGreenChip);
    $addSettings->bindParam(":valueBlue", $valueBlueChip);
    $addSettings->bindParam(":valueBlack", $valueBlackChip);
    $addSettings->bindParam("id", $tourID);

    if ($addSettings->execute()) {
        $_SESSION['startAmount'] = $inputStartAmount;
        $_SESSION['maxRounds'] = $inputRoundAmount;
        $_SESSION['valueWhite'] = $valueWhiteChip;
        $_SESSION['valueRed'] = $valueRedChip;
        $_SESSION['valueGreen'] = $valueGreenChip;
        $_SESSION['valueBlue'] = $valueBlueChip;
        $_SESSION['valueBlack'] = $valueBlackChip;

        calcLevel($tourID);
        header('Location: speelschermadmin.php');
        die();
    }
}

// Gebruikt voor de usort.
function sortByPlayerLevel($speler_1, $speler_2)
{
    if ($speler_1['playerLevel'] == $speler_2['playerLevel']) {
        return 0;
    }
    if ($speler_1['playerLevel'] < $speler_2['playerLevel']) {
        return -1;
    }

    return 1;
}

function calcLevel($tourID)
{
    include('connectDB.php');
    $tourID = (int)$tourID;

//  Andere query is; SELECT * FROM participant INNER JOIN player_stats ON participant.player_id = player_stats.player_id WHERE tournament_id = :tourID'
    $getParticipants = $conn->prepare('SELECT participant.player_id, (player_stats.round_won + (player_stats.tournament_won * 5)) / (player_stats.round_played + (player_stats.tournament_played) * 5) * 100 AS playerLevel FROM participant INNER JOIN player_stats ON participant.player_id = player_stats.player_id WHERE participant.tournament_id = :tourID');
    $getParticipants->bindParam(':tourID', $tourID);
    $getParticipants->setFetchMode(PDO::FETCH_ASSOC);
    $getParticipants->execute();
    $players = $getParticipants->fetchAll();

    foreach ($players as $key => $player) {
//        $roundsWon = $player['round_won'] + ($player['tournament_won'] * 5);
//        $roundsPlayed = $player['round_played'] + ($player['tournament_played'] * 5);
//        $playerLevel = ($roundsWon / $roundsPlayed) * 100;
        $players[$key]['playerLevel'] = (round($player['playerLevel'], 2));

    }
    usort($players, "sortByPlayerLevel");


    // Bereken aantal tafels
    $playerCount = count($players);
    $tables = ceil($playerCount / 10);


    // Bereken aantal spelers aan een tafel
    $playerTable = (int)ceil($playerCount / $tables);
    var_dump($playerCount / $tables);

    for ($currentTableNumber = 0; $currentTableNumber < $tables; $currentTableNumber++) {

        for ($i = 0; $i < $playerTable; $i++) {

            $newKey = $i + ($playerTable * $currentTableNumber);

            // Wanneer de speler niet bestaat. Stop met de loop.
            if (!array_key_exists($newKey, $players)) {
                break;
            }

            $updateTable = $conn->prepare("UPDATE participant SET table_nr = :tableNr WHERE player_id = :id AND tournament_id = :tourID");
            $updateTable->bindValue(':tableNr', ($currentTableNumber + 1));
            $updateTable->bindParam(':id', $players[$newKey]['player_id']);
            $updateTable->bindParam('tourID', $tourID);
            $updateTable->execute();

        }

    }


}

function getPlayers()
{
    include('connectDB.php');
    $tourID = $_SESSION['tour_id'];

    $getParticipants = $conn->prepare('SELECT `user`.Name, participant.*  FROM participant INNER JOIN `user` ON participant.player_id = `user`.id WHERE tournament_id = :tourID');
    $getParticipants->bindParam(':tourID', $tourID);
    $getParticipants->setFetchMode(PDO::FETCH_ASSOC);
    $getParticipants->execute();
    return $getParticipants->fetchAll();

}

getPlayers();
setTournament();

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
                    <h2><?= $_SESSION['tour_code'] ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!--Lijst van deelnemers-->
    <div class="row">
        <div class="col-5">
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

                </div>
            </div>
        </div>
        <!--Toernooi instellingen-->
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Instellingen</h2>
                    <!--Startbedrag invoeren-->
                    <form method="POST">
                        <div class="form-group">
                            <label for="startAmount">Startbedrag in euro's</label>
                            <input type="number" min="1" name="startAmount" class="form-control" id="startAmount"/>
                        </div>
                        <!--Aantal rondes invoeren-->
                        <div class="form-group">
                            <label for="rounds">Aantal rondes</label>
                            <input type="number" min="1" name="rounds" class="form-control" id="rounds"/>
                        </div>

                        <!--Waarde van de fiches invoeren-->
                        <div class="row">
                            <div class="col-12">
                                Waarde fiches
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <div class="chip"></div>
                                <input type="number" name="whiteChip" min="1" id="whiteChip" class="form-control">
                            </div>

                            <div class="col-2">
                                <div class="chip" id="red"></div>
                                <input type="number" name="redChip" min="1" class="form-control inputNumber">
                            </div>

                            <div class="col-2">
                                <div class="chip" id="green"></div>
                                <input type="number" name="greenChip" min="1" class="form-control">
                            </div>

                            <div class="col-2">
                                <div class="chip" id="blue"></div>
                                <input type="number" name="blueChip" min="1" class="form-control">
                            </div>

                            <div class="col-2">
                                <div class="chip" id="black"></div>
                                <input type="number" name="blackChip" min="1" class="form-control">
                            </div>

                        </div>
                        <div>
                            <button class="btn" type="submit" id="Starten">Start tournooi!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>