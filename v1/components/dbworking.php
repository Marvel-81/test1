<?php
class dbWorking

{

    protected static $_instance;
    private static $connect;
    private function __construct()
    {
        require_once("configs/db.php");
        self::$connect = mysqli_connect($db['HOST'], $db['USER'], $db['PASSWORD']);
        mysqli_select_db(self::$connect,$db['DB_NAME']);
        mysqli_set_charset(self::$connect, $db['CHARSET']);
    }
    public static function dbConnect(){
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __clone() {
    }

    private function __wakeup() {
    }

    public static function query($sql) {

//        echo $sql.'<br>';
            $result=mysqli_query(self::$connect, $sql);
//            or die("<br/><span style='color:red'>Ошибка в SQL запросе:</span> ".mysqli_error(self::$connect));
            return $result;
    }
}


