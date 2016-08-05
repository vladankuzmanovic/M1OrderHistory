<?php
class Kuzman_OrderHistory_Block_Order_History_Print extends Mage_Core_Block_Template
{
    protected function _prepareLayout()
    {
        if ($headBlock = $this->getLayout()->getBlock('head')) {
            $headBlock->setTitle($this->__('Print Order # %s', $this->getOrder()->getOldorderId()));
        }
    }

    public function getPaymentInfoHtml()
    {
        $old_model = Mage::getModel('kuzmanorders/order')->load($this->getOrder()->getOldorderId());
        return $old_model->getPaymentMethodTitle();
    }

    public function getOrder()
    {
        return Mage::registry('current_order');
    }

    public function getOrderItems()
    {
        return Mage::getModel('kuzmanorders/order_item')->getCollection()->addFieldToFilter('order_id', $this->getOrder()->getOrderId());
    }
}