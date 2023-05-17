<?php

class Place
{
    private $connection;
    public function __construct(){
        $this->connection=DbWorking::dbConnect();

    }
    public function DeletePlace($id,$params){
        $query="DELETE FROM `Places` WHERE `Place_id`=".$id.";";
        $result = $this->connection->query($query);
        if ($result) {Return ["success"=>"Deleting complete!"];}else {return ["error " => $result.". Deletion false"];}
    }
    public function UpdatePlace($id,$params){
        $query="UPDATE `Places` SET `Place_title`='".$params->title."',`Place_text`='".$params->text."' WHERE `Place_id`=".$id.";";
        $result = $this->connection->query($query);
        if ($result) {Return ["success"=>"Update complete!"];}else {return ["error " => $result.". Updating false"];}
    }
    public function AddPlace($params){
        $query="SELECT COUNT(`ID`) FROM `ticket` WHERE (`ID_seance`=$params->seance AND `row`=$params->row AND`number`=$params->number)";
        $result=(mysqli_fetch_all($this->connection->query($query),MYSQLI_NUM)[0][0]);
        if ($result>0) {return ["error " => "Ticket already sold!"];}

        $query="SELECT COUNT(`ID`) FROM `place` WHERE (`ID_hall`=(SELECT `ID_hall` FROM `seance` WHERE `seance`.`ID`=$params->seance) AND `row`=$params->row AND `number`= $params->number)";
        $result=(mysqli_fetch_all($this->connection->query($query),MYSQLI_NUM)[0][0]);
        if ($result<1) {return ["error " => "Invalid place row/number!"];}

        $query="INSERT INTO `ticket` (`ID_seance`,`ID_status`,`row`,`number`) VALUES ($params->seance, $params->status, $params->row, $params->number);";
        $result = $this->connection->query($query);
                if ($result) {Return ["success"=>"Adding ok!"];}else {return ["error " => $result.".  Place not added"];}
    }
    public function getAllPlaces($id){
        $query="SELECT `seance`.`ID`, `seance`.`datetime` AS 'Дата', `movies`.`name` AS 'Фильм', `cinema`.`name` AS 'Кинотеатр', 
                `hall`.`name` AS 'Зал', `place`.`row` AS 'Ряд', `place`.`number` AS 'Место', `status`.`name` AS 'Статус'
                FROM `seance`
                LEFT JOIN `place` ON `place`.`ID_hall`=`seance`.`ID_hall`
                LEFT JOIN `ticket` ON (`ticket`.`ID_seance`=`seance`.`ID` AND `place`.`row`=`ticket`.`row` AND `place`.`number`=`ticket`.`number`)
                LEFT JOIN `movies` ON `movies`.`ID`=`seance`.`ID_movie`
                LEFT JOIN `hall` ON `hall`.`ID`=`seance`.`ID_hall`
                LEFT JOIN`cinema` ON `cinema`.`ID`=`hall`.`ID_cinema`
                LEFT JOIN `status` ON `status`.`ID`=`ticket`.`ID_status`
                WHERE (`seance`.`ID`=$id);";
        $result = $this->connection->query($query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
    public function getFreePlaces($id){
        $query="SELECT `seance`.`ID`, `seance`.`datetime` AS 'Дата', `movies`.`name` AS 'Фильм', `cinema`.`name` AS 'Кинотеатр', 
                `hall`.`name` AS 'Зал', `place`.`row` AS 'Ряд', `place`.`number` AS 'Место', `status`.`name` AS 'Статус'
                FROM `seance`
                LEFT JOIN `place` ON `place`.`ID_hall`=`seance`.`ID_hall`
                LEFT JOIN `ticket` ON (`ticket`.`ID_seance`=`seance`.`ID` AND `place`.`row`=`ticket`.`row` AND `place`.`number`=`ticket`.`number`)
                LEFT JOIN `movies` ON `movies`.`ID`=`seance`.`ID_movie`
                LEFT JOIN `hall` ON `hall`.`ID`=`seance`.`ID_hall`
                LEFT JOIN`cinema` ON `cinema`.`ID`=`hall`.`ID_cinema`
                LEFT JOIN `status` ON `status`.`ID`=`ticket`.`ID_status`
                WHERE (`seance`.`ID`=$id AND `ticket`.`ID` is null);";
//        echo $query;
        $result = $this->connection->query($query);
        $result=mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (count($result)>0) {return $result;} else {return ["error" => "No such Place!"];}
    }
    public function getBlockedPlaces($id){
        $query="SELECT `seance`.`ID`, `seance`.`datetime` AS 'Дата', `movies`.`name` AS 'Фильм', `cinema`.`name` AS 'Кинотеатр', 
                `hall`.`name` AS 'Зал', `place`.`row` AS 'Ряд', `place`.`number` AS 'Место', `status`.`name` AS 'Статус'
                FROM `seance`
                LEFT JOIN `place` ON `place`.`ID_hall`=`seance`.`ID_hall`
                LEFT JOIN `ticket` ON (`ticket`.`ID_seance`=`seance`.`ID` AND `place`.`row`=`ticket`.`row` AND `place`.`number`=`ticket`.`number`)
                LEFT JOIN `movies` ON `movies`.`ID`=`seance`.`ID_movie`
                LEFT JOIN `hall` ON `hall`.`ID`=`seance`.`ID_hall`
                LEFT JOIN`cinema` ON `cinema`.`ID`=`hall`.`ID_cinema`
                LEFT JOIN `status` ON `status`.`ID`=`ticket`.`ID_status`
                WHERE (`seance`.`ID`=$id AND `ticket`.`ID` >0);";
//        echo $query;
        $result = $this->connection->query($query);
        $result=mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (count($result)>0) {return $result;} else {return ["error" => "No such Place!"];}
    }
}