<?php

namespace Tests\Yepsua\Commons\Collection\Node;

use PHPUnit_Framework_TestCase;
use Yepsua\Commons\Collection\Node\TreeNode;

class TreeNodeTest extends PHPUnit_Framework_TestCase
{
    public function testList()
    {
        $parent = new TreeNode();

        $child1 = new TreeNode($parent);
        $child2 = new TreeNode($parent);

        $this->assertEquals(2, $parent->length());

        $this->assertEquals($parent, $child1->getParentNode());
        $this->assertEquals($parent, $child2->getParentNode());
    }
}
