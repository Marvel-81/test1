<?php

class Seance
{
    private $connection;
    public function __construct(){
        $this->connection=DbWorking::dbConnect();
    }

    public function getAllSeances(){
        $query="SELECT
                `seance`.`datetime` AS 'Дата',
                `hall`.`name` AS 'Название зала',
                `cinema`.`name` AS 'Кинотеатр',
                `cinema`.`address` AS 'Адрес',
                `genre`.`name` AS 'Жанр',
                `movies`.`census` AS 'Возр.',
                `movies`.`name`AS 'Название',
                `seance`.`price` AS 'Цена',
                `movies`.`desc`AS 'Описание',
                CONCAT(`directed`.`first_name`,' ',`directed`.`last_name`) AS 'Режиссер',
                group_CONCAT(`actor`.`first_name`,' ',`actor`.`last_name` separator '; ') AS 'Актёры'
                FROM `cinema`.`seance`
                LEFT JOIN `cinema`.`hall` ON  `hall`.`ID`=`seance`.`ID_hall`
                LEFT JOIN `cinema`.`cinema` ON `cinema`.`ID`=`hall`.`ID_cinema`
                LEFT JOIN `cinema`.`movies` ON `seance`.`ID_movie`=`movies`.`ID`
                LEFT JOIN `cinema`.`genre` ON `movies`.`ID_genre`=`genre`.`ID`
                LEFT JOIN `cinema`.`directed` ON `directed`.`ID`=`movies`.`ID_directed`
                LEFT JOIN `cinema`.`actor_list` ON `movies`.`ID`=`actor_list`.`ID_movis`
                LEFT JOIN `cinema`.`actor` ON `actor`.`ID`=`actor_list`.`ID_actor`
                GROUP BY `seance`.`ID`
                ;";
//ECHO $query;
        $result = $this->connection->query($query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
    public function getSeanceByDay($date){
        $query="SELECT
                `seance`.`datetime` AS 'Дата',
                `hall`.`name` AS 'Название зала',
                `cinema`.`name` AS 'Кинотеатр',
                `cinema`.`address` AS 'Адрес',
                `genre`.`name` AS 'Жанр',
                `movies`.`census` AS 'Возр.',
                `movies`.`name`AS 'Название',
                `seance`.`price` AS 'Цена',
                `movies`.`desc`AS 'Описание',
                CONCAT(`directed`.`first_name`,' ',`directed`.`last_name`) AS 'Режиссер',
                group_CONCAT(`actor`.`first_name`,' ',`actor`.`last_name` separator '; ') AS 'Актёры'
                FROM `cinema`.`seance`
                LEFT JOIN `cinema`.`hall` ON  `hall`.`ID`=`seance`.`ID_hall`
                LEFT JOIN `cinema`.`cinema` ON `cinema`.`ID`=`hall`.`ID_cinema`
                LEFT JOIN `cinema`.`movies` ON `seance`.`ID_movie`=`movies`.`ID`
                LEFT JOIN `cinema`.`genre` ON `movies`.`ID_genre`=`genre`.`ID`
                LEFT JOIN `cinema`.`directed` ON `directed`.`ID`=`movies`.`ID_directed`
                LEFT JOIN `cinema`.`actor_list` ON `movies`.`ID`=`actor_list`.`ID_movis`
                LEFT JOIN `cinema`.`actor` ON `actor`.`ID`=`actor_list`.`ID_actor`                
                WHERE DATE(`seance`.`datetime`) = DATE('$date')
                GROUP BY `seance`.`ID`;";
//        echo $query;

        $result = $this->connection->query($query);

        $result=mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (count($result)>0) {return $result;} else {return ["error" => "No such seance!"];}
    }

}