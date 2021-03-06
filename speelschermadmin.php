<?php
require_once 'checkLogin.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Speelscherm</title>
    <!--Make responsive-->
    <meta charset="utf-8"/>
    <title>Speelscherm</title>
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
                    <div class="row">
                        <div class="col-3">
                            <button class="btn" type="button" id="spelregels">Spelregels</button>
                            <!-- HIERZO JARNO -->
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
                            <!-- Einde -->
                        </div>
                        <div class="col-3">
                            <button class="btn" type="button" id="fiches">Fiches</button>
                        </div>
                        <div class="col-3">
                            <button class="btn" type="button" id="rebuy">Rebuy</button>
                        </div>
                        <div class="col-3">
                            <button class="btn" type="button" id="quit">Quit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Players</h3>
                    <div>
                        <ul>
                            <li>Player 1: 5 rondes</li>
                            <li>Player 2: 4 rondes</li>
                            <li>Player 3: 3 rondes</li>
                            <li>Player 4: 2 rondes</li>
                            <li>Player 5: 1 ronde</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body gameboard-admin">
                    <div id="board-top">
                        <div class="board-container">
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>

                        </div>
                    </div>
                    <div id="board-bottom">
                        <div class="board-container">
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body gameboard-admin">
                    <div id="board-top">
                        <div class="board-container">
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>

                        </div>
                    </div>
                    <div id="board-bottom">
                        <div class="board-container">
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-4 offset-4">
            <div class="card">
                <div class="card-body gameboard-admin">
                    <div id="board-top">
                        <div class="board-container">
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>

                        </div>
                    </div>
                    <div id="board-bottom">
                        <div class="board-container">
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="player-admin">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Get the modal
    var modal = document.getElementById("spelregelPopup");

    // Get the button that opens the modal
    var btn = document.getElementById("spelregels");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>
