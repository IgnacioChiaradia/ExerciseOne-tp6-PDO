<?php namespace Config;
	
    class Autoload {
        
        public static function Start() {
            spl_autoload_register(function($className)
			{
                $classPath = ucwords(str_replace("\\", "/", ROOT.$className).".php");
                
                /*echo '<pre>';
                var_dump($classPath);
                echo '<pre>';*/

				include_once($classPath);
			});
        }
    }
?>