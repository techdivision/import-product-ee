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

use TechDivision\Import\Actions\UrlRewriteAction;
use TechDivision\Import\Connection\ConnectionInterface;
use TechDivision\Import\Product\Services\ProductBunchProcessor;
use TechDivision\Import\Product\Ee\Actions\SequenceProductAction;
use TechDivision\Import\Product\Ee\Repositories\ProductRepository;
use TechDivision\Import\Product\Repositories\ProductWebsiteRepository;
use TechDivision\Import\Product\Repositories\ProductDatetimeRepository;
use TechDivision\Import\Product\Repositories\ProductDecimalRepository;
use TechDivision\Import\Product\Repositories\ProductIntRepository;
use TechDivision\Import\Product\Repositories\ProductTextRepository;
use TechDivision\Import\Product\Repositories\ProductVarcharRepository;
use TechDivision\Import\Product\Repositories\CategoryProductRepository;
use TechDivision\Import\Product\Repositories\StockStatusRepository;
use TechDivision\Import\Product\Repositories\StockItemRepository;
use TechDivision\Import\Repositories\EavAttributeOptionValueRepository;
use TechDivision\Import\Repositories\EavAttributeRepository;
use TechDivision\Import\Product\Actions\CategoryProductAction;
use TechDivision\Import\Product\Actions\ProductDatetimeActionInterface;
use TechDivision\Import\Product\Actions\ProductDecimalActionInterface;
use TechDivision\Import\Product\Actions\ProductIntActionInterface;
use TechDivision\Import\Product\Actions\ProductAction;
use TechDivision\Import\Product\Actions\ProductTextActionInterface;
use TechDivision\Import\Product\Actions\ProductVarcharActionInterface;
use TechDivision\Import\Product\Actions\ProductWebsiteAction;
use TechDivision\Import\Product\Actions\StockItemAction;
use TechDivision\Import\Product\Actions\StockStatusAction;
use TechDivision\Import\Product\Assemblers\ProductAttributeAssemblerInterface;

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
     * @var \TechDivision\Import\Product\Ee\Actions\SequenceProductAction
     */
    protected $sequenceProductAction;

    /**
     * Initialize the processor with the necessary assembler and repository instances.
     *
     * @param \TechDivision\Import\Connection\ConnectionInterface                        $connection                        The connection to use
     * @param \TechDivision\Import\Product\Ee\Actions\SequenceProductAction              $sequenceProductAction             The sequence product action to use
     * @param \TechDivision\Import\Product\Ee\Repositories\ProductRepository             $productRepository                 The product repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductWebsiteRepository         $productWebsiteRepository          The product website repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductDatetimeRepository        $productDatetimeRepository         The product datetime repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductDecimalRepository         $productDecimalRepository          The product decimal repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductIntRepository             $productIntRepository              The product integer repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductTextRepository            $productTextRepository             The product text repository to use
     * @param \TechDivision\Import\Product\Repositories\ProductVarcharRepository         $productVarcharRepository          The product varchar repository to use
     * @param \TechDivision\Import\Product\Repositories\CategoryProductRepository        $categoryProductRepository         The category product repository to use
     * @param \TechDivision\Import\Product\Repositories\StockStatusRepository            $stockStatusRepository             The stock status repository to use
     * @param \TechDivision\Import\Product\Repositories\StockItemRepository              $stockItemRepository               The stock item repository to use
     * @param \TechDivision\Import\Repositories\EavAttributeOptionValueRepository        $eavAttributeOptionValueRepository The EAV attribute option value repository to use
     * @param \TechDivision\Import\Repositories\EavAttributeRepository                   $eavAttributeRepository            The EAV attribute repository to use
     * @param \TechDivision\Import\Product\Actions\CategoryProductAction                 $categoryProductAction             The category product action to use
     * @param \TechDivision\Import\Product\Actions\ProductDatetimeActionInterface        $productDatetimeAction             The product datetime action to use
     * @param \TechDivision\Import\Product\Actions\ProductDecimalActionInterface         $productDecimalAction              The product decimal action to use
     * @param \TechDivision\Import\Product\Actions\ProductIntActionInterface             $productIntAction                  The product integer action to use
     * @param \TechDivision\Import\Product\Actions\ProductAction                         $productAction                     The product action to use
     * @param \TechDivision\Import\Product\Actions\ProductTextActionInterface            $productTextAction                 The product text action to use
     * @param \TechDivision\Import\Product\Actions\ProductVarcharActioInterfacen         $productVarcharAction              The product varchar action to use
     * @param \TechDivision\Import\Product\Actions\ProductWebsiteAction                  $productWebsiteAction              The product website action to use
     * @param \TechDivision\Import\Product\Actions\StockItemAction                       $stockItemAction                   The stock item action to use
     * @param \TechDivision\Import\Product\Actions\StockStatusAction                     $stockStatusAction                 The stock status action to use
     * @param \TechDivision\Import\Actions\UrlRewriteAction                              $urlRewriteAction                  The URL rewrite action to use
     * @param \TechDivision\Import\Product\Assemblers\ProductAttributeAssemblerInterface $productAttributeAssembler         The assembler to load the product attributes with
     */
    public function __construct(
        ConnectionInterface $connection,
        SequenceProductAction $sequenceProductAction,
        ProductRepository $productRepository,
        ProductWebsiteRepository $productWebsiteRepository,
        ProductDatetimeRepository $productDatetimeRepository,
        ProductDecimalRepository $productDecimalRepository,
        ProductIntRepository $productIntRepository,
        ProductTextRepository $productTextRepository,
        ProductVarcharRepository $productVarcharRepository,
        CategoryProductRepository $categoryProductRepository,
        StockStatusRepository $stockStatusRepository,
        StockItemRepository $stockItemRepository,
        EavAttributeOptionValueRepository $eavAttributeOptionValueRepository,
        EavAttributeRepository $eavAttributeRepository,
        CategoryProductAction $categoryProductAction,
        ProductDatetimeActionInterface $productDatetimeAction,
        ProductDecimalActionInterface $productDecimalAction,
        ProductIntActionInterface $productIntAction,
        ProductAction $productAction,
        ProductTextActionInterface $productTextAction,
        ProductVarcharActionInterface $productVarcharAction,
        ProductWebsiteAction $productWebsiteAction,
        StockItemAction $stockItemAction,
        StockStatusAction $stockStatusAction,
        UrlRewriteAction $urlRewriteAction,
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
            $stockStatusRepository,
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
            $stockStatusAction,
            $urlRewriteAction,
            $productAttributeAssembler
        );
    }

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
