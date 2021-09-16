<?php

/**
 * TechDivision\Import\Product\Ee\Observers\EeProductAttributeUpdateObserver
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

use TechDivision\Import\Product\Ee\Utils\MemberNames;
use TechDivision\Import\Ee\Observers\EeAttributeObserverTrait;
use TechDivision\Import\Product\Observers\ProductAttributeUpdateObserver;

/**
 * Observer that provides product attribute update functionality.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeProductAttributeUpdateObserver extends ProductAttributeUpdateObserver
{

    /**
     * The trait providing basic EE product attribute functionality.
     *
     * @var \TechDivision\Import\Ee\Observers\EeAttributeObserverTrait
     */
    use EeAttributeObserverTrait;

    /**
     * Initialize the category product with the passed attributes and returns an instance.
     *
     * @param array $attr The category product attributes
     *
     * @return array The initialized category product
     */
    protected function initializeAttribute(array $attr)
    {

        // try to load the attribute with the passed attribute ID and merge it with the attributes
        if (isset($this->attributes[$attributeId = (integer) $attr[MemberNames::ATTRIBUTE_ID]])) {
            return $this->mergeEntity($this->attributes[$attributeId], $attr);
        }

        // otherwise simply return the attributes
        return $attr;
    }
}
