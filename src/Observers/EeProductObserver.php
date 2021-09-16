<?php

/**
 * TechDivision\Import\Product\Ee\Observers\EeProductObserver
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

use TechDivision\Import\Ee\Utils\SqlConstants;
use TechDivision\Import\Utils\EntityStatus;
use TechDivision\Import\Product\Ee\Utils\MemberNames;
use TechDivision\Import\Product\Observers\ProductObserver;

/**
 * Observer that create's the product itself for the Magento 2 EE edition.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeProductObserver extends ProductObserver
{

    /**
     * Merge's and return's the entity with the passed attributes and set's the
     * passed status.
     *
     * @param array       $entity        The entity to merge the attributes into
     * @param array       $attr          The attributes to be merged
     * @param string|null $changeSetName The change set name to use
     *
     * @return array The merged entity
     */
    protected function mergeEntity(array $entity, array $attr, $changeSetName = null)
    {

        // temporary persist the entity and row ID
        $this->setLastRowId($entity[MemberNames::ROW_ID]);
        $this->setLastEntityId($entity[MemberNames::ENTITY_ID]);

        // merge and return the entity
        return parent::mergeEntity($entity, $attr, $changeSetName);
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

        // initialize the product attributes
        $attr = parent::initializeProduct($attr);

        // query whether or not, we found a new product
        if ($attr[EntityStatus::MEMBER_NAME] === EntityStatus::STATUS_CREATE) {
            // if yes, initialize the additional Magento 2 EE product values
            $additionalAttr = array(
                MemberNames::ENTITY_ID  => $this->nextIdentifier(),
                MemberNames::CREATED_IN => 1,
                MemberNames::UPDATED_IN => SqlConstants::MAX_UNIXTIMESTAMP
            );

            // merge and return the attributes
            $attr = array_merge($attr, $additionalAttr);
        }

        // otherwise simply return the attributes
        return $attr;
    }

    /**
     * Persist's the passed product data.
     *
     * @param array $product The product data to persist
     *
     * @return void
     */
    protected function persistProduct($product)
    {
        // persist the entity and set the entity ID, SKU and attribute set
        $this->setLastRowId($this->getProductBunchProcessor()->persistProduct($product));
        $this->setLastEntityId($product[MemberNames::ENTITY_ID]);
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
        return $this->getProductBunchProcessor()->nextIdentifier();
    }
}
