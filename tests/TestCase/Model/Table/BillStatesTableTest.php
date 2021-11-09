<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BillStatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BillStatesTable Test Case
 */
class BillStatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BillStatesTable
     */
    public $BillStates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BillStates',
        'app.Bills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BillStates') ? [] : ['className' => BillStatesTable::class];
        $this->BillStates = TableRegistry::getTableLocator()->get('BillStates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BillStates);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
