<?php
include("BinarySearchTree.php");

/**
 * This class will help to balance a binary search tree
 * @author anonCoding
 */
class BinarySearchTreeRotate extends BinarySearchTree{
    
    /**
     * Rotate the tree to the right
     */
    public function rotateRight()
    {
        $temp = $root->leftNode;
        $root->leftNode = $temp->rightNode;
        $temp->rightNode = $root;
        $root = $temp;
    }
    
    /**
     * Rotate the tree to the left
     */
    public function rotateLeft()
    {
        $temp = $root->rightNode;
        $root->rightNode = $temp->leftNode;
        $temp->leftNode = $root;
        $root = $temp;
    }
}
