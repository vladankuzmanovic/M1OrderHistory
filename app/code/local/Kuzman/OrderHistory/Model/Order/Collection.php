<?php
class Kuzman_OrderHistory_Model_Order_Collection extends Varien_Data_Collection
{
    /**
     * Implementation of IteratorAggregate::getIterator()
     *
     */
    public function getIterator()
    {
        $iterator = parent::getIterator();
 
        if (FALSE === $size = $this->getPageSize()) {
            return $iterator;
        }
 
        $page = $this->getCurPage();
        if ($page < 1) {
            return $iterator;
        }
 
        $offset = $size * $page - $size;
 
        return new LimitIterator($iterator, $offset, $size);
    }
}