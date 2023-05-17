<?php

class Auth
{
    private $connection;
    public function __construct()
    {
        $this->connection = dbWorking::dbConnect();
    }
    public function generateToken(){
        $helper=new Helper();
        return $helper->generateToken();
    }
    public function getToken($key,$appId){
        $query="SELECT COUNT(*) AS `count`FROM `applications`
                WHERE `application_id` = $appId AND `application_key` = '$key'";
        $result=$this->connection->query($query);
        if (mysqli_fetch_assoc($result)["count"] == 1){
            $token=$this->generateToken();
            $query="UPDATE `applications` SET `application_token` = '$token'
                    WHERE `application_id` = $appId";
            $result=$this->connection->query($query);
            return $token;
        }
        else {return "";}
}
public function checkToken($token){
        //------------------------------------------
        // ВЫКЛЮЧАЕМ ПРОВЕРКУ ПРАВИЛЬНОСТИ ТОКЕНА
        return (1==1);
        //------------------------------------------
    //
        $query="SELECT COUNT(*) AS `count` FROM `applications` WHERE `application_token`='$token'";
        $result=$this->connection->query($query);
        if (empty($result)){return (1==2);}
        return (mysqli_fetch_assoc($result)['count']==1);
}

}