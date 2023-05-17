<?php

class SeancesController extends BaseController
{
    private $SeanceModel;
    public function __construct()
    {
        $this->SeanceModel = new Seance;
    }
    private static function check($values,$entityBody){
        $count=0;
        foreach ($values as $value){
            foreach ($entityBody as $key=>$value2) {
                if ($value == $key) {
                    $count += 1;
                    break;
                }
            }
        }
        if (count($values)==$count) {return 1;} else {return 0;}

    }

    public function main($param)
    {
        if ((!isset($_GET['token']))||(empty($_GET['token']))) {
            $this->showUnauthorized();
            return;
        }
        $token=$_GET['token'];
        $result=new Auth();
        if (!$result->checkToken($token)){
            $this->showUnauthorized();
            return;
        }
        if ((!isset($_GET['date']))||(empty($_GET['date']))) {
            $param='';
        } else {
            $param = $_GET['date'];
        }
        $method=$_SERVER['REQUEST_METHOD'];
        switch ($method){
            case "GET":
                $this->get($param);
                break;
            default:
                $this->showBadRequest();
        }
    }


    protected function get($date){
        if (strlen($date)>0){
//            print_r($id);
            $Seances=$this->SeanceModel->getSeanceByDay($date);
            $this->answer=$Seances;
            $this->showAnswer();
        } else{
            $Seances=$this->SeanceModel->getAllSeances();
            $this->answer=$Seances;
            $this->showAnswer();
        }

    }


}