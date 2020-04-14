<?php
require_once 'checkLogin.php';

function setTournament() {
    // Check if all fields are filled
    if (empty($_POST['startAmount']) || empty($_POST['rounds']) || empty($_POST['whiteChip']) || empty($_POST['redChip']) || empty($_POST['greenChip']) || empty($_POST['blueChip']) || empty($_POST['blackChip']))
    {
        return;
    };

    require_once('connectDB.php');


    $inputStartAmount = $_POST['startAmount'];
    $inputRoundAmount = $_POST['rounds'];
    $valueWhiteChip = $_POST['whiteChip'];
    $valueRedChip = $_POST['redChip'];
    $valueGreenChip = $_POST['greenChip'];
    $valueBlueChip = $_POST['blueChip'];
    $valueBlackChip = $_POST['blackChip'];
    $tourID = $_SESSION['tour_id']; // TODO: aanpassen

    $addSettings = $conn->prepare("UPDATE tournament SET start_amount = :startAmount, max_rounds = :maxRounds, chip_white = :valueWhite, chip_red = :valueRed, chip_green = :valueGreen, chip_blue = :valueBlue, chip_black = :valueBlack WHERE id = :id");

    $addSettings->bindParam(":startAmount", $inputStartAmount);
    $addSettings->bindParam(":maxRounds", $inputRoundAmount);
    $addSettings->bindParam(":valueWhite", $valueWhiteChip);
    $addSettings->bindParam(":valueRed", $valueRedChip);
    $addSettings->bindParam(":valueGreen", $valueGreenChip);
    $addSettings->bindParam(":valueBlue", $valueBlueChip);
    $addSettings->bindParam(":valueBlack", $valueBlackChip);
    $addSettings->bindParam("id", $tourID);

    if($addSettings->execute()) {
        $_SESSION['startAmount'] = $inputStartAmount;
        $_SESSION['maxRounds'] = $inputRoundAmount;
        $_SESSION['valueWhite'] = $valueWhiteChip;
        $_SESSION['valueRed'] = $valueRedChip;
        $_SESSION['valueGreen'] = $valueGreenChip;
        $_SESSION['valueBlue'] = $valueBlueChip;
        $_SESSION['valueBlack'] = $valueBlackChip;

        // TODO: Set location to speelscherm
        // TODO: Give each player in tournament a seat at a table. See test.php calcLevel()
        header('Location: #');
        die();
    }
};

function getPlayers() {
    include ('connectDB.php');
    $tourID = $_SESSION['tour_id'];
    $playerID = $_POST['player_id'];

    $getPlayers = $conn->prepare('SELECT * FROM participant WHERE player_id = :player_id ');
    $getPlayers->bindParam(':player_id', $playerID);


};

setTournament();


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
              <!-- TODO: Zorgen dat game code wordt weergegeven -->
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

            <!--Tijdelijke lijst-->
            <ul>
              <p>Speler 1</p>
              <p>Speler 2</p>
              <p>Speler 3</p>
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
                  <input type="number" name="whiteChip" min="1"  id="whiteChip" class="form-control">
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