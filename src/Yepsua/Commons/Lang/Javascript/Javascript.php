<?php

namespace Yepsua\Commons\Lang\Javascript;

/**
 * Javascript sintax object.
 *
 * @author <a href="mailto:omar.yepez@yepsua.com">Omar Yepez</a>
 */
class Javascript
{
    const SINTAX_SEPARATOR = ';';
    const ARGUMENT_SEPARATOR = ',';

    public static function cleanSintax($sintax)
    {
        $errorSintax = array('.()',';;',',}',',]','{;',',,');
        $realSintax = array('',';','}',']','{', ',');
        $sintax = str_replace($errorSintax, $realSintax, $sintax);
        $errorSintax = array("[\n|\r|\n\r]");
        $realSintax = array(' ');
        $sintax = preg_replace($errorSintax, $realSintax, $sintax);

        return $sintax;
    }

    public static function booleanValue($bool)
    {
        return ($bool === true ? 'true' : 'false');
    }
}
