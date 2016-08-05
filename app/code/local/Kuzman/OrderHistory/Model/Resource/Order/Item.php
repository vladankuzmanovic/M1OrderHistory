<?php
class Kuzman_OrderHistory_Model_Resource_Order_Item extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('kuzmanorders/order_item', "id");
    }
}