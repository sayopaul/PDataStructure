<?php

/**
 * @author anonCoding
 * A stack uses the principle of last in , first out
 */
class Stack {   
    
    //the underlying array
    private $stackArray;
    
    //top of the stack
    private $tos;
    
    /**
     * initialize the instance of the class
     */
    public function __construct()
    {
        $this->stackArray = array();
        $this->tos = -1;
    }
    
    /**
     * Add new value to stack
     * @param $value the data to be added to the stack
     */
    public function push($value)
    {
        $this->stackArray[++$this->tos] = $value;
    }
    
    /**
     * Remove the value at the top of the stack
     * @return the value at the top of the stack
     * @throws Exception if stack is empty
     */
    public function pop()
    {
        if($this->isEmpty())
        {
            throw new Exception("The stack is empty");
        }
        else
        {
            return $this->stackArray[$this->tos--];
        }
    }
    
    /**
     * Get the value at the top of the stack
     * @return the value at the top of the stack
     * @throws Exception if stack is empty
     */
    public function peek()
    {
        if($this->isEmpty())
        {
            throw new Exception("The stack is empty");
        }
        else
        {
            return $this->stackArray[$this->tos];
        }
    }
    
    /**
     * Check if the stack is empty
     * @return boolean 
     */
    public function isEmpty()
    {
        return $this->tos < 0;
    }
    
    //end of the Stack class
}

$a = new Stack();

$a->push("hello");

$a->push("hi,there");