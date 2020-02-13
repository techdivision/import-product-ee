<?php

/**
 * TechDivision\Import\Product\Ee\Utils\RmaKeysInterface
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

namespace TechDivision\Import\Product\Ee\Utils;

/**
 * Interface for utitlity implementations that provides RMA keys.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
interface RmaKeysInterface
{

    /**
     * Name for the member 'Returnable'.
     *
     * @var string
     */
    const RETURNABLE = 'Returnable';

    /**
     * Name for the member 'Not Returnable'.
     *
     * @var string
     */
    const NOT_RETURNABLE = 'Not Returnable';

    /**
     * Name for the member 'Use Config'.
     *
     * @var string
     */
    const USE_CONFIG = 'Use Config';

    /**
     * Return's the value for the passed key.
     *
     * @param string $key The key to return the value for
     *
     * @return int The value
     */
    public function get(string $key) : int;
}
