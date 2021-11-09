<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestProdStatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestProdStatusTable Test Case
 */
class RequestProdStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestProdStatusTable
     */
    public $RequestProdStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RequestProdStatus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RequestProdStatus') ? [] : ['className' => RequestProdStatusTable::class];
        $this->RequestProdStatus = TableRegistry::getTableLocator()->get('RequestProdStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestProdStatus);

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
