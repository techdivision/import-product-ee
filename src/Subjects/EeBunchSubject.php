<?php

/**
 * TechDivision\Import\Product\Ee\Subjects\BunchHandler
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

namespace TechDivision\Import\Product\Ee\Subjects;

use TechDivision\Import\Utils\RegistryKeys;
use TechDivision\Import\Product\Subjects\BunchSubject;

/**
 * A SLSB that handles the process to import product bunches.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeBunchSubject extends BunchSubject
{

    /**
     * The row ID of the product that has been created recently.
     *
     * @var integer
     */
    protected $lastRowId;

    /**
     * The mapping for the SKUs to the created row IDs.
     *
     * @var array
     */
    protected $skuRowIdMapping = array();

    /**
     * The mapping for the supported backend types (for the product entity) => persist methods.
     *
     * @var array
     */
    protected $backendTypes = array(
        'datetime' => array('persistProductDatetimeAttribute', 'loadProductDatetimeAttributeByRowIdAndAttributeIdAndStoreId'),
        'decimal'  => array('persistProductDecimalAttribute', 'loadProductDecimalAttributeByRowIdAndAttributeIdAndStoreId'),
        'int'      => array('persistProductIntAttribute', 'loadProductIntAttributeByRowIdAndAttributeIdAndStoreId'),
        'text'     => array('persistProductTextAttribute', 'loadProductTextAttributeByRowIdAndAttributeIdAndStoreId'),
        'varchar'  => array('persistProductVarcharAttribute', 'loadProductVarcharAttributeByRowIdAndAttributeIdAndStoreId')
    );

    /**
     * Mappings for the table column => CSV column header.
     *
     * @var array
     */
    protected $headerStockMappings = array(
        'qty'                              => array('qty', 'float'),
        'min_qty'                          => array('out_of_stock_qty', 'float'),
        'use_config_min_qty'               => array('use_config_min_qty', 'int'),
        'is_qty_decimal'                   => array('is_qty_decimal', 'int'),
        'backorders'                       => array('allow_backorders', 'int'),
        'use_config_backorders'            => array('use_config_backorders', 'int'),
        'min_sale_qty'                     => array('min_cart_qty', 'float'),
        'use_config_min_sale_qty'          => array('use_config_min_sale_qty', 'int'),
        'max_sale_qty'                     => array('max_cart_qty', 'float'),
        'use_config_max_sale_qty'          => array('use_config_max_sale_qty', 'int'),
        'is_in_stock'                      => array('is_in_stock', 'int'),
        'notify_stock_qty'                 => array('notify_on_stock_below', 'float'),
        'use_config_notify_stock_qty'      => array('use_config_notify_stock_qty', 'int'),
        'manage_stock'                     => array('manage_stock', 'int'),
        'use_config_manage_stock'          => array('use_config_manage_stock', 'int'),
        'use_config_qty_increments'        => array('use_config_qty_increments', 'int'),
        'qty_increments'                   => array('qty_increments', 'float'),
        'use_config_enable_qty_inc'        => array('use_config_enable_qty_inc', 'int'),
        'enable_qty_increments'            => array('enable_qty_increments', 'int'),
        'is_decimal_divided'               => array('is_decimal_divided', 'int'),
        'deferred_stock_update'            => array('deferred_stock_update', 'int'),
        'use_config_deferred_stock_update' => array('use_config_deferred_stock_update', 'int'),
    );

    /**
     * Clean up the global data after importing the bunch.
     *
     * @return void
     */
    public function tearDown()
    {

        // call parent method
        parent::tearDown();

        // load the registry processor
        $registryProcessor = $this->getRegistryProcessor();

        // update the status up the actual import with SKU => row ID mapping
        $registryProcessor->mergeAttributesRecursive($this->serial, array(RegistryKeys::SKU_ROW_ID_MAPPING => $this->skuRowIdMapping));
    }

    /**
     * Set's the row ID of the product that has been created recently.
     *
     * @param string $lastRowId The row ID
     *
     * @return void
     */
    public function setLastRowId($lastRowId)
    {
        $this->lastRowId = $lastRowId;
    }

    /**
     * Return's the row ID of the product that has been created recently.
     *
     * @return string The row Id
     */
    public function getLastRowId()
    {
        return $this->lastRowId;
    }

    /**
     * Add the passed SKU => row ID mapping.
     *
     * @param string $sku The SKU
     *
     * @return void
     */
    public function addSkuRowIdMapping($sku)
    {
        $this->skuRowIdMapping[$sku] = $this->getLastRowId();
    }

    /**
     * Return's the product rows with the passed SKU.
     *
     * @param string $sku The SKU of the product rows to return
     *
     * @return array The product rows
     */
    public function getProductRowsBySku($sku)
    {
        return $this->getProductProcessor()->getProductRowsBySku($sku);
    }

    /**
     * Return's the next available product entity ID.
     *
     * @return integer The next available product entity ID
     */
    public function nextIdentifier()
    {
        return $this->getProductProcessor()->nextIdentifier();
    }

    /**
     * Load's and return's the product with the passed SKU and timestamp.
     *
     * @param string  $sku       The SKU of the product to return
     * @param integer $timestamp The timestamp to find the matching scheduled update
     *
     * @return array The product
     */
    public function loadProductBySkuAndTimestamp($sku, $timestamp)
    {
        return $this->getProductProcessor()->loadProductBySkuAndTimestamp($sku, $timestamp);
    }

    /**
     * Load's and return's the datetime attribute with the passed row/attribute/store ID.
     *
     * @param integer $rowId       The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The datetime attribute
     */
    public function loadProductDatetimeAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return  $this->getProductProcessor()->loadProductDatetimeAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }

    /**
     * Load's and return's the decimal attribute with the passed row/attribute/store ID.
     *
     * @param integer $rowId       The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The decimal attribute
     */
    public function loadProductDecimalAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return  $this->getProductProcessor()->loadProductDecimalAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }

    /**
     * Load's and return's the integer attribute with the passed row/attribute/store ID.
     *
     * @param integer $rowId       The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The integer attribute
     */
    public function loadProductIntAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return $this->getProductProcessor()->loadProductIntAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }

    /**
     * Load's and return's the text attribute with the passed row/attribute/store ID.
     *
     * @param integer $rowId       The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The text attribute
     */
    public function loadProductTextAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return $this->getProductProcessor()->loadProductTextAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }

    /**
     * Load's and return's the varchar attribute with the passed row/attribute/store ID.
     *
     * @param integer $rowId       The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The varchar attribute
     */
    public function loadProductVarcharAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return $this->getProductProcessor()->loadProductVarcharAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }
}
