<?php
class Kuzman_OrderHistory_Model_Resource_Order extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('kuzmanorders/order', "oldorder_id");
    }
}