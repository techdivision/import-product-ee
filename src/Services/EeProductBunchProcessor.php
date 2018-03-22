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

use TechDivision\Import\Connection\ConnectionInterface;
use TechDivision\Import\Actions\UrlRewriteActionInterface;
use TechDivision\Import\Repositories\EavAttributeRepositoryInterface;
use TechDivision\Import\Repositories\EavAttributeOptionValueRepositoryInterface;
use TechDivision\Import\Product\Services\ProductBunchProcessor;
use TechDivision\Import\Product\Actions\ProductActionInterface;
use TechDivision\Import\Product\Actions\StockItemActionInterface;
use TechDivision\Import\Product\Actions\ProductIntActionInterface;
use TechDivision\Import\Product\Actions\ProductTextActionInterface;
use TechDivision\Import\Product\Actions\ProductDecimalActionInterface;
use TechDivision\Import\Product\Actions\ProductVarcharActionInterface;
use TechDivision\Import\Product\Actions\ProductWebsiteActionInterface;
use TechDivision\Import\Product\Actions\CategoryProductActionInterface;
use TechDivision\Import\Product\Actions\ProductDatetimeActionInterface;
use TechDivision\Import\Product\Ee\Actions\SequenceProductActionInterface;
use TechDivision\Import\Product\Ee\Repositories\ProductRepositoryInterface;
use TechDivision\Import\Product\Assemblers\ProductAttributeAssemblerInterface;
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
     * @param \TechDivision\Import\Product\Ee\Repositories\ProductRepositoryInterface      $productRepository                 The product repository to use
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
     * @param \TechDivision\Import\Product\Actions\CategoryProductActionInterface          $categoryProductAction             The category product action to use
     * @param \TechDivision\Import\Product\Actions\ProductDatetimeActionInterface          $productDatetimeAction             The product datetime action to use
     * @param \TechDivision\Import\Product\Actions\ProductDecimalActionInterface           $productDecimalAction              The product decimal action to use
     * @param \TechDivision\Import\Product\Actions\ProductIntActionInterface               $productIntAction                  The product integer action to use
     * @param \TechDivision\Import\Product\Actions\ProductActionInterface                  $productAction                     The product action to use
     * @param \TechDivision\Import\Product\Actions\ProductTextActionInterface              $productTextAction                 The product text action to use
     * @param \TechDivision\Import\Product\Actions\ProductVarcharActionInterface           $productVarcharAction              The product varchar action to use
     * @param \TechDivision\Import\Product\Actions\ProductWebsiteActionInterface           $productWebsiteAction              The product website action to use
     * @param \TechDivision\Import\Product\Actions\StockItemActionInterface                $stockItemAction                   The stock item action to use
     * @param \TechDivision\Import\Actions\UrlRewriteActionInterface                       $urlRewriteAction                  The URL rewrite action to use
     * @param \TechDivision\Import\Product\Assemblers\ProductAttributeAssemblerInterface   $productAttributeAssembler         The assembler to load the product attributes with
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
        CategoryProductActionInterface $categoryProductAction,
        ProductDatetimeActionInterface $productDatetimeAction,
        ProductDecimalActionInterface $productDecimalAction,
        ProductIntActionInterface $productIntAction,
        ProductActionInterface $productAction,
        ProductTextActionInterface $productTextAction,
        ProductVarcharActionInterface $productVarcharAction,
        ProductWebsiteActionInterface $productWebsiteAction,
        StockItemActionInterface $stockItemAction,
        UrlRewriteActionInterface $urlRewriteAction,
        ProductAttributeAssemblerInterface $productAttributeAssembler
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
            $productAttributeAssembler
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
