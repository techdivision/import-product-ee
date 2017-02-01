<?php

/**
 * TechDivision\Import\Product\Ee\Observers\EeCleanUpObserver
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

use TechDivision\Import\Product\Utils\ColumnKeys;
use TechDivision\Import\Product\Observers\CleanUpObserver;

/**
 * A SLSB that handles the process to import product bunches.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeCleanUpObserver extends CleanUpObserver
{

    /**
     * Process the observer's business logic.
     *
     * @return array The processed row
     */
    protected function process()
    {

        // add the SKU => entity ID mapping
        $this->addSkuRowIdMapping($this->getValue(ColumnKeys::SKU));

        // invoke the parent method
        parent::process();
    }

    /**
     * Add the passed SKU => row ID mapping.
     *
     * @param string $sku The SKU
     *
     * @return void
     */
    protected function addSkuRowIdMapping($sku)
    {
        $this->getSubject()->addSkuRowIdMapping($sku);
    }
}
