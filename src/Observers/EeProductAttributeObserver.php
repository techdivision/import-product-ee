<?php

/**
 * TechDivision\Import\Product\Ee\Observers\EeProductAttributeObserver
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

namespace TechDivision\Import\Product\Ee\Observers;

use TechDivision\Import\Product\Observers\ProductAttributeObserver;

/**
 * A SLSB that handles the process to import product bunches.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */
class EeProductAttributeObserver extends ProductAttributeObserver
{

    /**
     * This method finally persists the passed value by invoking the
     * persist method defined by the attribute's backend type.
     *
     * @param mixed $value The value to persist
     *
     * @return void
     */
    public function processAttribute($value)
    {

        // laod the callbacks for the actual attribute code
        $callbacks = $this->getCallbacksByType($this->getAttributeCode());

        // invoke the pre-cast callbacks
        foreach ($callbacks as $callback) {
            $value = $callback->handle($value);
        }

        // load the row ID of the product that has been created recently
        $lastRowId = $this->getLastRowId();

        // load the ID of the attribute to create the values for
        $attributeId = $this->getAttributeId();

        // load the store ID
        $storeId = $this->getRowStoreId();

        // load the backend type of the actual attribute
        $backendType = $this->getBackendType();

        // cast the value based on the backend type
        $castedValue = $this->castValueByBackendType($backendType, $value);

        // prepare the attribute values
        $attribute = array($lastRowId, $attributeId, $storeId, $castedValue);

        // initialize and persist the entity attribute
        $persistMethod = $this->getPersistMethod();
        $this->$persistMethod($attribute);
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
