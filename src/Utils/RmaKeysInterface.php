<?php

/**
 * TechDivision\Import\Product\Ee\Utils\RmaKeysInterface
 *
 * PHP version 7
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Ee\Utils;

/**
 * Interface for utitlity implementations that provides RMA keys.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
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
     * Query's whether or not the passed key is valid or not.
     *
     * @param string $key The key to query for
     *
     * @return bool TRUE if the passed key is valid, else FALSE
     */
    public function isValid(string $key) : bool;

    /**
     * Return's the value for the passed key.
     *
     * @param string $key The key to return the value for
     *
     * @return int The value
     */
    public function get(string $key) : int;

    /**
     * Return all available keys.
     *
     * @return array The array with the available keys
     */
    public function getAll() : array;
}
