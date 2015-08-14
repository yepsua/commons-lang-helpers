<?php

namespace Tests\Yepsua\Commons\Lang\Helper;

use \PHPUnit_Framework_TestCase;
use Yepsua\Commons\Lang\Helper\Html;

class HtmlTest extends PHPUnit_Framework_TestCase
{	
	public function testDivTag()
    {
        $this->assertEquals('<div>', Html::div());
    }
    
    public function testDivTagWithProperties()
    {
    	$this->assertEquals('<div class="foo">', Html::div('class="foo"'));
    }
    
    public function testDivTagWithPropertiesAndContent()
    {
    	$this->assertEquals('<div class="foo">bar</div>', Html::div('class="foo"', 'bar'));
    }
    
    public function testVideoTagWithContent()
    {
    	$this->assertEquals('<div>bar</div>', Html::div(null, 'bar'));
    }
    
    public function testClosedDivWithProperties()
    {
    	$this->assertEquals('<div class="foo" />', Html::getClosedTag('div', 'class="foo"'));
    }
}