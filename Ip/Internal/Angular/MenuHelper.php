<?php
/**
 * Created by PhpStorm.
 * User: boing
 * Date: 29/05/2017
 * Time: 09:51
 */

namespace Ip\Internal\Angular;

use Ip\Internal\Admin\Model as AdminModel;

class MenuHelper
{
    public static function menuCoreItem($module, $withIcon = true, $subItems = []){
        $obj = [
            'title' => __($module, 'Ip-admin', false),
            'icon'  => 'fa ' . AdminModel::getAdminMenuItemIcon($module),
            'isCore' => true,
            'state' => 'parent.' . strtolower($module),
            'url' => ipActionUrl(['aa' => "$module.index"])
        ];

        if(!$withIcon){
            $obj['icon'] = '';
        }

        if(count($subItems) > 0){
            $obj['subMenu'] = $subItems;
        }

        return $obj;
    }

    public static function menuPluginItem($plugin, $icon = '', $state = '', $subItems = []){
        $obj = [
            'title' => __($plugin, $plugin, false),
            'icon'  => $icon,
            'isCore' => false,
            'state' => 'parent.' . $state,
            'url' => ipActionUrl(['aa' => "$plugin.index"])
        ];

        if(count($subItems) > 0){
            $obj['subMenu'] = $subItems;
        }

        return $obj;
    }

    public static function menuItem($title, $plugin, $icon = '', $url = '', $state = ''){
        $obj = [
            'title' => __($title, $plugin, false),
            'icon'  => $icon,
            'isCore' => false,
            'state' => 'parent.' . $state,
            'url' => ipActionUrl(['aa' => "$plugin.$url"])
        ];

        if(is_null($state)){
            unset($obj['state']);
        }

        if(is_null($url)){
            unset($obj['url']);
        }

        return $obj;
    }

    public static function getCoreModules(){
        $res = [];
        $internal = \Ip\Internal\Plugins\Model::getModules();

        foreach ($internal as $item){
            if(in_array($item,['Angular', 'Install'])){
                continue;
            }

            $controllerClass = 'Ip\\Internal\\' . $item . '\\AdminController';
            if (!class_exists($controllerClass) || !method_exists($controllerClass, 'index')) {
                continue;
            }

            $res[] = $item;
        }

        return$res;
    }

    public static function getMenuCoreInOneMenu(){
        $modules = [];
        $firstModule = '';

        foreach (MenuHelper::getCoreModules() as $coreModule) {
            if(in_array($coreModule, ['Content', 'Administrators', 'Log', 'Email'])){
                continue;
            }
            if($firstModule === ''){
                $firstModule = $coreModule;
            }
            $modules[] = MenuHelper::menuCoreItem($coreModule, false);
        }

        $obj = [
            'title' => __('Site Management', 'Ip-admin', false),
            'icon' => '',
            'state' => '',
            'url' => '',
            'subMenu' => [
                'columns' => 1,
                'col1'    => $modules
            ]
        ];

        return $obj;
    }

    public static function menuCore()
    {
        $res = [];
        $internal = self::getCoreModules();

        $index = 1;
        foreach ($internal as $item) {

            if (!in_array($item, ['Content', 'Administrators', 'Log', 'Email'])) {

                switch ($item){
                    case 'System':
                        $sumenu = [
                            'columns' => 1,
                            'col1'    => [
                                self::menuCoreItem($item, false),
                                self::menuCoreItem('Administrators', false),
                                self::menuCoreItem('Log', false),
                                self::menuCoreItem('Email', false)
                            ]
                        ];
                        $res[$index] = self::menuCoreItem($item);
                        break;
                    default:
                        $res[$index] = self::menuCoreItem($item);
                        break;
                }

                $index++;
            }
        }


        return $res;
    }
}