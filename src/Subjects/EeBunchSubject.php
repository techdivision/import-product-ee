<?php

/**
 * TechDivision\Import\Product\Ee\Subjects\EeBunchSubject
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
use TechDivision\Import\Product\Ee\Utils\MemberNames;
use TechDivision\Import\Product\Subjects\BunchSubject;
use TechDivision\Import\Utils\StoreViewCodes;

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
        'datetime' => array('persistDatetimeAttribute', 'loadProductDatetimeAttributeByRowIdAndAttributeIdAndStoreId'),
        'decimal'  => array('persistDecimalAttribute', 'loadProductDecimalAttributeByRowIdAndAttributeIdAndStoreId'),
        'int'      => array('persistIntAttribute', 'loadProductIntAttributeByRowIdAndAttributeIdAndStoreId'),
        'text'     => array('persistTextAttribute', 'loadProductTextAttributeByRowIdAndAttributeIdAndStoreId'),
        'varchar'  => array('persistVarcharAttribute', 'loadProductVarcharAttributeByRowIdAndAttributeIdAndStoreId')
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
     * Return's TRUE, if the passed URL key varchar value IS related with the actual PK.
     *
     * @param array $productVarcharAttribute The varchar value to check
     *
     * @return boolean TRUE if the URL key is related, else FALSE
     */
    public function isUrlKeyOf(array $productVarcharAttribute)
    {
        return ((integer) $productVarcharAttribute[MemberNames::ROW_ID] === (integer) $this->getLastRowId()) &&
               ((integer) $productVarcharAttribute[MemberNames::STORE_ID] === (integer) $this->getRowStoreId(StoreViewCodes::ADMIN));
    }

    /**
     * Clean up the global data after importing the bunch.
     *
     * @param string $serial The serial of the actual import
     *
     * @return void
     */
    public function tearDown($serial)
    {

        // call parent method
        parent::tearDown($serial);

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
}
