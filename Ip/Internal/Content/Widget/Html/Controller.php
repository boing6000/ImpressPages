<?php
/**
 * @package ImpressPages
 *
 */
namespace Ip\Internal\Content\Widget\Html;

use Ip\Internal\Content\Model;

class Controller extends \Ip\WidgetController
{
    public function getTitle()
    {
        return __('HTML', 'Ip-admin', false);
    }

    public function adminHtmlSnippet()
    {
        return ipView('snippet/edit.php')->render();
    }

    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {
        if ($this->core) {
            $skinFile = 'Ip/Internal/' . $this->pluginName . '/' . Model::WIDGET_DIR . '/' . $this->name . '/' . self::SKIN_DIR . '/' . $skin . '.latte';
        } else {
            $skinFile = 'Plugin/' . $this->pluginName . '/' . Model::WIDGET_DIR . '/' . $this->name . '/' . self::SKIN_DIR . '/' . $skin . '.latte';
        }
        if (!is_file(ipFile($skinFile)) && !is_file(ipThemeFile(\Ip\View::OVERRIDE_DIR . '/' . $skinFile))) {
            $skin = 'default';
            if ($this->core) {
                $skinFile = 'Ip/Internal/' . $this->pluginName . '/' . Model::WIDGET_DIR . '/' . $this->name . '/' . self::SKIN_DIR . '/' . $skin . '.latte';
            } else {
                $skinFile = 'Plugin/' . $this->pluginName . '/' . Model::WIDGET_DIR . '/' . $this->name . '/' . self::SKIN_DIR . '/' . $skin . '.latte';
            }
        }

        $latte = new \Latte\Engine;
        $latte->setLoader(new \Latte\Loaders\StringLoader);

        if(!in_array('html', array_keys($data))){
            $data['html'] = '';
        }

        $data['name'] = 'Deco';

        $latte->addFilter('ipfileurl', function($file){
            return ipFileUrl($file);
        });

        $macros = new \Latte\Macros\MacroSet($latte->getCompiler());

        $macros->addMacro('src', null, null, [\Ip\Internal\Admin\Latte\Macros::class, 'teste']);



        $data['html'] = $latte->renderToString($data['html'], ['name' => 'caca.jpg']);
        //var_dump($data);exit;
        return ipView($skinFile, $data)->render();
    }

}
