<?php

/**
 * TechDivision\Import\Product\Observers\LastEntityAndRowIdObserver
 *
 * PHP version 7
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2019 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Ee\Observers;

use TechDivision\Import\Product\Ee\Utils\MemberNames;
use TechDivision\Import\Product\Observers\GenericSkuEntityIdMappingObserver;

/**
 * A generic oberserver implementation that provides functionality to add the SKU => entity/row ID
 * mapping for products that has not yet been processed or are NOT part of the actual CSV file.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2019 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class GenericSkuRowIdMappingObserver extends GenericSkuEntityIdMappingObserver
{

    /**
     * Map the PK for the product with the passed SKU.
     *
     * @param array $product The product to add the SKU => entity ID mapping for
     *
     * @return void
     */
    protected function addSkuPkMapping(array $product)
    {

        // invoke the parent method (add the SKU => entity ID mapping)
        parent::addSkuPkMapping($product);

        // additionally add the SKU => row ID mapping
        $this->addSkuRowIdMapping($product[MemberNames::SKU], $product[MemberNames::ROW_ID]);
    }

    /**
     * Add the passed SKU => row ID mapping.
     *
     * @param string       $sku   The SKU
     * @param integer|null $rowId The optional entity ID, the last processed entity ID is used, if not set
     *
     * @return void
     */
    protected function addSkuRowIdMapping($sku, $rowId = null)
    {
        $this->getSubject()->addSkuRowIdMapping($sku, $rowId);
    }
}
