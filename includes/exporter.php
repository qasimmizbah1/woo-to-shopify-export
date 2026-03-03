<?php
if (!defined('ABSPATH')) exit;

add_action('wp_ajax_wse_export_products', 'wse_export_products');

function wse_export_products(){

    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    check_ajax_referer('wse_nonce', 'nonce');

    $ids = isset($_POST['ids']) ? array_map('intval', $_POST['ids']) : [];

    if (empty($ids)) {
        $ids = wc_get_products(['limit'=>-1, 'return'=>'ids']);
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=shopify-products.csv');

    $output = fopen('php://output', 'w');

    fputcsv($output, [
        'Title',
        'Body (HTML)',
        'Vendor',
        'Published',
        'Option1 Name',
        'Option1 Value',
        'Option2 Name',
        'Option2 Value',
        'Option3 Name',
        'Option3 Value',
        'Variant SKU',
        'Variant Price',
        'Variant Inventory Qty',
        'Image Src'
    ]);

    foreach ($ids as $id) {

        $product = wc_get_product($id);
        if (!$product) continue;

        $title = $product->get_name();
        $description = $product->get_description();
        $vendor = get_bloginfo('name');
        $image = wp_get_attachment_url($product->get_image_id());

        if ($product->is_type('simple')) {

            fputcsv($output, [
                $title,
                $description,
                $vendor,
                'TRUE',
                'Title',
                'Default Title',
                '',
                '',
                '',
                '',
                $product->get_sku(),
                $product->get_regular_price(),
                $product->get_stock_quantity(),
                $image
            ]);
        }

        if ($product->is_type('variable')) {

            $attributes = $product->get_attributes();
            $attr_keys = array_keys($attributes);

            $option1 = wc_attribute_label($attr_keys[0] ?? '');
            $option2 = wc_attribute_label($attr_keys[1] ?? '');
            $option3 = wc_attribute_label($attr_keys[2] ?? '');

            foreach ($product->get_children() as $variation_id) {

                $variation = wc_get_product($variation_id);
                $var_attrs = array_values($variation->get_attributes());

                fputcsv($output, [
                    $title,
                    $description,
                    $vendor,
                    'TRUE',
                    $option1,
                    $var_attrs[0] ?? '',
                    $option2,
                    $var_attrs[1] ?? '',
                    $option3,
                    $var_attrs[2] ?? '',
                    $variation->get_sku(),
                    $variation->get_regular_price(),
                    $variation->get_stock_quantity(),
                    $image
                ]);
            }
        }
    }

    fclose($output);
    exit;
}