<?php
$installer = $this;
$installer->startSetup();

/*
 * sales_flat_kuzman_order DB table
 */
if (!$installer->tableExists($this->getTable('kuzmanorders/order'))) {
    $table = $installer->getConnection()
        ->newTable($this->getTable('kuzmanorders/order'))
        ->addColumn('oldorder_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'Id')
        ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'order_id')
        ->addColumn('customer_email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'customer_email')
        ->addColumn('website', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'website_id')
        ->addColumn('increment_id', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(), 'increment_id')
        ->addColumn('status', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(), 'status')
        ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(), 'created_at')
        ->addColumn('subtotal', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'subtotal')
        ->addColumn('shipping_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'shipping_amount')
        ->addColumn('discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'discount_amount')
        ->addColumn('tax', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'tax')
        ->addColumn('grand_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'grand_total')
        ->addColumn('shipping_description', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_description')
        ->addColumn('shipping_title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_title')
        ->addColumn('shipping_address_firstname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_address_firstname')
        ->addColumn('shipping_address_lastname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_address_lastname')
        ->addColumn('shipping_email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_email')
        ->addColumn('shipping_address_street', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_address_street')
        ->addColumn('shipping_address_postcode', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_address_postcode')
        ->addColumn('shipping_address_country_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_address_country_id')
        ->addColumn('shipping_address_city', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_address_city')
        ->addColumn('shipping_address_telephone', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'shipping_address_telephone')
        ->addColumn('billing_title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'billing_title')
        ->addColumn('billing_address_firstname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'billing_address_firstname')
        ->addColumn('billing_address_lastname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'billing_address_lastname')
        ->addColumn('billing_email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'billing_email')
        ->addColumn('billing_address_street', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'billing_address_street')
        ->addColumn('billing_address_postcode', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'billing_address_postcode')
        ->addColumn('billing_address_country_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'billing_address_country_id')
        ->addColumn('billing_address_city', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'billing_address_city')
        ->addColumn('billing_address_telephone', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'billing_address_telephone')
        ->addColumn('payment_method_title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'payment_method_title');
    $installer->getConnection()->createTable($table);
}

/*
 * sales_flat_kuzman_order_item DB table
 */
if (!$installer->tableExists($this->getTable('kuzmanorders/order_item'))) {
    $table = $installer->getConnection()
        ->newTable($this->getTable('kuzmanorders/order_item'))
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'item Id')
        ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'order_id')
        ->addColumn('item_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'item_name')
        ->addColumn('item_sku', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'item_sku')
        ->addColumn('item_qty_ordered', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'item_qty_ordered')
        ->addColumn('item_price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'item_price')
        ->addColumn('item_row_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'item_row_total')
        ->addColumn('discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'discount_amount');
    $installer->getConnection()->createTable($table);
}

$installer->endSetup();
