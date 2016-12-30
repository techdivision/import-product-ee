<?php

/**
 * TechDivision\Import\Product\Ee\Repositories\ProductRepository
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

namespace TechDivision\Import\Product\Ee\Repositories;

use TechDivision\Import\Repositories\AbstractRepository;

/**
 * Repository implementation to load URL rewrite data.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class ProductRepository extends \TechDivision\Import\Product\Repositories\ProductRepository
{

    /**
     * The prepared statement to load an existing product with the passed SKU for the also passed timestamp.
     *
     * @var \PDOStatement
     */
    protected $productBySkuAndTimestampStmt;

    /**
     * Initializes the repository's prepared statements.
     *
     * @return void
     */
    public function init()
    {

        // load the utility class name
        $utilityClassName = $this->getUtilityClassName();

        // initialize the prepared statements
        $this->productBySkuAndTimestampStmt = $this->getConnection()->prepare($utilityClassName::PRODUCT_BY_SKU_AND_TIMESTAMP);
    }

    /**
     * Return's the product with the passed SKU and for the also passed timestamp.
     *
     * @param string  $sku       The SKU of the product to return
     * @param integer $timestamp The timestamp to find the matching scheduled update
     *
     * @return array The product
     */
    public function findOneBySkuAndTimestamp($sku, $timestamp)
    {

        // load and return the product with the passed SKU and timestamp
        $this->productBySkuAndTimestampStmt->execute(array($timestamp, $sku));
        return $this->productBySkuAndTimestampStmt->fetch(\PDO::FETCH_ASSOC);
    }
}
