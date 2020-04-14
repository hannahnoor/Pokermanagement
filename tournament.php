<?php
// TODO: Straks misschien linken aan apart document
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function getPlayers()
{
    include('connectDB.php');
    $tourID = $_SESSION['tour_id'];
    $playerID = $_POST['player_id'];
    $playerName =

        // TODO: Moet ik het misschien uit toernooi halen?
    $getPlayers = $conn->prepare('SELECT * FROM participant WHERE player_id = :player_id ');
    $getPlayers->bindParam(':player_id', $playerID);
    $getPlayers->execute();
    $players = $getPlayers->fetchAll();

    return $players;

    // TODO: Get names from table user
    $getPlayerNames = $conn->prepare('SELECT * FROM user WHERE Name = :name');


}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <!--Make responsive-->
    <meta charset="utf-8"/>
    <title>Tournament</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7dd5b04b57.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&family=Quicksand&display=swap" rel="stylesheet">

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
              <!-- TODO: Zorgen dat gamecode wordt weergegeven -->
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

            <!--TODO: Ik wil de name die hoort bij de player_id-->
            <ul class="list-group">
                <li class="list-group-item">
                    <?= $value['Name'] ?>
                   <!-- <div class="action-buttons">

                    </div>-->
                </li>
            </ul> 

          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>