<?php

/**
 * TechDivision\Import\Product\Ee\Callbacks\RmaValidatorCallback
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
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Ee\Callbacks;

use TechDivision\Import\Callbacks\CallbackInterface;
use TechDivision\Import\Product\Ee\Utils\RmaKeysInterface;
use TechDivision\Import\Product\Ee\Utils\ColumnKeys;

/**
 * A callback implementation that validates the passed RMA keys.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class RmaValidatorCallback implements CallbackInterface
{

    /**
     * The RMA keys utility instance.
     *
     * @var \TechDivision\Import\Product\Ee\Utils\RmaKeysInterface
     */
    protected $rmaKeys = null;

    /**
     * Initializes the callback with the RMA keys utility instance.
     *
     * @param \TechDivision\Import\Product\Ee\Utils\RmaKeysInterface $rmaKeys The RMA keys utility instance
     */
    public function __construct(RmaKeysInterface $rmaKeys)
    {
        $this->rmaKeys = $rmaKeys;
    }

    /**
     * Query whether or not the passed value IS empty and empty values are allowed.
     *
     * @param string $attributeValue The attribute value to query for
     *
     * @return boolean TRUE if empty values are allowed and the passed value IS empty
     */
    protected function isNullable($attributeValue)
    {
        return $attributeValue === '' || $attributeValue === null;
    }

    /**
     * Will be invoked by the observer it has been registered for.
     *
     * @param string|null $attributeCode  The code of the attribute that has to be validated
     * @param string|null $attributeValue The attribute value to be validated
     *
     * @return void
     * @throws \InvalidArgumentException Is thrown, if either the validator has been bound to an invalid column or an invalid value has been found
     */
    public function handle($attributeCode = null, $attributeValue = null)
    {

        // query whether or not the passed attribute code matches and the value is a valid RMA key
        if (strtolower($attributeCode) === ColumnKeys::IS_RETURNABLE && ($this->isNullable($attributeValue) || $this->rmaKeys->isValid($attributeValue))) {
            return;
        }

        // throw an exception if the validator has bound to an invalid column
        if (strtolower($attributeCode) !== ColumnKeys::IS_RETURNABLE) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Tried to bind RMA validator on invalid column "%s"',
                    $attributeCode
                )
            );
        }

        // throw an exception if the value is NOT a valid RMA key
        throw new \InvalidArgumentException(
            sprintf(
                'Found invalid RMA key "%s" for column "%s" (must be one of: "%s")',
                $attributeValue,
                $attributeCode,
                implode(', ', array_keys($this->rmaKeys->getAll()))
            )
        );
    }
}
