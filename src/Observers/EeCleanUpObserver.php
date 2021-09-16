<?php

/**
 * TechDivision\Import\Product\Ee\Observers\EeCleanUpObserver
 *
 * PHP version 7
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
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
 * @license   https://opensource.org/licenses/MIT
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
