<?php

namespace Yepsua\Commons\Collection\Node;

use \ArrayObject,
	\ArrayAccess;

/**
 * An Array object implementation.
 * @author <a href="mailto:omar.yepez@yepsua.com">Omar Yepez</a>
 */
class TreeNode extends \ArrayObject implements ArrayAccess {
	
	private $parentNode;
	private $leaf;
	
	public function __construct(TreeNode &$parent = null){
		if($parent !== null){
			$this->setParentNode($parent);
			$parent->append($this);
		}
	}
	
	public function isLeaf(){
		return $this->count() === 0;
	}
	
	public function getLeaf() {
		return $this->leaf;
	}
	
	public function setLeaf($leaf) {
		$this->leaf = $leaf;
	}
	
	public function getParentNode(){
		return $this->parentNode;
	}
	 
	public function setParentNode($parentNode){
		$this->parentNode = $parentNode;
	}
	
	public function getChildrens(){
		return $this->getArrayCopy();
	}
	
	public function length(){
		return sizeof($this->getChildrens());
	}
}