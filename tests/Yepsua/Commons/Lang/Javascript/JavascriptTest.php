<?php

namespace Tests\Yepsua\Commons\Lang\Javascript;

use Yepsua\Commons\Lang\Javascript\Javascript;

class JavascriptTest extends \PHPUnit_Framework_TestCase
{
    public function testBooleanValue()
    {
        $this->assertEquals('alert(true)', sprintf('alert(%s)', Javascript::booleanValue(true)));
    }

    public function testCleanSintax()
    {
        $this->assertEquals('alert(true);', Javascript::cleanSintax('alert(true);;'));
        $this->assertEquals('[foo, bar]', Javascript::cleanSintax('[foo, bar,]'));
    }
}
