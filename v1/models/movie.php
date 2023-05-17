<?php

class Movie
{
    private $connection;
    public function __construct(){
        $this->connection=DbWorking::dbConnect();
    }

    public function getAllMovies(){
        $query="SELECT `movies`.`ID`, `movies`.`name` AS `Название`, `movies`.`census` AS `Возраст`,
                `genre`.`name` AS `Жанр`, CONCAT(`directed`.`first_name`,' ',`directed`.`last_name`) AS `Режиссер`,
                GROUP_CONCAT(CONCAT(`actor`.`first_name`,' ',`actor`.`last_name`) SEPARATOR '; ') AS `Актёры`
                FROM cinema.movies
                LEFT JOIN `cinema`.`genre` ON `genre`.`ID`=`movies`.`ID_genre`
                LEFT JOIN `cinema`.`directed` ON `directed`.`ID`=`movies`.`ID_directed`
                RIGHT JOIN `cinema`.`actor_list` ON `movies`.`ID`=`actor_list`.`ID_movis`
                LEFT JOIN `cinema`.`actor` ON `actor`.`ID`=`actor_list`.`ID_actor`
                GROUP BY `movies`.`ID`;";

        $result = $this->connection->query($query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
    public function getMovie($id){
        $query="SELECT `movies`.`ID`, `movies`.`name` AS `Название`, `movies`.`census` AS `Возраст`,
                `genre`.`name` AS `Жанр`, CONCAT(`directed`.`first_name`,' ',`directed`.`last_name`) AS `Режиссер`,
                GROUP_CONCAT(CONCAT(`actor`.`first_name`,' ',`actor`.`last_name`) SEPARATOR '; ') AS `Актёры`
                FROM cinema.movies
                LEFT JOIN `cinema`.`genre` ON `genre`.`ID`=`movies`.`ID_genre`
                LEFT JOIN `cinema`.`directed` ON `directed`.`ID`=`movies`.`ID_directed`
                RIGHT JOIN `cinema`.`actor_list` ON `movies`.`ID`=`actor_list`.`ID_movis`
                LEFT JOIN `cinema`.`actor` ON `actor`.`ID`=`actor_list`.`ID_actor`
                WHERE `movies`.`ID`=$id
                GROUP BY `movies`.`ID`;";
//        echo $query;
        $result = $this->connection->query($query);
        $result=mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (count($result)>0) {return $result;} else {return ["error" => "No such Movie!"];}
    }

}