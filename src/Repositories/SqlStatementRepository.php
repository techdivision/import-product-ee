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
        SqlStatementKeys::PRODUCT =>
            'SELECT *
               FROM ${table:catalog_product_entity}
              WHERE sku = :sku
                AND updated_in > unix_timestamp(now())
           ORDER BY created_in ASC',
        SqlStatementKeys::PRODUCTS =>
            'SELECT * FROM ${table:catalog_product_entity}
              WHERE updated_in > unix_timestamp(now())
           GROUP BY sku
           ORDER BY created_in ASC',
        SqlStatementKeys::PRODUCT_DATETIMES =>
            'SELECT *
               FROM ${table:catalog_product_entity_datetime}
           ORDER BY row_id, store_id',
        SqlStatementKeys::PRODUCT_DATETIMES_BY_PK_AND_STORE_ID =>
        'SELECT *
               FROM ${table:catalog_product_entity_datetime}
              WHERE row_id = :pk
                AND store_id = :store_id',
        SqlStatementKeys::PRODUCT_DECIMALS =>
            'SELECT *
               FROM ${table:catalog_product_entity_decimal}
           ORDER BY row_id, store_id',
        SqlStatementKeys::PRODUCT_DECIMALS_BY_PK_AND_STORE_ID =>
        'SELECT *
               FROM ${table:catalog_product_entity_decimal}
              WHERE row_id = :pk
                AND store_id = :store_id',
        SqlStatementKeys::PRODUCT_INTS =>
            'SELECT *
               FROM ${table:catalog_product_entity_int}
           ORDER BY row_id, store_id',
        SqlStatementKeys::PRODUCT_INTS_BY_PK_AND_STORE_ID =>
            'SELECT *
               FROM ${table:catalog_product_entity_int}
              WHERE row_id = :pk
                AND store_id = :store_id',
        SqlStatementKeys::PRODUCT_TEXTS =>
            'SELECT *
               FROM ${table:catalog_product_entity_text}
           ORDER BY row_id, store_id',
        SqlStatementKeys::PRODUCT_TEXTS_BY_PK_AND_STORE_ID =>
            'SELECT *
               FROM ${table:catalog_product_entity_text}
              WHERE row_id = :pk
                AND store_id = :store_id',
        SqlStatementKeys::PRODUCT_VARCHARS =>
            'SELECT *
               FROM ${table:catalog_product_entity_varchar}
           ORDER BY row_id, store_id',
        SqlStatementKeys::PRODUCT_VARCHARS_BY_PK_AND_STORE_ID =>
            'SELECT *
               FROM ${table:catalog_product_entity_varchar}
              WHERE row_id = :pk
                AND store_id = :store_id',
        SqlStatementKeys::PRODUCT_VARCHAR_BY_ATTRIBUTE_CODE_AND_ENTITY_TYPE_ID_AND_STORE_ID_AND_PK =>
            'SELECT t1.*
               FROM ${table:catalog_product_entity_varchar} t1,
                    ${table:eav_attribute} t2
              WHERE t2.attribute_code = :attribute_code
                AND t2.entity_type_id = :entity_type_id
                AND t1.attribute_id = t2.attribute_id
                AND (t1.store_id = :store_id OR t1.store_id = 0)
                AND t1.row_id = :pk
           ORDER BY t1.store_id DESC',
        SqlStatementKeys::CREATE_SEQUENCE_PRODUCT =>
            'INSERT INTO ${table:sequence_product} VALUES ()',
        SqlStatementKeys::CREATE_PRODUCT =>
            'INSERT
               INTO ${table:catalog_product_entity}
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
        SqlStatementKeys::UPDATE_PRODUCT =>
            'UPDATE ${table:catalog_product_entity}
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
        SqlStatementKeys::CREATE_PRODUCT_DATETIME =>
            'INSERT
               INTO ${table:catalog_product_entity_datetime}
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatementKeys::UPDATE_PRODUCT_DATETIME =>
            'UPDATE ${table:catalog_product_entity_datetime}
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id',
        SqlStatementKeys::CREATE_PRODUCT_DECIMAL =>
            'INSERT
               INTO ${table:catalog_product_entity_decimal}
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatementKeys::UPDATE_PRODUCT_DECIMAL =>
            'UPDATE ${table:catalog_product_entity_decimal}
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id',
        SqlStatementKeys::CREATE_PRODUCT_INT =>
            'INSERT
               INTO ${table:catalog_product_entity_int}
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatementKeys::UPDATE_PRODUCT_INT =>
            'UPDATE ${table:catalog_product_entity_int}
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id',
        SqlStatementKeys::CREATE_PRODUCT_VARCHAR =>
            'INSERT
               INTO ${table:catalog_product_entity_varchar}
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatementKeys::UPDATE_PRODUCT_VARCHAR =>
            'UPDATE ${table:catalog_product_entity_varchar}
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id',
        SqlStatementKeys::CREATE_PRODUCT_TEXT =>
            'INSERT
               INTO ${table:catalog_product_entity_text}
                    (row_id,
                     attribute_id,
                     store_id,
                     value)
             VALUES (:row_id,
                     :attribute_id,
                     :store_id,
                     :value)',
        SqlStatementKeys::UPDATE_PRODUCT_TEXT =>
            'UPDATE ${table:catalog_product_entity_text}
                SET row_id = :row_id,
                    attribute_id = :attribute_id,
                    store_id = :store_id,
                    value = :value
              WHERE value_id = :value_id'
    );

    /**
     * Initializes the SQL statement repository with the primary key and table prefix utility.
     *
     * @param \IteratorAggregate<\TechDivision\Import\Utils\SqlCompilerInterface> $compilers The array with the compiler instances
     */
    public function __construct(\IteratorAggregate $compilers)
    {

        // pass primary key + table prefix utility to parent instance
        parent::__construct($compilers);

        // compile the SQL statements
        $this->compile($this->statements);
    }
}
