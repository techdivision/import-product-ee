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
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */

namespace TechDivision\Import\Product\Ee\Utils;

/**
 * A SSB providing process registry functionality.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */
class SqlStatements
{

    /**
     * This is a utility class, so protect it against direct
     * instantiation.
     */
    private function __construct()
    {
    }

    /**
     * This is a utility class, so protect it against cloning.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Return's the Magento edition/version specific utility class containing
     * the SQL statements to use.
     *
     * @param string $magentoEdition The Magento edition to use, EE or CE
     * @param string $magentoVersion The Magento version to use, e. g. 2.1.0
     *
     * @return string The fully qualified utility class name
     */
    public static function getUtilityClassName($magentoEdition, $magentoVersion)
    {

        // prepare the Magento edition/version specific utility classname
        $utilClassName = sprintf('TechDivision\Import\Product\Utils\%s\V%s\SqlStatements', ucfirst($magentoEdition), $magentoVersion);

        // if NOT available, use the default utility class name
        if (!class_exists($utilClassName)) {
            // prepare the Magento edition/version specific utility classname
            if (!class_exists($utilClassName = sprintf('TechDivision\Import\Product\Utils\%s\SqlStatements', ucfirst($magentoEdition)))) {
                $utilClassName = __CLASS__;
            }
        }

        // return the utility class name
        return $utilClassName;
    }

    /**
     * The SQL statement to create a new sequence product value.
     *
     * @var string
     */
    const CREATE_SEQUENCE_PRODUCT = 'INSERT INTO sequence_product VALUES ()';

    /**
     * The SQL statement to create new products.
     *
     * @var string
     */
    const CREATE_PRODUCT = 'INSERT
                              INTO catalog_product_entity (
                                       entity_id,
                                       created_in,
                                       updated_in,
                                       sku,
                                       created_at,
                                       updated_at,
                                       has_options,
                                       required_options,
                                       type_id,
                                       attribute_set_id
                                   )
                            VALUES (?, ?, ?, ?, ?, ?, ?)';

    /**
     * The SQL statement to create a new product datetime value.
     *
     * @var string
     */
    const CREATE_PRODUCT_DATETIME = 'INSERT
                                       INTO catalog_product_entity_datetime (
                                                entity_id,
                                                attribute_id,
                                                store_id,
                                                value
                                            )
                                    VALUES (?, ?, ?, ?)';

    /**
     * The SQL statement to create a new product decimal value.
     *
     * @var string
     */
    const CREATE_PRODUCT_DECIMAL = 'INSERT
                                      INTO catalog_product_entity_decimal (
                                               row_id,
                                               attribute_id,
                                               store_id,
                                               value
                                           )
                                   VALUES (?, ?, ?, ?)';

    /**
     * The SQL statement to create a new product integer value.
     *
     * @var string
     */
    const CREATE_PRODUCT_INT = 'INSERT
                                  INTO catalog_product_entity_int (
                                           row_id,
                                           attribute_id,
                                           store_id,
                                           value
                                       )
                                VALUES (?, ?, ?, ?)';

    /**
     * The SQL statement to create a new product varchar value.
     *
     * @var string
     */
    const CREATE_PRODUCT_VARCHAR = 'INSERT
                                      INTO catalog_product_entity_varchar (
                                               row_id,
                                               attribute_id,
                                               store_id,
                                               value
                                           )
                                    VALUES (?, ?, ?, ?)';

    /**
     * The SQL statement to create a new product text value.
     *
     * @var string
     */
    const CREATE_PRODUCT_TEXT = 'INSERT
                                   INTO catalog_product_entity_text (
                                            row_id,
                                            attribute_id,
                                            store_id,
                                            value
                                        )
                                 VALUES (?, ?, ?, ?)';
}