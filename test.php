<?php
require_once ('connectDB.php');

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

// Level berekenen
function calcLevel()
{
    $tourID = 4; //$_SESSION[];\\

    include ('connectDB.php');

//  Andere query is; SELECT * FROM participant INNER JOIN player_stats ON participant.player_id = player_stats.player_id WHERE tournament_id = :tourID'
    $getParticipants = $conn->prepare('SELECT participant.player_id, (player_stats.round_won + (player_stats.tournament_won * 5)) / (player_stats.round_played + (player_stats.tournament_played) * 5) * 100 AS playerLevel FROM participant INNER JOIN player_stats ON participant.player_id = player_stats.player_id WHERE tournament_id = :tourID');
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
    var_dump($players);

    // BEREKEN HOEVEELHEID TAFELS.
    $playerCount = count($players);
    $tables = ceil($playerCount / 10);
    var_dump($tables);

    // Calculate players on a table
    // (int) is type casting. hiermee forceer je een type waarde naar een andere type. Als je (int) $i doet en $i = '1'; een string. dan wordt $i 1 als nummer
    $playerTable = (int) ceil($playerCount / $tables);
    var_dump($playerCount / $tables);

    for($currentTableNumber = 0; $currentTableNumber < $tables; $currentTableNumber++) {
        // Loop door alle tafels en houd bij welke tafel we zijn ($currentTableNumber)

        for($i = 0; $i < $playerTable; $i++) {
            // Loop door het aantal (maximum) spelers per tafel dat bepaald is door $playerTable.


            // Omdat er straks berekend wordt op welke positie de spelers zitten aan de hand van het maximum spelers per tafel. Hoeven we niet door de hele spelerlijst heen.

            // Bereken per tafel, de positie van de speler die bij het huidgie tafel nummer hoort.
            // Dit gebeurd door $i (speler positie aan tafel) + (totaal speler per tafel * huidgie tafelnummer)
            $newKey = $i + ($playerTable * $currentTableNumber);

            // Wanneer de speler niet bestaat. stop met de loop.
            if(!array_key_exists($newKey, $players)) {
                break;
            }

            //TODO: inplaats van dat je table_nr aanmaakt in de speler. Wil je het ID van de speler uit $players[$newKey] halen en voor die speler de participant table_nr updaten.
            // $players[$newKey]['table_nr'] = $currentTableNumber + 1;
            $updateTable = $conn->prepare("UPDATE participant SET table_nr = :tableNr WHERE player_id = :id");
            $updateTable->bindParam(':tableNr', ($currentTableNumber + 1));
            $updateTable->bindParam(':id', $players[$newKey]);
            // TODO: O.a. execute
            var_dump($updateTable);


        }
    }

    var_dump($players);

}


calcLevel();

?>