<?php



/**
 * @author anonCoding
 * A queue uses the principle of first in, first out
 */
class Queue {
    
    //the underlying array
    private $queueArray;
    
    //the first element in the queue (top of queue)
    private $toq;
    
    
    /**
     * Initialize the class instance variables
     */
    public function __construct() 
    {
        $this->queueArray = array();
        $this->toq = -1;
    }
    
    /**
     * Add new element to the back of the queue
     * @param $data the value to be added to the queue
     */
    public function enqueue($data)
    {
        $this->queueArray[] = $data;
    }
    
    /**
     * If queue is empty, throw an exception
     * Increment $toq by one to point to the next element as top of queue
     * Return top of the queue
     * @return $toq
     * @throws queueIsEmptyException
     */
    public function dequeue()
    {
        if(isEmpty())
        {
            throw new Exception("The queue is Empty");
        }
        return $this->queueArray[++$this->toq];
    }
    
    /**
     * If the queue is not empty, get the value at the top of the queue
     * If otherwise, throw an exception
     * @return $value the top of queue value
     * @throws queueIsEmptyException
     */
    public function peekFirsk()
    {
        if(isEmpty())
        {
            throw new Exception("The queus is Empty");
        }
        
        return $this->queueArray[$this->toq];
    }
    
    /**
     * If the queue is not empty,
     * get the size of the $queueArray,
     * retrieve the last element in the queue.
     * Throw an exception if queue is empty
     * @return value the last in queue
     * @throws queueIsEmptyException
     */
    public function peekLast()
    {
        if(isEmpty())
        {
            throw new Exception("The queue is Empty");
        }
        
        //get the size of the array
        $size = count($this->queueArray);
        
        return $this->queueArray[$size - 1];
    }
    
    /**
     * Check if queue is empty
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->toq < 0;
    }
    
    //end of the Queue class
}