<?php

/**
 * TechDivision\Import\Product\Ee\Services\EeProductBunchProcessor
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

namespace TechDivision\Import\Product\Ee\Services;

use TechDivision\Import\Product\Services\ProductBunchProcessor;
use TechDivision\Import\Product\Ee\Utils\MemberNames;

/**
 * A SLSB providing methods to load sequence product data using a PDO connection.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeProductBunchProcessor extends ProductBunchProcessor implements EeProductBunchProcessorInterface
{

    /**
     * The action for sequence product CRUD methods.
     *
     * @var \TechDivision\Import\Product\Ee\Actions\SequenceProductAction
     */
    protected $sequenceProductAction;

    /**
     * Set's the action with the sequence product CRUD methods.
     *
     * @param \TechDivision\Import\Product\Ee\Actions\SequenceProductAction $sequenceProductAction The action with the sequence product CRUD methods
     *
     * @return void
     */
    public function setSequenceProductAction($sequenceProductAction)
    {
        $this->sequenceProductAction = $sequenceProductAction;
    }

    /**
     * Return's the action with the sequence product CRUD methods.
     *
     * @return \TechDivision\Import\Product\Ee\Actions\SequenceProductAction The action instance
     */
    public function getSequenceProductAction()
    {
        return $this->sequenceProductAction;
    }

    /**
     * Return's the next available product entity ID.
     *
     * @return integer The next available product entity ID
     */
    public function nextIdentifier()
    {
        return $this->getSequenceProductAction()->nextIdentifier();
    }

    /**
     * Return's the product with the passed SKU and for the also passed timestamp.
     *
     * @param string  $sku       The SKU of the product to return
     * @param integer $timestamp The timestamp to find the matching scheduled update
     *
     * @return array The product
     */
    public function loadProductBySkuAndTimestamp($sku, $timestamp)
    {
        return $this->getProductRepository()->findOneBySkuAndTimestamp($sku, $timestamp);
    }

    /**
     * Load's and return's the datetime attribute with the passed row/attribute/store ID.
     *
     * @param integer $row         The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The datetime attribute
     */
    public function loadProductDatetimeAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return  $this->getProductDatetimeRepository()->findOneByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }

    /**
     * Load's and return's the decimal attribute with the passed row/attribute/store ID.
     *
     * @param integer $row         The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The decimal attribute
     */
    public function loadProductDecimalAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return  $this->getProductDecimalRepository()->findOneByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }

    /**
     * Load's and return's the integer attribute with the passed row/attribute/store ID.
     *
     * @param integer $row         The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The integer attribute
     */
    public function loadProductIntAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return $this->getProductIntRepository()->findOneByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }

    /**
     * Load's and return's the text attribute with the passed row/attribute/store ID.
     *
     * @param integer $row         The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The text attribute
     */
    public function loadProductTextAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return $this->getProductTextRepository()->findOneByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }

    /**
     * Load's and return's the varchar attribute with the passed row/attribute/store ID.
     *
     * @param integer $row         The row ID of the attribute
     * @param integer $attributeId The attribute ID of the attribute
     * @param integer $storeId     The store ID of the attribute
     *
     * @return array|null The varchar attribute
     */
    public function loadProductVarcharAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return $this->getProductVarcharRepository()->findOneByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }
}
