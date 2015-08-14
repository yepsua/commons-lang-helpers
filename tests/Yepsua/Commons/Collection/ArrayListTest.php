<?php

namespace Tests\Yepsua\Commons\Collection;

use \PHPUnit_Framework_TestCase;
use Yepsua\Commons\Collection\ArrayList;

class ArrayListTest extends PHPUnit_Framework_TestCase{
	
	public function testList()
    {
        $arrayList = new ArrayList();
        
        $arrayList->add("foo", "bar");
        $arrayList->add("hello", "world");
        
    	$this->assertEquals(array("foo" => "bar", "hello" => "world") , $arrayList->getItems());
    	
    	$arrayList->delete("foo");
    	
    	$this->assertEquals(FALSE , $arrayList->contains("foo"));
    	
    	$this->assertEquals(array("hello" => "world") , $arrayList->getItems());
    	
    }
    
    public function testListAsArrayAccess()
    {
    	$arrayList = new ArrayList();
    
    	$arrayList["foo"] = "bar";
    	$arrayList["hello"] = "world";
    
    	$this->assertEquals(array("foo" => "bar", "hello" => "world") , $arrayList->getItems());
    	 
    	$arrayList->delete("foo");
    	 
    	$this->assertEquals(FALSE , $arrayList->contains("foo"));
    	 
    	$this->assertEquals(array("hello" => "world") , $arrayList->getItems());
    	 
    }
}