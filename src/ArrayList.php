<?php
namespace AnonCoding\PHPDataStructures;
/**
 * @author anonCoding
 */
class ArrayList
{
    /** the size of the array **/
    private $size;
    
    // the underlying array
    private $data;
    
    /**
     * Initialize the instance variables
     */
    public function __construct() 
    {
        $this->data = array();
        $this->size = 0;
    }
    
    /**
     * check if user want to insert in the middle of array
     * if yes, insert in the middle. if no, add new value to the end of the array
     * @param type $param
     * @param type $index
     */
    public function add($param,$index = null) {
        if($index == null)
        {
            $this->data[$this->size] = $param; 
            $this->size++;
        }
        else
        {
            for($i = $this->size; $i > $index; $i--)
            {
                $this->data[$i] = $this->data[$i - 1];
            }
            $this->data[$index] = $param;
        }
    }
    
    /**
     * get the size of the array
     * @return type
     */
    public function size()
    {
        return $this->size;
    }
    
    /**
     * get the value at a particular location
     * @param int $index the value at a specified index
     * @return type
     */
    public function get(int $index)
    {
        return $this->data[$index];
    }
    
    /**
     * assign a new value to an element at a particular index
     * @param type $param
     * @param int $index
     */
    public function set($param,int $index)
    {
        $this->data[$index] = $param;
    }
    
    /**
     * check if the given index is valid
     * if not valid, throw an exception
     * if valid, delete the element located at index
     * @param int $index
     * @return boolean
     * @throws Exception
     */
    public function remove(int $index)
    {
        if($index < 0 || $index > $this->size)
        {
            throw new Exception("Index Out of Bound Exception");
        }
        else
        {
            for($i = $index; $i < $this->size; $i++)
            {
                $this->data[$i]  = $this->data[$i + 1];
            }
            $this->size--;
            return true;
        }
    }
    
    /**
     * return the index of the matched element
     * or return null if no element is matched 
     * @param type $param
     * @return string
     */
    public function indexOf($param)
    {
        foreach($this->data as $key => $value)
        {
            if($param == $value)
            {
                return $key;
            }
        }
        return -1;
    }
    
    public function isEmpty()
    {
        return $this->size <= 0;
    }
    
    //end of ArrayList
    
}