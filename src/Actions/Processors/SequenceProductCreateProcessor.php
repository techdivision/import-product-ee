<?php

/**
 * TechDivision\Import\Product\Ee\Actions\Processors\SequenceProductCreateProcessor
 *
 * PHP version 7
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */

namespace TechDivision\Import\Product\Ee\Actions\Processors;

use TechDivision\Import\Product\Ee\Utils\SqlStatementKeys;
use TechDivision\Import\Dbal\Collection\Actions\Processors\AbstractBaseProcessor;

/**
 * The sequence product create processor implementation.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/wagnert/csv-import
 * @link      http://www.appserver.io
 */
class SequenceProductCreateProcessor extends AbstractBaseProcessor
{

    /**
     * Return's the array with the SQL statements that has to be prepared.
     *
     * @return array The SQL statements to be prepared
     */
    protected function getStatements()
    {

        // return the array with the SQL statements that has to be prepared
        return array(
            SqlStatementKeys::CREATE_SEQUENCE_PRODUCT => $this->loadStatement(SqlStatementKeys::CREATE_SEQUENCE_PRODUCT)
        );
    }

    /**
     * Persist's the passed row.
     *
     * @param array       $row                  The row to persist
     * @param string|null $name                 The name of the prepared statement that has to be executed
     * @param string|null $primaryKeyMemberName The primary key member name of the entity to use
     *
     * @return string The last inserted ID
     */
    public function execute($row, $name = null, $primaryKeyMemberName = null)
    {
        parent::execute($row, $name);
        return $this->getConnection()->lastInsertId();
    }
}
