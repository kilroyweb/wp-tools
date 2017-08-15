<?php

namespace KilroyWeb\WPTools\Builders\Forms\Fields;

abstract class BaseField{

    protected $template = 'bootstrap';
    protected $type;
    protected $name;
    protected $value;
    protected $id;
    protected $label;
    protected $prefix;
    protected $suffix;
    protected $placeholder;
    protected $options=[];
    protected $classes=[];

    public function __construct()
    {
        $this->addClass('form-control');
    }

    public function setName($name){
        $this->name = $name;
        if(!$this->id){
            $this->id = $this->name;
        }
    }

    protected function getClassString(){
        return implode(' ',$this->classes);
    }

    public function addClass($class){
        $this->classes[] = $class;
        return $this;
    }

    public function name($name){
        $this->setName($name);
        return $this;
    }

    public function setLabel($label){
        $this->label = $label;
    }

    public function label($label){
        $this->setLabel($label);
        return $this;
    }

    public function setPrefix($prefix){
        $this->prefix = $prefix;
    }

    public function prefix($prefix){
        $this->setPrefix($prefix);
        return $this;
    }

    public function setOptions($options){
        $this->options = $options;
    }

    public function options($options){
        $this->setOptions($options);
        return $this;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function value($value){
        $this->setValue($value);
        return $this;
    }

    public function setSuffix($suffix){
        $this->suffix = $suffix;
    }

    public function suffix($suffix){
        $this->setSuffix($suffix);
        return $this;
    }

    public function render(){
        $output = [];
        $output[] = $this->renderFormGroupOpen();
        $output[] = $this->renderLabel();
        $output[] = $this->renderInputGroupOpen();
        $output[] = $this->renderInput();
        $output[] = $this->renderInputGroupClose();
        $output[] = $this->renderFormGroupClose();
        $output = implode("\n",$output);
        return $output;
    }

    public function renderFormGroupOpen(){
        return '<div class="form-group">';
    }

    public function renderFormGroupClose(){
        return '</div>';
    }

    public function renderLabel(){
        if($this->label){
            return '<label for="'.$this->name.'" class="control-label">'.$this->label.'</label>';
        }
        return '';
    }

    public function renderInputGroupOpen(){
        if(!empty($this->prefix) || !empty($this->suffix)){
            $output = '<div class="input-group">';
            if(!empty($this->prefix)){
                $output .= '<span class="input-group-addon">'.$this->prefix.'</span>';
            }
            return $output;
        }
        return '';
    }

    public function renderInputGroupClose(){
        if(!empty($this->prefix) || !empty($this->suffix)){
            $output = '';
            if(!empty($this->suffix)){
                $output .= '<span class="input-group-addon">'.$this->suffix.'</span>';
            }
            $output .= '</div>';
            return $output;
        }
        return '';
    }

    public function renderInput(){
        $output = '<input type="'.$this->type.'" name="'.$this->name.'" class="'.$this->getClassString().'" id="'.$this->id.'"';
        if($this->placeholder){
            $output .= ' placeholder="'.$this->placeholder.'"';
        }
        if($this->value){
            $output .= ' value="'.$this->value.'"';
        }
        $output .= ' />';
        return $output;
    }

}