<?php

    class Author
    {
        public function getAll()
        {
            $db = array(
                'HOST' => 'localhost',
                'USER' => 'tbasumadmin',
                'PASSWORD' => '',
                'DB_NAME' => 'knigi',
                'CHARSET' => 'utf8'
            );
//            require_once("/configs/db.php");
            $connect = mysqli_connect($db['HOST'], $db['USER'], $db['PASSWORD'], $db['DB_NAME']);
            mysqli_set_charset($connect, $db['CHARSET']);
            $query = "SELECT * FROM `authors`";
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }