<?php

namespace Yepsua\Commons\Lang\Html;

use Yepsua\Commons\Collection\Node\TreeNode;
use Yepsua\Commons\Lang\Helper\Html;

class LinkableListNode extends ListNode{
	
	public static $ACTION = '#';
	public static $LINK_TAG = 'a';
	 
	private $linkProperties;
	private $action;
	private $label;
	 
	public function __construct($id, $caption = null , $action = null, ListNode &$parent = null){
		parent::__construct($id, $caption, $parent);
		$this->setValue("");
		$this->setLabel($caption);
		$this->setAction($action === null ? static::$ACTION : $action);
	}
	 
	public function getCaption(){
		return $this->buildLinkPattern($this->getLabel());
	}
	 	 
	public function buildLinkPattern($caption){
		$this->addLinkPropertie('href', $this->getAction());
		return Html::getTag(static::$LINK_TAG, $this->getLinkProperties(), $caption);
	}
	 
	public function getAction(){
		return $this->action;
	}
	 
	public function setAction($action){
		$this->action = $action;
	}
	
	public function setLinkProperties($linkProperties){
		if(isset($this->linkProperties)){
			$linkProperties = sprintf('%s %s',$this->getLinkProperties(),$linkProperties);
		}
		$this->linkProperties = $linkProperties;
	}
	 
	public function getLinkProperties(){
		return $this->linkProperties;
	}
		
	public function addLinkPropertie($key, $value){
		$this->setLinkProperties(sprintf('%s="%s"',$key,$value));
	}
	
	public function setLabel($label) {
		$this->label = $label;
		return $this;
	}
	
	public function getLabel() {
		return $this->label;
	}
	
	protected function getAppendContent(){
		return $this->getCaption();
	}
}