<?php

/**
 * TechDivision\Import\Product\Ee\Actions\SequenceProductAction
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */

namespace TechDivision\Import\Product\Ee\Actions;

use TechDivision\Import\Actions\AbstractAction;

/**
 * A SLSB providing repository functionality for sequence product CRUD actions.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */
class SequenceProductAction extends AbstractAction
{

    /**
     * Persist's the passed row.
     *
     * @param array $row The row to persist
     *
     * @return string The last inserted ID
     */
    public function persist($row)
    {
        return $this->getPersistProcessor()->execute($row);
    }

    /**
     * Remove's the entity with the passed attributes.
     *
     * @param array $row The attributes of the entity to remove
     *
     * @return void
     */
    public function remove($row)
    {
        return $this->getRemoveProcessor()->execute($row);
    }

    /**
     * Return's the next available sequence product value.
     *
     * @return integer The next available sequence product value
     */
    public function nextIdentifier()
    {
        return $this->getPersistProcessor()->execute(array());
    }
}
