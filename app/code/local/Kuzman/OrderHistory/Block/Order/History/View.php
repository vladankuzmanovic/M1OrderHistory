<?php
class Kuzman_OrderHistory_Block_Order_History_View extends Mage_Core_Block_Template
{
    private $_id = null;
    protected $_links = array();

    protected function _construct()
    {
        parent::_construct();
        $this->_id = $this->getRequest()->getParam('order_id');
    }

    protected function _prepareLayout()
    {
        if ($headBlock = $this->getLayout()->getBlock('head')) {
            $headBlock->setTitle($this->__('Order # %s', $this->getOrder()->getRealOrderId()));
        }
    }

    public function getOrder()
    {
        $old_model = Mage::getModel('kuzmanorders/order')->load($this->_id);


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
                    ->setOrderId($old_model->getOldorderId())
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

    public function getPaymentInfoHtml()
    {
        $old_model = Mage::getModel('kuzmanorders/order')->load($this->_id);
        return $old_model->getPaymentMethodTitle();
    }

    public function addLink($name, $path, $label)
    {
        $this->_links[$name] = new Varien_Object(array(
            'name' => $name,
            'label' => $label,
            'url' => ''
        ));
        return $this;
    }

    public function getLinks()
    {
        return $this->_links;
    }

    public function getOrderFromImportItems()
    {
        $orderId = Mage::getModel('kuzmanorders/order')->getCollection()->addFieldToFilter('oldorder_id', $this->_id)->getFirstItem()->getOrderId();

        $orderFromImportItems=  Mage::getModel('kuzmanorders/order_item')->getCollection()->addFieldToFilter('order_id', $orderId);
        return $orderFromImportItems;
    }

    public function getBackUrl()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            return Mage::getUrl('*/*/history');
        }
        return Mage::getUrl('*/*/form');
    }

    /**
     * Return back title for logged in and guest users
     *
     * @return string
     */
    public function getBackTitle()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            return Mage::helper('sales')->__('Back to My Orders');
        }
        return Mage::helper('sales')->__('View Another Order');
    }

    public function getPrintUrl()
    {
        return $this->getUrl('sales/order/printOld', array('order_id' => $this->_id));
    }
}