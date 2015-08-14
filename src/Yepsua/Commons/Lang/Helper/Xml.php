<?php

namespace Yepsua\Commons\Lang\Helper;

/**
 * XML Helper
 * @author <a href="mailto:omar.yepez@yepsua.com">Omar Yepez</a>
 */
class Xml {
	
    const TAG_INITIATOR = '<';
	const TAG_FINALIZER = '>';
	const TAG_CLOSER_AT_FIRST = '</';
	const TAG_CLOSER_AT_END = ' />';
		
	public static function getClosedTag($tag , $properties = null){
		return self::buildClosedTag($tag, $properties);
	}
	
	public static function getTag($tag , $properties = null, $content = null){
		$template = $tag;
		if ($content === null){
			$template = static::buildTag($tag , $properties);
		}else{
			$template = static::buildTag($tag , $properties) . $content . static::buildClosedTag($tag);
		}
		return $template;
	}
		
	public static function appendInPropeties($propertie,$appendValues,$propeties){
		$propertie = sprintf('%s="',$propertie);
		$classes = sprintf('%s%s ',$propertie,$appendValues);
		if(strstr($propeties, $propertie)){
			$propeties = str_replace($propertie, $classes, $propeties);
		}else{
			$propeties = sprintf('%s %s%s"',$propeties,$propertie,$appendValues);
		}
		return $propeties;
	}
	
	public function __toString() {
		return $this->template;
	}
	
	protected static function buildTag($tag , $properties = null){
		$pattern = ($properties === null) ? '%s' : '%s %s';
		return sprintf(self::TAG_INITIATOR . $pattern . self::TAG_FINALIZER, $tag, $properties);
	}
	
	protected static function buildClosedTag($tag , $properties = null){
		$tagClosed = $tag;
		if($properties === null){
			$tagClosed = sprintf(self::TAG_CLOSER_AT_FIRST . '%s' . self::TAG_FINALIZER , $tag);
		}else{
			$tagClosed = sprintf(self::TAG_INITIATOR . '%s %s' . self::TAG_CLOSER_AT_END, $tag , $properties);
		}
		return $tagClosed;
	}
}