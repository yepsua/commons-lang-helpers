<?php

namespace Tests\Yepsua\Commons\Lang\Helper;

use PHPUnit_Framework_TestCase;
use Yepsua\Commons\Lang\Helper\Xml;

class XmlTest extends PHPUnit_Framework_TestCase
{
    private static $TAG = 'doc';

    public function testTag()
    {
        $this->assertEquals('<doc>', Xml::getTag(self::$TAG));
    }
    public function testTagWithProperties()
    {
        $this->assertEquals('<doc name="foo">', Xml::getTag(self::$TAG, 'name="foo"'));
    }
    public function testTagWithPropertiesAndContent()
    {
        $this->assertEquals('<doc name="foo">bar</doc>', Xml::getTag(self::$TAG, 'name="foo"', 'bar'));
    }
    public function testTagWithContent()
    {
        $this->assertEquals('<doc>bar</doc>', Xml::getTag(self::$TAG, null, 'bar'));
    }
    public function testClosedTag()
    {
        $this->assertEquals('</doc>', Xml::getClosedTag(self::$TAG));
    }
    public function testClosedTagWithProperties()
    {
        $this->assertEquals('<doc foo="bar" />', Xml::getClosedTag(self::$TAG, 'foo="bar"'));
    }
}
