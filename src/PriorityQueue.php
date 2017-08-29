<?php
include("ArrayList.php");

/**
 * Description of PriorityQueue
 * The priority queue is a queue that dosent follow the FIFO principle. Elements
 * are moved up the queue based on the priority given to them. A heap is used
 * for the implementation of the priority queue below
 * @author anonCoding
 */
class PriorityQueue {
    
    //arrayPriorityQueue
    public $apq;
    
    public function __construct()
    {
        $this->apq = new ArrayList();
    }
    
    /**
     * Add new element to the priority queue
     * @param type $item the data to be added
     * @return boolean to indicate a succesful addition to the queue
     * @throws illegalArgumentException if $item is null
     */
    public function enqueue($item)
    {
        if($item == null)
        {
            throw new Exception("illegalArgumentException");
        }
        $this->apq->add($item);
        $child = $this->apq->size() - 1;
        $parent = (int)(child - 1)/2;
        $compareTo = strcmp($this->apq->get($parent), $this->apq-get($child)) ;
        while($parent >= 0 && $compareTo > 0 )
        {
            swap($parent,$child);
            $child = $parent;
            $parent = ($child - 1)/2;
        }
        return true;      
    }
    
    /**
     * Swap two elements in the queue
     * @param type $a
     * @param type $b
     */
    public function swap($a,$b)
    {
        $temp = $a;
        $this->apq->set($this->apq->get($b),$a);
        $this->apq->set($this->apq->get($temp),$b);
    }
    
    /**
     * Remove element from the queue
     * @return the element removed
     */
    public function dequeue()
    {
        if($this->apq->isEmpty())
        {
            return null;
        }
        
        //save the data at the the top of queue
        $topOfQueue = $this->apq->get(0);
        
        //if only one item then remove it
        if($this->apq->size() == 1)
        {
            $this->apq->remove(0);
            return $topOfQueue;
        }
        
        //remove the last item from the list and place it in the first
        $last = $this->apq->get($this->apq->size() - 1);
        $this->apq->set($last,0);
        $this->apq->remove($this->apq->size() - 1);
        
        $parent = 0;
        
        while(true)
        {
            $leftChild = (2 * $parent) + 1;
            $rightChild = $leftChild + 1;
            
            if($leftChild > $this->apq->size())
            {
                break;
            }
            
            $minChild = $leftChild;
            $compareTo = strcmp($this->apq->get($leftChild),
                    $this->apq->get($rightChild));
            
            if($rightChild < $this->apq->size() && $compareTo > 0)
            {
                $minChild = $rightChild;
            }
            
            $compareTo = strcmp($this->apq->get($parent),
                    $this->apq->get($minChild));
            
            if($compareTo > 0)
            {
                swap($parent,$minChild);
                $parent = $minChild;
            }
            else
            {
                break;
            }
            
            //end of while loop
        }
        
        return $topOfQueue;
    }
    
    //end of PriorityQueue
}