<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TableStatus;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TableStatus Test Case
 */
class TableStatusTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TableStatus
     */
    public $TableStatus;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Status') ? [] : ['className' => TableStatus::class];
        $this->TableStatus = TableRegistry::getTableLocator()->get('Status', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TableStatus);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
