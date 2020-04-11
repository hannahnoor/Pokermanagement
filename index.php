<?php
// Check if session exists
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function login() {

    if (empty($_POST['inputEmail']) || empty($_POST['inputPassword']))
    {
        return;
    };
    include_once('connectDB.php');

    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    var_dump($dbUsers);
    // Check if email exists
    $chkEmail = $conn->prepare('SELECT * FROM user WHERE Email = :email');
    $chkEmail->bindParam(':email', $email);
    $chkEmail->execute();
    $dbUsers = $chkEmail->fetch();

    if($chkEmail) {
        if (!password_verify($password, $dbUsers['Password'])) {
           // return;
        }
        var_dump('');
        $_SESSION['id'] = $dbUsers['id'];
        $_SESSION['name'] = $dbUsers['Name'];

        header('Location: home.php');
        die();
    }

}

login();

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <!--Make responsive-->
    <meta charset="utf-8"/>
    <title>Login</title>
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
                        <h1 class="text-center card-title">Inloggen</h1>
                        <form method="POST">
                            <div class="textfields">
                                <div class="form-group">
                                <label for="inputEmail">E-mailadres</label>
                                    <input type="email" name="inputEmail" class="form-control" id="inputEmail"/>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Wachtwoord</label>
                                    <input type="password" name="inputPassword" class="form-control" id="inputPassword"/>
                                </div>
                            </div>
                                <div>
                                    <!--Add link-->
                                    <button type="submit" name="login" class="btn btn-getstarted">Log in</button>
                                </div>
                                <div>
                                    <!--Add link + page-->
                                    <a href="#">Wachtwoord vergeten?</a>
                                </div>
                            
                            <div>
                                <p class="text-center" id="noAccount">Nog geen account? <a href="signup.php">Registreer</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>