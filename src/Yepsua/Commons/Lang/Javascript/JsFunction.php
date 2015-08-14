<?php

namespace Yepsua\Commons\Lang\Javascript;

/**
 * Javascript function sintax object.
 * @author <a href="mailto:omar.yepez@yepsua.com">Omar Yepez</a>
 */
class JsFunction {
	
	protected $body;
	protected $arguments;
	protected $returnFalse = false;
	protected $condition;
	protected $onConditionFailure;
	protected $confirmation;
	protected $onConfirmationFailure;
	protected $buildSuccess;
	protected $varName;
	protected $pattern = 'function(%s){%s}';
	
	public function  __construct($body= null, $arguments = null)
	{
		$this->setArguments($arguments);
		if($body instanceof self){
			$this->setPattern('%s%s');
			$this->setArguments(null);
		}
		$this->setBody($body);
	}
	
	public static function newInstance($body= null, $arguments = null){
		return new JsFunction($body,$arguments);
	}
	
	public function getPattern(){
		return $this->pattern;
	}
	
	public function setPattern($pattern){
		$this->pattern = $pattern;
	}
	
	public function getBody(){
		return (!$this->returnFalse) ? $this->body : $this->body . '; return false';
	}
	
	public function setBody($body){
		$this->body = $body;
	}
	
	public function getArguments(){
		return $this->arguments;
	}
	
	public function setArguments($arguments){
		$this->arguments = $arguments;
		return $this;
	}
	
	public function  __toString() {
		if(isset($this->condition) || isset($this->confirmation) ){
			$this->buildPattern();
		}
		if(isset($this->varName)){
			$this->setPattern(sprintf('%s = %s',$this->varName, $this->getPattern()));
		}
		return sprintf($this->getPattern(), $this->getArguments(),$this->getBody());
	}
	
	/*public static function call($functionName){
		return new YsArgument($functionName, false);
	}
	
	public static function execute(){
		$function = new JsFunction();
		$function->setBody(new YsJQueryDynamic(func_get_args()));
		return $function;
	}*/
	
	public function getReturnFalse() {
		return $this->returnFalse;
	}
	
	public function setReturnFalse($returnFalse) {
		$this->returnFalse = $returnFalse;
	}
	
	public function getCondition() {
		return $this->condition;
	}
	
	public function setCondition($condition, $onFailure = null) {
		if(is_bool($condition)){
			$condition = Javascript::booleanValue($condition);
		}
		$this->condition = $condition;
		$this->setOnConditionFailure($onFailure);
	}
	
	public function getOnConditionFailure() {
		return $this->onConditionFailure;
	}
	
	public function setOnConditionFailure($onConditionFailure) {
		$this->onConditionFailure = $onConditionFailure;
	}
	
	public function getConfirmation() {
		return $this->confirmation;
	}
	
	public function setConfirmation($confirmation, $onFailure = null) {
		$this->confirmation = $confirmation;
		$this->setOnConfirmationFailure($onFailure);
	}
	
	public function getOnConfirmationFailure() {
		return $this->onConfirmationFailure;
	}
	
	public function setOnConfirmationFailure($onConfirmationFailure) {
		$this->onConfirmationFailure = $onConfirmationFailure;
	}
	
	public function condition($condition,$onFailure = null){
		$this->setCondition($condition);
		$this->onConditionFailure =  $onFailure;
		return $this;
	}
	
	public function conditionNOT($condition, $onFailure = null){
		$this->condition(Javascript::BOOLEAN_NOT . $condition, $onFailure);
	}
	
	public function confirmation($message, $onFailure = null){
		$this->confirmation =  $message;
		$this->onConfirmationFailure =  $onFailure;
		return $this;
	}
	
	public function getVarName() {
		return $this->varName;
	}
	
	public function assignToVar($varName) {
		$this->varName = $varName;
	}
	public function setVarName($varName) {
		$this->varName = $varName;
	}
	
	public function buildPattern(){
		$conditionPattern = null;
		$confirmationPattern = null;
		$pattern = $this->getPattern();
		if(!$this->buildSuccess){
			if(isset($this->confirmation)){
				if(isset($this->onConfirmationFailure)){
					$confirmationPattern = "if (confirm('" . $this->confirmation . "')){%s}else{". $this->onConfirmationFailure ."}";
				}else{
					$confirmationPattern = "if (confirm('" . $this->confirmation . "')){%s}";
				}
			}
			if(isset($this->condition)){
				if(isset($this->onConditionFailure)){
					$conditionPattern = "if(" . $this->condition . "){%s}else{". $this->onConditionFailure ."}";
				}else{
					$conditionPattern = "if(" . $this->condition . "){%s}";
				}
			}
			if($conditionPattern !== null){
				$pattern = sprintf($pattern,"%s",$conditionPattern);
			}
			if($confirmationPattern !== null){
				$pattern = sprintf($pattern,"%s",$confirmationPattern);
			}
			$this->setPattern($pattern);
		}
		$this->buildSuccess = true;
	}
	
}