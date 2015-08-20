<?php

namespace Tests\Yepsua\Commons\Lang\Html;

use PHPUnit_Framework_TestCase;
use Yepsua\Commons\Lang\Html\ListNode;

class ListNodeTest extends PHPUnit_Framework_TestCase
{
    public function testUnorderedList()
    {
        $list = new ListNode('root');
        $child = new ListNode('leaf1', 'Leaf 1', $list);
        $child2 = new ListNode('leaf2', 'Leaf 2', $list);
        $this->assertEquals('<ul id="root"><li id="leaf1">Leaf 1 </li><li id="leaf2">Leaf 2 </li></ul>', $list);
    }

    public function testProperties()
    {
        $list = new ListNode('root');
        $list->setProperties('class="foo" onclick="mailto()"');
        $child = new ListNode('leaf1', 'Leaf', $list);
        $child->addPropertie('class', 'foo');
        $child2 = new ListNode('leaf2', 'Leaf 2', $list);
        $this->assertEquals('<ul id="root" class="foo" onclick="mailto()"><li id="leaf1" class="foo">Leaf </li><li id="leaf2">Leaf 2 </li></ul>', $list);
    }

    public function testNestedList()
    {
        $list = new ListNode('root');
        $child1 = new ListNode('branch1', 'Branch 1', $list);
        $child1_1 = new ListNode('leaf11', 'Leaf 1', $child1);
        $child2 = new ListNode('leaf2', 'Leaf 2', $list);
        //echo $list->__toString();
        $this->assertEquals('<ul id="root"><li id="branch1">Branch 1 <ul><li id="leaf11">Leaf 1 </li></ul></li><li id="leaf2">Leaf 2 </li></ul>', $list);
    }

    public function testOrderedList()
    {
        $list = new ListNode('root');
        $list::$BRANCH_TAG = 'ol';
        $child = new ListNode('leaf1', 'Leaf 1', $list);
        $child2 = new ListNode('leaf2', 'Leaf 2', $list);
        $this->assertEquals('<ol id="root"><li id="leaf1">Leaf 1 </li><li id="leaf2">Leaf 2 </li></ol>', $list);
    }
}
