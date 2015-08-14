<?php

namespace Yepsua\Commons\Lang\Html;

use Yepsua\Commons\Collection\Node\TreeNode;
use Yepsua\Commons\Lang\Helper\Html;

class ListNode extends TreeNode{
	
	public static $LEAF_TAG = 'li';
	public static $BRANCH_TAG = 'ul';
	
	private $value;
	private $id;
	private $properties;
	
	public function __construct($id, $value = null, TreeNode &$parent = null){
		$this->setId($id);
		$this->setValue($value);
		$this->buildID();
		if($parent !== null){
			$this->setParentNode($parent);
			$parent->append($this);
		}
	}
		
	public function build($onlyContent = false){
		$result = "";
		foreach ($this->getArrayCopy() as $node){
			if($node->isLeaf()){
				$result .= $node->buildLeaf();
			}else{				
				$result .= $node->buildLeaf($node->build());
			}
		}
		if(!$onlyContent){
			$result = $this->buildBranch($result);
		}
		return $result;
	}
		
	public function buildID(){
		$this->addPropertie('id',$this->getId());
	}
	
	public function getContents(){
		return $this->build(true);
	}
	 
	public function buildLeaf($content = null){
		$content = sprintf('%s%s%s',$content,$this->getPrependContent(), $this->getAppendContent());
		$content = sprintf('%s %s',$this->getValue(),$content);
		return Html::getTag(static::$LEAF_TAG, $this->getProperties(), $content);
	}
	 
	public function buildBranch($content){
		if($this->getParentNode() != null){
			return Html::getTag(static::$BRANCH_TAG, null, $content);
		}else{
			return Html::getTag(static::$BRANCH_TAG, $this->getProperties(), $content);
		}
	}
	 
	public function __toString(){
		return $this->build();
	}
		 	 
	public function setProperties($properties){
		if(isset($this->properties)){
			$properties = sprintf('%s %s',$this->getProperties(),$properties);
		}
		$this->properties = $properties;
	}
	 
	public function getProperties(){
		return $this->properties;
	}
	
	public function addPropertie($key, $value){
		$this->setProperties(sprintf('%s="%s"',$key,$value));
	}
	 
	public function getId(){
		return $this->id;
	}
	 
	public function setId($id){
		$this->id = $id;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}
	
	protected function getAppendContent(){
		return false;
	}
	
	protected function getPrependContent(){
		return false;
	}
}