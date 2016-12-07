<?php

/**
 * TechDivision\Import\Product\Ee\Services\ProductProcessor
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

namespace TechDivision\Import\Product\Ee\Services;

use TechDivision\Import\Product\Services\ProductProcessor;

/**
 * A SLSB providing methods to load sequence product data using a PDO connection.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */
class EeProductProcessor extends ProductProcessor implements EeProductProcessorInterface
{

    /**
     * The action for sequence product CRUD methods.
     *
     * @var \TechDivision\Import\Product\Ee\Actions\SequenceProductAction
     */
    protected $sequenceProductAction;

    /**
     * Set's the action with the sequence product CRUD methods.
     *
     * @param \TechDivision\Import\Product\Ee\Actions\SequenceProductAction $sequenceProductAction The action with the sequence product CRUD methods
     *
     * @return void
     */
    public function setSequenceProductAction($sequenceProductAction)
    {
        $this->sequenceProductAction = $sequenceProductAction;
    }

    /**
     * Return's the action with the sequence product CRUD methods.
     *
     * @return \TechDivision\Import\Product\Ee\Actions\SequenceProductAction The action instance
     */
    public function getSequenceProductAction()
    {
        return $this->sequenceProductAction;
    }


    /**
     * Return's the next available product entity ID.
     *
     * @return integer The next available product entity ID
     */
    public function nextIdentifier()
    {
        return $this->getSequenceProductAction()->nextIdentifier();
    }
}
