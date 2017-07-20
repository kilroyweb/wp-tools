<?php

namespace KilroyWeb\WPTools\Support;


class Renderer
{

    private $lines;

    public function add($string){
        $this->lines[] = $string;
    }

    public function render(){
        return implode("\n",$this->lines);
    }

}