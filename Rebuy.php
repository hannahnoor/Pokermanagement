<?php
require_once 'connectDB.php';
$rebuy_not_num= $rebuyEmpty= $checkboxEmpty= $doubleRebuy= "";
$userId=1; // Wordt deze al ergens aangemaakt in speelscherm?
// is $_SERVER request juiste manier?
if($_SERVER["REQUEST_METHOD"]== "POST"){

    $rebuy = htmlspecialchars($_POST['rebuy']);
    if(empty($_POST['rebuy'])){
        $rebuyEmpty= "Vul rebuy in!";
    }
    if(!is_numeric($rebuy)){

        $rebuy_not_num="Voer een getal in!";
    }

    if(empty($_POST['checkbox'])){
        $checkboxEmpty= "Vul checkbox in!";
    }
//Nog niet helemaal getest
    $getRebuy= $conn->prepare('SELECT rebuy_amount FROM participant WHERE id= :id');
    $getRebuy->bindParam(':id',$userId);
    $getRebuy->execute();

    if($getRebuy->rowCount() >0){
        $doubleRebuy ="Je hebt al te vaak een rebuy gedaan.";

    }

    // niet getest

    $rebuyQuery= $conn->prepare('SELECT start_amount FROM tournament WHERE id= :id');
    $rebuyQuery->bindParam(':id',$userId);
    $rebuyQuery->execute();
    if($rebuyQuery<$rebuy){
        $rebuyQuery1= $conn->prepare('INSERT INTO participant (rebuy_amount) VALUES (:rebuy_amount) WHERE id= :id');
        $rebuyQuery1->bindParam(':rebuy_amount',$rebuy);
        $rebuyQuery1->bindParam(':id',$userId);
        $rebuyQuery1->execute();
    }


}
