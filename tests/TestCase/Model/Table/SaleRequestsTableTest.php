<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SaleRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SaleRequestsTable Test Case
 */
class SaleRequestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SaleRequestsTable
     */
    public $SaleRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SaleRequests',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SaleRequests') ? [] : ['className' => SaleRequestsTable::class];
        $this->SaleRequests = TableRegistry::getTableLocator()->get('SaleRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SaleRequests);

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
