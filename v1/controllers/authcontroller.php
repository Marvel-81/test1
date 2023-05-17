<?php

 class AuthController extends baseController
{
    private $authModel;
    public function __construct(){
        $this->authModel=new Auth();
    }
     public function main($param)
     {
         $method=$_SERVER['REQUEST_METHOD'];
         switch ($method){
             case "GET":
                 $this->get($param);
                 break;
             default:
                 $this->showBadRequest();
         }
     }
     protected function get(){
        $key=$_GET['key'];
        $appId = $_GET['application'];
        $token= $this->authModel->getToken( $key,$appId);
        if ($token !==''){
            $this->answer=['token'=>$token];
            $this->showAnswer();
        }
        else{
            $this->showUnauthorized();
        }
     }
}