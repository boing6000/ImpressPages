<?php
/**
 * Created by PhpStorm.
 * User: boing
 * Date: 26/05/2017
 * Time: 06:33
 */

namespace Ip\Internal\Angular;


use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;

class Service
{
    const INTERNAL = 'Internal';
    const PLUGIN = 'Plugin';


    /**
     * @param array $files
     * @param string $module
     * @param string $place
     *
     * @return null|string
     */
    public static function loadCss( $files, $module, $place = 'Internal', $include = true)
    {
        foreach ($files as $file) {
            if($include) {
                if ($place == 'Internal') {
                    ipAddCss("Ip/Internal/$module/$file");
                } else if ($place == 'Plugin') {
                    ipAddCss("Plugin/$module/$file");
                }
            }else{
                if($place == 'Internal'){
                    return ipFileUrl("Ip/Internal/$module/$file");
                }else if($place == 'Plugin'){
                    return ipFileUrl("Plugin/$module/$file");
                }
            }
        }
    }

    /**
     * @param array $files
     * @param string $module
     * @param string $place
     *
     * @return null|string
     */
    public static function loadJs($files, $module, $place = 'Internal', $include = true)
    {
        foreach ($files as $file) {
            if($include){
                if($place == 'Internal'){
                    ipAddJs("Ip/Internal/$module/$file");
                }else if($place == 'Plugin'){
                    ipAddJs("Plugin/$module/$file");
                }
            }else{
                if($place == 'Internal'){
                   return ipFileUrl("Ip/Internal/$module/$file");
                }else if($place == 'Plugin'){
                    return ipFileUrl("Plugin/$module/$file");
                }
            }

        }
    }


    /**
     * @param $files
     * @return mixed|string
     */
    public static function combineJs($files){
        $minify = new JS();
        foreach ($files as $file) {
            $minify->add($file);
        }

        $file = ipFile('Ip/Internal/Angular/assets/vendor.js');
        $minify->minify($file);

        return $file;
    }

    /**
     * @param $files
     * @return mixed|string
     */
    public static function combineCss($files){
        $minify = new CSS();
        foreach ($files as $file) {
            $minify->add($file);
        }

        $file = ipFile('Ip/Internal/Angular/assets/vendor.js');
        $minify->minify($file);

        return $file;
    }
}