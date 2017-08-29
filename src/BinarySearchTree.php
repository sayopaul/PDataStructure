<?php

/**
 * @author anonCoding
 */

/**
 * Nodes are building blocks of a binary tree
 */
class TreeNode {
    
    //the value in the node
    public $data;
    
    //a reference to the left subtree of the node
    public $leftNode;
    
    //a reference to the right subtree of the node
    public $rightNode;
    
    //initialize the instance variable
    public function __construct($data)
    {
        $this->data = $data;
        $this->leftNode = $this->rightNode = null;
    }
    
    //end of TreeNode
}

/**
 * A binary tree is a tree with nodes that do not have more than two children
 */
class BinarySearchTree{
    
    //the root node
    public $root;
    
    public function __construct()
    {
        $this->root = null;
    }
    
    /**
     * Get the value in a particular node
     * @param type $node
     * @return data in node
     */
    public function visit($node)
    {
        echo $node->data;
    }
    
    /**
     * Traverse the tree using preOrder traversal
     */
    public function preOrder($root)
    {
        if($root == null) return;
        visit($root);
        preOrder($root->leftNode);
        preOrder($root->rightNode);
    }
    
    /**
     * Traverse the tree using inOrder traversal
     */
    public function inOrder($root)
    {
        if($root == null) return;
        inOrder($root->leftNode);
        visit($root);
        inOrder($root->rightNode);
    }
    
    /**
     * Traverse the tree using postOrder traversal
     */
    public function postOrder($root)
    {
        if($root == null) return;
        postOrder($root->leftNode);
        postOrder($root->rightNode);
        visit($root);
    }
    
    /**
     * Insert data in tree
     */
    public function insert($data)
    {
        //ptr will represent the current node as the tree is traversed
        $ptr = $this->root;
        
        //the parent of node $ptr
        $parent = null;
        
        //this will help me know whether to attach the new node to the left of
        //it parent node or to the right
        $left = false;
        
        while($ptr != null)
        {
            //check if there is a duplicate
            if($data == $ptr->data)
            {
                throw new Exception("Data already exist");
            }
            
            //keep a reference to the current node
            $parent = $ptr;
            
            //check if the value in data is less than that in node $ptr
            $compareTo = strcmp($data, $ptr->data);
            
            if($compareTo < 0)
            {
                $ptr = $ptr->leftNode; $left = true;
            }
            
            if($compareTo > 0)
            {
                $ptr = $ptr->rightNode; $left = false;
            }
        }
        
        //create a new Node
        $newNode = new TreeNode($data);
        
        /**
         * If the tree is empty, $newNode becomes the root
         */
        if($this->root == null)
        {
            $this->root = $newNode;
            return;
        }
        
        /**
         * Attach new node to its parent
         */
        if($left)
        {
            $parent->leftNode = $newNode;
        }
        else
        {
            $parent->rightNode = $newNode;
        }
        
        //end of insert method
    }
    
    /**
     * Search for a given node
     */
    public function search($data)
    {
        $ptr = $this->root;
        
        while($ptr != null)
        {
            $compareTo = strcmp($data,$ptr->data);
            switch($compareTo)
            {
                case -1:
                    $ptr = $ptr->leftNode;
                    break;
                case 0:
                    return $ptr;
                case 1:
                    $ptr = $ptr->rightNode;
                    break;
            }
        }
        
        return $ptr;
        
        //end of search method
    }
    
    /**
     * Delete a node from the tree
     */
    public function delete($data)
    {
        $parent = null;
        
        //node to be deleted
        $x = $this->root;
        
        //this will help me to know whether the node $x is to the right or left
        //of its parent
        $left = false;
        
        while($x != null)
        {
            if($data == $x->data)
            {
                break;
            }
            
            $parent = $x;
            
            $compareTo = strcmp($data,$x->data);
            
            if($compareTo < 0)
            {
                $x = $x->leftNode; $left = true;
            }
            
            if($compareTo > 0)
            {
                $x = $x->rightNode; $left = false;
            }
        }
        
        if($x == null)
        {
            return null;
        }
        
        //if the node to be deleted has two children
        if($x->leftNode != null && $x->rightNode != null)
        {
            $parent = $x; $left = true;
            $y = $x->left;
            while($y->rightNode != null)
            {
                $left = false;
                $parent = $y;
                $y = $y->rightNode;
            }
            
            $x->data = $y->data;
            $x = $y;
        }
        
        //if it is a leaf
        $this->isLeafDelete($x,$left,$parent);
        
        //if it has one child
        $this->hasOneChildDelete($x,$parent);
        
        //end of delete
    }
    
    /**
     * Delete a leaf node
     */
    public function isLeafDelete($x,$left,$parent)
    {
        if($x->leftNode == null && $x->rightNode == null)
        {
            if($left)
            {
                $parent->leftNode = null;
            }
            else
            {
                $parent->rightNode = null;
            }
        }
        
        //end of isLeafDelete
    }
    
    /**
     * Delete a node with one child
     */
    public function hasOneChildDelete($x,$parent)
    {
        if(
                ($x->leftNode != null && $x->rightNode == null) || 
                ($x->leftNode == null && $x->rightNode != null)
          )
        {
            if($x->leftNode != null)
            {
                if($x == $parent->rightNode)
                {
                    $parent->rightNode = $x->leftNode;
                }
                else
                {
                    $parent->leftNode = $x->leftNode;
                }
            }
            else
            {
                if($x == $parent->rightNode)
                {
                    $parent->rightNode = $x->rightNode;
                }
                else
                {
                    $parent->leftNode = $x->rightNode;
                }
            }
        }
        
        //end of hasOneChildDelete
    }
    
    //end of BinaryTree
}
