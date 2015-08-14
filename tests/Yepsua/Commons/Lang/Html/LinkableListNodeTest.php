<?php

namespace Tests\Yepsua\Commons\Lang\Html;

use \PHPUnit_Framework_TestCase;
use Yepsua\Commons\Lang\Html\ListNode,
	Yepsua\Commons\Lang\Html\LinkableListNode;

class LinkableListNodeTest extends PHPUnit_Framework_TestCase {
	
	public function testLinkableList()
	{
		$list = new ListNode("root");
		$child = new LinkableListNode("leaf1", "Leaf 1", null, $list);
		$this->assertEquals('<ul id="root"><li id="leaf1"> <a href="#">Leaf 1</a></li></ul>', $list);		
	}
	
	public function testLinkableAttrList()
	{
		$list = new ListNode("root");
		$child = new LinkableListNode("leaf1", "Leaf 1", null, $list);
		$child->addPropertie("class", "leaf");
		$child->addLinkPropertie("title", "Link to");
		$this->assertEquals('<ul id="root"><li id="leaf1" class="leaf"> <a title="Link to" href="#">Leaf 1</a></li></ul>', $list);
	}
}