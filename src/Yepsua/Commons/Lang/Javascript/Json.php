<?php

namespace Yepsua\Commons\Lang\Javascript;

/**
 * Json parser
 * @author <a href="mailto:omar.yepez@yepsua.com">Omar Yepez</a>
 */
class Json {
	
	public static $QUOTED_PATTERN = "%s:'%s'";
	public static $UNQUOTED_PATTERN = "%s:%s";
	public static $PATTERN = "{%s}";
	
	public static function encode($value, $options=0, $depth=512){
		return json_encode($value, $options, $depth);
	}
	
	public static function decode($json, $assoc=false, $depth=512, $options=0){
		return json_decode($json,$assoc,$depth,$options);
	}
	
	public static function arrayToJson($value){
		$jsonValue = "";
		foreach ($value as $key => $value) {
			if (is_object($value)){
				$jsonValue .= self::withUnQuotedPattern($key, $value);
			}elseif (is_array($value)){
				$value = (array_keys($value) === range(0, count($value) - 1)) ? json_encode($value) : self::arrayToJson($value);
				$jsonValue .= self::withUnQuotedPattern($key, $value);
			}elseif (is_bool($value)){
				$jsonValue .= self::withUnQuotedPattern($key, Javascript::booleanValue($value));
			}elseif (is_numeric($value)){
				$jsonValue .= self::withUnQuotedPattern($key, $value);
			}else{
				$jsonValue .= self::withQuotedPattern($key, $value);
			}
			$jsonValue .= Javascript::ARGUMENT_SEPARATOR;
		}
		
		return  Javascript::cleanSintax(sprintf(Json::$PATTERN, $jsonValue));
	}
	

		
	public static function withQuotedPattern($key, $value){
		return self::witnAnyPattern(static::$QUOTED_PATTERN, $key, $value);
	}
	
	public static function withUnquotedPattern($key, $value){
		return self::witnAnyPattern(static::$UNQUOTED_PATTERN, $key, $value);
	}
	
	public static function witnAnyPattern($pattern, $key, $value){
		return sprintf($pattern, $key, $value);
	}
}