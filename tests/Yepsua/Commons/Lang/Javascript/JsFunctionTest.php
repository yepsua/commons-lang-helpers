<?php

namespace Tests\Yepsua\Commons\Lang\Javascript;

use \PHPUnit_Framework_TestCase;
use Yepsua\Commons\Lang\Helper\Javascript,
	Yepsua\Commons\Lang\Javascript\JsFunction;

class JsFunctionTest extends PHPUnit_Framework_TestCase {
	
	public function testSimpleFunction()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$this->assertEquals("function(){alert('Hello world')}", $function);	
	}
	
	public function testWithArguments()
	{
		$function = new JsFunction();
		$function->setBody("alert(foo + bar)");
		$function->setArguments("foo, bar");
		$this->assertEquals("function(foo, bar){alert(foo + bar)}", $function);
	}
	
	public function testReturnFalse()
	{
		$function = new JsFunction();
		$function->setBody("alert(foo + bar)");
		$function->setArguments("foo, bar");
		$function->setReturnFalse(true);
		$this->assertEquals("function(foo, bar){alert(foo + bar); return false}", $function);
	}
	
	public function testConfirm()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$function->setConfirmation('a');
		$this->assertEquals("function(){if (confirm('a')){alert('Hello world')}}", $function);
	}
	
	public function testConfirmFailure()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$function->setConfirmation('Are you sure?', "alert('Failure')");
		$this->assertEquals("function(){if (confirm('Are you sure?')){alert('Hello world')}else{alert('Failure')}}", $function);
	}
	
	public function testCondition()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$function->setCondition('5 = 5');
		$this->assertEquals("function(){if(5 = 5){alert('Hello world')}}", $function);
	}
	
	public function testConditionBoolean()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$function->setCondition(true);
		$this->assertEquals("function(){if(true){alert('Hello world')}}", $function);
	}
	
	public function testConditionFailure()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$function->setCondition('5 = 5', "alert('failure')");
		$this->assertEquals("function(){if(5 = 5){alert('Hello world')}else{alert('failure')}}", $function);
	}
	
	public function testAssingToVar()
	{
		$function = new JsFunction();
		$function->setBody("alert('Hello world')");
		$function->setCondition('5 = 5', "alert('failure')");
		$function->setVarName("foo_bar");
		$this->assertEquals("foo_bar = function(){if(5 = 5){alert('Hello world')}else{alert('failure')}}", $function);
	}
}