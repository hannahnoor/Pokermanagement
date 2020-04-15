<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function signUp() {
    // Controleer of alle velden gevuld zijn
    if (empty($_POST['signUpEmail']) || empty($_POST['signUpPassword']) || empty($_POST['inputName']) || empty($_POST['repeatSignUpPassword']))
    {
        return;
    };

    // Database connectie
    require_once ('connectDB.php');

    $signUpEmail = $_POST['signUpEmail'];
    $signUpPassword = $_POST['signUpPassword'];
    $inputName = $_POST['inputName'];
    $repeatSignUpPassword = $_POST['repeatSignUpPassword'];

    // Controleer of e-mail adres bestaat
    $chkEmail = $conn->prepare('SELECT * FROM user WHERE Email = :email');
    $chkEmail->bindParam(':email', $signUpEmail);
    $chkEmail->execute();

    if($chkEmail->rowCount() > 0){
        return;
    }

    // Controleer of wachtwoorden gelijk zijn
    if ($signUpPassword !== $repeatSignUpPassword){
        return;
    }

    // Hash wachtwoord
    $hashedPassword = password_hash($signUpPassword, PASSWORD_DEFAULT);

    // Voeg gebruiker toe aan database
    $insertUser = $conn->prepare("INSERT INTO user (`Email`, `Password`, `Name`) VALUES (:insEmail, :insPW, :insName)");
    $insertUser->bindParam(':insEmail', $signUpEmail);
    $insertUser->bindParam(':insPW', $hashedPassword);
    $insertUser->bindParam(':insName', $inputName);
    if($insertUser->execute()) {
        $id = $conn->lastInsertId();
        $insertPlayerStats = $conn->prepare("INSERT INTO player_stats (`player_id`) VALUES (:playerId)");
        $insertPlayerStats->bindParam(':playerId', $id);

        if($insertPlayerStats->execute()) {
            header('Location: index.php');
            die();
        }
    }

    die();
}

signUp();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Sign up</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css">

        <!--Fonts-->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&family=Quicksand&display=swap" rel="stylesheet">

    </head>

    <body class="backgroundStart">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card getstarted">
                        <div class="card-body">
                            <h1 class="text-center card-title">Registreren</h1>
                            <form method="POST">
                                <div class="textfields">
                                    <div class="form-group">
                                        <label for="signUpEmail">E-mailadres</label>
                                        <input type="email" name="signUpEmail" class="form-control" id="signUpEmail"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Naam</label>
                                        <input type="text" name="inputName" class="form-control" id="inputName"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="signUpPassword">Wachtwoord</label>
                                        <input type="password" name="signUpPassword" class="form-control" id="signUpPassword"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="repeatSignUpPassword">Wachtwoord herhalen</label>
                                        <input type="password" name="repeatSignUpPassword" class="form-control" id="repeatSignUpPassword"/>
                                    </div>
                                </div>
                                    <div>
                                    <button type="submit" class="btn btn-getstarted">Registreer</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </body>
</html>