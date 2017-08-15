<?php

namespace KilroyWeb\WPTools\Builders\Forms\Fields;

class Select extends BaseField {

    protected $type = 'select';

    public function renderInput(){
        $output = '<select name="'.$this->name.'" class="'.$this->getClassString().'" id="'.$this->id.'">';
        foreach($this->options as $optionValue => $optionLabel){
            $selected = '';
            if($this->value == $optionValue){
                $selected = 'selected="selected"';
            }
            $output .= '<option value="'.$optionValue.'" '.$selected.'>'.$optionLabel.'</option>';
        }
        $output .= '</select>';
        return $output;
    }

}