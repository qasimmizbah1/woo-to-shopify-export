# Woo to Shopify Export Pro

Woo to Shopify Export is a simple WordPress plugin that allows you to export WooCommerce products in Shopify-compatible CSV format.

This plugin is designed for quick and easy migration from WooCommerce to Shopify.

---

## Features

- Export all products or selected products
- Supports simple and variable products
- Supports up to 3 Shopify product options
- Includes SKU, price, stock, and images
- Modern admin UI
- Search products before exporting
- Direct CSV download (no file stored on server)

---

## Requirements

- WordPress (Self-hosted / WordPress.org)
- WooCommerce plugin installed and active
- PHP 7.4 or higher (recommended)

---

## Installation

1. Download or clone this repository.
2. Upload the folder to:

   wp-content/plugins/

3. Go to WordPress Admin → Plugins.
4. Activate **Woo to Shopify Export Pro**.

---

## How to Use

1. Go to WordPress Admin.
2. Click on **Woo → Shopify** in the sidebar.
3. Select products you want to export.
4. Click:
   - **Export Selected** OR
   - **Export All**
5. CSV file will download automatically.
6. Upload this CSV inside Shopify Admin → Products → Import.

---

## CSV Output Includes

- Title
- Description (HTML)
- Vendor
- Published Status
- Option1 / Option2 / Option3
- Variant SKU
- Variant Price
- Variant Inventory
- Image URL

---

## Important Notes

- Shopify supports maximum 3 product options.
- Make sure image URLs are publicly accessible.
- Each product must have unique SKU.
- Shopify allows maximum 100 variants per product.

---

## Use Case

This plugin is best for:

- WooCommerce to Shopify migration
- Client store transfer
- Bulk export for development use
- Internal migration tool

---

## Author

Developed by Qasim

---

## License

This plugin is open-source and free to use.