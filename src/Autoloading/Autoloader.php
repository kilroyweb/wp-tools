<?php

namespace KilroyWeb\WPTools\Autoloading;

class Autoloader{

    public static function autoload($path){
        $items = glob( $path . DIRECTORY_SEPARATOR . "*" );
        foreach( $items as $item ) {
            $pathInfo = pathinfo( $item );
            $isFile = is_file($item);
            $isDirectory = is_dir($item);
            if($isFile && isset($pathInfo['extension']) && $pathInfo['extension'] == 'php'){
                require_once $item;
            }
            if($isDirectory){
                static::autoload( $item );
            }
        }
    }

}