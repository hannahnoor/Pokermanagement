<?php
require_once ('connectDB.php');

$gewonnenRondes = 20;
$gespeeldeRondes = 50;
$gewonnenToernooien = 1;

$roundsWon = $gewonnenRondes + ($gewonnenToernooien * 5);
$roundsPlayed = $gespeeldeRondes + ($gewonnenToernooien * 5);
$playerLevel = ($roundsWon / $roundsPlayed) * 100;

var_dump(round ($playerLevel, 2));

foreach

?>