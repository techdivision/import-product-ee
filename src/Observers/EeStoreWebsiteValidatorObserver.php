<?php

/**
 * TechDivision\Import\Product\Ee\Observers\StoreWebsiteValidatorObserver
 *
 * PHP version 7
 *
 * @author    MET <met@techdivision.com>
 * @copyright 2024 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Ee\Observers;

use TechDivision\Import\Product\Msi\Utils\ColumnKeys;
use TechDivision\Import\Product\Observers\StoreWebsiteValidatorObserver;
use TechDivision\Import\Product\Utils\MemberNames;

/**
 * Store view validator implementation.
 *
 * @author    MET <met@techdivision.com>
 * @copyright 2024 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */
class EeStoreWebsiteValidatorObserver extends StoreWebsiteValidatorObserver
{
    /**
     * @return void
     */
    public function setLastEntityRowId($sku): void
    {
        if (!$this->hasBeenProcessed($sku)) {
            $this->entity = $this->loadProduct($sku);
            $this->setLastEntityId($this->entity[MemberNames::ROW_ID]);
            $this->lastEntityId = $this->getLastEntityId();
        }
    }
}
