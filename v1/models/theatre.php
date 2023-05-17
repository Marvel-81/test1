<?php

class Theatre
{
    private $connection;
    public function __construct(){
        $this->connection=DbWorking::dbConnect();
    }

    public function getAllTheatres(){
        $query="SELECT DISTINCT `cinema`.`ID`,`cinema`.`name` AS 'Кинотеатр', `cinema`.`address` AS 'Адрес', count(`hall`.`name`) AS 'Кол-во залов' 
                FROM `cinema`.`cinema` 
                LEFT JOIN `hall` ON `cinema`.`ID`=`hall`.`ID_cinema` 
                GROUP BY `cinema`.`name`;";
        $result = $this->connection->query($query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
    public function getTheatre($id){
        $query="SELECT DISTINCT `cinema`.`ID`,`cinema`.`name` AS 'Кинотеатр', `cinema`.`address` AS 'Адрес', count(`hall`.`name`) AS 'Кол-во залов' 
                FROM `cinema`.`cinema` 
                LEFT JOIN `hall` ON `cinema`.`ID`=`hall`.`ID_cinema` 
                WHERE `cinema`.`ID`=$id 
                GROUP BY `cinema`.`name`;";

//        echo $query;
        $result = $this->connection->query($query);
        $result=mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (count($result)>0) {return $result;} else {return ["error" => "No such Theatre!"];}
    }

}