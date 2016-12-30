<?php

/**
 * TechDivision\Import\Product\Ee\Observers\EeUrlRewriteUpdateObserver
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

use TechDivision\Import\Product\Observers\UrlRewriteUpdateObserver;

/**
 * Observer that creates/updates the product's URL rewrites for the Magento 2 EE edition.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeUrlRewriteUpdateObserver extends UrlRewriteUpdateObserver
{

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
