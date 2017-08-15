<?php

namespace KilroyWeb\WPTools\Settings;

abstract class BaseSetting{

    protected $name;
    protected $group;

    public function getName(){
        return $this->name;
    }

    public static function name(){
        $static = new static();
        return $static->getName();
    }

    public function getGroup(){
        $static = new static();
        return $static->group;
    }

    public static function group(){
        $static = new static();
        return $static->getGroup();
    }

}