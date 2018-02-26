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

namespace TechDivision\Import\Product\Ee\Repositories;

use TechDivision\Import\Product\Ee\Utils\SqlStatementKeys;

/**
 * Repository class with the SQL statements to use.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class SqlStatementRepository extends \TechDivision\Import\Product\Repositories\SqlStatementRepository
{

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
        SqlStatements::PRODUCTS =>
            'SELECT * FROM catalog_product_entity
              WHERE updated_in > unix_timestamp(now())
           GROUP BY sku
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
              WHERE value_id = :value_id'
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
