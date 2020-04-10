<?php
// TODO: Straks misschien linken aan apart document
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function joinGame($conn) {
    if (empty($_POST['inputGameCode']))
    {
        return;
    }

    $inputGameCode = $_POST['inputGameCode'];
    $playerID = 1; // $_SESSION['id']; // TODO: Test

 // Check if code exists in Database
    $checkCode = $conn->prepare('SELECT * FROM tournament WHERE game_code = :code');
    $checkCode->bindParam('code', $inputGameCode);
    $checkCode->execute();
    $join = $checkCode->fetch();

    if($join) {

        $addToTour = $conn->prepare("INSERT INTO participant (player_id) VALUES (:playerID)");
        $addToTour->bindParam(":playerID", $playerID);
        if($addToTour->execute()){
            $_SESSION['tour_id'] = $join['id'];
            $_SESSION['tour_name'] = $join['tournament_name'];
            $_SESSION['tour_code'] = $join['game_code'];
            $_SESSION['player_name'] = $join['Name'];
            $_SESSION['player_id'] = $join['player_id'];
            $_SESSION['user_id'] = $join['id'];
            header('Location: tournament.php');
        };

        die();
    }
}

function startGame($conn) {
    //Check if user has chosen a name
    if (empty($_POST['inputGameName']))
    {
        return;
    };

    $gameName = $_POST['inputGameName'];


    // TODO: Make complexer game code
    $gameCode = base64_encode($gameName . '_#$_');

    $userID = $userID = 1; // $_SESSION['id']; // TODO: Test

    //Insert game into database
    $addTour = $conn->prepare("INSERT INTO tournament (game_code, tournament_name, admin) VALUES (:gameCode, :gameName, :admin)");
    $addTour->bindParam(":gameCode", $gameCode);
    $addTour->bindParam(":gameName", $gameName);
    $addTour->bindParam(":admin", $userID);


    if($addTour->execute()) {
        $_SESSION['tour_name'] = $gameName;
        // $_SESSION['tour_id'] = $addTour ['id']; TODO: Moet dit er nou wel in of niet?

        header('Location: tournamentadmin.php');
        die();
    }

}

include_once('connectDB.php');
joinGame($conn);
startGame($conn);

?>

<!DOCTYPE html>
<html>
    <head>
        <!--Make responsive-->
        <meta charset="utf-8"/>
        <title>Home</title>
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
                            <h1 class="card-title">Welkom, <?= $_SESSION['#'] ?>!</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!--Skill level-->
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Total amount of wins of a player-->
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Total amount of money a player has won-->
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <i class="fas fa-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!--Join game-->
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Meedoen</h3>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="inputGameCode">Voer code in</label>
                                    <input type="text" name="inputGameCode" class="form-control" id="inputGameCode"/>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Doe mee</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--Create game-->
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Creëer spel</h3>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="inputGameName">Naam toernooi</label>
                                    <input type="text" name="inputGameName" class="form-control" id="inputGameName"/>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Creëer</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </body>
</html> 