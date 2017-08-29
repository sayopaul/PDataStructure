<?php

/**
 * @author anonCoding
 *  A node is the building block of a doubly linked list
 */
class Node{
    
    //The node before the current node to be created
    public $prev;
    
    //The item in the current node
    public $data;
    
    //The node after the node to be created
    public $next;
    
    /**
     * Initialize the instance variables of the Node class to create a new Node
     * @param $prev
     * @param $item
     * @param $next
     */
    public function __construct($prev = null, $item, $next = null)
    {
        $this->prev = $prev;
        $this->data = $item;
        $this->next = $next;
    }    
}

class DoublyLinkedList{
    
    //The first element in the list
    private $head;
    
    //The size of the list
    private $size;
    
    
    /**
     * Initialize the instance variables to indicate the default data in a newly
     * created list.
     */
    public function __construct()
    {
        $this->head = null;
        $this->size = 0;
    }
    
    /**
     * Get a reference to the Node Y currently in the head
     * Then, make the newly created Node X the current element in the head
     * Set X->prev = null since there is no node before it
     * Set X->next = Y since that is the node after it
     * Set X->item = $item
     * Increase the size of the list by 1 
     * @param type $item the data to be added to the node
     * @post a new Node is expected to be created after the above steps
     */
    private function addFirst($item)
    {
        $temp = $this->head;
        $this->head = new Node(null,$item,$temp);
        $temp->prev = $this->head;
        $this->size++;
    }
    
    /**
     * @pre the value of the first parameter must not be null
     * Create a new Node X
     * Set X->prev = $prevNode since this will now be the node before it
     * Set X->item = $item this is the item to be inserted inside the node X
     * Set X->next = $prevNode->next since X is now after the prevNode, it has 
     *      to point to what the prevNode points to
     * Make the node after X point to X in its prev link i.e nodeAfterX->prev =X
     * Now make the prevNode point to X i.e $prevNode->next = X
     * Increase the size of the list by 1
     * @param type $prevNode the node before the
     * @param type $item the data to be added to the node
     * @post a new node must have been inserted after a particular node
     */
    private function addAfter($prevNode,$item)
    {
        $newNode = new Node($prevNode,$item,$prevNode->next);
        $prevNode->next->prev = $newNode;
        $prevNode->next = $newNode;
        $this->size++;
    }
    
    /**
     * If the list is empty, return false
     * If the list is not empty, make the head pointer point to the next element
     *      in the list
     * Now, set the value of the current head element to null since there is no
     *      before it
     * Decrease the size of the list by 1
     * Indicate successful deletion by returning true;
     * @return boolean
     */
    private function removeFirst()
    {
        if($this->head == null)
        {
            return false;
        }
        else
        {
            $this->head = $this->head->next;
            $this->head->prev = null;
            $this->size--;
            return true;
        }
    }
    
    /**
     * Y represents the node to be removed
     * Set the next pointer of the node before Y to point to the node that the
     *      next pointer of Y is pointing to
     * Set the prev pointer of the node after Y to point to the node that the
     *      prev pointer of Y is pointing to
     * @param $node the node to be removed
     * @return boolean
     */
    private function removeInMiddle($node)
    {
        $node->prev->next = $node->next;
        $node->next->prev = $node->prev;
        $this->size--;
        return true;
    }
    
    /**
     * @pre the parameter given must not be null
     * Let the element before the last element be A
     * Set A->next = null, this statement makes A the last element
     * Decrease the size of the list accordingly
     * @param type $node the last node in the doubly linked list
     * @post the node given must have been removed successfully
     */
    private function removeLast($node)
    {
        $node->prev->next = null;
        $this->size--;
    }
    
    /**
     * @pre index must not be null
     * if the index is undefined, an exception is thrown
     * @param type $index the location of the node
     * @return boolean
     * @throws Exception NoSuchElementExist
     * @post element at the given index is expected to be removed
     */
    public function remove($index)
    {
        if($index == 0)
        {
            $this->removeFirst();
        }
        else if($index > 0 && $index != $this->size)
        {
            $this->removeInMiddle($this->getNode($index));
        }
        else if($index == $this->size)
        {
            $this->removeLast($this->getNode($index));
        }
        else
        {
            throw new Exception("No element at specified index");
        }
        return true;
    }
    
    /**
     * @param type $item the data to be added to node at a location in the list
     * @param type $index the location where the new element is to be added
     * @throws Exception ElementCannotBeAdded
     * @post a new node must have been added to the list
     */
    public function add($item,$index = 0)
    {
        if($index > $this->size)
        {
            throw new Exception("Cannot add element at specified index");
        }
        else if($index == 0)
        {
            $this->addFirst($item);
        }
        else
        {
            $this->addAfter($this->getNode($index - 1), $item);
        }
    }
    
    /**
     * If the index given is invalid, an exception is thrown
     * @param $index the location of a node
     * @return node the node at at the given location
     * @throws Exception NoElementAtIndex
     */
    private function getNode($index)
    {
        if($index > 0 && $index <= $this->size)
        {
            $node = $this->head;
            for($i = 0; $i < $index; $i++)
            {
                $node = $node->next;
            }
            return $node;
        }
        else
        {
            throw new Exception("No such element at specified index");
        }
    }
    
    /**
     * Get the size of the list
     * @return size the length of the list
     */
    public function size()
    {
        return $this->size;
    }
    
    /**
     * If the value of index is undefined, throw an exception
     * @param $index the location of a given node
     * @return $item the data item in a node at a given location
     * @throws Exception NoElementAtIndex
     */
    public function get($index)
    {
        if($index < 0 || $index > $this->size)
        {
            throw new Exception("No element exist at specified index");
        }
        else
        {
            return $this->getNode($index)->data;
        }
    }
    
    /**
     * @pre The index value must be valid
     * @param type $item the data to replace the current data item in the node
     *      at a given location
     * @param type $index the location of a given node
     * @throws Exception
     * @post the value of the data in the node must have been replaced with the
     *      new value
     */
    public function set($item,$index)
    {
        if($index < 0 || $index > $this->size)
        {
            throw new Exception("No element exist at specified index");
        }
        else
        {
            $node = $this->getNode($index);
            $node->data = $item;
        }
    }
    
    /**
     * Get the data at a particular index using the linear search algorithm
     * @param type $item the data being searched for
     * @return boolean/int if data is not found, return boolean else return the
     *      index of the data
     */
    public function indexOf($item)
    {
        $size = $this->size;
        for($i = 0; $i < $this->size; $i++)
        {
            if($item == $this->getNode(--$size)->data)
            {
                return $size;
            }
            else
            {
                return false;
            }
        }
    }
     
    //end of DoubleLinkedList class
}