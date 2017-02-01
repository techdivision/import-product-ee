<?php

/**
 * TechDivision\Import\Product\Ee\Observers\EeProductAttributeUpdateObserver
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

namespace TechDivision\Import\Product\Ee\Observers;

use TechDivision\Import\Product\Ee\Utils\MemberNames;
use TechDivision\Import\Product\Observers\ProductAttributeUpdateObserver;

/**
 * Observer that provides product attribute update functionality.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeProductAttributeUpdateObserver extends ProductAttributeUpdateObserver
{

    /**
     * The trait providing basic EE product attribute functionality.
     *
     * @var \TechDivision\Import\Product\Ee\Observers\EeProductAttributeObserverTrait
     */
    use EeProductAttributeObserverTrait;

    /**
     * Initialize the category product with the passed attributes and returns an instance.
     *
     * @param array $attr The category product attributes
     *
     * @return array The initialized category product
     */
    protected function initializeAttribute(array $attr)
    {

        // load the supported backend types
        $backendTypes = $this->getBackendTypes();

        // initialize the persist method for the found backend type
        list (, $loadMethod) = $backendTypes[$this->getBackendType()];

        // load row/store/attribute ID
        $rowId = $attr[MemberNames::ROW_ID];
        $storeId = $attr[MemberNames::STORE_ID];
        $attributeId = $attr[MemberNames::ATTRIBUTE_ID];

        // try to load the attribute with the passed row/attribute/store ID
        // and merge it with the attributes
        if ($entity = $this->$loadMethod($rowId, $attributeId, $storeId)) {
            return $this->mergeEntity($entity, $attr);
        }

        // otherwise simply return the attributes
        return $attr;
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
    protected function loadProductDatetimeAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return  $this->getSubject()->loadProductDatetimeAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
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
    protected function loadProductDecimalAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return  $this->getSubject()->loadProductDecimalAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
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
    protected function loadProductIntAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return $this->getSubject()->loadProductIntAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
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
    protected function loadProductTextAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return $this->getSubject()->loadProductTextAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
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
    protected function loadProductVarcharAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId)
    {
        return $this->getSubject()->loadProductVarcharAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }
}
