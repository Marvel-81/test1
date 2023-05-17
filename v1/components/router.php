<?php

    require_once ("controllers/authcontroller.php");

    class router
    {
        private $routes;

        public function __construct()
        {
            require_once("./configs/routes.php");
            $this->routes = $routes;
        }

        public function run()
        {
//!!!!!!!!!!!
            $userUrl = $_SERVER['REQUEST_URI']; // pav2023/oop/authors в АПИ  REDIRECT_URL
            $found=false;
//            echo "$userUrl<br>";
            $userUrl = $_SERVER['REDIRECT_URL'];
//            echo "$userUrl<br>";

            foreach ($this->routes as $controller => $paths) {
                foreach ($paths as $path => $actionWithParameters) {
                    $fullPath=API_ROOT . $path;
//                    print_r($fullPath.'<br>');
                    if (preg_match("~$fullPath~", $userUrl)) {
//                        print_r($userUrl.'<br>');
//                        print_r($actionWithParameters.'<br>');
                        $actionWithParameters = preg_replace("~$fullPath~",$actionWithParameters,$userUrl);
//                        print_r($actionWithParameters.'<br>');
                        $actionWithParametersArray = explode('/',$actionWithParameters);
//                        print_r($actionWithParametersArray);
//                        echo '<br>';
                        $actionWithoutParameters = array_shift($actionWithParametersArray);
//                        print_r($actionWithoutParameters);
//                        echo '<br>';

                        $requestedController = new $controller();
//                        print_r($actionWithoutParameters.'-----------<br>');
                        $found=true;
//                        die();
                        $action = "action" . ucfirst($actionWithoutParameters);  // 'authorcontroller' => [ 'authors' => 'index' ] => actionIndex;
// обратить внимание - экшенс с параметрами
//                        echo ('--------<br>');
//                        print_r(array($requestedController,$actionWithoutParameters));
//                        echo ('--------<br>');
//                        print_r($actionWithParametersArray);
//                        echo '---------<br>';
// у мегя вопрос - почему в функции передаем экшенс с параметрами?
                        call_user_func_array(array($requestedController,$actionWithoutParameters), $actionWithParametersArray);
//                        $requestedController->$requestedAction();
                        break 2;
                    }
                }
            }
            if (!$found) {
                // если не найден маршрут
            }
        }
    }