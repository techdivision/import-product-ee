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

use TechDivision\Import\Product\Observers\ProductAttributeUpdateObserver;
use TechDivision\Import\Product\Ee\Utils\MemberNames;
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
class EeProductAttributeUpdateObserver extends ProductAttributeUpdateObserver
{

    /**
     * Prepare the attributes of the entity that has to be persisted.
     *
     * @return array The prepared attributes
     */
    public function prepareAttributes()
    {

        // load the attribute value
        $attributeValue = $this->getAttributeValue();

        // laod the callbacks for the actual attribute code
        $callbacks = $this->getCallbacksByType($this->getAttributeCode());

        // invoke the pre-cast callbacks
        foreach ($callbacks as $callback) {
            $attributeValue = $callback->handle($attributeValue);
        }

        // load the ID of the product that has been created recently
        $lastEntityId = $this->getPrimaryKey();

        // load the ID of the attribute to create the values for
        $attributeId = $this->getAttributeId();

        // load the store ID
        $storeId = $this->getRowStoreId(StoreViewCodes::ADMIN);

        // load the backend type of the actual attribute
        $backendType = $this->getBackendType();

        // cast the value based on the backend type
        $castedValue = $this->castValueByBackendType($backendType, $attributeValue);

        // prepare the attribute values
        return $this->initializeEntity(
            array(
                MemberNames::ROW_ID       => $lastEntityId,
                MemberNames::ATTRIBUTE_ID => $attributeId,
                MemberNames::STORE_ID     => $storeId,
                MemberNames::VALUE        => $castedValue
            )
        );
    }

    /**
     * Initialize the category product with the passed attributes and returns an instance.
     *
     * @param array $attr The category product attributes
     *
     * @return array The initialized category product
     */
    public function initializeAttribute(array $attr)
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
     * Return's the PK to create the product => attribute relation.
     *
     * @return integer The PK to create the relation with
     */
    public function getPrimaryKey()
    {
        return $this->getLastRowId();
    }

    /**
     * Return's the row ID of the product that has been created recently.
     *
     * @return string The row Id
     */
    public function getLastRowId()
    {
        return $this->getSubject()->getLastRowId();
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
        return  $this->getSubject()->loadProductDatetimeAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
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
        return  $this->getSubject()->loadProductDecimalAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
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
        return $this->getSubject()->loadProductIntAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
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
        return $this->getSubject()->loadProductTextAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
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
        return $this->getSubject()->loadProductVarcharAttributeByRowIdAndAttributeIdAndStoreId($rowId, $attributeId, $storeId);
    }
}
