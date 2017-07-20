<?php

namespace KilroyWeb\WPTools\PageCallbacks;

abstract class BasePageCallback{

    public function render(){
        echo $this->getContent();
    }

    protected function getContent(){
        return '<div class="wrap"></div>';
    }

}