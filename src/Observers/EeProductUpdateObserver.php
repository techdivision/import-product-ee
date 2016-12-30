<?php

/**
 * TechDivision\Import\Product\Ee\Observers\EeProductObserver
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

/**
 * Observer that create's the product itself for the Magento 2 EE edition.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeProductUpdateObserver extends EeProductObserver
{

    /**
     * Initialize the product with the passed attributes and returns an instance.
     *
     * @param array $attr The product attributes
     *
     * @return array The initialized product
     */
    public function initializeProduct(array $attr)
    {

        // load the actual date/time
        $now = new \DateTime();

        // load the product with the passed SKU and merge it with the data
        if ($entity = $this->loadProductBySkuAndTimestamp($attr[MemberNames::SKU], $now->getTimestamp())) {
            return array_merge($entity, $attr);
        }

        // otherwise simply return the attributes
        return $attr;
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
        return $this->getSubject()->loadProductBySkuAndTimestamp($sku, $timestamp);
    }
}
