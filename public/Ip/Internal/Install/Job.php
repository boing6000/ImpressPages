<?php
/**
 * Created by PhpStorm.
 * User: maskas
 * Date: 16.12.4
 * Time: 16.52
 */

namespace Ip\Internal\Install;


class Job
{

    public static function ipRouteAction_0($info)
    {
        return array(
            'plugin' => 'Install',
            'controller' => 'PublicController',
            'action' => 'index',
        );

        if (Model::isLoginPage($info['request'])) {
            return array(
                'plugin' => 'Admin',
                'controller' => 'SiteController',
                'action' => 'login',
            );
        }
        return null;
    }
}