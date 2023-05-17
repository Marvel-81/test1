<?php

abstract class BaseController
{
    protected $answer;
    abstract function main($param);
    protected function showAnswer(){
        header ("HTTP/1.1 200 OK");
        echo json_encode($this->answer,JSON_UNESCAPED_UNICODE);
    }
    protected function showNotFound(){
        header ("HTTP/1.1 404 Not found");
    }
    protected function showUnauthorized(){
        header ("HTTP/1.1 403 Unauthorized");
    }
    protected function showBadRequest(){
        header ("HTTP/1.1 401 Bad Request");
    }
    protected function unreacheble(){
        header ("HTTP/1.1 424 Failed Dependency");
        echo json_encode($this->answer, JSON_UNESCAPED_UNICODE);
    }
}