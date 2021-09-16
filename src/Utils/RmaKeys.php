<?php

/**
 * TechDivision\Import\Product\Ee\Utils\RmaKeys
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
 * Utitlity class that provides RMA keys.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2020 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class RmaKeys implements RmaKeysInterface
{

    /**
     * The available states for the 'is_returnable' colum.
     *
     * @var array
     */
    protected $returnable = array(
        RmaKeysInterface::NOT_RETURNABLE => 0,
        RmaKeysInterface::RETURNABLE     => 1,
        RmaKeysInterface::USE_CONFIG     => 2
    );

    /**
     * Query's whether or not the passed key is valid or not.
     *
     * @param string $key The key to query for
     *
     * @return bool TRUE if the passed key is valid, else FALSE
     */
    public function isValid(?string $key) : bool
    {
        return isset($this->returnable[$key]);
    }

    /**
     * Return's the value for the passed key.
     *
     * @param string $key The key to return the value for
     *
     * @return int The value
     */
    public function get(?string $key) : int
    {
        return isset($this->returnable[$key]) ? $this->returnable[$key] : $this->returnable[RmaKeysInterface::USE_CONFIG];
    }

    /**
     * Return all available keys.
     *
     * @return array The array with the available keys
     */
    public function getAll() : array
    {
        return $this->returnable;
    }
}
