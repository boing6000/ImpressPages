<?php
/**
 * Created by PhpStorm.
 * User: boing
 * Date: 25/05/2017
 * Time: 22:46
 */

namespace Ip\Internal\Angular;


class Event
{
    /*
    public static function ipBeforeController_40()
    {

        if (ipIsManagementState() && ipRoute()->plugin() === 'Angular') {
            Helper::loadFiles();
        }else if(ipIsManagementState() && ipRoute()->plugin() === 'Content'){
            Helper::loadFiles(true);
        }
    }*/

    public static function ipBeforeController_20()
    {
        if (ipIsManagementState() && ipRoute()->plugin() === 'Content') {
            /*ipAddJsVariable('ipAngularMenu', ipFilter('ipAngularMenu', MenuHelper::menuCore()));
            $admin = \Ip\Internal\Administrators\Model::get(ipAdminId());
            unset($admin['hash']);
            ipAddJsVariable('ipUser', $admin);*/
        }
    }

}