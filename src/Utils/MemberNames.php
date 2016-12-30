<?php

/**
 * TechDivision\Import\Product\Ee\Utils\MemberNames
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

namespace TechDivision\Import\Product\Ee\Utils;

/**
 * Utitlity class that provides entity member names.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-ee
 * @link      http://www.techdivision.com
 */
class MemberNames extends \TechDivision\Import\Product\Utils\MemberNames
{

    /**
     * Name for the member 'row_id'.
     *
     * @var string
     */
    const ROW_ID = 'row_id';

    /**
     * Name for the member 'created_in'.
     *
     * @var string
     */
    const CREATED_IN = 'created_in';

    /**
     * Name for the member 'updated_in'.
     *
     * @var string
     */
    const UPDATED_IN = 'updated_in';
}
