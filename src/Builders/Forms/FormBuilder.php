<?php

namespace KilroyWeb\WPTools\Builders\Forms;

use RapidRover\Builders\Forms\Fields\Email;
use RapidRover\Builders\Forms\Fields\Select;
use RapidRover\Builders\Forms\Fields\Text;

class FormBuilder{

    private function getFieldAndSetName($fieldClass,$name){
        $field = new $fieldClass();
        $field->setName($name);
        return $field;
    }

    public function text($name){
        return $this->getFieldAndSetName(Text::class, $name);
    }

    public function email($name){
        return $this->getFieldAndSetName(Email::class, $name);
    }

    public function select($name){
        return $this->getFieldAndSetName(Select::class, $name);
    }

    public function open($attributes=[]){
        $method = 'GET';
        if(!empty($attributes['method'])){
            $method = $attributes['method'];
        }
        return '<form method="'.$method.'">';
    }

    public function close(){
        return '</form>';
    }


}