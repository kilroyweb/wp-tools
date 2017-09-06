<?php

namespace KilroyWeb\WPTools\Shortcodes;

abstract class BaseShortcode{

    protected $key;

    public function init(){
        add_shortcode( $this->key, array($this, 'run') );
    }

    public function run($attributes=[]){
        echo 'shortcode';
    }

}
