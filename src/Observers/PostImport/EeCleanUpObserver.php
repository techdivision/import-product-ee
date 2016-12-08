<?php

/**
 * TechDivision\Import\Product\Ee\Observers\PostImport\EeCleanUpObserver
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

namespace TechDivision\Import\Product\Ee\Observers\PostImport;

use TechDivision\Import\Product\Utils\ColumnKeys;
use TechDivision\Import\Product\Observers\PostImport\CleanUpObserver;

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
     * {@inheritDoc}
     * @see \Importer\Csv\Actions\Listeners\Row\ListenerInterface::handle()
     */
    public function handle(array $row)
    {

        // load the header information
        $headers = $this->getHeaders();

        // add the SKU => entity ID mapping
        $this->addSkuRowIdMapping($sku = $row[$headers[ColumnKeys::SKU]]);

        // invoke the parent method
        return parent::handle($row);
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
        $this->getSubject()->addSkuRowIdMapping($sku);
    }
}
