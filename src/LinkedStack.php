<?php

/**
 * @author anonCoding
 * A linkedStack basically just implement the linked list data structure with 
 * a stack.
 */

class Node{
    
    //the data item;
    public $data;
    
    //the reference to the next node;
    public $next;
    
    /**
     * Initialize the instance variables of the class
     */
    public function __construct($data,$next)
    {
        $this->data = $data;
        $this->next = $next;
    }
}

class LinkedStack {
    
    //reference to the first stack node
    private $topOfStackRef;
    
    /**
     * Initialize the instance variables of the class
     */
    public function __construct()
    {
        $this->topOfStackRef = null;
    }
    
    /**
     * Create a new node
     * Pass it the data parameter and also make the next pointer point to the
     * current node at the topOfStackRef.
     * @post The new node becomes becomes the topOfStackRef
     * @param $data the item to be added to the node element
     */
    public function push($data)
    {
        $this->topOfStackRef = new Node($data,$this->topOfStackRef);
    }
    
    /**
     * if stack is not empty,
     * Get a reference to the node Y in the current top of stack and save it in 
     * $temp.
     * Then make the node Y in the top of Stack point to the node in the next 
     * pointer of Y
     * retrieve the data item in the current top of Stack
     * @post the value in the topOfStackRef must have been overridden with the 
     * new top of stack ref.
     * @return data the value in the node at the top of the stack
     * @throws LinkedStackIsEmptyException
     */
    public function pop()
    {
        if(isEmpty())
        {
            throw new Exception("No element in LinkedStack");
        }
        
        $temp = $this->topOfStackRef;
        $this->topOfStackRef = $this->topOfStackRef->next;
        return $temp->data;
    }
    
    /**
     * If the stack is not empty, retrieve the data in the node at the top of 
     * the stack.
     * @return value the data in the node at the top of the stack
     * @throws LinkedStackIsEmptyException
     */
    public function peek()
    {
        if(isEmpty())
        {
            throw new Exception("No element in LinkedStack");
        }
        
        return $this->topOfStackRef->data;
    }
    
    /**
     * Check if the LinkedStack is empty
     * @return boolean
     */
    public function isEmpty()
    {
        if($this->topOfStackRef === null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    //end of the LinkedStack class
}