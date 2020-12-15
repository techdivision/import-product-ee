<?php

/**
 * TechDivision\Import\Product\Ee\Services\EeProductBunchProcessor
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

namespace TechDivision\Import\Product\Ee\Services;

use TechDivision\Import\Loaders\LoaderInterface;
use TechDivision\Import\Actions\ActionInterface;
use TechDivision\Import\Connection\ConnectionInterface;
use TechDivision\Import\Repositories\UrlRewriteRepositoryInterface;
use TechDivision\Import\Repositories\EavAttributeRepositoryInterface;
use TechDivision\Import\Repositories\EavEntityTypeRepositoryInterface;
use TechDivision\Import\Repositories\EavAttributeOptionValueRepositoryInterface;
use TechDivision\Import\Product\Services\ProductBunchProcessor;
use TechDivision\Import\Product\Ee\Actions\SequenceProductActionInterface;
use TechDivision\Import\Product\Assemblers\ProductAttributeAssemblerInterface;
use TechDivision\Import\Product\Repositories\ProductRepositoryInterface;
use TechDivision\Import\Product\Repositories\StockItemRepositoryInterface;
use TechDivision\Import\Product\Repositories\ProductIntRepositoryInterface;
use TechDivision\Import\Product\Repositories\ProductTextRepositoryInterface;
use TechDivision\Import\Product\Repositories\ProductDecimalRepositoryInterface;
use TechDivision\Import\Product\Repositories\ProductWebsiteRepositoryInterface;
use TechDivision\Import\Product\Repositories\ProductDatetimeRepositoryInterface;
use TechDivision\Import\Product\Repositories\ProductVarcharRepositoryInterface;
use TechDivision\Import\Product\Repositories\CategoryProductRepositoryInterface;

/**
 * A SLSB providing methods to load sequence product data using a PDO connection.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class EeProductBunchProcessor extends ProductBunchProcessor implements EeProductBunchProcessorInterface
{

    /**
     * The action for sequence product CRUD methods.
     *
     * @var \TechDivision\Import\Product\Ee\Actions\SequenceProductActionInterface
     */
    protected $sequenceProductAction;

    /**
     * Initialize the processor with the necessary assembler and repository instances.
     *
     * @param \TechDivision\Import\Connection\ConnectionInterface                          $connection                        The connection to use
     * @param \TechDivision\Import\Product\Ee\Actions\SequenceProductActionInterface       $sequenceProductAction             The sequence product action to use
     * @param \TechDivision\Import\Product\Repositories\ProductRepositoryInterface         $productRepository                 The product repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductWebsiteRepositoryInterface  $productWebsiteRepository          The product website repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductDatetimeRepositoryInterface $productDatetimeRepository         The product datetime repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductDecimalRepositoryInterface  $productDecimalRepository          The product decimal repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductIntRepositoryInterface      $productIntRepository              The product integer repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductTextRepositoryInterface     $productTextRepository             The product text repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductVarcharRepositoryInterface  $productVarcharRepository          The product varchar repository to use
     * @param \TechDivision\Import\Product\Repositories\CategoryProductRepositoryInterface $categoryProductRepository         The category product repository to use
     * @param \TechDivision\Import\Product\Repositories\StockItemRepositoryInterface       $stockItemRepository               The stock item repository to use
     * @param \TechDivision\Import\Repositories\EavAttributeOptionValueRepositoryInterface $eavAttributeOptionValueRepository The EAV attribute option value repository to use
     * @param \TechDivision\Import\Repositories\EavAttributeRepositoryInterface            $eavAttributeRepository            The EAV attribute repository to use
     * @param \TechDivision\Import\Repositories\EavEntityTypeRepositoryInterface           $eavEntityTypeRepository           The EAV entity type repository to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $categoryProductAction             The category product action to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $productDatetimeAction             The product datetime action to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $productDecimalAction              The product decimal action to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $productIntAction                  The product integer action to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $productAction                     The product action to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $productTextAction                 The product text action to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $productVarcharAction              The product varchar action to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $productWebsiteAction              The product website action to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $stockItemAction                   The stock item action to use
     * @param \TechDivision\Import\Actions\ActionInterface                                 $urlRewriteAction                  The URL rewrite action to use
     * @param \TechDivision\Import\Product\Assemblers\ProductAttributeAssemblerInterface   $productAttributeAssembler         The assembler to load the product attributes with
     * @param \TechDivision\Import\Loaders\LoaderInterface                                 $rawEntityLoader                   The raw entity loader instance
     * @param \TechDivision\Import\Repositories\UrlRewriteRepositoryInterface              $urlRewriteRepository              The URL rewrite repository to use
     */
    public function __construct(
        ConnectionInterface $connection,
        SequenceProductActionInterface $sequenceProductAction,
        ProductRepositoryInterface $productRepository,
        ProductWebsiteRepositoryInterface $productWebsiteRepository,
        ProductDatetimeRepositoryInterface $productDatetimeRepository,
        ProductDecimalRepositoryInterface $productDecimalRepository,
        ProductIntRepositoryInterface $productIntRepository,
        ProductTextRepositoryInterface $productTextRepository,
        ProductVarcharRepositoryInterface $productVarcharRepository,
        CategoryProductRepositoryInterface $categoryProductRepository,
        StockItemRepositoryInterface $stockItemRepository,
        EavAttributeOptionValueRepositoryInterface $eavAttributeOptionValueRepository,
        EavAttributeRepositoryInterface $eavAttributeRepository,
        EavEntityTypeRepositoryInterface $eavEntityTypeRepository,
        ActionInterface $categoryProductAction,
        ActionInterface $productDatetimeAction,
        ActionInterface $productDecimalAction,
        ActionInterface $productIntAction,
        ActionInterface $productAction,
        ActionInterface $productTextAction,
        ActionInterface $productVarcharAction,
        ActionInterface $productWebsiteAction,
        ActionInterface $stockItemAction,
        ActionInterface $urlRewriteAction,
        ProductAttributeAssemblerInterface $productAttributeAssembler,
        LoaderInterface $rawEntityLoader,
        UrlRewriteRepositoryInterface $urlRewriteRepository
    ) {

        // set the sequence product action
        $this->setSequenceProductAction($sequenceProductAction);

        // call parent constructor
        parent::__construct(
            $connection,
            $productRepository,
            $productWebsiteRepository,
            $productDatetimeRepository,
            $productDecimalRepository,
            $productIntRepository,
            $productTextRepository,
            $productVarcharRepository,
            $categoryProductRepository,
            $stockItemRepository,
            $eavAttributeOptionValueRepository,
            $eavAttributeRepository,
            $eavEntityTypeRepository,
            $categoryProductAction,
            $productDatetimeAction,
            $productDecimalAction,
            $productIntAction,
            $productAction,
            $productTextAction,
            $productVarcharAction,
            $productWebsiteAction,
            $stockItemAction,
            $urlRewriteAction,
            $productAttributeAssembler,
            $rawEntityLoader,
            $urlRewriteRepository
        );
    }

    /**
     * Set's the action with the sequence product CRUD methods.
     *
     * @param \TechDivision\Import\Product\Ee\Actions\SequenceProductActionInterface $sequenceProductAction The action with the sequence product CRUD methods
     *
     * @return void
     */
    public function setSequenceProductAction(SequenceProductActionInterface $sequenceProductAction)
    {
        $this->sequenceProductAction = $sequenceProductAction;
    }

    /**
     * Return's the action with the sequence product CRUD methods.
     *
     * @return \TechDivision\Import\Product\Ee\Actions\SequenceProductActionInterface The action instance
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
