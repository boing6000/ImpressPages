<?php
/**
 * Created by PhpStorm.
 * User: boing
 * Date: 26/05/2017
 * Time: 08:47
 */

namespace Ip\Internal\Angular;


class Helper
{
    public static function loadFiles($onlyCss = false)
    {

        $modules = \Ip\Internal\Plugins\Model::getModules();
        $plugins = \Ip\Internal\Plugins\Model::getAllPluginNames();

        $system = array_merge($modules, $plugins);
        $combine = ['css' => [], 'js' => []];

        foreach ($system as $item) {

            if (is_file("Ip/Internal/$item/assets/angular.json")) {
                $json = file_get_contents("Ip/Internal/$item/assets/angular.json");
                $json = json_decode($json);

                if (!ipConfig()->isDevelopmentEnvironment()) {
                    if(!$onlyCss){
                        $combine['js'][] = Service::loadJs($json->js, $item, Service::INTERNAL, false);
                    }
                    $combine['css'][] = Service::loadCss($json->css, $item, Service::INTERNAL, false);
                }else{
                    if(!$onlyCss){
                        Service::loadJs($json->js, $item, Service::INTERNAL);
                    }
                    Service::loadCss($json->css, $item, Service::INTERNAL);
                }
            } elseif (is_file("Plugin/$item/assets/angular.json")) {
                $json = file_get_contents("Plugin/$item/assets/angular.json");
                $json = json_decode($json);

                if (!ipConfig()->isDevelopmentEnvironment()) {
                    if(!$onlyCss){
                        $combine['js'][] = Service::loadJs($json->js, $item, Service::INTERNAL, false);
                    }
                    $combine['css'][] = Service::loadCss($json->css, $item, Service::INTERNAL, false);
                } else {
                    if(!$onlyCss){
                        Service::loadJs($json->js, $item, Service::PLUGIN);
                    }
                    Service::loadCss($json->css, $item, Service::PLUGIN);
                }
            }
        }

        if (!ipConfig()->isDevelopmentEnvironment()) {
            if(!$onlyCss){
                Service::combineJs($combine['js']);
            }
            Service::combineCss($combine['css']);
        }
    }
}