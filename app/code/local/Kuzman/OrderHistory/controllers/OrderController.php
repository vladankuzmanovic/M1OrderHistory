<?php
require_once(Mage::getModuleDir('controllers','Mage_Sales').DS.'OrderController.php');
class Kuzman_OrderHistory_OrderController extends Mage_Sales_OrderController
{
    public function oldAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');

        $navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        if ($navigationBlock) {
            $navigationBlock->setActive('sales/order/history');
        }
        $this->renderLayout();
    }

    public function printOldAction()
    {
        $OldorderId = (int) $this->getRequest()->getParam('order_id');
        Mage::register('current_order', $this->_getOldOrder($OldorderId));

        $this->loadLayout('print');
        $this->renderLayout();
    }

    protected function _getOldOrder($OldorderId)
    {
        $old_model = Mage::getModel('kuzmanorders/order')->load($OldorderId);


        $shipping = Mage::getModel('sales/order_address')
            ->setFirstname($old_model->getShippingAddressFirstname())
            ->setLastname($old_model->getShippingAddressLastname())
            ->setStreet($old_model->getShippingAddressStreet())
            ->setPostcode($old_model->getShippingAddressPostcode())
            ->setCountryId($old_model->getShippingAddressCountryId())
            ->setCity($old_model->getShippingAddressCity())
            ->setTelephone($old_model->getShippingAddressTelephone());

        $billing = Mage::getModel('sales/order_address')
            ->setFirstname($old_model->getBillingAddressFirstname())
            ->setLastname($old_model->getBillingAddressLastname())
            ->setStreet($old_model->getBillingAddressStreet())
            ->setPostcode($old_model->getBillingAddressPostcode())
            ->setCountryId($old_model->getBillingAddressCountryId())
            ->setCity($old_model->getBillingAddressCity())
            ->setTelephone($old_model->getBillingAddressTelephone());

        $old = Mage::getModel('sales/order')
            ->setStatus(trim($old_model->getStatus()))
            ->setOldorderId($old_model->getOldorderId())
            ->setOrderId($old_model->getOrderId())
            ->setRealOrderId($old_model->getIncrementId())
            ->setCreatedAt($old_model->getCreatedAt())
            ->setCreatedAtStoreDate($old_model->getCreatedAt())
            ->setSubtotal($old_model->getSubtotal())
            ->setShippingAmount($old_model->getShippingAmount())
            ->setTaxAmount($old_model->getTax())
            ->setDiscountAmount($old_model->getDiscountAmount())
            ->setGrandTotal($old_model->getGrandTotal())
            ->setShippingMethod($old_model->getShippingMethod())
            ->setShippingDescription($old_model->getShippingDescription())
            ->setShippingAddress($shipping)
            ->setBillingAddress($billing);
        return $old;
    }
}