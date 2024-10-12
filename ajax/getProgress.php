<?php
    require_once("../includes/config.php");

    if(isset($_POST["videoId"]) && isset($_POST["username"])){

        $query = $con->prepare("SELECT progress FROM videoProgress WHERE videoId=:videoId AND username=:username");
        
        $query->bindValue(":videoId", $_POST["videoId"]);
        $query->bindValue(":username", $_POST["username"]);

        $query->execute();

        echo $query->fetchColumn();

    } else {
        echo "no details sent";
    }
?>