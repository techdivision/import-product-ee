<?php

/**
 * TechDivision\Import\Product\Ee\Utils\SqlStatements
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Ee\Utils;

/**
 * Utility class with the SQL statements to use.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class SqlStatements extends \TechDivision\Import\Product\Utils\SqlStatements
{

    /**
     * The SQL statement to load the actual product with the passed SKU.
     *
     * @var string
     */
    const PRODUCT = 'product';

    /**
     * The SQL statement to load the product datetime attribute with the passed row/attribute/store ID.
     *
     * @var string
     */
    const PRODUCT_DATETIME = 'product_datetime';

    /**
     * The SQL statement to load the product decimal attribute with the passed row/attribute/store ID.
     *
     * @var string
     */
    const PRODUCT_DECIMAL = 'product_decimal';

    /**
     * The SQL statement to load the product integer attribute with the passed row/attribute/store ID.
     *
     * @var string
     */
    const PRODUCT_INT = 'product_int';

    /**
     * The SQL statement to load the product text attribute with the passed row/attribute/store ID.
     *
     * @var string
     */
    const PRODUCT_TEXT = 'product_text';

    /**
     * The SQL statement to load the product varchar attribute with the passed row/attribute/store ID.
     *
     * @var string
     */
    const PRODUCT_VARCHAR = 'product_varchar';

    /**
     * The SQL statement to create a new sequence product value.
     *
     * @var string
     */
    const CREATE_SEQUENCE_PRODUCT = 'create.sequence_product';

    /**
     * The SQL statement to create new products.
     *
     * @var string
     */
    const CREATE_PRODUCT = 'create.product';

    /**
     * The SQL statement to update an existing product.
     *
     * @var string
     */
    const UPDATE_PRODUCT = 'update.product';

    /**
     * The SQL statement to create a new product datetime value.
     *
     * @var string
     */
    const CREATE_PRODUCT_DATETIME = 'create.product_datetime';

    /**
     * The SQL statement to update an existing product datetime value.
     *
     * @var string
     */
    const UPDATE_PRODUCT_DATETIME = 'update.product_datetime';

    /**
     * The SQL statement to create a new product decimal value.
     *
     * @var string
     */
    const CREATE_PRODUCT_DECIMAL = 'create.product_decimal';

    /**
     * The SQL statement to update an existing product decimal value.
     *
     * @var string
     */
    const UPDATE_PRODUCT_DECIMAL = 'update.product_decimal';

    /**
     * The SQL statement to create a new product integer value.
     *
     * @var string
     */
    const CREATE_PRODUCT_INT = 'create.product_int';

    /**
     * The SQL statement to update an existing product integer value.
     *
     * @var string
     */
    const UPDATE_PRODUCT_INT = 'update.product_int';

    /**
     * The SQL statement to create a new product varchar value.
     *
     * @var string
     */
    const CREATE_PRODUCT_VARCHAR = 'create.product_varchar';

    /**
     * The SQL statement to update an existing product varchar value.
     *
     * @var string
     */
    const UPDATE_PRODUCT_VARCHAR = 'update.product_varchar';

    /**
     * The SQL statement to create a new product text value.
     *
     * @var string
     */
    const CREATE_PRODUCT_TEXT = 'create.product_text';

    /**
     * The SQL statement to update an existing product text value.
     *
     * @var string
     */
    const UPDATE_PRODUCT_TEXT = 'update.product_text';

    /**
     * The SQL statement to create a product's stock status.
     *
     * @var string
     */
    const CREATE_STOCK_ITEM = 'create.stock_item';

    /**
     * The SQL statement to create a product's stock status.
     *
     * @var string
     */
    const UPDATE_STOCK_ITEM = 'update.stock_item';

    /**
     * The SQL statements.
     *
     * @var array
     */
    private $statements = array(
        SqlStatements::PRODUCT =>
            'SELECT *
               FROM catalog_product_entity
              WHERE sku = :sku
                AND updated_in > unix_timestamp(now())
           ORDER BY created_in ASC',
        SqlStatements::PRODUCT_DATETIME =>
            'SELECT *
               FROM catalog_product_entity_datetime
              WHERE row_id = :row_id
                AND attribute_id = :attribute_id
                AND store_id = :store_id',
        SqlStatements::PRODUCT_DECIMAL =>
            'SELECT *
               FROM catalog_product_entity_decimal
              WHERE row_id = :row_id
                AND attribute_id = :attribute_id
                AND store_id = :store_id',
        SqlStatements::PRODUCT_INT =>
            'SELECT *
               FROM catalog_product_entity_int
              WHERE row_id = :row_id
                AND attribute_id = :attribute_id
                AND store_id = :store_id',
        SqlStatements::PRODUCT_TEXT =>
            'SELECT *
               FROM catalog_product_entity_text
              WHERE row_id = :row_id
                AND attribute_id = :attribute_id
                AND store_id = :store_id',
        SqlStatements::PRODUCT_VARCHAR =>
            'SELECT *
               FROM catalog_product_entity_varchar
              WHERE row_id = :row_id
                AND attribute_id = :attribute_id
                AND store_id = :store_id',
        SqlStatements::CREATE_SEQUENCE_PRODUCT =>
            'INSERT INTO sequence_product VALUES ()',
        SqlStatements::CREATE_PRODUCT =>
            'INSERT
               INTO catalog_product_entity
                    (entity_id,
                     created_in,
                     updated_in,
                     sku,
                     created_at,
                     updated_at,
                     has_options,
                     required_options,
                     type_id,
                     attribute_set_id)
             VALUES (:entity_id,
                     :created_in,
                     :updated_in,
                     :sku,
                     :created_at,
                     :updated_at,
                     :has_options,
                     :required_options,
                     :type_id,
                     :attribute_set_id)',
        SqlStatements::UPDATE_PRODUCT =>
            'UPDATE catalog_product_entity
                SET entity_id = :entity_id,
                    created_in = :created_in,
                    updated_in = :updated_in,
                    sku = :sku,
                    created_at = :created_at,
                    updated_at = :updated_at,
                    has_options = :has_options,
                    required_options = :required_options,
                    type_id = :type_id,
                    attribute_set_id = :attribute_set_id
              WHERE row_id = :row_id',
        SqlStatements::CREATE_PRODUCT_DATETIME =>
            'INSERT
               INTO catalog_product_entity_datetime
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatements::UPDATE_PRODUCT_DATETIME =>
            'UPDATE catalog_product_entity_datetime
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id',
        SqlStatements::CREATE_PRODUCT_DECIMAL =>
            'INSERT
               INTO catalog_product_entity_decimal
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatements::UPDATE_PRODUCT_DECIMAL =>
            'UPDATE catalog_product_entity_decimal
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id',
        SqlStatements::CREATE_PRODUCT_INT =>
            'INSERT
               INTO catalog_product_entity_int
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatements::UPDATE_PRODUCT_INT =>
            'UPDATE catalog_product_entity_int
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id',
        SqlStatements::CREATE_PRODUCT_VARCHAR =>
            'INSERT
               INTO catalog_product_entity_varchar
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatements::UPDATE_PRODUCT_VARCHAR =>
            'UPDATE catalog_product_entity_varchar
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id',
        SqlStatements::CREATE_PRODUCT_TEXT =>
            'INSERT
               INTO catalog_product_entity_text
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatements::UPDATE_PRODUCT_TEXT =>
            'UPDATE catalog_product_entity_text
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id',
        SqlStatements::CREATE_STOCK_ITEM =>
            'INSERT
               INTO cataloginventory_stock_item
                    (product_id,
                     stock_id,
                     website_id,
                     qty,
                     min_qty,
                     use_config_min_qty,
                     is_qty_decimal,
                     backorders,
                     use_config_backorders,
                     min_sale_qty,
                     use_config_min_sale_qty,
                     max_sale_qty,
                     use_config_max_sale_qty,
                     is_in_stock,
                     notify_stock_qty,
                     use_config_notify_stock_qty,
                     manage_stock,
                     use_config_manage_stock,
                     use_config_qty_increments,
                     qty_increments,
                     use_config_enable_qty_inc,
                     enable_qty_increments,
                     is_decimal_divided,
                     deferred_stock_update,
                     use_config_deferred_stock_update)
             VALUES (:product_id,
                     :stock_id,
                     :website_id,
                     :qty,
                     :min_qty,
                     :use_config_min_qty,
                     :is_qty_decimal,
                     :backorders,
                     :use_config_backorders,
                     :min_sale_qty,
                     :use_config_min_sale_qty,
                     :max_sale_qty,
                     :use_config_max_sale_qty,
                     :is_in_stock,
                     :notify_stock_qty,
                     :use_config_notify_stock_qty,
                     :manage_stock,
                     :use_config_manage_stock,
                     :use_config_qty_increments,
                     :qty_increments,
                     :use_config_enable_qty_inc,
                     :enable_qty_increments,
                     :is_decimal_divided,
                     :deferred_stock_update,
                     :use_config_deferred_stock_update)',
        SqlStatements::UPDATE_STOCK_ITEM =>
            'UPDATE cataloginventory_stock_item
                SET product_id = :product_id,
                    stock_id = :stock_id,
                    website_id = :website_id,
                    qty = :qty,
                    min_qty = :min_qty,
                    use_config_min_qty = :use_config_min_qty,
                    is_qty_decimal = :is_qty_decimal,
                    backorders = :backorders,
                    use_config_backorders = :use_config_backorders,
                    min_sale_qty = :min_sale_qty,
                    use_config_min_sale_qty = :use_config_min_sale_qty,
                    max_sale_qty = :max_sale_qty,
                    use_config_max_sale_qty = :use_config_max_sale_qty,
                    is_in_stock = :is_in_stock,
                    low_stock_date = :low_stock_date,
                    notify_stock_qty = :notify_stock_qty,
                    use_config_notify_stock_qty = :use_config_notify_stock_qty,
                    manage_stock = :manage_stock,
                    use_config_manage_stock = :use_config_manage_stock,
                    stock_status_changed_auto = :stock_status_changed_auto,
                    use_config_qty_increments = :use_config_qty_increments,
                    qty_increments = :qty_increments,
                    use_config_enable_qty_inc = :use_config_enable_qty_inc,
                    enable_qty_increments = :enable_qty_increments,
                    is_decimal_divided = :is_decimal_divided,
                    deferred_stock_update = :deferred_stock_update,
                    use_config_deferred_stock_update = :use_config_deferred_stock_update
              WHERE item_id = :item_id'
    );

    /**
     * Initialize the the SQL statements.
     */
    public function __construct()
    {

        // call the parent constructor
        parent::__construct();

        // merge the class statements
        foreach ($this->statements as $key => $statement) {
            $this->preparedStatements[$key] = $statement;
        }
    }
}
