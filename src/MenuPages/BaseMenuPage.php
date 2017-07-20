<?php

namespace KilroyWeb\WPTools\MenuPages;

abstract class BaseMenuPage{

    protected $pageTitle;
    protected $menuTitle;
    protected $capability = 'manage_options';
    protected $slug;
    protected $callbackClass;
    protected $icon = 'dashicons-admin-generic';

    public function getPageTitle(){
        return $this->pageTitle;
    }

    public function getMenuTitle(){
        return $this->menuTitle;
    }

    public function getCapability(){
        return $this->capability;
    }

    public function getSlug(){
        return $this->slug;
    }

    public function getCallbackClass(){
        return $this->callbackClass;
    }

    public function getFunction(){
        $callback = new $this->callbackClass;
        return [$callback, 'render'];
    }

    public function getIcon(){
        return $this->icon;
    }

}