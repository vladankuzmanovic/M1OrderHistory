Kuzman_OrderHistory
==========================

Requirement was to enable Wabsite stuff to show previously imported orders (in custom tables)
Version:

    version 0.0.1

Features:

    Added new order history view grid

    Added new tables "sales_flat_kuzman_order" and "sales_flat_kuzman_order_item" which needs to be populated 
    Mage_Sales_Block_Order_History overrided to allow join magento order history orders with imported orders

Installation:

    Clear the store cache under var/cache, var/full_page_cache and all cookies for your store domain. Disable compilation if enabled. This step eliminates almost all potential problems. It’s necessary since Magento uses cache heavily.
    Backup your store database and web directory.
    Download and unzip extension contents on your computer and navigate inside the extracted folder.
    Using your FTP client upload content of ”app” directory to “app” directory inside your store root.

Uninstall:

    You can safely remove the extension files from your store.

