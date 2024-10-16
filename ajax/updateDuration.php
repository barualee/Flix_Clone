<?php
    require_once("../includes/config.php");

    if(isset($_POST["videoId"]) && isset($_POST["username"]) && isset($_POST["progress"])){

        $query = $con->prepare("UPDATE videoProgress SET progress=:progress, dateModified=NOW()
                                    WHERE videoId=:videoId AND username=:username");
        
        $query->bindValue(":videoId", $_POST["videoId"]);
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":progress", $_POST["progress"]);
        $query->execute();

    } else {
        echo "no details sent";
    }
?>