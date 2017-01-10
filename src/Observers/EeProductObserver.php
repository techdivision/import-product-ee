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
use TechDivision\Import\Product\Observers\ProductObserver;

/**
 * Observer that create's the product itself for the Magento 2 EE edition.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeProductObserver extends ProductObserver
{

    /**
     * Process the observer's business logic.
     *
     * @return array The processed row
     */
    protected function process()
    {

        // prepare the static entity values
        $product = $this->initializeProduct($this->prepareAttributes());

        // insert the entity and set the entity ID, SKU and attribute set
        $this->setLastRowId($this->persistProduct($product));
        $this->setLastEntityId($product[MemberNames::ENTITY_ID]);
    }

    /**
     * Initialize the product with the passed attributes and returns an instance.
     *
     * @param array $attr The product attributes
     *
     * @return array The initialized product
     */
    protected function initializeProduct(array $attr)
    {

        // initialize the addtional Magento 2 EE product values
        $additionalAttr = array(
            MemberNames::ENTITY_ID  => $this->nextIdentifier(),
            MemberNames::CREATED_IN => 1,
            MemberNames::UPDATED_IN => strtotime('+20 years')
        );

        // merge and return the attributes
        return array_merge($attr, $additionalAttr);
    }

    /**
     * Set's the row ID of the product that has been created recently.
     *
     * @param string $rowId The row ID
     *
     * @return void
     */
    protected function setLastRowId($rowId)
    {
        $this->getSubject()->setLastRowId($rowId);
    }

    /**
     * Return's the next available product entity ID.
     *
     * @return integer The next available product entity ID
     */
    protected function nextIdentifier()
    {
        return $this->getSubject()->nextIdentifier();
    }
}
