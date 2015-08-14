<?php

namespace Yepsua\Commons\Lang\Helper;

use Yepsua\Commons\Lang\Javascript\Javascript;

class Javascript {
	
	public static function setInterval($function, $time, $intervalVarName = null){
		$pattern = $intervalVarName === null
		? "setInterval('%s',%s)"
				: $intervalVarName . " = setInterval('%s',%s)";
				return sprintf('setInterval(%s, %s);',$function,$time);
	}
	
	public static function setTimeout($function, $time){
		return sprintf('setTimeout(%s, %s);',$function,$time);
	}
	
	public static function parseInt($value){
		return self::parse('parseInt', $value);
	}
	
	public static function parse($parseName, $value){
		$pattern = $parseName . '(%s)';
		return YsArgument::likeVar(sprintf($pattern, YsJSON::valueToJS($value)));
	}
	
}