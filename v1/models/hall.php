<?php

class Hall
{
    private $connection;
    public function __construct(){
        $this->connection=DbWorking::dbConnect();
    }

    public function getAllHalls(){
        $query="SELECT `hall`.`ID`, `hall`.`name` AS 'Название зала', `cinema`.`name` AS 'Кинотеатр', 
                `cinema`.`address` AS 'Адрес', count(`place`.`ID`) AS 'Вместимость' 
                FROM `cinema`.`hall` 
                LEFT JOIN `cinema` ON `cinema`.`ID`=`hall`.`ID_cinema` 
                LEFT JOIN `cinema`.`place` ON `hall`.`ID`=`place`.`ID_hall` 
                GROUP BY `hall`.`ID`;";
        $result = $this->connection->query($query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
    public function getHall($id){
        $query="SELECT `hall`.`ID`, `hall`.`name` AS 'Название зала', `cinema`.`name` AS 'Кинотеатр', 
                `cinema`.`address` AS 'Адрес', count(`place`.`ID`) AS 'Вместимость' 
                FROM `cinema`.`hall` 
                LEFT JOIN `cinema` ON `cinema`.`ID`=`hall`.`ID_cinema` 
                LEFT JOIN `cinema`.`place` ON `hall`.`ID`=`place`.`ID_hall` 
                WHERE `hall`.`ID`= $id 
                GROUP BY `hall`.`ID`;";
//        echo $query;
        $result = $this->connection->query($query);
        $result=mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (count($result)>0) {return $result;} else {return ["error" => "No such Hall!"];}
    }

}