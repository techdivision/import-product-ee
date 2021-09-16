<?php

/**
 * TechDivision\Import\Product\Ee\Actions\SequenceProductActionTest
 *
 * PHP version 7
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-media
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Ee\Actions;

use PHPUnit\Framework\TestCase;
use TechDivision\Import\Dbal\Actions\Processors\ProcessorInterface;

/**
 * Test class for the sequence product action implementation.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   https://opensource.org/licenses/MIT
 * @link      https://github.com/techdivision/import-product-media
 * @link      http://www.techdivision.com
 */
class SequenceProductActionTest extends TestCase
{

    /**
     * Test's the create() method successfull.
     *
     * @return void
     */
    public function testCreateWithSuccess()
    {

        // create a create processor mock instance
        $mockCreateProcessor = $this->getMockBuilder($processorInterface = ProcessorInterface::class)
                                    ->setMethods(get_class_methods($processorInterface))
                                    ->getMock();
        $mockCreateProcessor->expects($this->once())
                            ->method('execute')
                            ->with($row = array())
                            ->willReturn(null);

        // create a mock for the sequence product action
        $mockAction = $this->getMockBuilder(SequenceProductAction::class)
                           ->setMethods(array('getCreateProcessor'))
                           ->getMock();
        $mockAction->expects($this->once())
                   ->method('getCreateProcessor')
                   ->willReturn($mockCreateProcessor);

        // test the create() method
        $this->assertNull($mockAction->create($row));
    }
}
