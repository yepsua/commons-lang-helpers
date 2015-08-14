<?php

namespace Yepsua\Commons\Lang\Helper;

/**
 * Html Helper
 * @author <a href="mailto:omar.yepez@yepsua.com">Omar Yepez</a>
 */
class Html extends Xml{
		
	public static function __callStatic($name, $arguments)
    {
		$properties = isset($arguments[0]) ? $arguments[0] : null;
		$content = isset($arguments[1]) ? $arguments[1] : null;
    	return self::getTag($name, $properties, $content);
    }
}