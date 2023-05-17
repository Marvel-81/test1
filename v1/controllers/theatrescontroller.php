<?php

class TheatresController extends BaseController
{
    private $theatreModel;
    public function __construct()
    {
        $this->theatreModel = new Theatre;
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
        if ((!isset($_GET['id']))||(empty($_GET['id']))) {
            $param='';
        } else {
            $param = $_GET['id'];
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


    protected function get($id){
        if ($id>0){
//            print_r($id);
            $theatres=$this->theatreModel->getTheatre($id);
            $this->answer=$theatres;
            $this->showAnswer();
        } else{
            $theatres=$this->theatreModel->getAllTheatres();
            $this->answer=$theatres;
            $this->showAnswer();
        }

    }


}