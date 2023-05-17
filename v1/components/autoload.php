<?php
//echo "!!!";
 spl_autoload_register(function ($class){
//     echo $class;
     $dirs=['components','controllers','models'];
     foreach ($dirs as $dir){
         $fileName = "$dir/" . mb_strtolower($class) . ".php";
//         echo $fileName;
         if (file_exists($fileName)) {
             require_once ($fileName);

//             die();
         }
     }
 });