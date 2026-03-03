<?php
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function () {
    add_menu_page(
        'Woo → Shopify Export',
        'Woo → Shopify',
        'manage_options',
        'woo-shopify-export',
        'wse_admin_page',
        'dashicons-migrate',
        56
    );
});

function wse_admin_page()
{
    $products = wc_get_products([
        'limit' => -1,
        'status' => 'publish'
    ]);
?>

<div class="wrap wse-container">

    <!-- HEADER -->
    <div class="wse-header-card">
        <div>
            <h1>WooCommerce → Shopify Export</h1>
            <p>Export selected or all WooCommerce products to Shopify CSV format.</p>
        </div>
        <div class="wse-actions-top">
            <button id="wse-export-selected" class="button button-primary">
                Export Selected
            </button>
            <button id="wse-export-all" class="button button-secondary">
                Export All
            </button>
        </div>
    </div>

    <!-- SEARCH BAR -->
    <div class="wse-search-bar">
        <input type="text" id="wse-search" placeholder="Search product by name...">
    </div>

    <!-- PRODUCT TABLE CARD -->
    <div class="wse-table-card">
        <table class="wse-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="wse-select-all"></th>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td>
                        <input type="checkbox" class="wse-product" value="<?php echo $product->get_id(); ?>">
                    </td>
                    <td>#<?php echo $product->get_id(); ?></td>
                    <td class="wse-product-name">
                        <?php echo esc_html($product->get_name()); ?>
                    </td>
                    <td>
                        <span class="wse-badge">
                            <?php echo ucfirst($product->get_type()); ?>
                        </span>
                    </td>
                    <td>₹<?php echo $product->get_price(); ?></td>
                    <td>
                        <?php 
                        $stock = $product->get_stock_quantity();
                        echo $stock ? $stock : '<span class="wse-out">Out</span>';
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php
}