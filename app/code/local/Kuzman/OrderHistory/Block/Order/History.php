<?php
class Kuzman_OrderHistory_Block_Order_History
    extends Mage_Sales_Block_Order_History {

    public function __construct() {
        parent::__construct();

        $orders = Mage::getModel('kuzmanorders/order_collection');
        // add normal orders
        foreach ($this->getOrders() as $new){
            $orders->addItem($new);
        }
        // fetch and add old orders history - migrated orders

        $old_collection = Mage::getModel('kuzmanorders/order')->getCollection()
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_email', Mage::getSingleton('customer/session')->getCustomer()->getEmail())
            ->addFieldToFilter('website', Mage::app()->getWebsite()->getId())
            ->setOrder('created_at', 'desc');

        foreach ($old_collection as $old_model){
            $shipping = Mage::getModel('sales/order_address')
                    ->setFirstname($old_model->getShippingAddressFirstname())
                    ->setLastname($old_model->getShippingAddressLastname())
                    ->setStreet($old_model->getShippingAddressStreet())
                    ->setPostcode($old_model->getShippingAddressPostcode())
                    ->setCountryId($old_model->getShippingAddressCountryId())
                    ->setCity($old_model->getShippingAddressCity())
                    ->setTelephone($old_model->getShippingAddressTelephone());

            $old = Mage::getModel('sales/order');
            $old->setId(9999 + (int)$old_model->getId());
            $old->setStatus(trim($old_model->getStatus()));
            $old->setOldorderId($old_model->getOldorderId());
            $old->setRealOrderId($old_model->getIncrementId());
            $old->setIsFromImport(1);
            $old->setCreatedAt($old_model->getCreatedAt());
            $old->setCreatedAtStoreDate($old_model->getCreatedAt());
            $old->setGrandTotal($old_model->getGrandTotal());
            $old->setShippingAddress($shipping);
            $orders->addItem($old);
        }
        // reset collection
        $this->setOrders($orders);
    }

    /**
     * override the view link for migrated orders ( read only view )
     *
     */
    public function getViewUrl($order)
    {
        if($order->getIsFromImport()){
            return $this->getUrl('*/*/old', array('order_id' => $order->getOldorderId()));
        }
        return parent::getViewUrl($order);
    }
}