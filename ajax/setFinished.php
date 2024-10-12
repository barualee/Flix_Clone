<?php
    require_once("../includes/config.php");

    if(isset($_POST["videoId"]) && isset($_POST["username"])){

        $query = $con->prepare("UPDATE videoProgress SET finished=1, progress=0, dateModified=NOW()
                                    WHERE videoId=:videoId AND username=:username");
        
        $query->bindValue(":videoId", $_POST["videoId"]);
        $query->bindValue(":username", $_POST["username"]);

        $query->execute();

    } else {
        echo "no details sent";
    }
?>