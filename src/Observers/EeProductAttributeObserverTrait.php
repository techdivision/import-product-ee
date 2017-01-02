<?php

/**
 * TechDivision\Import\Product\Ee\Observers\EeProductAttributeObserverTrait
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

use TechDivision\Import\Utils\StoreViewCodes;
use TechDivision\Import\Product\Ee\Utils\MemberNames;

/**
 * Trait that provides basic product attribute functionality.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
trait EeProductAttributeObserverTrait
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
}
