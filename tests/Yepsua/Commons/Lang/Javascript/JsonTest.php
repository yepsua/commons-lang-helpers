<?php

namespace Tests\Yepsua\Commons\Lang\Javascript;

use \PHPUnit_Framework_TestCase;
use Yepsua\Commons\Lang\Javascript\Json,
	Yepsua\Commons\Lang\Javascript\JsFunction;

class JsonTest extends PHPUnit_Framework_TestCase {
	
	public function testJsonEncode()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$encodedVal = Json::encode(array('foo' => 'bar', 'number' => (int) '5', 'onclick' => $function->__toString()));
		$this->assertEquals('{"foo":"bar","number":5,"onclick":"function(){alert(\'Hello world\')}"}', $encodedVal);
		
	}
	
	public function testArrayToJson()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$encodedVal = Json::arrayToJson(array('foo' => 'bar', 'number' => (int) '5', 'onclick' => $function));
		$this->assertEquals("{foo:'bar',number:5,onclick:function(){alert('Hello world')}}", $encodedVal);
	}
	
	public function testNestedArrayToJson()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$encodedVal = Json::arrayToJson(array('foo' => 'bar', 'test' => array('bar' => 'foo')));
		$this->assertEquals("{foo:'bar',test:{bar:'foo'}}", $encodedVal);
	}
	
	public function testSequentialArrayToJson()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$encodedVal = Json::arrayToJson(array('foo' => 'bar', 'test' => array('bar' => 'foo'), 'test2' => array(1,2,3)));		
		$this->assertEquals("{foo:'bar',test:{bar:'foo'},test2:[1,2,3]}", $encodedVal);
	}
	
	public function testAssociativeAndSequentialNestedArrayToJson()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$encodedVal = Json::arrayToJson(array('bar' => 'foo', 'secuential' => array(1,2,3), 'associative' => array('hello' => 'world','foo'=>'bar')));
		$this->assertEquals("{bar:'foo',secuential:[1,2,3],associative:{hello:'world',foo:'bar'}}", $encodedVal);
	}
		
	public function testArrayToJsonWithBoolean()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$encodedVal = Json::arrayToJson(array('foo' => 'bar', 'boolean' => FALSE, 'onclick' => $function));
		$this->assertEquals("{foo:'bar',boolean:false,onclick:function(){alert('Hello world')}}", $encodedVal);
	}
}