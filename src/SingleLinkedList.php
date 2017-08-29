<?php


/**
 * @author anonCoding
 * A node is a data structure that consists of a data item and a link.
 * The link refences the next node in the list(in the case of a single linked 
 *  list)
 */
class Node
{
    //create the data item;
    public $data;
    
    //create the node reference
    public $next;
    
    /**
     * Initialize  the instance variables
     * @param type $dataItem the data to be added to the node
     * @param type $nodeRef the next node in the list
     */
    public function __construct($dataItem,$nodeRef = null)
    {
        $this->data = $dataItem;
        $this->next = $nodeRef;
    }
}

/**
 * A single linked list class is a collection of nodes
 */
class SingleLinkedList
{
    //the size of the linked list
    private $size;
    
    //the head of the linked list
    private $head;
    
    /**
     * Initialize the instance variables
     */
    public function __construct()
    {
        $this->size = 0;
        $this->head = null;
    }
    
    /**
     * add the very first item in the list
     * @param type $item to be added to node
     */
    private function addFirst($item)
    {
        $this->head = new Node($item,$this->head);
        $this->size++;
    }
    
    /**
     * Make the prevNode point to the new Node while also making the new
     *  node point to the node the prevNode was pointing to
     * @param type $prevNode reference for the previous node is needed to add
     *  the new node
     * @param type $item the item to be added to the new node
     */
    private function addAfter($prevNode,$item)
    { 
        $prevNode->next = new Node($item,$prevNode->next);
        $this->size++;
    }
    
    /**
     * make the prevNode point to the node after the node to be removed
     * update the size of the list
     * @param type $prevNode reference to the node before the node to be 
     *  removed
     * @return type string/null
     */
    private function removeAfter($prevNode)
    {
        $temp = $prevNode->next;
        if(!empty($temp))
        {
            $prevNode->next = $temp->next;
            $this->size--;
            return $temp->data;
        }
        else
        {
            return null;
        }
    }
    
    /**
     * if the head value is not null, make it point to the second element in the
     *  list
     * @return type null
     */
    private function removeFirst()
    {
        if($this->head != null)
        {
            $this->head = $this->head->next;
            $this->size--;
        }
        else
        {
            return null;
        }
    }
    
    /**
     * Get the node at a given index
     * @pre the parameter given should not be less than zero
     * @param type $index
     * @return type
     * @throws Exception
     * @post the node at the given index should be returned
     */
    private function getNode($index)
    {
        if($index < 0 || $index > $this->size)
        {
            throw new Exception("There is no such element at index $index");
        }
        
        $node = $this->head;
        
        for($i = 0; $i < $index && $node != null; $i++)
        {
            $node = $node->next;
        }
        return $node;
    }
    
    /**
     * if the index = 0 then add the new node to the head
     * else add it after the node before the index where the new node is to be
     *  added
     * @param type $item data to be added to node
     * @param type $index location where node will be added
     */
    public function add($item,$index = 0)
    {
        
        if($index == 0)
        {
            $this->addFirst($item);
        }
        else
        {
            $this->addAfter($this->getNode($index-1), $item);
        }
    }
    
    /**
     * get a node at a particular index
     * @param type $index
     * @return type node
     */
    public function get($index)
    {
        if($index >= 0)
        {
            $node =  $this->getNode($index);
            return $node->data;
        }
    }
    
    /**
     * Assign a new value to a node at a particular location
     * @param type $item the new value to be assigned to node
     * @param type $index location of the node
     */
    public function set($item,$index)
    {
        $node = $this->getNode($index);
        $node->data = $item;
    }
    
    /**
     * Remove a particular node from the list
     * @pre the paramter must not be less than zero
     * @throws Exception when the parameter is less than zero
     * @param index
     * @post the node must be removed from the list successfully
     */
    public function remove($index)
    {
        if($index < 0)
        {
            throw new Exception("There is no element at index < 0");
        }
        if($index == 0)
        {
            $this->removeFirst();
        }
        else
        {
            $this->removeAfter($this->getNode($index - 1));
        }
    }
    
    /**
     * get the index of a particular element
     * @param type $param
     * @return index of the parameter
     */
    public function indexOf($param)
    {
        $size = $this->size;
        for($i = 0; $i < $this->size; $i++)
        {
            $node = $this->getNode(--$size);
            if($node->data == $param)
            {
                return $size;
            }
        }
    }
    
    /**
     * @return size the size of the list
     */
    public function getSize()
    {
        return $this->size;
    }
    
    //end of SingleLinkedList
}