<?php

Class extension_association_ui_selector_materie extends Extension
{
    protected static $provides = array();

    public static function registerProviders()
    {
        self::$provides = array(
            'association-ui' => array(
                'aui-selector' => 'Selector: Search',
                'aui-selector-sortable' => 'Selector: Search (sortable)',
            )
        );

        return true;
    }

    public static function providerOf($type = null)
    {
        self::registerProviders();

        if (is_null($type)) {
            return self::$provides;
        }

        if (!isset(self::$provides[$type])) {
            return array();
        }

        return self::$provides[$type];
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscribedDelegates()
    {
        return array(
            array(
                'page' => '/backend/',
                'delegate' => 'InitaliseAdminPageHead',
                'callback' => 'appendAssets'
            )
        );
    }

    /**
     * Append assets
     */
    public function appendAssets()
    {
        $callback = Symphony::Engine()->getPageCallback();

        if ($callback['driver'] == 'publish'&& $callback['context']['page'] !== 'index') {
            Administration::instance()->Page->addStylesheetToHead(URL . '/extensions/association_ui_selector_materie/assets/aui.selector.publish.css');
            Administration::instance()->Page->addScriptToHead(URL . '/extensions/association_ui_selector_materie/assets/selectize.js');
            Administration::instance()->Page->addScriptToHead(URL . '/extensions/association_ui_selector_materie/assets/aui.selector.publish.js');
        }
    }

}
