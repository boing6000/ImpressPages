<?php

namespace Ip\Internal\Admin\Latte;

use Latte\MacroNode;
use Latte\Macros\CoreMacros;
use Latte\PhpWriter;

class Macros extends CoreMacros
{
    public static function teste(MacroNode $node, PhpWriter $writer){
        return $writer->write('echo \' src="\' . LR\Filters::safeUrl( ipFileUrl(\'file/repository/\'.%node.word)) . \'"\';');
    }
}