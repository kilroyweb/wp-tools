<?php

namespace KilroyWeb\WPTools\Plugins;

abstract class BasePlugin{

    protected $settingClasses = [];
    protected $menuPageClasses = [];

    public function init(){
        add_action('admin_init', array($this, 'registerSettings'));
        add_action('admin_menu', array($this, 'registerAdminMenuPages'));
        //add_action('init', array($this, 'initiateShortcodes'));
        //add_action( 'wp_enqueue_scripts', array($this, 'registerScripts') );
        //add_action('init', array($this, 'interceptRequests'));
        //add_action('init', array($this, 'injectRewrites'));
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
/*
            $titleApiSettingsPage = new TitleAPISettings();
            add_menu_page(
                'Title API',
                'Title API Settings',
                'manage_options',
                'title_api_settings',
                array($titleApiSettingsPage, 'render'),
                'dashicons-share-alt'
            );
            $titleApiApplicantsPage = new Applicants();
            add_submenu_page(
                'title_api_settings',
                'Applicant Details',
                'Applicant Details',
                'manage_options',
                'title_api_applicants',
                array($titleApiApplicantsPage, 'render')
            );
            $titleApiTitleCalculatorSubmissionsPage = new TitleCalculatorSubmissions();
            add_submenu_page(
                'title_api_settings',
                'Title Calculator Submissions',
                'Title Calculator Submissions',
                'manage_options',
                'title_api_title_calculator_submissions',
                array($titleApiTitleCalculatorSubmissionsPage, 'render')
            );
            $titleApiTransferTaxSubmissionsPage = new TransferTaxSubmissions();
            add_submenu_page(
                'title_api_settings',
                'Transfer Tax Submissions',
                'Transfer Tax Submissions',
                'manage_options',
                'title_api_transfer_tax_submissions',
                array($titleApiTransferTaxSubmissionsPage, 'render')
            );
            $titleApiDemoPage = new Demo();
            add_submenu_page(
                'title_api_settings',
                'API Demo',
                'API Demo',
                'manage_options',
                'title_api_demo',
                array($titleApiDemoPage, 'render')
            );

*/

        }
    }

}