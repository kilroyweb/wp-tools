<?php

namespace KilroyWeb\WPTools\Plugins;

abstract class BasePlugin{

    protected $settingClasses = [];
    protected $menuPageClasses = [];
    protected $shortCodes = [];

    public function init(){
        add_action('admin_init', array($this, 'registerSettings'));
        add_action('admin_menu', array($this, 'registerAdminMenuPages'));
        add_action('init', array($this, 'initiateShortcodes'));
    }

    public function registerSettings()
    {
        foreach($this->settingClasses as $settingClass){
            $setting = new $settingClass;
            register_setting($setting->getGroup(), $setting->getName());
        }
    }

    public function registerAdminMenuPages(){
        foreach($this->menuPageClasses as $menuPageClass){
            $menuPage = new $menuPageClass;
            add_menu_page(
                $menuPage->getPageTitle(),
                $menuPage->getMenuTitle(),
                $menuPage->getCapability(),
                $menuPage->getSlug(),
                $menuPage->getFunction(),
                $menuPage->getIcon()
            );
        }
    }

    public function initiateShortcodes(){
        foreach($this->shortCodes as $shortcodeClass){
            $shortcodeInstance = new $shortcodeClass;
            $shortcodeInstance->init();
        }
    }

}