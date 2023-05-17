<?php

class PlacesController extends BaseController
{
    private $PlaceModel;
    public function __construct()
    {
        $this->PlaceModel = new Place;
    }
    private static function check($values,$entityBody){
        $count=0;
        foreach ($values as $value){
//            print_r($entityBody);
            foreach ($entityBody as $key=>$value2) {
                if ($value == $key) {
                    $count += 1;
                    break;
                }
            }
        }
//        echo $count;
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

//            $this->showBadRequest();
            $param = 1;
//            return;
        } else {
            $param = $_GET['id'];
        }
        if ((!isset($_GET['free']))||(empty($_GET['free']))) {
            $alt=null;
        } else {
            $alt = $_GET['free'];
        }

        $method=$_SERVER['REQUEST_METHOD'];
        switch ($method){
            case "GET":
                $this->get($param,$alt);
                break;
            case "POST":
                $this->post($param);
                break;
            case "PUT":
                $this->update($param);
                break;
            case "DELETE":
                $this->delete($param);
                break;

            default:
                $this->showBadRequest();
        }
    }

    protected function delete($id){
        if ($id<=0){
            $this->showBadRequest();
            return;
        }
        $Places=$this->PlaceModel->getPlace($id);
        if  (!empty($Places["error"])) {
            $this->answer=$Places;
            $this->unreacheble();
            return;
        }
        else {
            $entityBody = file_get_contents('php://input');
            $entityBody = json_decode($entityBody);
            $this->answer = $this->PlaceModel->DeletePlace($id, $entityBody);
        }
        $this->showAnswer();
    }

    protected function update($id){

        if ($id<=0){
            $this->showBadRequest();
            return;
        }
        $Places=$this->PlaceModel->getPlace($id);
        if  (!empty($Places["error"])) {
            $this->answer=$Places;
            $this->unreacheble();
            return;
        }

        else {
            $entityBody = file_get_contents('php://input');
            $entityBody = json_decode($entityBody);
            $values = ['title', 'text'];
            if (!self::check($values, $entityBody)) {
                $this->answer = ['error' => "Need for fields text and title!"];
            } else {
                $this->answer = $this->PlaceModel->UpdatePlace($id, $entityBody);
            }
        }
        $this->showAnswer();
    }



    protected function post(){
        $entityBody = file_get_contents('php://input');
        $entityBody=json_decode($entityBody);
        $values=['seance','status','row','number'];
        if (!self::check($values,$entityBody)) {$this->answer=['error' => "Need for fields 'seance','status','row','number'!"];}
        else {
            $this->answer=$this->PlaceModel->AddPlace($entityBody);
        }
        $this->showAnswer();
    }

//        echo file_get_contents('php://input');

    protected function get($id,$alt){
//        echo '-'.$id.'='.$alt.'-';
        switch ($alt){
            case 0:
                //            print_r($id);
                $Places=$this->PlaceModel->getFreePlaces($id);
                $this->answer=$Places;
                $this->showAnswer();
                break;
            case 1:
                $Places=$this->PlaceModel->getBlockedPlaces($id);
                $this->answer=$Places;
                $this->showAnswer();
                break;
            default:
                $Places=$this->PlaceModel->getAllPlaces($id);
                $this->answer=$Places;
                $this->showAnswer();
        }
    }
}