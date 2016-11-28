<?php

/**
 * TechDivision\Import\Product\Services\ProductProcessorFactory
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

use TechDivision\Import\ConfigurationInterface;
use TechDivision\Import\Product\Services\ProductProcessorFactory;
use TechDivision\Import\Product\Ee\Actions\Processors\SequenceProductPersistProcessor;
use TechDivision\Import\Product\Ee\Actions\SequenceProductAction;

/**
 * A SLSB providing methods to load product data using a PDO connection.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */
class EeProductProcessorFactory extends ProductProcessorFactory
{

    /**
     * Return's the processor instance.
     *
     * @return object The processor instance
     */
    protected static newProcessor()
    {
        return new EeProductProcessor::class();
    }

    /**
     * Factory method to create a new product processor instance.
     *
     * @param \PDO                                       $connection    The PDO connection to use
     * @param TechDivision\Import\ConfigurationInterface $configuration The subject configuration
     *
     * @return \TechDivision\Import\Product\Services\ProductProcessor The processor instance
     */
    public function factory(\PDO $connection, ConfigurationInterface $configuration)
    {

        // initialize the product processor
        $productProcessor = parent::factory($connection, $configuration);

        // initialize the action that provides sequence product CRUD functionality
        $sequenceProductPersistProcessor = new SequenceProductPersistProcessor()PersistProcessor();
        $sequenceProductPersistProcessor->setMagentoEdition($magentoEdition);
        $sequenceProductPersistProcessor->setMagentoVersion($magentoVersion);
        $sequenceProductPersistProcessor->setConnection($connection);
        $sequenceProductPersistProcessor->init();
        $sequenceProductAction = new SequenceProductAction();
        $sequenceProductAction->setPersistProcessor($sequenceProductPersistProcessor);

        // initialize the product processor
        $productProcessor->setSequenceProductAction($sequenceProductAction);

        // return the instance
        return $productProcessor;
    }
}
