<?php

/**
 * TechDivision\Import\Product\Ee\Callbacks\RmaCallback
 *
 * PHP version 7
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Ee\Callbacks;

use TechDivision\Import\Product\Ee\Utils\ColumnKeys;
use TechDivision\Import\Product\Ee\Utils\RmaKeysInterface;
use TechDivision\Import\Product\Callbacks\AbstractProductImportCallback;
use TechDivision\Import\Observers\AttributeCodeAndValueAwareObserverInterface;

/**
 * A callback implementation that converts the passed RMA key.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class RmaCallback extends AbstractProductImportCallback
{

    /**
     * The utility instance with the RMA keys.
     *
     * @var \TechDivision\Import\Product\Ee\Utils\RmaKeysInterface
     */
    protected $rmaKeys;

    /**
     * Initializes the callback with the RMA keys instance.
     *
     * @param \TechDivision\Import\Product\Ee\Utils\RmaKeysInterface $rmaKeys The instance
     */
    public function __construct(RmaKeysInterface $rmaKeys)
    {
        $this->rmaKeys = $rmaKeys;
    }

    /**
     * Will be invoked by a observer it has been registered for.
     *
     * @param \TechDivision\Import\Observers\AttributeCodeAndValueAwareObserverInterface|null $observer The observer
     *
     * @return int The converted value
     */
    public function handle(AttributeCodeAndValueAwareObserverInterface $observer = null) : int
    {

        // set the observer
        $this->setObserver($observer);

        // replace the passed attribute value into the visibility ID
        return $this->getRmaKeys()->get($this->getValue(ColumnKeys::IS_RETURNABLE));
    }

    /**
     * Return's the instance with the RMA keys.
     *
     * @return \TechDivision\Import\Product\Ee\Utils\RmaKeysInterface The instance
     */
    protected function getRmaKeys() : RmaKeysInterface
    {
        return $this->rmaKeys;
    }
}
