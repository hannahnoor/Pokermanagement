<?php
require_once 'checkLogin.php';

// TODO: Maak af. Hoe je de huidige spelertafel ophaalt + andere spelers aan die tafel staat hieronder.
// TODO: Verwerk al de gegevens waar nodig. (Tonen van spelernamen op het bord etc.)
$tourID = 4; //$_SESSION[];\\
$player_id = 2;  //$_SESSION[];\\

//$getPlayer =  SQL: SELECT * FROM participant WHERE player_id = :playerId AND tournament_id = :tourID
// bindParam
//$getPlayer->execute();
//$speler = $getPlayer->fetch();

// $getOtherPlayers = SQL: SELECT * FROM participant WHERE table_nr = :tableNr AND tournament_id = :tourID
// bindParam
//$getOtherPlayers->execute();
//$andereSpelers = $getOtherPlayers->fetchAll();


if(isset($_POST['fiches']))
{
    fiches();
}
if(isset($_POST['startbedrag']))
{
    startbedrag();
}

function fiches()
{
    include_once('connectDB.php');
    $stmt = $conn->prepare("SELECT chip_white, chip_red, chip_green, chip_blue, chip_black FROM tournament;");
    $stmt->execute();

    echo '<div id="fichesPopup" class="modal"><div class="modal-content">';
    echo '<div><input class="btn" type="button" onclick="closeModal()" value="x"></div>';
    echo '<table class="table table-condensed"> <th>Wit</th> <th>Rood</th><th>Groen</th><th>Blauw</th><th>Zwart</th>';

    while ($row = $stmt->fetch(PDO :: FETCH_NUM)) {
        echo '<tr>';
        foreach ($row as $column) {
            echo '<td>', $column, '</td>';
        }
        echo '<td></tr>';
    }

    echo '</table>';
    echo '</div></div>';
    ?>
    <script>
    var modal = document.getElementById("fichesPopup");
    modal.style.display = "block";

    function closeModal()
    {
    var modal = document.getElementById("fichesPopup");
    modal.style.display = "none";
    }
    </script>
<?php

    if(isset($_POST['close']))
    {
        ?><script>
        var modal = document.getElementById("fichesPopup");
        modal.style.display = "none";
</script><?php
    }
}


function startbedrag()
{
    include_once('connectDB.php');
    $stmt = $conn->prepare("SELECT start_amount FROM tournament;");
    $stmt->execute();

    echo '<div id="bedragPopup" class="modal"><div class="modal-content">';
    echo '<div><input class="btn" type="button" onclick="closeModal()" value="x"></div>';
    while ($row = $stmt->fetch(PDO :: FETCH_NUM)) {
        echo '<div>';
        foreach ($row as $column) {
            echo '<p>Het start bedrag is: €', $column, '</p>';
        }
        echo '</div>';
    }
    echo '</div></div >';

    ?>
    <script>
        var modal = document.getElementById("bedragPopup");
        modal.style.display = "block";

        function closeModal() {
            var modal = document.getElementById("bedragPopup");
            modal.style.display = "none";
        }
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <title>Speelscherm</title>
   <!--Make responsive-->
   <meta charset="utf-8"/>
   <title>Speelscherm</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://kit.fontawesome.com/7dd5b04b57.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css">

<style>
    /* Modal (Achtergrond) */
    .modal {
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }
    /* Modal Inhoud */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
</style>
</head>

<body class="background">
  <div class="container centerScreen">
      <div class="row">
          <div class="col">
              <div class="card">
                  <div class="card-body">
                      <h1 class="card-title">[Tafelniveau]</h1>
                  </div>
              </div>
          </div>
      </div>

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-2">
                <button class="btn" type="button" id="spelregels">Spelregels</button>
                  <div id="spelregelPopup" class="modal">
                      <div class="modal-content">
                          <span class="close">&times;</span>
                          <pre>
                            <b>Het doel van Poker hold’em</b>
                            Het doel is om met de pocketkaarten en de deckkaarten een combinatie met een zo’n hoog mogelijke combinatie van maximaal vijf kaarten te maken.

                            <b>Het spelverloop van poker hold’em</b>
                            De small en big blind: degene die direct links van de dealer zit, moet een small blind kopen. Hoe hoog deze small blind is, wordt aan het begin van het spel bepaalt.
                            De pokerspeler twee plekken naast de dealer is verplicht de big blind in te leggen. De overige spelers aan tafel hoeven niks in te leggen. Hierna begint het spel.
                            De dealer deelt twee gesloten kaarten per persoon uit en legt drie gesloten kaarten op tafel neer.

                            <b>De pre-flop:</b> iedereen mag zijn eigen kaarten bekijken. Op basis van deze kaarten kan er ingezet worden. De volgende acties zijn mogelijk: folden, checken of (re-)raisen.
                            <b>De flop:</b> na de pre-flop ronde volgt de flop ronde; wat betekent dat de drie kaarten op tafel worden omgedraaid. De tweede inzetronde kan plaatsvinden en de mogelijkheden folden, checken of (re-)raisen zijn van toepassing.
                            <b>De turn:</b> de vierde kaart op tafel wordt omgedraaid en kan opnieuw folden, checken of (re)-raisen)
                            <b>De river:</b> de vijfde kaart wordt omgedraaid en de spelers aan tafel mogen voor de laatste keer inzetten (folden, checken en (re-) raisen.
                            <b>De showdown:</b> de dealer vraagt iedereen om zijn of haar kaarten om te draaien en op basis van de hoogste kaartcombinatie wordt de winnaar bepaalt.

                            <b>De acties per speelronde Texas Hold’em</b>
                            <b>Folden:</b> soms is het beter om je verliezen te nemen en eerder uit de ronde te stappen. In dit geval kun je kiezen voor folden; wat betekent dat je niet meer aan deze speelronde deelneemt.
                            <b>Checken:</b> deze actie is alleen mogelijk wanneer de overige spelers de inzet niet verhoogt hebben. In dit geval kun je kiezen voor checken, wat betekent dat je niks inzet.
                            <b>Raisen:</b> in dit geval verhoog je de inzet. Dit kun je doen omdat je goede kaarten hebt of omdat je wilt gaan bluffen.
                            <b>Re-raisen:</b> wanneer je buurman zojuist voor raisen heeft gekozen, kun je er voor kiezen om te re-raisen. In dit geval verhoog je de inzet van je buurman.

                            <b>Hoe win je in poker Hold’em?</b>
                            Het doel van Texas Hold’em poker is om een zo’n hoog mogelijk combinatie met vijf kaarten te maken. Wanneer je de hoogste kaartencombinatie van alle overgebleven spelers aan tafel hebt, win je de speelronde.

<b>De kaartencombinaties in poker Hold’em</b>
Dit zijn de combinaties van kaarten die je kunt maken. Ze zijn hier op volgorde van beste naar slechtste.
<b>Royal Flush:</b> aas, koning, vrouw, boer, 10 van gelijk teken is de hoogst mogelijke pokerhand.
<b>Straight Flush:</b> Vijf opeenvolgende kaarten van gelijke teken. De aas kan zowel voor de twee als na de koning. Bij meerdere straight flush-handen beslist de hoogste kaart.
<b>Four of a kind:</b> Vier gelijkwaardige kaarten in dit geval vier boeren. Een four of a kind-hand is in bijna alle gevallen de winnaar.
<b>Full house:</b> Combinatie van three of a kind en een one pair. Soms komt er in dezelfde ronde twee of meer keer full house op tafel. Dan beslist de hoogste Three of a Kind, is deze gelijk dan is het pair beslissend.
<b>Flush:</b> Vijf willekeurige kaarten van gelijke teken. Bij twee of meer flush-handen beslist de hoogste kaart, daarna de volgende in de reeks.
<b>Straight:</b> Opeenvolgende kaarten van verschillende tekens. De aas kan voor de twee en na de koning. De laagst mogelijke straat is a-2-3-4-5, de hoogste is 10-j-v-k-a. Bij meerdere straight-handen beslist de hoogste kaart.
<b>Three of a kind:</b> Drie gelijkwaardige kaarten, in dit geval drie koningen. Deze hand is vaak genoeg om de pot te winnen.
<b>Two pair:</b> Verschillende paren. Bij meer two pair-handen is de waarde van het hoogste paar beslissend. Is die gelijk, dan beslist de waarde van het volgende paar of van de vijfde kaart.
<b>One pair:</b> Soms is "een paartje" genoeg om de pot te winnen. Bij gelijke combinaties beslist de hoogte van de volgende kaart.
<b>High card:</b> Vijf verschillende kaarten zonder een combinatie. Eerst kijk je natuurlijk wie de hoogste kaart heeft. Is die gelijk dan beslist de tweede kaart, is die ook gelijk dan gaat het om de waarde van de volgende.

                          </pre>
                      </div>
                  </div>
              </div>
              <div class="col-2">
                  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      <input type="submit" value="Fiches" name="fiches" class="btn" role="button">
                  </form>
              </div>
                <div class="col-2">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <input type="submit" value="Start bedrag" name="startbedrag" class="btn" role="button">
                    </form>
                </div>
                <div class="col-2">
                <button class="btn" type="button" id="rebuy">Rebuy</button>
              </div>
              <div class="col-2">
                <button class="btn" type="button" id="quit">Quit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-3">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Players</h3>
            <div>
              <ul>
                <li>Player 1: 430</li>
                <li>Player 2: 580</li>
                <li>Player 3: 310</li>
                <li>Player 4: 640</li>
                <li>Player 5: 495</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-9">
        <div class="card">
          <div class="card-body gameboard">
              <div id="board-top">
                  <div class="board-container">
                      <div class="player">
                          <i class="fas fa-user"></i>
                          <p style="color: white;">Pipi</p>
                      </div>
                      <div class="player">
                          <i class="fas fa-user"></i>
                      </div>
                      <div class="player">
                          <i class="fas fa-user"></i>
                      </div>
                      <div class="player">
                          <i class="fas fa-user"></i>
                      </div>
                      <div class="player">
                          <i class="fas fa-user"></i>
                      </div>

                  </div>
              </div>
              <div id="board-bottom">
                <div class="board-container">
                    <div class="player">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="player">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="player">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="player">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="player">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
              </div>

            <!--  <div class="player" id="player1">
                  <i class="fas fa-user"></i>
              </div>
             <div class="player" id="player2">
                  <i class="fas fa-user"></i>
              </div>
             <div class="player" id="player3">
                  <i class="fas fa-user"></i>
              </div>
              <div class="player" id="player4">
                  <i class="fas fa-user"></i>
              </div>
              <div class="player" id="player5">
                  <i class="fas fa-user"></i>
              </div>
              <div class="player" id="player6">
                  <i class="fas fa-user"></i>
              </div>
              <div class="player" id="player7">
                  <i class="fas fa-user"></i>
              </div>
              <div class="player" id="player8">
                  <i class="fas fa-user"></i>
              </div>
              <div class="player" id="player9">
                  <i class="fas fa-user"></i>
              </div>
              <div class="player" id="player10">
                  <i class="fas fa-user"></i>
              </div>
              </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>



<!--Doen we er een chat in?-->
<!--<div class="chat-popup" id="myForm">
  <form action="/action_page.php" class="form-container">
    <h1>Chat</h1>

    <label for="msg"><b>Message</b></label>
    <textarea placeholder="Type message.." name="msg" required></textarea>

    <button type="submit" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>-->

<!--<script>
function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
</script>-->

  <script>

      // Get the modal
      var modal = document.getElementById("spelregelPopup");

      // Get the button that opens the modal
      var btn = document.getElementById("spelregels");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal
      btn.onclick = function() {
          modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
          modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }
      }

      var modalfiches = document.getElementById("fichesPopup");
      var btnfiches = document.getElementById("fiches");
      var spanfiches = document.getElementsByClassName("close")[0];

      // When the user clicks on <span> (x), close the modal
      spanfiches.onclick = function() {
          modal.style.display = "none";
      }
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }
      }
  </script>
</body>
</html>
