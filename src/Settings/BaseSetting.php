<?php

namespace KilroyWeb\WPTools\Settings;

abstract class BaseSetting{

    protected $name;
    protected $group;

    public function getName(){
        return $this->name;
    }

    public function getGroup(){
        return $this->group;
    }

}