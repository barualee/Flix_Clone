<?php
class Entity{
    private $con, $SQLData;

    public function __construct($con, $input){
        $this->con = $con;

        if(is_array($input)){
            $this->SQLData = $input;
        } else {
            $query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindValue(":id", $input);
            $query->execute();

            $this->SQLData = $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getId(){
        return $this->SQLData["id"];
    }

    public function getName(){
        return $this->SQLData["name"];
    }

    public function getThumbnail(){
        return $this->SQLData["thumbnail"];
    }

    public function getPreview(){
        return $this->SQLData["preview"];
    }

    public function getCategoryId(){
        return $this->SQLData["categoryId"];
    }

    public function getSeasons() {
        $query = $this->con->prepare("SELECT * FROM videos WHERE entityId=:id
                                    AND isMovie=0 ORDER BY season, episode ASC");
        $query->bindValue(":id", $this->getId());
        $query->execute();

        $seasons = array();
        $videos = array();
        $currentSeason = null;
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            
            if($currentSeason != null && $currentSeason != $row["season"]){
                $seasons[] = new Season($currentSeason, $videos);
                $videos = array();
            }

            $currentSeason = $row["season"];
            $videos[] = new Video($this->con, $row);
        }
        if(sizeof($videos) != 0){
            $seasons[] = new Season($currentSeason, $videos);
        }
        return $seasons;
    }
}
?>